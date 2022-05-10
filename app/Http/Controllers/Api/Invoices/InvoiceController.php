<?php

namespace App\Http\Controllers\Api\Invoices;

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
use App\Models\CommonModel\State;
use App\Models\Currency;
use App\Models\Admin\Accounts\Journal;
use Validator;

class InvoiceController extends Controller
{

    public function app_mode()
    {
         return Paytab::where(['active' => 1, 'company_id' => admin_company_id()])->pluck('type')->first();
    }

    //TODO: Getting Login Company's Myridepay Account Credentials
    public function get_myridepay_account_status(Request $request)
    {
        try {
            $paytab = Paytab::where(['active' => 1, 'company_id' => admin_company_id()])->first();

            if (is_null($paytab)) {
                return response()->json(['status' => 400, 'message' => 'Warning: To continue please create MyridePay account got to -> Settings -> Account Configurations.']);
            }

            if (!$paytab->server_key || !$paytab->profile_id || !$paytab->cart_id) {
                return response()->json(['status' => 400, 'message' => 'Warning: To continue please create MyridePay account got to -> Settings -> Account Configurations.']);
            }

            if ($paytab->type == 1) {
                $message = 'Your Live account is currently active';
            } else {
                $message = 'Your Sandbox account is currently active';
            }
            return response()->json(['status' => 200, 'message' => $message]);
        } catch (\Exception $ex) {
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }


    //TODO: Getting Currencies Here
    public function get_currency()
    {
        try {
            $currencies = Currency::where('active', 1)->orderBy('id', 'ASC')->get(['from_currency as currency']);
            $currency = [];
            if(count($currencies) > 0)
            {
                foreach($currencies as $item)
                {
                    $currency[] = $item->currency;
                }
            }
            return response()->json(['status' => 200, 'message' => 'Active Currencies', 'response' => $currency]);
        } catch (\Exception $ex) {
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    //TODO: Getting Currencies Here
    public function get_countries()
    {
        try {
            $countries = Country::get(['val', 'text']);
            return response()->json(['status' => 200, 'message' => 'All Countries', 'response' => $countries]);
        } catch (\Exception $ex) {
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    //TODO: Getting Currencies Here
    public function get_states($country)
    {
        try {
            $states = State::where('country_val', $country)->get(['val', 'text']);
            $zip = Country::where('val', $country)->pluck('zip')->first();
            return response()->json(['status' => 200, 'message' => 'All States',  'zip' => $zip, 'response' => $states]);
        } catch (\Exception $ex) {
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    //TODO: Creating New Invoice here
    public function create_invoice(Request $request)
    {
        try {
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
             $admin_details = User::where('id', 1)->first();
             $company_address = '';
             $company_phone = '';
             $company_country = '';
             $company_state = '';
             if($company_details->address != "")
             {
                $company_address = $company_details->address;
             }
             else
             {
                $company_address = $admin_details->address;
             }
             if($company_details->phone != "")
             {
                $company_phone = $company_details->phone;
             }
             else
             {
                $company_phone = $admin_details->phone;
             }
             if($company_details->country != "")
             {
                $company_country = $company_details->country;
             }
             else
             {
                $company_country = $admin_details->country;
             }
             if($company_details->state != "")
             {
                $company_state = $company_details->state;
             }
             else
             {
                $company_state = $admin_details->state;
             }

             $customer_details = $request->except( 'cart_description', 'currency', 'customer_ref', 'invoice_ref','zip', 'tran_type','phone', 'discount_amount', 'tax_total', 'sku', 'state', 'description', 'unit_cost', 'item_total','quantity', 'discount', 'item_tax', 'total_amount', 'extra_charges', 'shipping_charges', 'extra_discount', 'sub_total');
             $customer_details['city'] = isset($request->state) ? $request->state : $company_state;
             $customer_details['street1'] = isset($request->street1) ? $request->street1 : $company_address;
             $customer_details['country'] = isset($request->country) ? $request->country : $company_country;
             $shipping_details = $customer_details;

            //TODO: EXPLODING THE STRING AND CONVERTING INTO ARRAYS
            $sku = $request->sku;
            $description = $request->description;
            $unit_cost = $request->unit_cost;
            $quantity = $request->quantity;
            $discount = $request->discount;
            $item_tax = $request->item_tax;
            $item_total = $request->item_total;
            $discount_amount = $request->discount_amount;
            $tax_total = $request->tax_total;

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
                'total' => (float)$request->total_amount,
                'line_items' => $line_items
            ];


             $data['profile_id'] = $paytab->profile_id;
             $data['tran_type'] = $request->tran_type;
             $data['tran_class'] = "ecom";
             if($company_details->company_profile == 1)
             {
                $data['tokenise'] = "2";
             }
             $data['cart_id'] = $cart_id;
             $data['cart_currency'] = $request->currency;
             $data['cart_description'] = isset($request->cart_description) ? $request->cart_description : "Payment with tok enabled, save card enabled";
             $data['callback'] = url('/api/payment-callback') .'/'. base64_encode(Auth::user()->id);
             $data['return'] = url('/api/callback') .'/'. base64_encode(Auth::user()->id);
             $data['paypage_lang'] = "en";
             $data['customer_details'] = $customer_details;
             $data['shipping_details'] = $shipping_details;
             $data['invoice'] = $invoice;
             $data['hide_shipping'] = true;
             $response = create_invoice_link($data, $paytab->server_key);
             //Returning Error if api response is not valid
             if(!isset($response['invoice_link']))
             {
                return response()->json(['status' => 400, 'message' => $response['message']]);
             }


            //TODO: Checking Customer against this company_id exist or not
            $checkCustomer = User::where(['email' => $request->email, 'company_id' => Auth::user()->id, 'customer_from' => 2])->first();
            //TODO: Customer Array
            $customer = $request->except( 'cart_description', 'currency', 'tax_total','customer_ref', 'invoice_ref','discount_amount', 'sku', 'tran_type','street1', 'state', 'description', 'unit_cost', 'item_total','quantity', 'discount', 'item_tax', 'total_amount', 'extra_charges', 'shipping_charges', 'extra_discount', 'sub_total');
            $customer['city'] = isset($request->state) ? $request->state : $company_state;
            $customer['address'] = isset($request->street1) ? $request->street1 : $company_address;
            $customer['country'] = isset($request->country) ? $request->country : $company_country;
            $customer['phone'] = isset($request->phone) ? $request->phone : $company_phone;
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
            $latest_invoice = Invoice::where('company_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
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
            $transaction['customer_ref'] = isset($request->customer_ref) ? $request->customer_ref : $company_details->customer_ref;
            $transaction['invoice_ref'] = isset($request->invoice_ref) ? $request->invoice_ref : $company_details->invoice_ref;
            $transaction['invoice_id'] = $invoice_id;
            $transaction['redirect_url'] = $response['invoice_link'];
            $transaction['tran_id'] = $tran_id;
            $transaction['cart_amount'] = $request->total_amount;
            $transaction['tran_count'] = $request->total_amount;
            $transaction['conversion_rate'] = $conversion_rate;
            $transaction['conversion_amount'] = $request->total_amount * $conversion_rate;
            $transaction['transferable_amount'] = $request->total_amount * $conversion_rate;
            $transaction['type'] = 3;
            $transaction['payment_method'] = 'Visa';
            $transaction['tran_type'] = $request->tran_type;
            $transaction['currency'] = $request->currency;
            $transaction['cart_id'] =  $data['cart_id'];
            $transaction['account_type'] = $paytab->type;
            $transaction['description'] = isset($request->cart_description) ? $request->cart_description : "Payment with tok enabled, save card enabled";
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

            CompanySendEmail(admin_company_id(), 6, $varMap, $request->email);
            return response()->json(['status' => 200, 'message' => $response['invoice_link']]);
        }catch(\Exception $ex)
        {
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }


     //TODO: Charging the amount from the customer
    public function charge_payment(Request $request)
    {
        try{
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
        $data = $request->except('id');
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
            return response()->json(['status' => 400, 'message' => $response['message']]);
        }

        //TODO: Saving Transaction Reponse
        CompanySendEmail(admin_company_id(), $response['tran_ref'] ,json_encode($response), '');

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

        CompanySendEmail(admin_company_id(), 4, $varMap, $request->email);
        return response()->json(['status' => 200, 'message' => 'Payment Charged Successfully!']);
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
     }


     //TODO: Charging the amount from the customer
     public function voided_payment(Request $request)
     {
        try{
            //TODO: Getting Active Paytabs Account Details
            $paytab = Paytab::where(['active' => 1, 'company_id' => admin_company_id()])->first();
            //Getting User ID Here
            $users = Transaction::where('id', $request->id)->first();
            $real_user = User::where('id', $users->user_id)->first();
            //TODO: Sending Array to Paytabs for creating new user and payment link
            $data = $request->except('id');
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
                return response()->json(['status' => 400, 'message' => $response['message']]);
            }

            //TODO: Saving Transaction Reponse
            CompanySendEmail(admin_company_id(), $response['tran_ref'] ,json_encode($response), '');

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
            //TODO: If Application Mode is set to live
            if ($this->app_mode() == 1) {
                $journal = new Journal;
                $journal->company_id = Auth::user()->id;
                $journal->type = "Payment Voided";
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

        CompanySendEmail(admin_company_id(), 7, $varMap, $request->email);
        return response()->json(['status' => 200, 'message' => 'Payment Charged Successfully!']);
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
     }

     //TODO: Voided the amount from the customer
    public function refund_payment(Request $request)
    {
        try{

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
        $data = $request->except('id');
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
            return response()->json(['status' => 200, 'message' => $response['message']]);
        }

        //TODO: Saving Transaction Reponse
        CompanySendEmail(admin_company_id(), $response['tran_ref'] ,json_encode($response), '');

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
        $transaction['type'] = 7;
        $transaction['cart_id'] = $cart_id;
        $transaction['description'] = $request->description;
        $transaction['account_type'] = $paytab->type;
        $transaction['parent_id'] = $request->id;
        $transaction['status'] = $response['payment_result']['response_status'];
        $transaction['resp_msg'] = $response['payment_result']['response_message'];
        $transaction['resp_code'] = $response['payment_result']['response_code'];
        Transaction::create($transaction);
        //TODO: If Application Mode is set to live
        if ($this->app_mode() == 1) {
            $journal = new Journal;
            $journal->company_id = Auth::user()->id;
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

        CompanySendEmail(admin_company_id(), 8, $varMap, $request->email);

        return response()->json(['status' => 200, 'message' => 'Payment Refunded Successfully!']);
        }catch(\Exception $ex)
        {
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    //TODO: Capture the amount from the customer
    public function capture_payment(Request $request)
    {

        try{
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
        $data['tran_class'] = "ecom";
        $data['cart_id'] = $request->cart_id;
        $data['cart_currency'] = $request->currency;
        $data['cart_amount'] = $request->amount;
        $data['cart_description'] = 'Captruing The Paymentt';
        $response = refund_payment($data, $paytab->server_key);
        //Returnning Error if api response is not valid
        if(!isset($response['tran_ref']))
        {
            return response()->json(['status' => 500, 'message' => $response['messages']]);
        }

        //TODO: Saving Transaction Reponse
        SaveTrash(Auth::user()->id, $response['tran_ref'] ,json_encode($response), '');

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
        $transaction['company_id'] = Auth::user()->id;
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

            return response()->json(['status' => 500, 'message' => 'Payment Captured Successfully!']);
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

     //TODO: Send Messsage
    public function send_message(Request $request)
    {
        try{
            if(!$request->phone)
            {
                return response()->json(['status' => 400, 'message' => 'Phone number not found!']);
            }
            $alias = 'MYPAY-' . rand(1, 10000);
            $response = create_tiny_url($request->link, $alias);
            $sms = User::where('id', admin_company_id())->first();

            if(Auth::user()->id == 1)
            {
                if($response['code'] == 0)
                {
                    $message = "Dear ". $request->name ." Please find below your payment link: " . $response['data']['tiny_url'];
                    send_message(admin_company_id(), $request->phone, $message);
                    return response()->json(['status' => 200, 'message' => 'Message sent successfully!']);
                }
            }
            else if($sms->sms_limit > 0)
                {
                    if($response['code'] == 0)
                {
                    $message = "Dear ". $request->name ." Please find below your payment link: " . $response['data']['tiny_url'];
                    send_message(admin_company_id(), $request->phone, $message);
                    //updated Messages
                    $messages = $sms->sms_limit - 1;
                    User::where('id', admin_company_id())->update(['sms_limit' => $messages]);
                    return response()->json(['status' => 200, 'message' => 'Message sent successfully!']);

                }
                }
                else
                {
                    return response()->json(['status' => 400, 'message' => 'Your Message Cotta is Completed! Can\'t Send Message']);
                }


        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);

        }
    }

    //TODO: For Soft Delete Transaction
    public function delete(Request $request)
    {
        try{
            Transaction::where('id', $request->id)->update(['is_delete' => 1]);
            return response()->json(['status' => 200, 'message' => 'Transaction link deleted successfully!']);
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    //TODO: Send Email along with payment link
    public function send_email(Request $request)
    {
        try{
            //TODO: Getting Transaction Details
            $transaction = Transaction::where(['id' => $request->id])->first();
            //TODO: Sending Email Here
            $token = array(
                'PaymentLinkButton'  => '<a href="'.$request->link.'"><button  class="btn btn-danger">Payment Link</button></a>',
                'Name' => $request->name,
                'InvoiceTotal' => $transaction->cart_amount,
            );
            $pattern = '[%s]';
            foreach($token as $key=>$val){
                $varMap[sprintf($pattern,$key)] = $val;
            }

            CompanySendEmail(admin_company_id(), 6, $varMap, $request->email);
            return response()->json(['status' => 200, 'message' => 'Email Sent Successfully!']);
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    //TODO: Get transactions api
    public function get_transaction(Request $request)
    {
        try{
            // $transactions = Transaction::with(['users' => function($query){
            //     $query->where('customer_from',2);
            // }])->withCount('transactions')->where(['company_id' => Auth::user()->id, 'is_delete' => 0, 'account_type' => $this->app_mode()])->where('type', '!=', 1)->where('type', '!=', 2)->orderBy('id', 'DESC')->get();

            if(CheckUseRole() == 1 || CheckUseRole() == 2 || CheckUseRole() == 3)
            {
                $transactions = Transaction::with('users')->where(['company_id' => admin_company_id(), 'account_type' => $this->app_mode()])->where('status', '!=', '')->orderBy('id', 'DESC')->get();
            }elseif(CheckUseRole() == 4)
            {
                $transactions = Transaction::with('users')->where('create_by', '!=', admin_company_id())->where(['company_id' => admin_company_id(), 'account_type' => $this->app_mode()])->where('status', '!=', '')->orderBy('id', 'DESC')->get();
            }
            else{
                $transactions = Transaction::with('users')->where('create_by', Auth::user()->id)->where(['company_id' => admin_company_id(), 'account_type' => $this->app_mode()])->where('status', '!=', '')->orderBy('id', 'DESC')->get();
            }

            return response()->json(['status' => 200, 'message' => 'Transactions Data', 'response' => $transactions]);
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

}
