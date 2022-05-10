<?php

namespace App\Http\Controllers\Admin\Paylinks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Yajra\Datatables\Datatables;
use App\Models\Admin\Paylinks\Transaction;
use App\Models\Admin\Company\Paytab;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Email\EmailSetting;
use App\Models\Admin\Email\TemplateBanner;
use App\Models\Admin\Accounts\Invoice;
use App\Models\Admin\Paylinks\Trash;
use App\Models\Currency;
use Validator;
use App\Models\CommonModel\Country;

class GeneratePayamentLinkController extends Controller
{
    //TODO: Loading Generate Payment Link index view
    public function index(Request $request)
    {

        if($request->ajax())
        {
            $transactions = Transaction::with(['users' => function($query){
                $query->where('customer_from',1);
            }])->where(['company_id' => Auth::user()->id, 'is_delete' => 0])->where('type', '!=', 3)->where('type', '!=', 4)->orderBy('id', 'DESC')->get();
            return Datatables::of($transactions)
            ->addIndexColumn()
            ->addColumn('status', function ($transactions) {

                if($transactions->status == 'A')
                {
                    return '<span class="label label-success mr-2" data-toggle="tooltip" title="Authorized">A</span>';
                }
                elseif($transactions->status == 'H')
                {
                    return '<span class="label label-warning mr-2" data-toggle="tooltip" title="Hold">H</span>';
                }
                elseif($transactions->status == 'V')
                {
                    return '<span class="label label-primary mr-2" data-toggle="tooltip" title="Voided">V</span>';
                }
                elseif($transactions->status == 'E')
                {
                    return '<span class="label label-danger mr-2" data-toggle="tooltip" title="Error">E</span>';
                }
                elseif($transactions->status == 'D')
                {
                    return '<span class="label label-danger mr-2" data-toggle="tooltip" title="Decline">D</span>';
                }
                elseif($transactions->status == '')
                {
                    return '<span class="label label-danger mr-2" data-toggle="tooltip" title="Waiting">W</span>';
                }
            })
            ->addColumn('action', function ($transactions) {

                if($transactions->status == 'A' &&  $transactions->tran_type == 'auth'){
                    return '<a id="charge"  class="btn btn-icon btn-success btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Charge">
                    <input type="hidden" name="id" value="'.$transactions->id.'">
                    <input type="hidden" name="name" value="'.$transactions->users->name.'">
                    <input type="hidden" name="phone" value="'.$transactions->users->phone.'">
                    <input type="hidden" name="email" value="'.$transactions->users->email.'">
                    <input type="hidden" name="country" value="'.$transactions->users->country.'">
                    <input type="hidden" name="token" value="'.$transactions->token.'">
                    <input type="hidden" name="tran_ref" value="'.$transactions->tran_ref.'">
                    <span class="svg-icon svg-icon-md svg-icon-primary">
                    <i class="fa fa-money"></i>
                    </span>
                    </a>';
                }else if($transactions->token == "" && $transactions->type == 1)
                {
                    return '
                <input type="hidden" name="id" value="'.$transactions->id.'">
                <input type="hidden" name="name" value="'.$transactions->users->name.'">
                <input type="hidden" name="phone" value="'.$transactions->users->phone.'">
                <input type="hidden" name="email" value="'.$transactions->users->email.'">
                <input type="hidden" name="country" value="'.$transactions->users->country.'">
                <input type="hidden" name="link" value="'.$transactions->redirect_url.'">
                <p id="'.$transactions->id.'" class="d-none">'.$transactions->redirect_url.'</p>
                <a id="copy" onclick="copyToClipboard('.$transactions->id.')" class="btn btn-icon btn-info btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Copy Link">
                <span class="svg-icon svg-icon-md svg-icon-primary">
                <i class="fas fa-copy"></i>
                </span>
                </a>
                <a href="https://wa.me/'.$transactions->users->phone.'?text='.$transactions->users->redirect_url.'" target="_blank" class="btn btn-icon btn-success btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Whatsapp">
                <span class="svg-icon svg-icon-md svg-icon-success">
                <i class="fa fa-whatsapp" aria-hidden="true"></i>
                </span>
                </a>
                <a id="message" class="btn btn-icon btn-primary btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="SMS">
                <span class="svg-icon svg-icon-md svg-icon-primary">
                <i class="fas fa-sms"></i>
                </span>
                </a>
                <a id="send_email" class="btn btn-icon btn-warning btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Email">
                <span class="svg-icon svg-icon-md svg-icon-primary">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
                </a>
                <a id="delete" class="btn btn-icon btn-danger btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                <span class="svg-icon svg-icon-md svg-icon-light">
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
                else
                {
                    return 'Payment Charged';
                }


            })
            ->editColumn('id', 'ID: {{$id}}')
            ->rawColumns(['status', 'account_type', 'action'])
            ->make(true);
        }

        return view('admin.paylinks.GeneratePaymentLinks.index');
    }

    //TODO: Loading Create Generate Payment Link index view
    public function create()
    {
        $paytab = Paytab::where(['active' => 1, 'company_id' => Auth::user()->id])->first();
        $countries = Country::all();
        return view('admin.paylinks.GeneratePaymentLinks.create', compact('paytab', 'countries'));
    }

    //TODO: Creating New Customer To Paytabs and getting the link
    public function create_payment_link(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'name' => 'required',
            'phone' => 'required',
            'amount' => 'required',
            'street1' => 'required',
        ]);
        if($validator->fails()) return 'Cyber';

        //TODO: Getting Active Paytabs Account Details Of Company From Paytabs Table
        $paytab = Paytab::where(['active' => 1, 'company_id' => Auth::user()->id])->first();
        $pay = explode('-', $paytab->cart_id);
        //TODO: Getting last transaction id by company_id from transactions table
        $latest_transaction = Transaction::where('company_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
        if(is_null($latest_transaction))
        {
            $tran_id = 1;
        }
        else
        {
            $tran_id = $latest_transaction->tran_id + 1;
        }

        $cart_id = $pay[0] .'-'. ($pay[1] + $tran_id);
        //TODO: Sending Array to Paytabs for creating new user and payment link
        $customer_data = $request->except('_token, amount');
        $customer_data['ip'] = $request->ip();
        $data['profile_id'] = $paytab->profile_id;
        $data['tran_type'] = "sale";
        $data['tran_class'] = "ecom";
        $data['tokenise'] = "2";
        $data['cart_id'] = $cart_id;
        $data['cart_currency'] = $paytab->currency;
        $data['cart_amount'] = $request->amount;
        $data['cart_description'] = isset($request->description) ? $request->description : "Payment with tok enabled, save card enabled";
        $data['show_save_card'] = false;
        $data['customer_details'] = $customer_data;
        $data['callback'] = CallbackLink(Auth::user()->id);
        $data['return'] = ReturnCallbackLink(Auth::user()->id);
        $data['hide_shipping'] = true;
        $response = generate_link($data, $paytab->server_key);

        //Returning Error if api response is not valid
        if(!isset($response['redirect_url']))
        {
            return 'api_error';
        }

        //TODO: Checking Customer against this company_id exist or not
        $checkCustomer = User::where(['email' => $request->email, 'company_id' => Auth::user()->id, 'customer_from' => 1])->first();
        //TODO: Customer Array
        $customer = $request->except('_token', 'street1', 'amount', 'description');
        $customer['address'] = $request->street1;
        $customer['redirect_url'] = $response['redirect_url'];
        $customer['tran_ref'] = $response['tran_ref'];
        $customer['company_id'] = Auth::user()->id;
        $customer['is_active'] = 1;
        $customer['is_verified'] = 1;
        $customer['customer_from'] = 1;
        $customer['user_role'] = 3;
        //TODO: If Check Customer Data Not Found The Created New Customer else Update The Customer
        if(is_null($checkCustomer))
        {
            $user = User::create($customer);
            //TODO: Getting Latest Inserted User Id For Transaction Table
            $user_id = $user->id;
        }
        else
        {
            $user = User::where('id', $checkCustomer->id)->update($customer);
            //TODO: Getting User Id For Transaction Table
            $user_id = $checkCustomer->id;
        }

        //TODO: Array To Create New Transaction
        $transaction['company_id'] = Auth::user()->id;
        $transaction['user_id'] = $user_id;
        $transaction['redirect_url'] = $response['redirect_url'];
        $transaction['tran_ref'] = $response['tran_ref'];
        $transaction['tran_id'] = $tran_id;
        $transaction['cart_amount'] = $request->amount;
        $transaction['type'] = 1;
        $transaction['payment_method'] = 'Visa';
        $transaction['tran_type'] = "sale";
        $transaction['currency'] = $paytab->currency;
        $transaction['cart_id'] = $data['cart_id'];
        $transaction['account_type'] = $paytab->type;
        $transaction['description'] = isset($request->description) ? $request->description : "Payment with tok enabled, save card enabled";
        $transaction = Transaction::create($transaction);

        //TODO: Sending Email Here

        //replace template var with value
        $token = array(
            'PaymentLinkButton'  => '<a href="'.$response['redirect_url'].'"><button  class="btn btn-danger">Payment Link</button></a>',
            'CustomerName' => $request->name,
            'Amount' => $request->amount,
            'Description' => isset($request->description) ? $request->description : "Payment with tok enabled, save card enabled",
        );
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }

        AdminSendEmail(Auth::user()->id, 3, $varMap, $request->email);
        return $response['redirect_url'];
    }

    public function return_callback($string, Request $request)
    {
        // return $request->all();
        $company_id = base64_decode($string);
        $checkCompanyExistoOrNot = User::where('id', $company_id)->first();
        //TODO: Checking the URL is exits or not
        if(!is_null($checkCompanyExistoOrNot))
        {
                //TODO: Checking checking if the paytabs response is exits or not
            if(isset($request->customerEmail))
            {
                //TODO: Checking if the payment is successfull or not
                if($request->respStatus == 'A' || $request->respStatus == 'H')
                {
                        return view('admin.errors.200');
                }
                else
                {
                   //TODO: Showing error message if payment not successfully done
                    $message = $request->respMessage;
                    return view('admin.errors.414', compact('message'));
                }

            }
            else
            {
                //TODO: Showing error message if payment parameters not found
                return view('admin.errors.404');
            }
        }
        else
        {
            //TODO: Showing error message if url not found
            return view('admin.errors.404');
        }


    }

    public function callback($string, Request $request)
    {
        $company_id = base64_decode($string);
        try
        {
            $checkCompanyExistoOrNot = User::where('id', $company_id)->first();

        //TODO: Checking If Respone is Returning or not
        if(isset($request['customer_details']['email']))
        {
            SaveTrash($company_id, $request->tran_ref ,json_encode($request->all()), '');
            $tran = Transaction::where(['cart_id' => $request['cart_id']])->orderBy('id', 'ASC')->limit(1)->first();
            //Getting Company Id By Decodeing Callback URL Link
            $user = User::where('id', $tran->user_id)->first();
            //Checking Transaction Referance Is Unique Or Not
            if(is_null($tran))
            {
                    //TODO: Create New User
                    $new_user = New User;
                    $new_user->city = $request['customer_details']['city'];
                    $new_user->country = $request['customer_details']['country'];
                    $new_user->email = $request['customer_details']['email'];
                    $new_user->ip = $request['customer_details']['ip'];
                    $new_user->name = $request['customer_details']['name'];
                    $new_user->phone = isset($request['customer_details']['phone']) ? $request['customer_details']['phone'] : '';
                    $new_user->state = $request['customer_details']['state'];
                    $new_user->address = $request['customer_details']['street1'];
                    $new_user->tran_ref = $request->tran_ref;
                    $new_user->token = isset($request->token) ? $request->token : '';
                    $new_user->payment_status = 1;
                    $new_user->user_role = 3;
                    $new_user->company_id = $company_id;
                    $new_user->save();
                    //TODO: Getting Conversion Rate Here
                    $conversion_rate = Currency::where('from_currency', $request->cart_currency)->pluck('rate')->first();
                    // //TODO: Create New Transaction
                    $new_transaction = new Transaction;
                    $new_transaction->user_id = $new_user->id;
                    $new_transaction->company_id = $company_id;
                    $new_transaction->resp_msg = $request['payment_result']['response_message'];
                    $new_transaction->resp_code = $request['payment_result']['response_code'];
                    $new_transaction->payment_method = $request['payment_info']['payment_method'];
                    $new_transaction->card_type = $request['payment_info']['card_type'];
                    $new_transaction->card_scheme = $request['payment_info']['card_scheme'];
                    //TODO: Getting last transaction by company_id from transactions table
                    $tran_id = '';
                    $latest_transaction = Transaction::where('company_id', $company_id)->orderBy('id', 'DESC')->first();
                    $company = User::where('id', $company_id)->first();
                    if(is_null($latest_transaction))
                    {
                        $tran_id = 1;
                    }
                    else
                    {
                        $tran_id = $latest_transaction->tran_id + 1;
                    }
                    $new_transaction->tran_id = $tran_id;
                    $new_transaction->tran_ref = $request->tran_ref;
                    $new_transaction->token = $request->token;
                    $new_transaction->cart_amount = $request->cart_amount;
                    $new_transaction->tran_count = $request->cart_amount;
                    $new_transaction->conversion_rate = $conversion_rate;
                    $new_transaction->conversion_amount = $request->cart_amount * $conversion_rate;
                    $new_transaction->transferable_amount = $request->cart_amount * $conversion_rate;
                    $new_transaction->cart_id = $request->cart_id;
                    $new_transaction->currency = $request->cart_currency;
                    $new_transaction->description = $request->cart_description;
                    $new_transaction->tran_type = strtolower($request['tran_type']);
                    $new_transaction->payment_date = date('Y-m-d');
                    $new_transaction->tran_time = date(' H:i');
                    $new_transaction->status = $request['payment_result']['response_status'];
                    $new_transaction->account_type = 1;
                    $new_transaction->resource = 2;
                    $new_transaction->type = 3;
                    $new_transaction->save();


                    if ($request['payment_result']['response_status'] == 'A' || $request['payment_result']['response_status'] == 'H') {

                    //TODO: Sending Email HERE

                        //replace template var with value
                        $token = array(
                            'CompanyName'  => $company->company_name,
                            'CompanyPhone' => $company->phone,
                            'CompanyEmail' => $company->email,
                            'Amount' => $request->cart_amount,
                            'Currency' => $request->cart_currency,
                            'Name' => $request['customer_details']['name'],
                            'Email' => $request['customer_details']['email'],
                            'DateTime' => date('Y-m-d') .' '. date(' H:i'),
                            'TranRef' => $request['tran_ref'],
                        );
                        $pattern = '[%s]';
                        foreach ($token as $key=>$val) {
                            $varMap[sprintf($pattern, $key)] = $val;
                        }

                        CompanySendEmail($company_id, 5, $varMap, $request['customer_details']['email']);
                        CompanySendEmail($company_id, 5, $varMap, $company->email);
                    }
                    elseif($request['payment_result']['response_status'] == 'D')
                    {
                             $token = array(
                                 'Name'  => $request['customer_details']['name'],
                                 'CartAmount' => $request->cart_amount,
                                 'Reason' => $request['payment_result']['response_message'],
                             );
                             $pattern = '[%s]';
                             foreach($token as $key=>$val){
                                 $varMap[sprintf($pattern,$key)] = $val;
                             }

                             CompanySendEmail($company_id, 23, $varMap, $request['customer_details']['email']);

                    }
            }
            else
            {
                 //TODO: Code For Generate Link Payment Response
                 if($tran->created_at->eq($tran->updated_at) && $tran->status == "")
                 {
                    if(isset($request['shipping_details']))
                    {
                            //TODO: Updating The Transaction Here
                            Transaction::where(['id' => $tran->id])->update(
                                [
                                'tran_ref' => $request['tran_ref'],
                                'token' => isset($request['token']) ? $request['token'] : '',
                                'payment_date' => date('Y-m-d'),
                                'tran_time' => date(' H:i'),
                                'resp_msg' => $request['payment_result']['response_message'],
                                'resp_code' => $request['payment_result']['response_code'],
                                'status' => $request['payment_result']['response_status'],
                                'payment_method' => $request['payment_info']['payment_method'],
                                'card_type' => $request['payment_info']['card_type'],
                                'card_scheme' => $request['payment_info']['card_scheme'],
                                ]);
                            //TODO: Getting Updated Transaction
                            $up_transaction = Transaction::where('id',$tran->id)->first();
                                //TODO: Updating The User Here
                                $UserToUpdate = User::find($tran->user_id);
                                $UserToUpdate->payment_status = 1;
                                $UserToUpdate->update();

                                //TODO: Sending Email to Company And User
                                //replace template var with value
                                $token = array(
                                    'CompanyName'  => $checkCompanyExistoOrNot->company_name,
                                    'CompanyPhone' => $checkCompanyExistoOrNot->phone,
                                    'CompanyEmail' => $checkCompanyExistoOrNot->email,
                                    'Amount' => $up_transaction->cart_amount,
                                    'Currency' => $up_transaction->currency,
                                    'Name' => $user->name,
                                    'Email' => $user->email,
                                    'DateTime' => date('Y-m-d') .' '. date(' H:i'),
                                    'TranRef' => $request['tran_ref'],
                                );
                                $pattern = '[%s]';
                                foreach($token as $key=>$val){
                                    $varMap[sprintf($pattern,$key)] = $val;
                                }

                        if ($request['payment_result']['response_status'] == 'A' || $request['payment_result']['response_status'] == 'H') {
                            CompanySendEmail($company_id, 5, $varMap, $request['customer_details']['email']);
                            CompanySendEmail(1, 5, $varMap, $checkCompanyExistoOrNot->email);
                        }
                        elseif($request['payment_result']['response_status'] == 'D')
                        {
                                $token = array(
                                    'Name'  => $request['customer_details']['name'],
                                    'CartAmount' => $request->cart_amount,
                                    'Reason' => $request['payment_result']['response_message'],
                                );
                                $pattern = '[%s]';
                                foreach($token as $key=>$val){
                                    $varMap[sprintf($pattern,$key)] = $val;
                                }

                                CompanySendEmail($company_id, 23, $varMap, $request['customer_details']['email']);

                        }

                    }
                 }elseif((!$tran->created_at->eq($tran->updated_at) && $request['payment_result']['response_status'] == 'A') || (!$tran->created_at->eq($tran->updated_at) && $request['payment_result']['response_status'] == 'D') || (!$tran->created_at->eq($tran->updated_at) && $request['payment_result']['response_status'] == 'A'))
                 {
                    //TODO: Getting Conversion Rate Here
                    $conversion_rate = Currency::where('from_currency', $request->cart_currency)->pluck('rate')->first();
                    // //TODO: Create New Transaction
                    $new_transaction = new Transaction;
                    $new_transaction->user_id = $tran->user_id;
                    $new_transaction->company_id = $company_id;
                    $new_transaction->resp_msg = $request['payment_result']['response_message'];
                    $new_transaction->resp_code = $request['payment_result']['response_code'];
                    $new_transaction->payment_method = $request['payment_info']['payment_method'];
                    $new_transaction->card_type = $request['payment_info']['card_type'];
                    $new_transaction->card_scheme = $request['payment_info']['card_scheme'];
                    //TODO: Getting last transaction by company_id from transactions table
                    $latest_transaction = Transaction::where('company_id', $company_id)->orderBy('id', 'DESC')->first();
                    $company = User::where('id', $company_id)->first();
                    $t_id = '';
                    if(is_null($latest_transaction))
                    {
                        $t_id = 1;
                    }
                    else
                    {
                        $t_id = $latest_transaction->tran_id + 1;
                    }
                    $new_transaction->tran_id = $t_id;
                    $new_transaction->tran_ref = $request->tran_ref;
                    $new_transaction->token = $request->token;
                    $new_transaction->cart_amount = $request->cart_amount;
                    $new_transaction->tran_count = $request->cart_amount;
                    $new_transaction->conversion_rate = $conversion_rate;
                    $new_transaction->conversion_amount = $request->cart_amount * $conversion_rate;
                    $new_transaction->transferable_amount = $request->cart_amount * $conversion_rate;
                    $new_transaction->cart_id = $request->cart_id;
                    $new_transaction->currency = $request->cart_currency;
                    $new_transaction->invoice_id = $tran->invoice_id;
                    $new_transaction->parent_id = $tran->id;
                    $new_transaction->description = $request->cart_description;
                    $new_transaction->tran_type = strtolower($request['tran_type']);
                    $new_transaction->payment_date = date('Y-m-d');
                    $new_transaction->tran_time = date(' H:i');
                    $new_transaction->status = $request['payment_result']['response_status'];
                    $new_transaction->account_type = $tran->account_type;
                    $new_transaction->resource = 1;
                    $new_transaction->type = 3;
                    $new_transaction->save();

                    //TODO: Updating The User Here
                    $UserToUpdate = User::find($tran->user_id);
                    $UserToUpdate->payment_status = 1;
                    $UserToUpdate->update();

                    if ($request['payment_result']['response_status'] == 'A' || $request['payment_result']['response_status'] == 'H') {

                    //TODO: Sending Email HERE

                        //replace template var with value
                        $token = array(
                            'CompanyName'  => $company->company_name,
                            'CompanyPhone' => $company->phone,
                            'CompanyEmail' => $company->email,
                            'Amount' => $request->cart_amount,
                            'Currency' => $request->cart_currency,
                            'Name' => $request['customer_details']['name'],
                            'Email' => $request['customer_details']['email'],
                            'DateTime' => date('Y-m-d') .' '. date(' H:i'),
                            'TranRef' => $request['tran_ref'],
                        );
                        $pattern = '[%s]';
                        foreach ($token as $key=>$val) {
                            $varMap[sprintf($pattern, $key)] = $val;
                        }

                        CompanySendEmail($company_id, 5, $varMap, $request['customer_details']['email']);
                        CompanySendEmail($company_id, 5, $varMap, $company->email);
                    }
                    elseif($request['payment_result']['response_status'] == 'D')
                    {
                             $token = array(
                                 'Name'  => $request['customer_details']['name'],
                                 'CartAmount' => $request->cart_amount,
                                 'Reason' => $request['payment_result']['response_message'],
                             );
                             $pattern = '[%s]';
                             foreach($token as $key=>$val){
                                 $varMap[sprintf($pattern,$key)] = $val;
                             }

                             CompanySendEmail($company_id, 23, $varMap, $request['customer_details']['email']);

                    }
                 }

            }
        }
        }catch(\Exception $ex)
        {
            SaveTrash($company_id , '', '', $ex->getMessage());

        }


    }

    //TODO: Charging the amount from the customer
    public function charge_payment(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()) return 'Cyber';

        //TODO: Getting Active Paytabs Account Details
        $paytab = Paytab::where(['active' => 1, 'company_id' => Auth::user()->id])->first();
        $pay = explode('-', $paytab->cart_id);
        //TODO: Getting last transaction id by company_id from transactions table
        $latest_transaction = Transaction::where('company_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
        if(is_null($latest_transaction))
        {
            $tran_id = 1;
        }
        else
        {
            $tran_id = $latest_transaction->tran_id + 1;
        }

        $cart_id = $pay[0] .'-'. ($pay[1] + $tran_id);
        //TODO: Sending Array to Paytabs for creating new user and payment link
        $data = $request->except('id', '_token');
        $data['profile_id'] = $paytab->profile_id;
        $data['tran_type'] = "capture";
        $data['tran_class'] = "recurring";
        $data['cart_id'] = $paytab->cart_id;
        $data['cart_currency'] = $paytab->currency;
        $data['cart_amount'] = $request->amount;
        $data['cart_description'] = $request->description;
        $response = generate_link($data, $paytab->server_key);

        //Returnning Error if api response is not valid
        if(!isset($response['tran_ref']))
        {
            return 'api_error';
        }

        //Getting User ID Here
        $users = Transaction::where('id', $request->id)->first();
        //TODO: Array To Create New Transaction
        $transaction['tran_ref'] = $response['tran_ref'];
        $transaction['cart_amount'] = $request->amount;
        $transaction['tran_id'] = $tran_id;
        $transaction['payment_method'] = $response['payment_info']['card_scheme'];
        $transaction['tran_type'] = "capture";
        $transaction['payment_date'] = date('Y-m-d');
        $transaction['tran_time'] = date(' H:i');
        $transaction['currency'] = $paytab->currency;
        $transaction['company_id'] = Auth::user()->id;
        $transaction['user_id'] = $users->user_id;
        $transaction['cart_id'] = $cart_id;
        $transaction['description'] = $paytab->description;
        $transaction['account_type'] = $paytab->type;
        $transaction['status'] = $response['payment_result']['response_status'];
        $transaction['resp_msg'] = $response['payment_result']['response_message'];
        $transaction['resp_code'] = $response['payment_result']['response_code'];
        Transaction::create($transaction);

        //TODO: Updating The User Here
        $UserToUpdate = User::find($users->user_id);
        $UserToUpdate->tran_ref = $response['tran_ref'];
        $UserToUpdate->update();

        //TODO: Sending Email Here
        //replace template var with value
        $token = array(
            'Name' => $request->name,
            'CartAmount' => $request->amount,
            'ChargeFormReason' => $request->description,
        );
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }

        AdminSendEmail(Auth::user()->id, 4, $varMap, $request->email);
        return 'true';
    }

    //TODO: Send Email along with payment link
    public function send_email(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'email' => 'email|required',
            'name' => 'required',
            'link' => 'required',
        ]);

        if($validator->fails()) return 'Cyber';

        //TODO: Getting Transaction Details
        $transaction = Transaction::where(['id' => $request->id])->first();

        //replace template var with value
        $token = array(
            'PaymentLinkButton'  => '<a href="'.$request->link.'"><button  class="btn btn-danger">Payment Link</button></a>',
            'CustomerName' => $request->name,
            'Amount' => $transaction->cart_amount,
            'Description' => $transaction->description,
        );
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }

        AdminSendEmail(Auth::user()->id, 3, $varMap, $request->email);
        return 'true';
    }

    //TODO: Send Messsage
    public function send_message(Request $request)
    {
        $alias = 'MYPAY-' . rand(1, 10000);
        $response = create_tiny_url($request->link, $alias);
        if($response['code'] == 0)
        {
            $message = "Your booking link to pay online: " . $response['data']['tiny_url'];
            send_message($request->phone, $message);
            return 'true';
        }

    }

    //TODO: For Soft Delete Transaction
    public function delete(Request $request)
    {
        Transaction::where('id', $request->id)->update(['is_delete' => 1]);
    }

}
