<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\CommonModel\Country;

class SaleController extends Controller
{
    //TODO: Loading manage customer index view
    public function index(Request $request)
    {

        if($request->ajax())
        {
            $users = User::withCount(['staff_transactions' => function($query)
            {
                return $query->where('status', '!=', '')->where('create_by', '!=', admin_company_id());
            }])->where(['role_id' => 5, 'company_id' => admin_company_id()])->orderBy('id', 'DESC')->get();
            return Datatables::of($users)
            ->addIndexColumn()
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }
        return view('admin.sales.sale-staff.index');
    }
}
