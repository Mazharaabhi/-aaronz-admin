<?php

namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Company\Paytab;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Models\Administrator\UserRole;
use App\Models\Administrator\Operation;
use App\Models\Administrator\Privileg;
use App\Models\User;
use Validator;

class UserRoleController extends Controller
{

    //TODO: Loading paytabs config index view
    public function index(Request $request)
    {

        $add_permission = CheckPermission(config('const.ADD'), config('const.USERROLE'));
        $edit_permission = CheckPermission(config('const.EDIT'), config('const.USERROLE'));
        $delete_permission = CheckPermission(config('const.DELETE'), config('const.USERROLE'));
        $currencies = UserRole::orderBy('id', 'ASC')->where('company_id', admin_company_id())->orWhere('is_admin', 1)->get();

        if($request->ajax())
        {

            $currencies = UserRole::orderBy('id', 'ASC')->where('company_id', admin_company_id())->orWhere('is_admin', 1)->get();

            return Datatables::of($currencies)
            ->addIndexColumn()
            ->addColumn('is_default', function($currencies){
                if($currencies->is_default == 1)
                {
                    return 'Yes';
                }
                else
                {
                    return 'No';
                }
            })
            ->addColumn('action', function ($currencies) use($edit_permission, $delete_permission) {
               if($currencies->is_default == 0)
               {
                if($edit_permission == 1 && $delete_permission == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$currencies->id.'">
                    <input type="hidden" name="name" value="'.$currencies->name.'">
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
                    <input type="hidden" name="id" value="'.$currencies->id.'">
                    <input type="hidden" name="name" value="'.$currencies->name.'">
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
                }elseif($delete_permission == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$currencies->id.'">
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
               }

            })
            ->rawColumns(['action', 'is_default'])
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }

        return view('admin.administrator.user-role.index', compact('add_permission'));
    }

    //TODO: Creating paytabs record here
    public function create(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if($validator->fails()) return 'Cyber';

        //TODO: Checking cart id is unique or not
        $checkFromCurrency = UserRole::where(['name' => $request->name, 'company_id' => admin_company_id()])->first();
        if(!is_null($checkFromCurrency)) return 'name';

        $role = new UserRole;
        $role->name = $request->name;
        $role->company_id = admin_company_id();
        $role->create_by = Auth::user()->id;
        $role->save();

        //Saving Privilages Here
        $operations = Operation::where('is_admin',1)->get();

        foreach($operations as $item)
        {
            Privileg::create([
                'company_id' => admin_company_id(),
                'role_id' => $role->id,
                'operation_id' => $item->id,
                'module_id' => $item->module_id
            ]);
        }


        return 'true';
    }

    public function edit(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id' => 'required'
        ]);
        if($validator->fails()) return 'Cyber';

        //TODO: Checking cart id is unique or not
        $checkFromCurrency = UserRole::where(['name' => $request->name, 'company_id' => admin_company_id()])->first();
        if(!is_null($checkFromCurrency)){
            if($checkFromCurrency->id != $request->id) return 'name';
        }

        $role = UserRole::find($request->id);
        $role->name = $request->name;
        $role->modify_by = Auth::user()->id;
        $role->update();

        return 'true';
    }

    //TODO: Change status of paytabs account
    public function status(Request $request)
    {
        if($request->active == 1)
        {
            $active = 0;
        }
        else
        {
            $active = 1;
        }
        Currency::where('id' , $request->id)->update(['active' => $active]);
    }

    public function delete(Request $request)
    {
        UserRole::find($request->id)->delete();
    }
}
