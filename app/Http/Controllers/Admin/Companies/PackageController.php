<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Company\Paytab;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Models\User;
use App\Models\Admin\Company\Bank;
use App\Models\Admin\Company\Package;
use Validator;

class PackageController extends Controller
{
    //TODO: Loading Bank Accounts index view
    public function index(Request $request)
    {
        $add_permission = CheckPermission(config('const.ADD'), config('const.PACKAGES'));
        $edit_permission = CheckPermission(config('const.EDIT'), config('const.PACKAGES'));
        if($request->ajax())
        {
            $packages = Package::all();
            return Datatables::of($packages)
            ->addIndexColumn()
            ->addColumn('action', function ($packages) use ($edit_permission){
                if($edit_permission == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$packages->id.'">
                    <input type="hidden" name="name" value="'.$packages->name.'">
                    <input type="hidden" name="sales_limit" value="'.$packages->sales_limit.'">
                    <input type="hidden" name="tax" value="'.$packages->tax.'">
                    <input type="hidden" name="charge" value="'.$packages->charge.'">
                    <input type="hidden" name="type" value="'.$packages->type.'">
                    <input type="hidden" name="american_tax" value="'.$packages->american_tax.'">
                    <input type="hidden" name="withdraw_charges" value="'.$packages->withdraw_charges.'">
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
                }
                // <a id="delete" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="" aria-describedby="ui-tooltip-1">
                // <span class="svg-icon svg-icon-md svg-icon-danger">
                // <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                //     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                //         <rect x="0" y="0" width="24" height="24"></rect>
                //         <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                //         <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                //     </g>
                // </svg>
                // </span>
                // </a>
            })
            ->rawColumns(['action'])
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }

        $users_count = Paytab::where('company_id', Auth::user()->id)->count();
         //TODO: Getting last company cart number to create cart_id
         $last_record = User::where(['user_role' => 2])->where('cart_number', '!=', '')->orderBy('cart_number','DESC')->first();
         $cart_number = rand(1, 100000);
        $companies = User::where(['user_role' => 2, 'is_active' => 1])->orderBy('id', 'DESC')->get();
        return view('admin.companies.packages.index', compact('users_count', 'cart_number', 'companies', 'add_permission'));
    }

    //TODO: Creating users record here
    public function create(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'sales_limit' => 'required',
            'type' => 'required',
        ]);
        if($validator->fails()) return 'Cyber';


        //TODO: CHECKING IBAN ALREADY EXISTS OR NOT
        $checkPackageName = Package::where(['name' => $request->name])->first();
        if(!is_null($checkPackageName)) return 'name';
        $package = $request->except('token');
        $package['create_by'] = Auth::user()->id;
        Package::create($package);
        return 'true';
    }

    //TODO: Creating users record here
    public function update(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'sales_limit' => 'required',
            'type' => 'required',
        ]);
        if($validator->fails()) return 'Cyber';

        //TODO: CHECKING IBAN ALREADY EXISTS OR NOT
        $checkPackageName = Package::where(['name' => $request->name])->first();
        if(!is_null($checkPackageName))
        {
            if($checkPackageName->id != $request->id)
            {
                return 'name';
            }
        }
        $package = $request->except('id','_token');
        $package['modify_by'] = Auth::user()->id;
        //TODO: UPDATING BANK HERE
        Package::where('id', $request->id)->update($package);
        return 'true';
    }

     //TODO: Change status of paytabs account
     public function status(Request $request)
     {
         Bank::where('company_id', Auth::user()->id)->update(['is_active' => 0]);
         Bank::where('id', $request->id)->update(['is_active' => 1]);
     }

    //TODO: DELETE BANK
    public function delete(Request $request)
    {
        BANK::where('id', $request->id)->delete();
    }
}
