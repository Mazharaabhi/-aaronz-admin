<?php

namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Company\Paytab;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Models\Administrator\UserRole;
use App\Models\Administrator\Privileg;
use App\Models\User;
use Validator;
use App\Models\Administrator\Module;

class RolePermissionController extends Controller
{
    //TODO: Loading paytabs config index view
    public function getPermission()
    {
        return CheckPermission(config('const.EDIT'), config('const.ROLEPERMISSION'));
    }

    public function index(Request $request)
    {

        $permission = $this->getPermission();
        if($request->ajax())
        {
            $currencies = UserRole::orderBy('id', 'ASC')->where(['company_id' => admin_company_id()])->orWhere('is_admin',1)->get();
            return Datatables::of($currencies)
            ->addIndexColumn()
            ->addColumn('action', function ($currencies) use($permission){
                    if($permission == 1)
                    {
                        return '
                        <a class="btn btn-sm btn-danger" href="'.route("admin.administrator.role-permission.edit", [$currencies->id]).'">
                        <span class="svg-icon menu-icon">
                                                <!--begin::Svg Icon | Path:/assets/media/svg/icons/Design/Bucket.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                        Role Permission Settings
                        </a>
                    ';
                    }

            })
            ->rawColumns(['action'])
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }

        return view('admin.administrator.role-permission.index');
    }

    //For Edit Role Permissions
    public function edit($id)
    {
        $modules = Module::has('operations')->with(['operations' => function($query)
        {
            $query->where('is_admin', 1)->orderBy('id', 'ASC');
        }])->where(['is_admin' => 1, 'is_show' => 1])->orderBy('sort', 'ASC')->get();
        // return $modules;
        $default = UserRole::where('id', $id)->pluck('is_default')->first();
        $role_id = $id;
        return view('admin.administrator.role-permission.role', compact('modules', 'role_id', 'default'));
    }

    //For Update Role Permissions
    public function update(Request $request)
    {
        // return $request->all();
        foreach($request->operation_id as $key => $item)
        {
             Privileg::where(['id' => $item])
            ->update([
                'is_view' => isset($request->is_view[$key])  ? $request->is_view[$key] : 0,
                'is_add' => isset($request->is_add[$key])  ?  $request->is_add[$key] : 0,
                'is_edit' => isset($request->is_edit[$key])  ? $request->is_edit[$key] : 0,
                'is_status' => isset($request->is_status[$key])  ? $request->is_status[$key] : 0,
                'is_delete' => isset($request->is_delete[$key])  ? $request->is_delete[$key] : 0,
                'modify_by' => Auth::user()->id
            ]);
        }

        return redirect()->back();
    }

}
