<?php

namespace App\Http\Controllers\PropertyManagers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Models\Admin\Company\Paytab;
use App\Mail\DynamicEmail;
use App\Models\Admin\Email\EmailCategory;
use App\Models\Admin\Email\EmailContent;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Datatables;
use App\Models\Admin\Email\EmailSetting;
use App\Models\Admin\Email\TemplateBanner;
use Illuminate\Support\Facades\Auth;
use App\Models\CommonModel\Country;
use App\Models\CommonModel\State;
use App\Models\Admin\Company\Bank;
use App\Models\Admin\Company\Package;
use App\Models\Admin\Company\CompanyPackage;
use App\Models\Currency;
use App\Models\Admin\Email\BrandedEmail;
use App\Models\Notification;
use App\Models\Locations\LocationState;
use App\Models\Locations\Location;
class PropertyManagerController extends Controller
{
    //TODO: Loading Manage Company Index View
    public function index(Request $request)
    {
        
        $add_permission = CheckPermission(config('const.ADD'), config('const.MANAGECOMPANY'));
        $edit_permission = CheckPermission(config('const.EDIT'), config('const.MANAGECOMPANY'));
        $status_permission = CheckPermission(config('const.STATUS'), config('const.MANAGECOMPANY'));
        $delete_permission = CheckPermission(config('const.DELETE'), config('const.MANAGECOMPANY'));

        if($request->ajax())
        {
            $users = User::with(['users' => function($query){
                $query->withCount('transactions');
            }])->with('paytabs')->withCount('company_transactions')->where('user_role','!=',1)->orderBy('id', 'DESC')->get();
           //return $users;
            return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('company_name', function($users){
                return '
                <div class="d-flex align-items-center mb-0">
                <!--begin::Symbol-->
                <div class="symbol symbol-40 symbol-light-success mr-5">
                    <span class="symbol-label">
                        <img loading="lazy" src="'.url('storage/app').'/'.$users->avatar.'" class="h-75 align-self-end" alt="">
                    </span>
                </div>
                <!--end::Symbol-->
                <!--begin::Text-->
                <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                    <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">'.$users->company_name.'</a>
                </div>

                </div>
                ';
            })
            ->addColumn('status', function($users) use ($status_permission) {
               if($status_permission == 1)
               {
                if($users->is_active == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$users->id.'">
                    <input type="hidden" name="is_active" value="'.$users->is_active.'">
                    <a id="status" class="btn btn-icon btn-light btn-hover-success btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Active">
                    <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Unlock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <mask fill="white">
                                <use xlink:href="#path-1"/>
                            </mask>
                            <g/>
                            <path d="M15.6274517,4.55882251 L14.4693753,6.2959371 C13.9280401,5.51296885 13.0239252,5 12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L14,10 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C13.4280904,3 14.7163444,3.59871093 15.6274517,4.55882251 Z" fill="#000000"/>
                        </g>
                    </svg></span>
                    </a>
                    ';
                }
                else
                {
                    return '
                    <input type="hidden" name="id" value="'.$users->id.'">
                    <input type="hidden" name="is_active" value="'.$users->is_active.'">
                    <a id="status" class="btn btn-icon btn-light btn-hover-danger btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Deactivated">
                    <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Lock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <mask fill="white">
                            <use xlink:href="#path-1"/>
                        </mask>
                        <g/>
                        <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"/>
                    </g>
                    </svg></span>
                    </a>
                    ';
                }
               }
            })
            ->addColumn('action', function ($users) use($delete_permission, $edit_permission){
                if($delete_permission == 1 && $edit_permission == 1)
                {
                    return '
                <input type="hidden" name="id" value="'.$users->id.'">
                <input type="hidden" name="name" value="'.$users->name.'">
                <input type="hidden" name="email" value="'.$users->email.'">
                <input type="hidden" name="country" value="'.$users->country.'">
                <input type="hidden" name="password" value="'.$users->real_password.'">
                <input type="hidden" name="paytabs" value="'.json_encode($users->paytabs).'">
                <input type="hidden" name="users" value="'.json_encode($users->users).'">
                <p id="'.$users->id.'" class="d-none">'.$users->redirect_url.'</p>
                <a id="send_email" class="btn btn-icon btn-warning btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Send Registration Email">
                <span class="svg-icon svg-icon-md svg-icon-primary">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
                </a>
                 <a href="'.route("property-manager.edit", ["id" => $users->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
                 <span class="svg-icon svg-icon-md svg-icon-primary">
                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                    </g>
                    </svg>
                </span>
                </a>
                <a id="delete" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                <span class="svg-icon svg-icon-md svg-icon-danger">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                    </g>
                </svg>
                </span>
                </a>
                ';
                }
                elseif($edit_permission == 1)
                {
                    return '
                <input type="hidden" name="id" value="'.$users->id.'">
                <input type="hidden" name="name" value="'.$users->name.'">
                <input type="hidden" name="email" value="'.$users->email.'">
                <input type="hidden" name="country" value="'.$users->country.'">
                <input type="hidden" name="password" value="'.$users->real_password.'">
                <input type="hidden" name="paytabs" value="'.json_encode($users->paytabs).'">
                <input type="hidden" name="users" value="'.json_encode($users->users).'">
                <p id="'.$users->id.'" class="d-none">'.$users->redirect_url.'</p>
                <a id="send_email" class="btn btn-icon btn-warning btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Send Registration Email">
                <span class="svg-icon svg-icon-md svg-icon-primary">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
                </a>
                 <a href="'.route("property-manager.edit", ["id" => $users->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
                 <span class="svg-icon svg-icon-md svg-icon-primary">
                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                    </g>
                    </svg>
                </span>
                </a>
                ';
                }elseif($delete_permission == 1)
                {
                    return '
                <input type="hidden" name="id" value="'.$users->id.'">
                <input type="hidden" name="name" value="'.$users->name.'">
                <input type="hidden" name="email" value="'.$users->email.'">
                <input type="hidden" name="country" value="'.$users->country.'">
                <input type="hidden" name="password" value="'.$users->real_password.'">
                <input type="hidden" name="paytabs" value="'.json_encode($users->paytabs).'">
                <input type="hidden" name="users" value="'.json_encode($users->users).'">
                <p id="'.$users->id.'" class="d-none">'.$users->redirect_url.'</p>
                <a id="send_email" class="btn btn-icon btn-warning btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Send Registration Email">
                <span class="svg-icon svg-icon-md svg-icon-primary">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
                </a>
                <a id="delete" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                <span class="svg-icon svg-icon-md svg-icon-danger">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                    </g>
                </svg>
                </span>
                </a>
                ';
                }
            })
            ->rawColumns(['status', 'action', 'company_name'])
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }
        return view('property-managers.manage-companies.index', compact('add_permission'));
    }

    //TODO: Loading Create View
    public function create()
    {

        $states = LocationState::where(['location_country_id' => 1, 'lang_id' => 1])->get();
        return view('property-managers.manage-companies.create',compact('states'));
    }

    //TODO: Create Company Process
    public function create_process(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'designation' => 'required',
            'company_name' => 'required',
            'name' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()) return 'Cyber';

        //TODO: Checking if the user email or phone is already exist or not
        $checkEmail = User::where(['email' => $request->email, 'user_role' => 2])->first();
        $checkMobile = User::where(['mobile' => $request->mobile])->first();
        if(!is_null($checkEmail)) return 'email';
        if(!is_null($checkMobile)) return 'mobile';
        //TODO: Checking if the user email or phone is already exist or not
        // if(isset($request->sender_id_by_number))
        // {
        //     $checksender_id_by_number = User::where(['sender_id_by_number' => $request->sender_id_by_number, 'user_role' => 2])->first();
        //     if(!is_null($checksender_id_by_number)) return 'sender_id_by_number';
        // }

        //TODO: Checking if the user email or phone is already exist or not
        // if (isset($request->sender_id_by_name)) {
        //     $checksender_id_by_name = User::where(['sender_id_by_name' => $request->sender_id_by_name, 'user_role' => 2])->first();
        //     if (!is_null($checksender_id_by_name)) {
        //         return 'sender_id_by_name';
        //     }
        // }

        //TODO: Checking if the user email or phone is already exist or not
        // if (isset($request->secrate_key)) {
        //     $checksecrate_key = User::where(['secrate_key' => $request->secrate_key, 'user_role' => 2])->first();
        //     if (!is_null($checksecrate_key)) {
        //         return 'secrate_key';
        //     }
        // }

        //TODO: Checking if the user email or phone is already exist or not
        // if (isset($request->api_key)) {
        //     $checkapi_key = User::where(['api_key' => $request->api_key, 'user_role' => 2])->first();
        //     if (!is_null($checkapi_key)) {
        //         return 'api_key';
        //     }
        // }

        //TODO: Getting Email Template Data here
        $settings = EmailSetting::where('company_id', admin_company_id())->first();
        $banner = TemplateBanner::all();
        //TODO: Email Category data
        $email_cat = EmailCategory::where('id', 2)->first();
        $subject = $email_cat->email_subject;
        //TODO: Email Template Content
        // $checkIfEmailTemplate = EmailContent::where(['company_id' => admin_company_id(), 'email_category_id' => $email_cat->id])->first();
        // if(is_null($checkIfEmailTemplate)){
        //     return 'email_template';
        // }
        // else
        // {
        //     if($checkIfEmailTemplate->content == "") return 'email_template';
        // }

        //TODO: Creating New Company Here
        $companyData = $request->except('_token', 'image', 'withdraw_limit', 'bank_name', 'bic', 'account_name', 'iban', 'account_no', 'b_currency', 'status');
        if($request->hasFile('image'))
        {
            $companyData['avatar'] = $request->file('image')->store('UserImages','public');
        }
        $companyData['company_id'] = admin_company_id();
        $companyData['create_by'] = Auth::user()->id;
        $companyData['user_role'] = $request->user_type_id;
        $companyData['withdraw_limit'] = isset($request->withdraw_limit) ? $request->withdraw_limit : 0;
        $company = User::create($companyData);

        //TODO: Creating Banks Here
        if(isset($request->bank_name))
        {
            if($request->bank_name != "")
            {
                $bank_name = explode(',', $request->bank_name);
                $bic = explode(',', $request->bic);
                $account_name = explode(',', $request->account_name);
                $iban = explode(',', $request->iban);
                $account_no = explode(',', $request->account_no);
                $currency = explode(',', $request->b_currency);
                $status = explode(',', $request->status);

                for($i = 0; $i < count($bank_name); $i++)
                {
                    $bank = new Bank;
                    $bank->company_id = $company->id;
                    $bank->bank_name = $bank_name[$i];
                    $bank->bic = $bic[$i];
                    $bank->account_name = $account_name[$i];
                    $bank->iban = $iban[$i];
                    $bank->account_no = $account_no[$i];
                    $bank->currency = 'AED';
                    $bank->status = $status[$i];
                    $bank->save();
                }
            }
        }

        //replace template var with value
        // $token = array(
        //     'ClickHere'  => '<a href="'.route('portal.auth.index').'">click here</a>',
        //     'Name' => $request->name,
        //     'Email' => $request->email,
        //     'Password' => $request->password,
        // );
        // $pattern = '[%s]';
        // foreach($token as $key=>$val){
        //     $varMap[sprintf($pattern,$key)] = $val;
        // }

        // $details = [
        //     'settings' => $settings,
        //     'banner' => $banner,
        //     'content' => strtr($checkIfEmailTemplate->content,$varMap),
        // ];
        // $brand = BrandedEmail::where('company_id', Auth::user()->id)->first();

        // if(!is_null($brand))
        // {
        //     $brand_name = $brand->title;
        //     $brand_email = $brand->email;
        // }
        // else
        // {
        //     $brand_name = config('app.name');
        //     $brand_email = 'xyz@gmail.com';
        // }

        // $email = $request->email;
        // Mail::send('emails.dynamic_email', $details, function($message) use ($brand_name, $subject, $email, $brand_email) {
        //     $message->to($email)->subject($subject);
        //     $message->from($brand_email, $brand_name);
        //  });
        // Mail::to($request->email)->send(new DynamicEmail($details, $subject));
        return 'true';
    }

     //TODO: Send Email along with payment link
     public function send_email(Request $request)
     {
         // TODO: Validating the rquest params for better security
         $validator = Validator::make($request->all(), [
             'email' => 'email|required',
             'name' => 'required',
             'password' => 'required',
         ]);

         if($validator->fails()) return 'Cyber';

         //TODO: Sending Email
         $token = array(
            'ClickHere'  => '<a href="'.route('portal.auth.index').'">click here</a>',
            'Name' => $request->name,
            'Email' => $request->email,
            'Password' => $request->password,
        );
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }

         AdminSendEmail(Auth::user()->id, 2, $varMap, $request->email);
         return 'true';
     }
    //TODO: CHECKING UNIQUE BANK ACCOUNT NUMBER
    public function check_unique_bank_numbers(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required',
            'bic' => 'required',
            'account_name' => 'required',
            'iban' => 'required',
            'account_no' => 'required',
            'currency' => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()) return 'Cyber';


        //TODO: CHECKING IBAN ALREADY EXISTS OR NOT
        $checkIBAN = Bank::where(['iban' => $request->iban])->first();
        if(!is_null($checkIBAN)) return 'iban';

        return 'true';
    }

    //TODO: Create Bank
    public function create_bank(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required',
            'bic' => 'required',
            'account_name' => 'required',
            'iban' => 'required',
            'account_no' => 'required',
            'currency' => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()) return 'Cyber';


        //TODO: CHECKING IBAN ALREADY EXISTS OR NOT
        $checkIBAN = Bank::where(['iban' => $request->iban])->first();
        if(!is_null($checkIBAN)) return 'iban';
        $bank = new Bank;
        $bank->company_id = $request->company_id;
        $bank->bank_name = $request->bank_name;
        $bank->bic = $request->bic;
        $bank->account_name = $request->account_name;
        $bank->iban = $request->iban;
        $bank->account_no = $request->account_no;
        $bank->currency = $request->currency;
        $bank->status = $request->status;
        $bank->save();

        //TODO: Creating Notification
        $noti = new Notification;
        $noti->to = $request->company_id;
        $noti->from = Auth::user()->id;
        $noti->row_id = $bank->id;
        $noti->link = '/portal/profile/bank-details';
        $noti->type = 'Created New Bank';
        $noti->save();

        //TODO: Getting Company Data From Users Table
        $company = User::where('id', $request->company_id)->first();
        if($request->status == 0)
        {
            $status = 'Under Review';
        }
        elseif($request->status == 1)
        {
            $status = 'Approved';
        }elseif($request->status == 2)
        {
            $status = 'Rejected';
        }
        //replace template var with value
        $token = array(
            'Name'  => $company->name,
            'BankName' => $request->bank_name,
            'BIC/SWIFT' => $request->bic,
            'BankAccountName' => $request->account_name,
            'IBAN' => $request->iban,
            'BankAccountNumber' => $request->account_no,
            'BankStatus' => $status,
            'Currency' => $request->currency,
        );
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }

        AdminSendEmail(Auth::user()->id, 11, $varMap, $company->email);

        return $bank->id;
    }

    //TODO: Edit Bank
    public function update_bank(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required',
            'bic' => 'required',
            'account_name' => 'required',
            'iban' => 'required',
            'account_no' => 'required',
            'currency' => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()) return 'Cyber';


        //TODO: CHECKING IBAN ALREADY EXISTS OR NOT
        $checkIBAN = Bank::where(['iban' => $request->iban])->first();
        if(!is_null($checkIBAN))
        {
            if($checkIBAN->id != $request->id) return 'iban';
        }
        $bank = Bank::find($request->id);
        $bank->bank_name = $request->bank_name;
        $bank->bic = $request->bic;
        $bank->account_name = $request->account_name;
        $bank->iban = $request->iban;
        $bank->account_no = $request->account_no;
        $bank->currency = $request->currency;
        $bank->status = $request->status;
        $bank->reason = isset($request->reason) ? $request->reason : '';
        $bank->update();

        //TODO: Creating Notification
        $noti = new Notification;
        $noti->to = $request->company_id;
        $noti->from = Auth::user()->id;
        $noti->row_id = $bank->id;
        $noti->link = '/portal/profile/bank-details';
        $noti->type = 'Bank status updated';
        $noti->save();

        //TODO: Getting Company Data From Users Table
        $company = User::where('id', $request->company_id)->first();

        if($request->status == 0)
        {
            $status = 'Under Review';
        }
        elseif($request->status == 1)
        {
            $status = 'Approved';
        }elseif($request->status == 2)
        {
            $status = 'Rejected';
        }

        //replace template var with value
        $token = array(
            'Name'  => $company->name,
            'Reason' => $request->status == 2 ? 'Due to ' . $request->reason : '',
            'BankName' => $request->bank_name,
            'BIC/SWIFT' => $request->bic,
            'BankAccountName' => $request->account_name,
            'IBAN' => $request->iban,
            'BankAccountNumber' => $request->account_no,
            'BankStatus' => $status,
            'Currency' => $request->currency,
        );
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }

        AdminSendEmail(Auth::user()->id, 10, $varMap, $company->email);

        return "true";
    }

    //TODO: DELETE BANK
    public function delete_bank(Request $request)
    {
        BANK::where('id', $request->id)->delete();
    }

    //TODO: Loading Create View
    public function edit($id, $row_id = null, $noti_id = null)
    {
        if(!empty($noti_id))
        {
            change_noti_status($noti_id);
        }
        $company = User::with('company_packages')->with('banks')->where('id', $id)->first();
        $states = LocationState::where(['location_country_id' => 1, 'lang_id' => 1])->get();
        $locations = Location::where(['location_id' => 0,'lang_id' => 1])->get();
        return view('property-managers.manage-companies.edit', compact('company', 'states', 'row_id','locations'));
    }

    //TODO: Update Company
    public function update(Request $request)
    {
        //return $request->all();
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'designation' => 'required',
            'company_name' => 'required',
            'name' => 'required'
        ]);
        if($validator->fails()) return 'Cyber';

        //TODO: Checking if the user email or phone is already exist or not
        $checkEmail = User::where(['email' => $request->email, 'user_role' => 2])->first();
        $checkMobile = User::where(['mobile' => $request->mobile])->first();
        if(!is_null($checkEmail))
        {
            if($checkEmail->id != $request->company_id) return 'email';
        }
        //TODO:CHECK MOBILE NUMBER//
        if(!is_null($checkMobile))
        {
            if($checkMobile->id != $request->company_id) return 'mobile';
        }
        //TODO: Checking if the user email or phone is already exist or not
        // if (isset($request->sender_id_by_number)) {
        //     $checksender_id_by_number = User::where(['sender_id_by_number' => $request->sender_id_by_number, 'user_role' => 2])->first();
        //     if (!is_null($checksender_id_by_number)) {
        //         if ($checksender_id_by_number->id != $request->company_id) {
        //             return 'sender_id_by_number';
        //         };
        //     }
        // }
        //TODO: Checking if the user email or phone is already exist or not
        // if (isset($request->sender_id_by_name)) {
        //     $checksender_id_by_name = User::where(['sender_id_by_name' => $request->sender_id_by_name, 'user_role' => 2])->first();
        //     if (!is_null($checksender_id_by_name)) {
        //         if ($checksender_id_by_name->id != $request->company_id) {
        //             return 'sender_id_by_name';
        //         };
        //     }
        // }
        //TODO: Checking if the user email or phone is already exist or not
        // if (isset($request->secrate_key)) {
        //     $checksecrate_key = User::where(['secrate_key' => $request->secrate_key, 'user_role' => 2])->first();
        //     if (!is_null($checksecrate_key)) {
        //         if ($checksecrate_key->id != $request->company_id) {
        //             return 'secrate_key';
        //         };
        //     }
        // }
        //TODO: Checking if the user email or phone is already exist or not
        // if (isset($request->api_key)) {
        //     $checkapi_key = User::where(['api_key' => $request->api_key, 'user_role' => 2])->first();
        //     if (!is_null($checkapi_key)) {
        //         if ($checkapi_key->id != $request->company_id) {
        //             return 'api_key';
        //         };
        //     }
        // }
        //Getting Company Data Here
        $company_old_data = User::where('id', $request->company_id)->first();
        //Creating New Company Here
        $companyData = $request->except('_token','image','withdraw_charges','company_package_id','tax','american_tax','package_id','charge', 'paytab_id', 'company_id', 'profile_id', 'server_key', 'currency', 'account_type');
        $companyData['company_id'] = Auth::user()->id;
        if($request->hasFile('image'))
        {
            $companyData['avatar'] = $request->file('image')->store('UserImages','public');
        }
        $companyData['modify_by'] = Auth::user()->id;

        $company = User::where('id', $request->company_id)->update($companyData);

        return 'true';
    }

    //TODO: Changing the is_active status
    public function is_active(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'is_active' => 'required',
        ]);

        if($validator->fails()) return 'Cyber';

        if($request->is_active == 1)
        {
            User::where('id', $request->id)->update(['is_active' => 0, 'modify_by' => Auth::user()->id]);
        }
        else
        {
            User::where('id', $request->id)->update(['is_active' => 1, 'modify_by' => Auth::user()->id]);
        }
    }

    //TODO: Delete Company
    public function Delete(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if($validator->fails()) return 'Cyber';
        User::where('id', $request->id)->delete();
        Notification::where('from', $request->id)->delete();
        Notification::where('to', $request->id)->delete();

    }

    //TODO: Get States Against Country
    public function get_states(Request $request)
    {
        $states = State::where('country_val', $request->country)->get();
        $zip = Country::where('val', $request->country)->pluck('zip')->first();

        return json_encode(['state_count' => count($states), 'states' => $states, 'zip' => $zip]);

    }

    //TODO: Get Package Details
    public function get_package(Request $request)
    {
        $pkg = Package::where('id', $request->package_id)->first();
        $html = '';

            $html .= "
            <div class='row'>
            <div class='col-md-6 col-lg-6 mb-2'>
            <label>Visa/Master Transaction Charges</label>
            <input type='number' id='tax'  class='form-control' value='".$pkg->tax."'/>
            <span class='text-danger' id='tax_error'></span>
            </div>
            <div class='col-md-6 col-lg-6 mb-2'>
            <label>American Express Transaction Charges</label>
            <input type='number' id='american_tax'   class='form-control' value='".$pkg->american_tax."'/>
            <span class='text-danger' id='american_tax_error'></span>
            </div>
            <div class='col-md-6 col-lg-6'>
            <label>Fixed Cost</label>
            <input type='number' id='charge'  class='form-control' value='".$pkg->charge."'/>
            <span class='text-danger' id='charge_error'></span>
            </div>
            <div class='col-md-6 col-lg-6'>
            <label>Withdrawal Charges</label>
            <input type='number' id='withdraw_charges'  class='form-control' value='".$pkg->withdraw_charges."'/>
            <span class='text-danger' id='withdraw_charges_error'></span>
            </div>
            </div>
            ";


        return $html;
    }
}
