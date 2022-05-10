<?php

namespace App\Http\Controllers\Admin\Invoices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommonModel\Country;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Company\Paytab;
use Yajra\Datatables\Datatables;
use App\Models\User;
use App\Models\Admin\Accounts\InvoiceItem;
use App\Models\Admin\Accounts\Invoice;
use App\Models\Admin\Paylinks\Transaction;
use App\Models\Admin\Email\EmailSetting;
use App\Models\Admin\Email\TemplateBanner;
use App\Models\Admin\Email\EmailCategory;
use App\Models\Admin\Email\EmailContent;
use App\Mail\DynamicEmail;
use App\Models\Admin\Paylinks\Trash;
use Illuminate\Support\Facades\Mail;
use App\Models\Currency;
use App\Models\Admin\Accounts\Journal;
use Validator;

class InvoiceController extends Controller
{
    //TODO: Loading Invoices index view
    public function index(Request $request)
    {
        $add_permission = CheckPermission(config('const.ADD'), config('const.INVOICES'));
        $delete_permission = CheckPermission(config('const.DELETE'), config('const.INVOICES'));

        if($request->ajax())
        {
            if(Auth::user()->company_id == 0 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3 )
            {
                $transactions = Transaction::with(['users' => function($query){
                    $query->where('customer_from',2);
                }])->withCount('transactions')->where(['company_id' => admin_company_id(), 'is_delete' => 0, 'account_type' => $request->session()->get('admin_application_mode')])->where('type', '!=', 1)->where('type', '!=', 2)->orderBy('id', 'DESC')->get();
            }
            elseif(Auth::user()->role_id == 4)
            {
                $transactions = Transaction::has('users')->with(['users' => function($query){
                    $query->where('customer_from',2)->where('role_id', 5);
                }])->withCount('transactions')->where(['company_id' => admin_company_id(), 'is_delete' => 0, 'account_type' => $request->session()->get('admin_application_mode')])->where('type', '!=', 1)->where('type', '!=', 2)->orderBy('id', 'DESC')->get();
            }
            else
            {
                $transactions = Transaction::with(['users' => function($query){
                    $query->where('customer_from',2);
                }])->withCount('transactions')->where(['create_by' => Auth::user()->id, 'is_delete' => 0, 'account_type' => $request->session()->get('admin_application_mode')])->where('type', '!=', 1)->where('type', '!=', 2)->orderBy('id', 'DESC')->get();
            }
            return Datatables::of($transactions)
            ->addIndexColumn()
            //TODO: For Displaying Invoice Description Details
            ->addColumn('tran_ref', function($transactions){
                return '
                <input type="hidden" name="id" value="'.$transactions->id.'">
                <input type="hidden" name="name" value="'.$transactions->users->name.'">
                <input type="hidden" name="phone" value="'.$transactions->users->phone.'">
                <input type="hidden" name="address" value="'.$transactions->users->address.'">
                <input type="hidden" name="state" value="'.$transactions->users->state.'">
                <input type="hidden" name="created_at" value="'.$transactions->updated_at->format('F d').', '.$transactions->updated_at->format('Y').'">
                <input type="hidden" name="email" value="'.$transactions->users->email.'">
                <input type="hidden" name="country" value="'.$transactions->users->country.'">
                <input type="hidden" name="token" value="'.$transactions->token.'">
                <input type="hidden" name="tran_ref" value="'.$transactions->tran_ref.'">
                <input type="hidden" name="type" value="'.$transactions->type.'">
                <input type="hidden" name="tran_type" value="'.$transactions->tran_type.'">
                <input type="hidden" name="tran_count" value="'.$transactions->tran_count.'">
                <input type="hidden" name="cart_amount" value="'.$transactions->cart_amount.'">
                <input type="hidden" name="currency" value="'.$transactions->currency.'">
                <input type="hidden" name="cart_id" value="'.$transactions->cart_id.'">
                <input type="hidden" name="description" value="'.$transactions->description.'">
                <input type="hidden" name="customer_ref" value="'.$transactions->customer_ref.'">
                <input type="hidden" name="invoice_ref" value="'.$transactions->invoice_ref.'">
                <input type="hidden" name="resp_msg" value="'.$transactions->resp_msg.'">
                <input type="hidden" name="resp_code" value="'.$transactions->resp_code.'">
                <input type="hidden" name="resp_code" value="'.$transactions->resp_code.'">
                <input type="hidden" name="invoice_id" value="'.$transactions->invoice_id.'">
                <input type="hidden" name="status" value="'.$transactions->status.'">
                <input type="hidden" name="tran_id" value="'.$transactions->tran_id.'">
                <input type="hidden" name="transactions_count" value="'.$transactions->transactions_count.'">
                <input type="hidden" name="refund_resp" value="'.$transactions->refund_resp.'">
                <a style="cursor:pointer;color:red" id="invoice_descriptions"><b>'.$transactions->tran_ref.'</b></a>
                ';
            })
            //TODO: For Displaying Status
            ->addColumn('status', function ($transactions) {

                if($transactions->status == 'A')
                {
                    return '<span class="label label-success mr-2" data-toggle="tooltip" title="'.$transactions->resp_msg.'">A</span>';
                }
                elseif($transactions->status == 'H')
                {
                    return '<span class="label label-warning mr-2" data-toggle="tooltip" title="'.$transactions->resp_msg.'">H</span>';
                }
                elseif($transactions->status == 'V')
                {
                    return '<span class="label label-primary mr-2" data-toggle="tooltip" title="'.$transactions->resp_msg.'">V</span>';
                }
                elseif($transactions->status == 'E')
                {
                    return '<span class="label label-danger mr-2" data-toggle="tooltip" title="'.$transactions->resp_msg.'">E</span>';
                }
                elseif($transactions->status == 'D')
                {
                    return '<span class="label label-danger mr-2" data-toggle="tooltip" title="'.$transactions->resp_msg.'">D</span>';
                }
                elseif($transactions->status == '')
                {
                    return '<span class="label label-danger mr-2" data-toggle="tooltip" title="'.$transactions->resp_msg.'">P</span>';
                }
            })
            ->addColumn('action', function ($transactions) use ($delete_permission) {
                //TODO: If Invoice Link Payemnt is maid then show this refund, void and other options
                if(($transactions->status == 'A' &&  $transactions->tran_type == 'auth') || ($transactions->status == 'A' &&  $transactions->tran_type == 'sale') || $transactions->status == 'H'){
                    //TODO: If transation link is sale and paid and not payment refunded  then show these options and not tokenize
                    if($transactions->tran_type == 'sale' && $transactions->type == 3 && $transactions->status == 'A' && $transactions->refund_resp != "A" && $transactions->token != "")
                    {
                        return '<a id="charge"  class="btn btn-icon btn-success btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Charge">
                    <input type="hidden" name="id" value="'.$transactions->id.'">
                    <input type="hidden" name="name" value="'.$transactions->users->name.'">
                    <input type="hidden" name="phone" value="'.$transactions->users->phone.'">
                    <input type="hidden" name="email" value="'.$transactions->users->email.'">
                    <input type="hidden" name="country" value="'.$transactions->users->country.'">
                    <input type="hidden" name="token" value="'.$transactions->token.'">
                    <input type="hidden" name="tran_ref" value="'.$transactions->tran_ref.'">
                    <input type="hidden" name="currency" value="'.$transactions->currency.'">
                    <input type="hidden" name="type" value="'.$transactions->type.'">
                    <input type="hidden" name="tran_type" value="'.$transactions->tran_type.'">
                    <input type="hidden" name="tran_count" value="'.$transactions->tran_count.'">
                    <input type="hidden" name="cart_amount" value="'.$transactions->cart_amount.'">
                    <input type="hidden" name="transactions_count" value="'.$transactions->transactions_count.'">
                    <span class="svg-icon svg-icon-md svg-icon-primary">
                    <i class="fa fa-money"></i>
                    </span>
                    </a>';
                    } //For Capture the Hold Payment
                    elseif($transactions->status == 'H' && $transactions->refund_resp != "A")
                    {
                        return '<a id="capture-payment"  class="btn btn-icon btn-info btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Capture Payment">
                    <input type="hidden" name="id" value="'.$transactions->id.'">
                    <input type="hidden" name="name" value="'.$transactions->users->name.'">
                    <input type="hidden" name="phone" value="'.$transactions->users->phone.'">
                    <input type="hidden" name="email" value="'.$transactions->users->email.'">
                    <input type="hidden" name="country" value="'.$transactions->users->country.'">
                    <input type="hidden" name="token" value="'.$transactions->token.'">
                    <input type="hidden" name="tran_ref" value="'.$transactions->tran_ref.'">
                    <input type="hidden" name="type" value="'.$transactions->type.'">
                    <input type="hidden" name="tran_type" value="'.$transactions->tran_type.'">
                    <input type="hidden" name="tran_count" value="'.$transactions->tran_count.'">
                    <input type="hidden" name="cart_amount" value="'.$transactions->cart_amount.'">
                    <input type="hidden" name="currency" value="'.$transactions->currency.'">
                    <input type="hidden" name="cart_id" value="'.$transactions->cart_id.'">
                    <input type="hidden" name="transactions_count" value="'.$transactions->transactions_count.'">
                    <span class="svg-icon svg-icon-md svg-icon-info">
                    <i class="fa fa-credit-card"></i>
                    </span>
                    </a>';
                    } //For Charging the Auth Payments
                    elseif($transactions->tran_type == 'auth' && $transactions->tran_count > 0 && $transactions->token != "")
                    {
                        if($transactions->transactions_count == 0)
                        {
                            return '<a id="charge"  class="btn btn-icon btn-success btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Charge">
                            <input type="hidden" name="id" value="'.$transactions->id.'">
                            <input type="hidden" name="name" value="'.$transactions->users->name.'">
                            <input type="hidden" name="phone" value="'.$transactions->users->phone.'">
                            <input type="hidden" name="email" value="'.$transactions->users->email.'">
                            <input type="hidden" name="country" value="'.$transactions->users->country.'">
                            <input type="hidden" name="token" value="'.$transactions->token.'">
                            <input type="hidden" name="tran_ref" value="'.$transactions->tran_ref.'">
                            <input type="hidden" name="type" value="'.$transactions->type.'">
                            <input type="hidden" name="cart_id" value="'.$transactions->cart_id.'">
                            <input type="hidden" name="tran_type" value="'.$transactions->tran_type.'">
                            <input type="hidden" name="tran_count" value="'.$transactions->tran_count.'">
                            <input type="hidden" name="cart_amount" value="'.$transactions->cart_amount.'">
                            <input type="hidden" name="tran_count" value="'.$transactions->tran_count.'">
                            <input type="hidden" name="currency" value="'.$transactions->currency.'">
                            <input type="hidden" name="transactions_count" value="'.$transactions->transactions_count.'">
                            <span class="svg-icon svg-icon-md svg-icon-primary">
                            <i class="fa fa-money"></i>
                            </span>
                            </a>
                            <a id="void"  class="btn btn-icon btn-danger btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Void">
                            <span class="svg-icon svg-icon-md svg-icon-primary">
                            <i class="fa fa-minus-square"></i>
                            </span>
                            </a>';
                        }
                        else
                        {
                            return '<a id="charge"  class="btn btn-icon btn-success btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Charge">
                            <input type="hidden" name="id" value="'.$transactions->id.'">
                            <input type="hidden" name="name" value="'.$transactions->users->name.'">
                            <input type="hidden" name="phone" value="'.$transactions->users->phone.'">
                            <input type="hidden" name="email" value="'.$transactions->users->email.'">
                            <input type="hidden" name="country" value="'.$transactions->users->country.'">
                            <input type="hidden" name="token" value="'.$transactions->token.'">
                            <input type="hidden" name="tran_ref" value="'.$transactions->tran_ref.'">
                            <input type="hidden" name="type" value="'.$transactions->type.'">
                            <input type="hidden" name="tran_type" value="'.$transactions->tran_type.'">
                            <input type="hidden" name="tran_count" value="'.$transactions->tran_count.'">
                            <input type="hidden" name="cart_amount" value="'.$transactions->cart_amount.'">
                            <input type="hidden" name="tran_count" value="'.$transactions->tran_count.'">
                            <input type="hidden" name="currency" value="'.$transactions->currency.'">
                            <input type="hidden" name="transactions_count" value="'.$transactions->transactions_count.'">
                            <span class="svg-icon svg-icon-md svg-icon-primary">
                            <i class="fa fa-money"></i>
                            </span>
                            </a>';
                        }

                    }

                //TODO: If Link Not Paid then show Delete, Send Email, Send Message, Options
                }elseif($transactions->token == "" && $transactions->type == 3 && $transactions->status == "")
                {
                    if($delete_permission == 1)
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
                <a href="'.$transactions->redirect_url.'" target="_blank" class="btn btn-icon btn-primary btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="" href="https://secure.paytabs.com/payment/request/invoice/537917/776A8C0216854907A3682DCAF18198ED" aria-describedby="ui-tooltip-0">
                <span class="svg-icon svg-icon-md svg-icon-primary">
                <i class="fa fa-eye" aria-hidden="true"></i>
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
                }else{
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
                <a href="'.$transactions->redirect_url.'" target="_blank" class="btn btn-icon btn-primary btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="" href="https://secure.paytabs.com/payment/request/invoice/537917/776A8C0216854907A3682DCAF18198ED" aria-describedby="ui-tooltip-0">
                <span class="svg-icon svg-icon-md svg-icon-primary">
                <i class="fa fa-eye" aria-hidden="true"></i>
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

                }
                else
                {
                    return '';
                }


            })
            ->editColumn('id', 'ID: {{$id}}')
            ->rawColumns(['status', 'account_type', 'action', 'tran_ref'])
            ->make(true);
        }
        return view('admin.invoices.invoice.index', compact('add_permission'));
    }

    //TODO: Loading Create Invoices view
    public function create()
    {
        $paytab = Paytab::where(['active' => 1, 'company_id' => admin_company_id()])->first();
        $countries = Country::all();
        $currencies = Currency::where('active', 1)->orderBy('id', 'ASC')->get();
        return view('admin.invoices.invoice.create', compact('countries', 'paytab', 'currencies'));
    }

    //TODO: Creating New Invoice here
    public function create_invoice(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'name' => 'required',
            'tran_type' => 'required',
            'total_amount' => 'required'
        ]);
        if($validator->fails()) return json_encode(['error' => 'Cyber']);

        //TODO: Getting Active Paytabs Account Details Of Company From Paytabs Table
        $paytab = Paytab::where(['active' => 1, 'company_id' => admin_company_id()])->first();
        $pay = explode('-', $paytab->cart_id);
        //TODO: Getting last transaction id by company_id from transactions table
        $latest_transaction = Transaction::where('company_id', admin_company_id())->orderBy('id', 'DESC')->first();
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
         $company_details = User::where('id', admin_company_id())->first();

         $customer_details = $request->except('_token', 'cart_description', 'currency', 'tran_ref', 'customer_ref', 'city','tran_type', 'phone', 'discount_amount', 'tax_total', 'sku', 'state', 'description', 'unit_cost', 'item_total','quantity', 'discount', 'item_tax', 'total_amount', 'extra_charges', 'shipping_charges', 'extra_discount', 'sub_total');
         $customer_details['city'] = isset($request->state) ? $request->state : $company_details->state;
         $customer_details['street1'] = isset($request->street1) ? $request->street1 : $company_details->address;
         $customer_details['country'] = isset($request->country) ? $request->country : $company_details->country;
         $shipping_details = $customer_details;

        //TODO: EXPLODING THE STRING AND CONVERTING INTO ARRAYS
        $sku = explode(',', $request->sku);
        $description = explode(',', $request->description);
        $unit_cost = explode(',', $request->unit_cost);
        $quantity = explode(',', $request->quantity);
        $discount = explode(',', $request->discount);
        $item_tax = explode(',', $request->item_tax);
        $item_total = explode(',', $request->item_total);
        $discount_amount = explode(',', $request->discount_amount);
        $tax_total = explode(',', $request->tax_total);

        //TODO: DEFINING THE LINE ITEMS ARRAY FOR INVOICE
        $line_items = [];
        for($i = 0; $i < count($sku) ; $i++)
        {
            $line_items[] = [
                'sku' => $sku[$i],
                'description' => $description[$i],
                'unit_cost' => (float)$unit_cost[$i],
                'quantity' => (float)$quantity[$i],
                'discount_rate' => (float)$discount[$i],
                'tax_rate' => (float)$item_tax[$i],
                'total' => (float)$item_total[$i],
            ];
        }

        //TODO: CREATING INVOICE ARRAY TO SEND INVOICE DATA
        $invoice = [
            'shipping_charges' => isset($request->shipping_charges) ? (float)$request->shipping_charges : 0,
            'extra_charges' => isset($request->extra_charges) ? (float)$request->extra_charges : 0,
            'extra_discount' => isset($request->extra_discount) ? (float)$request->extra_discount : 0,
            'total' => $request->total_amount,
            'line_items' => $line_items
        ];

         $data['profile_id'] = $paytab->profile_id;
         $data['tran_type'] = $request->tran_type;
         $data['tran_class'] = "ecom";
         $data['tokenise'] = "2";
         $data['cart_id'] = $cart_id;
         $data['cart_currency'] = $request->currency;
         $data['cart_description'] = isset($request->cart_description) ? $request->cart_description : "Payment with tok enabled, save card enabled";
         $data['callback'] = CallbackLink(admin_company_id());
         $data['return'] = ReturnCallbackLink(admin_company_id());
         $data['paypage_lang'] = "en";
         $data['customer_details'] = $customer_details;
         $data['shipping_details'] = $shipping_details;
         $data['invoice'] = $invoice;
         $data['hide_shipping'] = true;
         $response = create_invoice_link($data, $paytab->server_key);

         //Returning Error if api response is not valid
         if(!isset($response['invoice_link']))
         {
            return json_encode($response);
         }

        //TODO: Checking Customer against this company_id exist or not
        $checkCustomer = User::where(['email' => $request->email, 'company_id' => admin_company_id(), 'customer_from' => 2])->first();
        //TODO: Customer Array
        $customer = $request->except('_token', 'cart_description', 'currency' ,'invoice_ref', 'customer_ref', 'tax_total','discount_amount', 'sku','tran_type', 'street1', 'state', 'description', 'unit_cost', 'item_total','quantity', 'discount', 'item_tax', 'total_amount', 'extra_charges', 'shipping_charges', 'extra_discount', 'sub_total');
        $customer['city'] = isset($request->state) ? $request->state : $company_details->state;
        $customer['address'] = isset($request->street1) ? $request->street1 : $company_details->address;
        $customer['country'] = isset($request->country) ? $request->country : $company_details->country;
        $customer['phone'] = isset($request->phone) ? $request->phone : $company_details->phone;
        $customer['redirect_url'] = $response['invoice_link'];
        $customer['company_id'] = admin_company_id();
        $customer['create_by'] = Auth::user()->id;
        $customer['is_active'] = 1;
        $customer['is_verified'] = 1;
        $customer['customer_from'] = 2;
        $customer['user_role'] = 3;
        $customer['user_type'] = 1;
        //TODO: If Check Customer Data Not Found The Created New Customer else Update The Customer
        if(is_null($checkCustomer))
        {
            $user = User::create($customer);
            //TODO: Getting Latest Inserted User Id For Invoice Table
            $user_id = $user->id;
        }
        else
        {
            $customer['modify_by'] = Auth::user()->id;
            $user = User::where('id', $checkCustomer->id)->update($customer);
            //TODO: Getting User Id For Invoice Table
            $user_id = $checkCustomer->id;
        }

        //TODO: Getting last Invoice id by company_id from Invoices table
        $latest_invoice = Invoice::where('company_id', admin_company_id())->orderBy('id', 'DESC')->first();
        if(is_null($latest_invoice))
        {
            $invoice_no = 1;
        }
        else
        {
            $invoice_no = $latest_invoice->invoice_no + 1;
        }
        //TODO: Array To Create New Invoice
        $invoice['company_id'] = admin_company_id();
        $invoice['create_by'] = Auth::user()->id;
        $invoice['user_id'] = $user_id;
        $invoice['invoice_no'] = $invoice_no;
        $invoice['sub_total'] = $request->sub_total;
        $invoice['total'] = $request->total_amount;
        $invoice['shipping_charges'] = isset($request->shipping_charges) ? $request->shipping_charges : 0;
        $invoice['invoice_id'] = $response['invoice_id'];
        $invoice = Invoice::create($invoice);
        $invoice_id = $invoice->id;

        //TODO: ARRAY TO CREATE NEW INVOICE_ITEMS
        for($i = 0; $i < count($sku) ; $i++)
        {
            $invoice_items = new InvoiceItem;
            $invoice_items->sku = $sku[$i];
            $invoice_items->description = $description[$i];
            $invoice_items->unit_cost = $unit_cost[$i];
            $invoice_items->quantity = $quantity[$i];
            $invoice_items->net_total = $item_total[$i];
            $invoice_items->discount_rate = $discount[$i];
            $invoice_items->discount_amount = $discount_amount[$i];
            $invoice_items->tax_rate = $item_tax[$i];
            $invoice_items->tax_total = $tax_total[$i];
            $invoice_items->total = $item_total[$i];
            $invoice_items->invoice_id = $invoice_id;
            $invoice_items->save();
        }

        //TODO: Getting Conversion Rate Here
        $conversion_rate = Currency::where('from_currency', $request->currency)->pluck('rate')->first();

        //TODO: Array To Create New Transaction
        $transaction['company_id'] = admin_company_id();
        $transaction['create_by'] = Auth::user()->id;
        $transaction['user_id'] = $user_id;
        $transaction['invoice_ref'] = isset($request->invoice_ref) ? $request->invoice_ref : $company_details->company_prefix .'01';
        $transaction['customer_ref'] = isset($request->customer_ref) ? $request->customer_ref : $company_details->company_prefix .'01';
        $transaction['invoice_id'] = $invoice_id;
        $transaction['redirect_url'] = $response['invoice_link'];
        $transaction['tran_id'] = $tran_id;
        $transaction['cart_amount'] = $request->total_amount;
        $transaction['conversion_rate'] = $conversion_rate;
        $transaction['conversion_amount'] = $request->total_amount * $conversion_rate;
        $transaction['transferable_amount'] = $request->total_amount * $conversion_rate;
        $transaction['tran_count'] = $request->total_amount;
        $transaction['type'] = 3;
        $transaction['payment_method'] = 'Visa';
        $transaction['tran_type'] = $request->tran_type;
        $transaction['currency'] = $request->currency;
        $transaction['cart_id'] =  $data['cart_id'];
        $transaction['account_type'] = $paytab->type;
        $transaction['description'] = isset($request->description) ? $request->description : "Payment with tok enabled, save card enabled";
        $transaction = Transaction::create($transaction);

        //TODO: Sending Email Here
        //replace template var with value
        $token = array(
            'PaymentLinkButton'  => '<a href="'.$response['invoice_link'].'"><button  class="btn btn-danger">Payment Link</button></a>',
            'Name' => $request->name,
            'InvoiceTotal' => $request->total_amount
        );
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }

        AdminSendEmail(admin_company_id(), 6, $varMap, $request->email);
        return json_encode($response);
    }

    //TODO: Send Messsage
    public function send_message(Request $request)
    {
        $alias = 'MYPAY-' . rand(1, 10000);
        $response = create_tiny_url($request->link, $alias);
        if($response['code'] == 0)
        {
            $message = "Dear ". $request->name ." Please find below your payment link: " . $response['data']['tiny_url'];
            send_message(admin_company_id(),$request->phone, $message);
            return 'true';
        }

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
        //TODO: Sending Email
        //replace template var with value
        $token = array(
            'PaymentLinkButton'  => '<a href="'.$request->link.'"><button  class="btn btn-danger">Payment Link</button></a>',
            'Name' => $request->name,
            'InvoiceTotal' => $transaction->cart_amount,
        );
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }

        AdminSendEmail(admin_company_id(), 6, $varMap, $request->email);
        return 'true';
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
        $paytab = Paytab::where(['active' => 1, 'company_id' => admin_company_id()])->first();
        $pay = explode('-', $paytab->cart_id);
        //TODO: Getting last transaction id by company_id from transactions table
        $latest_transaction = Transaction::where('company_id', admin_company_id())->orderBy('id', 'DESC')->first();
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
        if($request->type == 'sale')
        {
            $data['tran_type'] = "sale";
            $data['tran_class'] = "recurring";
        }
        else
        {
            $data['tran_type'] = "capture";
            $data['tran_class'] = "ecom";
        }


        $data['cart_id'] = $cart_id;
        $data['cart_currency'] = $request->currency;
        $data['cart_amount'] = $request->amount;
        $data['cart_description'] = $request->description;
        $response = generate_link($data, $paytab->server_key);

        //Returnning Error if api response is not valid
        if(!isset($response['tran_ref']))
        {
            return 'api_error';
        }

        //TODO: Saving Transaction Reponse
        SaveTrash(admin_company_id(), $response['tran_ref'] ,json_encode($response), '');


        //Getting User ID Here
        $users = Transaction::where('id', $request->id)->first();
        $real_user = User::where('id', $users->user_id)->first();

        //TODO: Getting Conversion Rate Here
        $conversion_rate = Currency::where('from_currency', $request->currency)->pluck('rate')->first();

        //TODO: Updating Tran_Count
        Transaction::where('id', $request->id)->update(['tran_count' => $request->tran_count]);
        //TODO: Array To Create New Transaction
        $transaction['tran_ref'] = $response['tran_ref'];
        $transaction['cart_amount'] = $request->amount;
        $transaction['conversion_rate'] = $conversion_rate;
        $transaction['conversion_amount'] = $request->amount * $conversion_rate;
        $transaction['transferable_amount'] = $request->amount * $conversion_rate;
        $transaction['tran_id'] = $tran_id;
        $transaction['payment_method'] = $response['payment_info']['card_scheme'];
        if($request->type == 'sale')
        {
            $transaction['tran_type'] = "sale";
        }
        else
        {
            $transaction['tran_type'] = "capture";
        }
        $transaction['payment_date'] = date('Y-m-d');
        $transaction['tran_time'] = date(' H:i');
        $transaction['currency'] = $request->currency;
        $transaction['company_id'] = admin_company_id();
        $transaction['create_by'] = Auth::user()->id;
        $transaction['user_id'] = $users->user_id;
        $transaction['type'] = 4;
        $transaction['cart_id'] = $cart_id;
        $transaction['description'] = $request->description;
        $transaction['account_type'] = $paytab->type;
        $transaction['parent_id'] = $request->id;
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
            'Name' => $real_user->name,
            'CartAmount' => $request->amount,
            'ChargeFormReason' => $request->description,
        );
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }


        AdminSendEmail(admin_company_id(), 4, $varMap, $request->email);
        return 'true';
    }

    //TODO: Charging the amount from the customer
    public function voided_payment(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()) return 'Cyber';


        //TODO: Getting Active Paytabs Account Details
        $paytab = Paytab::where(['active' => 1, 'company_id' => admin_company_id()])->first();
         //Getting User ID Here
         $users = Transaction::where('id', $request->id)->first();
         $real_user = User::where('id', $users->user_id)->first();
        //TODO: Sending Array to Paytabs for creating new user and payment link
        $data = $request->except('id', '_token');
        $data['profile_id'] = $paytab->profile_id;
        $data['tran_type'] = "void";
        $data['tran_class'] = "ecom";
        $data['cart_id'] = $request->cart_id;
        $data['cart_currency'] = $request->currency;
        $data['cart_amount'] = $request->amount;
        $data['cart_description'] = $request->description;
        $response = voided_payment($data, $paytab->server_key);

        //Returnning Error if api response is not valid
        if(!isset($response['tran_ref']))
        {
            return 'api_error';
        }

        //TODO: Saving Transaction Reponse
        SaveTrash(admin_company_id(), $response['tran_ref'] ,json_encode($response), '');

        //TODO: Getting Conversion Rate Here
        $conversion_rate = Currency::where('from_currency', $request->currency)->pluck('rate')->first();
        //TODO: Array To Create New Transaction
        $transaction['tran_ref'] = $response['tran_ref'];
        $transaction['cart_amount'] = $request->amount;
        $transaction['conversion_rate'] = $conversion_rate;
        $transaction['conversion_amount'] = $request->amount * $conversion_rate;
        $transaction['transferable_amount'] = $request->amount * $conversion_rate;
        $transaction['payment_method'] = $response['payment_info']['card_scheme'];
        $transaction['tran_type'] = $response['tran_type'];
        $transaction['payment_date'] = date('Y-m-d');
        $transaction['tran_time'] = date(' H:i');
        $transaction['currency'] = $request->currency;
        $transaction['type'] = 5;
        $transaction['cart_id'] = $response['cart_id'];
        $transaction['description'] = $request->description;
        $transaction['account_type'] = $paytab->type;
        $transaction['modify_by'] = Auth::user()->id;
        $transaction['status'] = $response['payment_result']['response_status'];
        $transaction['resp_msg'] = $response['payment_result']['response_message'];
        $transaction['resp_code'] = $response['payment_result']['response_code'];
        Transaction::where('id', $request->id)->update($transaction);
        //TODO: If Application Mode is Live
        if($request->session()->get('admin_application_mode') == 1)
        {
            $journal = New Journal;
            $journal->company_id = admin_company_id();
            $journal->type = "Payment Voided";
            if($request->currency != 'AED')
            {
                $conversion = Currency::where('from_currency', $request->currency)->first();
                $journal->dr = $request->amount * $conversion->rate;
                $journal->narration = $request->amount .' '. $request->currency . 'Converted to AED with Conversion Rate of ' . $conversion->rate;
            }
            else
            {
            $journal->dr = $request->amount;
            }
            $journal->create_by = Auth::user()->id;
            $journal->save();
        }

        //TODO: Sending Email Here
        //replace template var with value
        $token = array(
            'Name' => $real_user->name,
            'CartAmount' => $request->amount,
            'ChargeFormReason' => $request->description,
        );
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }


        AdminSendEmail(admin_company_id(), 7, $varMap, $request->email);
        return 'true';
    }

    //TODO: Voided the amount from the customer
    public function refund_payment(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()) return 'Cyber';

        //TODO: Getting Active Paytabs Account Details
        $paytab = Paytab::where(['active' => 1, 'company_id' => admin_company_id()])->first();
        $pay = explode('-', $paytab->cart_id);
        //TODO: Getting last transaction id by company_id from transactions table
        $latest_transaction = Transaction::where('company_id', admin_company_id())->orderBy('id', 'DESC')->first();
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
        $data['tran_type'] = "refund";
        $data['tran_class'] = "ecom";
        $data['cart_id'] = $request->cart_id;
        $data['cart_currency'] = $request->currency;
        $data['cart_amount'] = $request->amount;
        $data['cart_description'] = $request->description;
        $response = refund_payment($data, $paytab->server_key);
        //Returnning Error if api response is not valid
        if(!isset($response['tran_ref']))
        {
            return 'api_error';
        }

        //TODO: Saving Transaction Reponse
        SaveTrash(admin_company_id(), $response['tran_ref'] ,json_encode($response), '');

        //TODO: Getting Conversion Rate Here
        $conversion_rate = Currency::where('from_currency', $request->currency)->pluck('rate')->first();
        //Getting User ID Here
        $users = Transaction::where('id', $request->id)->first();
        $real_user = User::where('id', $users->user_id)->first();
        //TODO: Updating Tran_Count
        Transaction::where('id', $request->id)->update(['refund_resp' => $response['payment_result']['response_status']]);
        //TODO: Array To Create New Transaction
        $transaction['tran_ref'] = $response['tran_ref'];
        $transaction['cart_amount'] = $request->amount;
        $transaction['conversion_rate'] = $conversion_rate;
        $transaction['conversion_amount'] = $request->amount * $conversion_rate;
        $transaction['transferable_amount'] = $request->amount * $conversion_rate;
        $transaction['tran_id'] = $tran_id;
        $transaction['payment_method'] = $response['payment_info']['card_scheme'];
        $transaction['tran_type'] = $response['tran_type'];
        $transaction['payment_date'] = date('Y-m-d');
        $transaction['tran_time'] = date(' H:i');
        $transaction['currency'] = $request->currency;
        $transaction['company_id'] = admin_company_id();
        $transaction['create_by'] = Auth::user()->id;
        $transaction['user_id'] = $users->user_id;
        $transaction['type'] = 6;
        $transaction['cart_id'] = $cart_id;
        $transaction['description'] = $request->description;
        $transaction['account_type'] = $paytab->type;
        $transaction['parent_id'] = $request->id;
        $transaction['status'] = $response['payment_result']['response_status'];
        $transaction['resp_msg'] = $response['payment_result']['response_message'];
        $transaction['resp_code'] = $response['payment_result']['response_code'];
        Transaction::create($transaction);


        //TODO: Updating The User Here
        $UserToUpdate = User::find($users->user_id);
        $UserToUpdate->tran_ref = $response['tran_ref'];
        $UserToUpdate->update();
        if ($request->session()->get('admin_application_mode') == 1) {
            $journal = new Journal;
            $journal->company_id = admin_company_id();
            $journal->create_by = Auth::user()->id;
            $journal->type = "Refunds";
            if ($request->currency != 'AED') {
                $conversion = Currency::where('from_currency', $request->currency)->first();
                $journal->dr = $request->amount * $conversion->rate;
                $journal->narration = $request->amount .' '. $request->currency . 'Converted to AED with Conversion Rate of ' . $conversion->rate;
            } else {
                $journal->dr = $request->amount;
            }
            $journal->save();
        }

        //TODO: Sending Email Here
        //replace template var with value
        $token = array(
            'Name' => $real_user->name,
            'CartAmount' => $request->amount,
            'ChargeFormReason' => $request->description,
        );
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }


        AdminSendEmail(admin_company_id(), 8, $varMap, $request->email);
        return 'true';
    }

      //TODO: Capture the amount from the customer
      public function capture_payment(Request $request)
      {
          // TODO: Validating the rquest params for better security
          $validator = Validator::make($request->all(), [
              'amount' => 'required'
          ]);

          if($validator->fails()) return 'Cyber';

          //TODO: Getting Active Paytabs Account Details
          $paytab = Paytab::where(['active' => 1, 'company_id' => admin_company_id()])->first();
          $pay = explode('-', $paytab->cart_id);
          //TODO: Getting last transaction id by company_id from transactions table
          $latest_transaction = Transaction::where('company_id', admin_company_id())->orderBy('id', 'DESC')->first();
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
          $data['tran_class'] = "ecom";
          $data['cart_id'] = $request->cart_id;
          $data['cart_currency'] = $request->currency;
          $data['cart_amount'] = $request->amount;
          $data['cart_description'] = 'Captruing The Payment';
          $response = refund_payment($data, $paytab->server_key);
          //Returnning Error if api response is not valid
          if(!isset($response['tran_ref']))
          {
              return 'api_error';
          }

          //TODO: Saving Transaction Reponse
          SaveTrash(admin_company_id(), $response['tran_ref'] ,json_encode($response), '');

           //Getting User ID Here
           $users = Transaction::where('id', $request->id)->first();
           $real_user = User::where('id', $users->user_id)->first();
           Transaction::where('id', $request->id)->update(['refund_resp' => $response['payment_result']['response_status']]);
          //TODO: Getting Conversion Rate Here
          $conversion_rate = Currency::where('from_currency', $request->currency)->pluck('rate')->first();
          //TODO: Array To Create New Transaction
          $transaction['tran_ref'] = $response['tran_ref'];
          $transaction['cart_amount'] = $request->amount;
          $transaction['conversion_rate'] = $conversion_rate;
          $transaction['conversion_amount'] = $request->amount * $conversion_rate;
          $transaction['transferable_amount'] = $request->amount * $conversion_rate;
          $transaction['tran_id'] = $tran_id;
          $transaction['payment_method'] = $response['payment_info']['card_scheme'];
          $transaction['tran_type'] = $response['tran_type'];
          $transaction['payment_date'] = date('Y-m-d');
          $transaction['tran_time'] = date(' H:i');
          $transaction['currency'] = $request->currency;
          $transaction['company_id'] = admin_company_id();
          $transaction['create_by'] = Auth::user()->id;
          $transaction['user_id'] = $users->user_id;
          $transaction['type'] = 8;
          $transaction['cart_id'] = $cart_id;
          $transaction['description'] = 'Capturing The Payment';
          $transaction['account_type'] = $paytab->type;
          $transaction['parent_id'] = $request->id;
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
              'Name' => $real_user->name,
              'CartAmount' => $request->amount,
              'ChargeFormReason' => $request->description,
          );
          $pattern = '[%s]';
          foreach($token as $key=>$val){
              $varMap[sprintf($pattern,$key)] = $val;
          }

          return 'true';
      }

     //TODO: For Soft Delete Transaction
     public function delete(Request $request)
     {
         Transaction::where('id', $request->id)->delete();
     }

    //TODO: FOR GETTING INVOICE AND INVOICE ITEMS DETIALS
    public function inoivce_details(Request $request)
    {
        $invoices = Invoice::with('invoice_items')->where('id', $request->invoice_id)->first();
        return json_encode($invoices);

    }
}
