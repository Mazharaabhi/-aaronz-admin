<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Company\Paytab;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Models\User;
use App\Models\Admin\Company\Bank;
use Validator;

class CompanyBanksController extends Controller
{
    //TODO: Loading Bank Accounts index view
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $users = User::join('banks', 'banks.company_id', '=', 'users.id')->where(['users.user_role' => 2, 'users.is_active' => 1])
            ->orderBy('banks.id', 'DESC')->get([
                'banks.id',
                'users.company_name',
                'banks.bank_name',
                'banks.bic',
                'banks.account_name',
                'banks.iban',
                'banks.account_no',
                'banks.currency',
                'banks.status',
                'banks.is_active',
                'banks.company_id',
            ]);
            return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('active', function($users) {
                    if($users->is_active == 1)
                {
                    return '<label class="label label-lg label-light-success label-inline">Active</label>';
                }
                else
                {
                    return '<label class="label label-lg label-light-danger label-inline">Not active</label>';
                }
            })
            ->addColumn('status', function($users) {
                    if($users->status == 0)
                    {
                        return '<label class="label label-lg label-light-warning label-inline">Pending</label>';
                    }
                    elseif($users->status == 1)
                    {
                        return '<label class="label label-lg label-light-success label-inline">Approved</label>';
                    }
                    else
                    {
                        return '<label class="label label-lg label-light-danger label-inline">Rejected</label>';
                    }
            })
            ->addColumn('action', function ($users) {
                    return '
                 <input type="hidden" name="company_id" value="'.$users->company_id.'">
                 <input type="hidden" name="bank_name" value="'.$users->bank_name.'">
                 <input type="hidden" name="bic" value="'.$users->bic.'">
                 <input type="hidden" name="account_name" value="'.$users->account_name.'">
                 <input type="hidden" name="iban" value="'.$users->iban.'">
                 <input type="hidden" name="status" value="'.$users->status.'">
                 <a id="edit" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
            })
            ->rawColumns(['status', 'action', 'active'])
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }

        $users_count = Paytab::where('company_id', Auth::user()->id)->count();
         //TODO: Getting last company cart number to create cart_id
         $last_record = User::where(['user_role' => 2])->where('cart_number', '!=', '')->orderBy('cart_number','DESC')->first();
         $cart_number = rand(1, 100000);
        $companies = User::where(['user_role' => 2, 'is_active' => 1])->orderBy('id', 'DESC')->get();
        return view('admin.companies.companies-banks.index', compact('users_count', 'cart_number', 'companies'));
    }

    //TODO: Creating users record here
    public function create(Request $request)
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
        //TODO: CHECKING BANK ACCOUNT NO ALREADY EXISTS OR NOT
        $checkAccountNo = Bank::where(['account_no' => $request->account_no])->first();
        if(!is_null($checkAccountNo)) return 'account_no';

        //TODO: CREATING NEW BANK HERE
        Bank::create($request->except('token'));
        return 'true';
    }

    //TODO: Creating users record here
    public function update(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'currency' => 'required',
            'profile_id' => 'required',
            'server_key' => 'required',
        ]);

        if($validator->fails()) return 'Cyber';

        Paytab::where('id', $request->id)->update($request->except('id','_token'));
        return 'true';
    }

    //TODO: Change status of users account
    public function status(Request $request)
    {
        Paytab::where('company_id', Auth::user()->id)->update(['active' => 0]);
        Paytab::where('id', $request->id)->update(['active' => 1]);

    }
}
