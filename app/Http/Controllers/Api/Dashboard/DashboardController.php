<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Paylinks\Transaction;
use Illuminate\Support\Carbon;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Company\Paytab;

class DashboardController extends Controller
{


    public function app_mode()
    {
         return Paytab::where(['active' => 1, 'company_id' => Auth::user()->id])->pluck('type')->first();
    }
    //TODO: Loading admin dashboard page view
    public function get_company_data(Request $request)
    {
        try{
            if(CheckUseRole() == 1 || CheckUseRole() == 2 || CheckUseRole() == 3)
            {
                $transactions = Transaction::with('users')->where(['company_id' => admin_company_id(), 'account_type' => $this->app_mode()])->where('status', '!=', '')->orderBy('id', 'DESC')->limit(30)->get();
            }
            elseif(CheckUseRole() == 4)
            {
                $transactions = Transaction::with('users')->where(['company_id' => admin_company_id(), 'account_type' => $this->app_mode()])
                ->where('create_by', '!=', admin_company_id())->where('status', '!=', '')->orderBy('id', 'DESC')->limit(30)->get();
            }
            else
            {
                $transactions = Transaction::with('users')->where(['company_id' => admin_company_id(), 'account_type' => $this->app_mode()])
                ->where('create_by', Auth::user()->id)->where('status', '!=', '')->orderBy('id', 'DESC')->limit(30)->get();
            }
        //TODO: Applying Conversion Rate On Transactions
        if(count($transactions))
        {
            foreach($transactions as $tran)
            {
                $conversion = Currency::where('from_currency', $tran->currency)->first();
                $tran->conversion_amount = (float)$tran->conversion_amount;
                $tran->rate = (float)$tran->conversion_rate;
                $tran->from_currency = $conversion->from_currency . 'to' . $conversion->to_currency ;

            }
        }
        $all = Transaction::where(['payment_date' => date('Y-m-d'), 'company_id' => Auth::user()->id, 'account_type' => $this->app_mode()])->where('status', '!=', '')->count();

        //TODO: Getting All Today Net Sales For Capture
        $today_net_sales_capture = Transaction::where(
            ['payment_date' => date('Y-m-d'), 'company_id' => Auth::user()->id, 'tran_type' => 'capture', 'status' => 'A', 'account_type' => $this->app_mode()]
        )->get();
        //TODO Calculating Converion Rate
        $today_net_sales_capture_conversion_rate = 0;
        if(count($today_net_sales_capture) > 0)
        {
            foreach($today_net_sales_capture as $capture)
            {
                $conversion = Currency::where('from_currency', $capture->currency)->first();
                $today_net_sales_capture_conversion_rate += $capture->cart_amount * $conversion->rate;
            }
        }
        //TODO: Getting All Today Net Sales For sale
        $today_net_sales_sale = Transaction::where(
            ['payment_date' => date('Y-m-d'), 'company_id' => Auth::user()->id, 'tran_type' => 'sale', 'status' => 'A', 'account_type' => $this->app_mode()]
        )->get();
        //TODO Calculating Converion Rate
        $today_net_sales_sale_conversion_rate = 0;
        if(count($today_net_sales_sale) > 0)
        {
            foreach($today_net_sales_sale as $sale)
            {
                $conversion = Currency::where('from_currency', $sale->currency)->first();
                $today_net_sales_sale_conversion_rate += $sale->cart_amount * $conversion->rate;
            }
        }
        //TODO: Getting All Today Net Sales For auth
        $today_net_sales_auth = Transaction::where(
            ['payment_date' => date('Y-m-d'), 'company_id' => Auth::user()->id, 'tran_type' => 'auth', 'status' => 'A', 'account_type' => $this->app_mode()]
        )->get();
        //TODO Calculating Converion Rate
        $today_net_sales_auth_conversion_rate = 0;
        if(count($today_net_sales_auth) > 0)
        {
            foreach($today_net_sales_auth as $auth)
            {
                $conversion = Currency::where('from_currency', $auth->currency)->first();
                $today_net_sales_auth_conversion_rate += $auth->cart_amount * $conversion->rate;
            }
        }
        //TODO: Getting All Today Net Sales For Refund
        $today_refund = Transaction::where(['payment_date' => date('Y-m-d'), 'company_id' => Auth::user()->id, 'status' => 'A' ,'account_type' => $this->app_mode()])
        ->where('tran_type', 'Refund')
        ->get();
        //TODO Calculating Converion Rate
        $today_refund_conversion_rate = 0;
        if(count($today_refund) > 0)
        {
            foreach($today_refund as $refund)
            {
                $conversion = Currency::where('from_currency', $refund->currency)->first();
                $today_refund_conversion_rate += $refund->cart_amount * $conversion->rate;
            }
        }
        //TODO: Getting Today Net Voids
        $today_void = Transaction::where(['payment_date' => date('Y-m-d'), 'company_id' => Auth::user()->id, 'status' => 'A' ,'account_type' => $this->app_mode()])
        ->where('tran_type', 'Void')
        ->get();
        //TODO Calculating Converion Rate
        $today_void_conversion_rate = 0;
        if(count($today_void) > 0)
        {
            foreach($today_void as $void)
            {
                $conversion = Currency::where('from_currency', $void->currency)->first();
                $today_void_conversion_rate += $void->cart_amount * $conversion->rate;
            }
        }
        //TODO: Calculating Todays's All Sales
        $NetTodaySales = $today_net_sales_capture_conversion_rate + $today_net_sales_sale_conversion_rate + $today_net_sales_auth_conversion_rate;
        $NetTodayLoss =  $today_refund_conversion_rate + $today_void_conversion_rate;
        $salesToday = $NetTodaySales - $NetTodayLoss;

        if($request->ajax())
        {
            return json_encode([
                'salesToday' => $NetTodaySales,
                'salesMonth' => $NetTodayLoss,
                'transactions' => $transactions
            ]);
        }

        //TODO: Getting All Month Net Sales For Capture
        $month_net_sales_capture = Transaction::where(['company_id' => Auth::user()->id, 'tran_type' => 'capture', 'status' => 'A' ,'account_type' => $this->app_mode()])
        ->whereMonth('created_at', Carbon::now()->month)->get();
        //TODO Calculating Converion Rate
        $month_net_sales_capture_conversion_rate = 0;
        if(count($month_net_sales_capture) > 0)
        {
            foreach($month_net_sales_capture as $capture)
            {
                $conversion = Currency::where('from_currency', $capture->currency)->first();
                $month_net_sales_capture_conversion_rate += $capture->cart_amount * $conversion->rate;
            }
        }
        //TODO: Getting All Month Net Sales For Sale
        $month_net_sales_sale = Transaction::where(['company_id' => Auth::user()->id, 'tran_type' => 'sale', 'status' => 'A' ,'account_type' => $this->app_mode()])
        ->whereMonth('created_at', Carbon::now()->month)->get();
        //TODO Calculating Converion Rate
        $month_net_sales_sale_conversion_rate = 0;
        if(count($month_net_sales_sale) > 0)
        {
            foreach($month_net_sales_sale as $sale)
            {
                $conversion = Currency::where('from_currency', $sale->currency)->first();
                $month_net_sales_sale_conversion_rate += $sale->cart_amount * $conversion->rate;
            }
        }
        //TODO: Getting All Month Net Sales For auth
        $month_net_sales_auth = Transaction::where(['company_id' => Auth::user()->id, 'tran_type' => 'auth', 'status' => 'A' ,'account_type' => $this->app_mode()])
        ->whereMonth('created_at', Carbon::now()->month)->get();
        //TODO Calculating Converion Rate
        $month_net_sales_auth_conversion_rate = 0;
        if(count($month_net_sales_auth) > 0)
        {
            foreach($month_net_sales_auth as $auth)
            {
                $conversion = Currency::where('from_currency', $auth->currency)->first();
                $month_net_sales_auth_conversion_rate += $auth->cart_amount * $conversion->rate;
            }
        }
        //TODO: Getting All Month Net Sales For Refund
        $month_refund = Transaction::where(['company_id' => Auth::user()->id, 'status' => 'A' ,'account_type' => $this->app_mode()])
        ->where('tran_type', 'Refund')
        ->whereMonth('created_at', Carbon::now()->month)->get();
        //TODO Calculating Converion Rate
        $month_refund_conversion_rate = 0;
        if(count($month_refund) > 0)
        {
            foreach($month_refund as $refund)
            {
                $conversion = Currency::where('from_currency', $refund->currency)->first();
                $month_refund_conversion_rate += $refund->cart_amount * $conversion->rate;
            }
        }
        //TODO: Getting Month Net Voids
        $month_void = Transaction::where(['company_id' => Auth::user()->id, 'status' => 'A' ,'account_type' => $this->app_mode()])
        ->where('tran_type', 'Void')
        ->whereMonth('created_at', Carbon::now()->month)->get();
        //TODO Calculating Converion Rate
        $month_void_conversion_rate = 0;
        if(count($month_void) > 0)
        {
            foreach($month_void as $void)
            {
                $conversion = Currency::where('from_currency', $void->currency)->first();
                $month_void_conversion_rate += $void->cart_amount * $conversion->rate;
            }
        }
        //TODO: Calculating Month's All Sales
        $MonthtotalSales = $month_net_sales_capture_conversion_rate + $month_net_sales_sale_conversion_rate + $month_net_sales_auth_conversion_rate;
        $lossMonth = $month_refund_conversion_rate + $month_void_conversion_rate;
        $salesMonth = $MonthtotalSales - $lossMonth;

        $data = [
                'salesToday' => $salesToday,
                'salesMonth' => $salesMonth,
                'transactions' => $transactions
            ];

            return response()->json(['status' => 200, 'message' => 'Company Dashboard Data!', 'response' => $data]);
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }

    }
}
