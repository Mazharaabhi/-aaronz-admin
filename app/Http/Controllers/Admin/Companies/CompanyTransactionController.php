<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Paylinks\Transaction;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class CompanyTransactionController extends Controller
{
    // TODO: Loading Companies Transactions view
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $transactions = Transaction::has('companies')->with('companies')->with('users')->where('company_id', '!=', Auth::user()->id)->where(['account_type' => $request->session()->get('admin_application_mode')])->where('status', '!=', '')->orderBy('id', 'DESC')->get();
            return Datatables::of($transactions)
            ->addIndexColumn()
            ->editColumn('id', 'ID: {{$id}}')
            ->addColumn('account_type', function($transactions){
                if($transactions->account_type == 1)
                {
                    return 'Merchant';
                }
                else
                {
                    return 'Sandbox';
                }
            })
            ->addColumn('status', function ($transactions) {

                if($transactions->status == 'A')
                {
                    return '<span class="label label-success mr-2">A</span>';
                }
                elseif($transactions->status == 'H')
                {
                    return '<span class="label label-warning mr-2">H</span>';
                }
                elseif($transactions->status == 'V')
                {
                    return '<span class="label label-primary mr-2">V</span>';
                }
                elseif($transactions->status == 'E')
                {
                    return '<span class="label label-danger mr-2">E</span>';
                }
                elseif($transactions->status == 'D')
                {
                    return '<span class="label label-danger mr-2">D</span>';
                }
            })
            ->rawColumns(['status', 'account_type'])
            ->make(true);
        }
        return view('admin.companies.companies-transactions.index');
    }
}
