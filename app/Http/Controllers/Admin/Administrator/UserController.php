<?php

namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\CommonModel\Country;
use App\Models\Administrator\UserRole;

class UserController extends Controller
{
    //Loading Manage User Controller
    public function index(Request $request)
    {
    $add_permission = CheckPermission(config('const.ADD'), config('const.MANAGEUSER'));
        $edit_permission = CheckPermission(config('const.EDIT'), config('const.MANAGEUSER'));
        $status_permission = CheckPermission(config('const.STATUS'), config('const.MANAGEUSER'));
        $delete_permission = CheckPermission(config('const.DELETE'), config('const.MANAGEUSER'));
        if($request->ajax())
        {
            if(CheckUseRole() == 1 || CheckUseRole() == 2)
            {
                $users = User::with('user_roles')->where(['company_id' => admin_company_id()])->where('user_role', 0)->orderBy('id', 'DESC')->get();
            }
            else
            {
                $users = User::with('user_roles')->where(['company_id' => admin_company_id()])->where('id', '!=', Auth::user()->id)->where('role_id', 5)->orderBy('id', 'DESC')->get();
            }
            return Datatables::of($users)
            ->addIndexColumn()
            ->editColumn('id', 'ID: {{$id}}')
            ->addColumn('status', function($users) use($status_permission){
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
            ->addColumn('action', function ($users) use($delete_permission, $edit_permission) {
                if($delete_permission == 1 && $edit_permission == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$users->id.'">
                    <input type="hidden" name="name" value="'.$users->name.'">
                    <input type="hidden" name="phone" value="'.$users->phone.'">
                    <input type="hidden" name="email" value="'.$users->email.'">
                    <input type="hidden" name="country" value="'.$users->country.'">
                    <input type="hidden" name="password" value="'.$users->real_password.'">
                    <input type="hidden" name="role" value="'.$users->user_roles->name.'">
                    <a id="send_email" class="btn btn-icon btn-warning btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Send Registration Email">
                    <span class="svg-icon svg-icon-md svg-icon-primary">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    </a>
                    <a href="'.route("admin.administrator.manage-users.edit", ['id' => $users->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="tooltip" data-theme="dark" title="Edit">
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
                }elseif($edit_permission == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$users->id.'">
                    <input type="hidden" name="name" value="'.$users->name.'">
                    <input type="hidden" name="phone" value="'.$users->phone.'">
                    <input type="hidden" name="email" value="'.$users->email.'">
                    <input type="hidden" name="country" value="'.$users->country.'">
                    <input type="hidden" name="password" value="'.$users->real_password.'">
                    <input type="hidden" name="role" value="'.$users->user_roles->name.'">
                    <a id="send_email" class="btn btn-icon btn-warning btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Send Registration Email">
                    <span class="svg-icon svg-icon-md svg-icon-primary">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    </a>
                    <a href="'.route("admin.administrator.manage-users.edit", ['id' => $users->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="tooltip" data-theme="dark" title="Edit">
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
                }
                elseif($delete_permission == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$users->id.'">
                    <input type="hidden" name="name" value="'.$users->name.'">
                    <input type="hidden" name="phone" value="'.$users->phone.'">
                    <input type="hidden" name="email" value="'.$users->email.'">
                    <input type="hidden" name="country" value="'.$users->country.'">
                    <input type="hidden" name="password" value="'.$users->real_password.'">
                    <input type="hidden" name="role" value="'.$users->user_roles->name.'">
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
            ->rawColumns(['status', 'action'])
            ->make(true);
        }
        return view('admin.administrator.manage-users.index', compact('add_permission'));
    }

    //Loading Create User view
    public function create(Request $request)
    {
        $countries = Country::all();
        $roles = UserRole::orderBy('id', 'ASC')->where('company_id', admin_company_id())->orWhere('is_admin',1)->get();
        return view('admin.administrator.manage-users.create', compact('countries', 'roles'));
    }

    //For Create Process
    public function create_process(Request $request)
    {
        $checkEmail = User::where(['email' => $request->email])->first();

        if(!is_null($checkEmail)) return 'email';

        $user = $request->except('_token');
        $user['company_id'] = admin_company_id();
        $user['create_by'] = Auth::user()->id;
        User::create($user);

        $role = UserRole::where('id', $request->role_id)->first();
        $company = User::where('id', admin_company_id())->first();


        $token = array(
            'Name'  => $request->name,
            'Designation' => $role->name,
            'CompanyName' => $company->company_name,
            'Email' => $request->email,
            'Password' => $request->real_password,
            'ClickHere'  => '<a href="'.route('admin.auth.index').'">click here</a>',
        );
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }

        AdminSendEmail(Auth::user()->id, 21, $varMap, $request->email);
        return 'true';

    }


    //TODO: Edit Customer Controller
    public function edit($id)
    {
        $customer = User::where('id', $id)->first();
        $countries = Country::all();
        $roles = UserRole::orderBy('id', 'ASC')->where('company_id', admin_company_id())->orWhere('is_admin',1)->get();
        return view('admin.administrator.manage-users.edit', compact('customer', 'countries', 'roles'));
    }

    //For Create Process
    public function update(Request $request)
    {
        $checkEmail = User::where(['email' => $request->email, 'company_id' => admin_company_id()])->where('user_role', 0)->first();

        if(!is_null($checkEmail)){
            if($checkEmail->id != $request->id)
            {
                return 'email';
            }
        }

        $user = $request->except('_token');
        $user['modify_by'] = Auth::user()->id;
        User::where('id', $request->id)->update($user);

        return 'true';

    }

    public function send_email(Request $request)
    {

        $user = User::where('id', $request->id)->first();
        $company = User::where('id', $user->company_id)->first();

        $token = array(
            'Name'  => $request->name,
            'Designation' => $request->tole,
            'CompanyName' => $company->company_name,
            'Email' => $request->email,
            'Password' => $request->real_password,
            'ClickHere'  => '<a href="'.route('admin.auth.index').'">click here</a>',
        );
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }

        AdminSendEmail(Auth::user()->id, 21, $varMap, $request->email);

        return 'true';
    }

}
