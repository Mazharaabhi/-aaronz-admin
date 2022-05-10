<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Admin\Accounts\Withdrawal;
use App\Models\Admin\Accounts\TransferableAmount;

class LiabilityControllController extends Controller
{
    //TODO: Loading liabillity index view
    public function index(Request $request)
    {
        $lib_due = TransferableAmount::sum('transferable_amount');
        $lib_paid = Withdrawal::where('status', 1)->sum('amount');
        if($request->ajax())
        {
            $withdraws = Withdrawal::orderBy('id', 'DESC')->where('status', 1)->get();
            return Datatables::of($withdraws)
            ->addIndexColumn()
            ->addColumn('time', function($withdrawal_requests) {
                $date = $withdrawal_requests->created_at->format('d F Y H:i:s');
                return '<input type="hidden" id="row_'.$withdrawal_requests->id.'" value="'.$withdrawal_requests->id.'">' . $date;
            })
            ->rawColumns(['time'])
            ->make(true);
        }
        return view('admin.accounts.liabilities.index', compact('lib_due', 'lib_paid'));
    }
}
