<?php

namespace App\Http\Controllers\Admin\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\User;
use App\Models\Admin\Email\EmailCategory;
use DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class EmailCategoryController extends Controller
{
    //TODO: Loading Email Categoryt View Page
    public function index(Request $request)
    {
        $add_permission = CheckPermission(config('const.ADD'), config('const.EMAILCATEGORY'));
        $edit_permission = CheckPermission(config('const.EDIT'), config('const.EMAILCATEGORY'));
        $status_permission = CheckPermission(config('const.STATUS'), config('const.EMAILCATEGORY'));
        //TODO: Passing Data to yajra Datatables
        if($request->ajax())
        {
            $email_category = EmailCategory::orderBy('id', 'DESC')->get();
            return Datatables::of($email_category)
            ->addIndexColumn()
            ->addColumn('status', function($email_category) use($status_permission){
               if($status_permission == 1)
               {
                if($email_category->is_active == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$email_category->id.'">
                    <input type="hidden" name="is_active" value="'.$email_category->is_active.'">
                    <a id="status" class="btn btn-icon btn-light btn-hover-success btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Active">
                    <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Unlock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <mask fill="white">
                                <use xlink:href="#path-1"/>
                            </mask>
                            <g/>
                            <path d="M15.6274517,4.55882251 L14.4693753,6.2959371 C13.9280401,5.51296885 13.0239252,5 12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L14,10 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C13.4280904,3 14.7163444,3.59871093 15.6274517,4.55882251 Z" fill="#000000"/>
                        </g>
                    </svg></span>
                    </a>
                    ';
                }
                else
                {
                    return '
                    <input type="hidden" name="id" value="'.$email_category->id.'">
                    <input type="hidden" name="is_active" value="'.$email_category->is_active.'">
                    <a id="status" class="btn btn-icon btn-light btn-hover-danger btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Deactivated">
                    <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Lock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <mask fill="white">
                            <use xlink:href="#path-1"/>
                        </mask>
                        <g/>
                        <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"/>
                    </g>
                    </svg></span>
                    </a>
                    ';
                }
               }
            })
            ->addColumn('action', function ($email_category) use($edit_permission){
                if($edit_permission == 1)
                {
                    return '
                <input type="hidden" name="id" value="'.$email_category->id.'">
                <input type="hidden" name="category_name" value="'.$email_category->category_name.'">
                <input type="hidden" name="email_subject" value="'.$email_category->email_subject.'">
                <input type="hidden" name="tags" value="'.$email_category->tags.'">
                <a id="edit" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="tooltip" data-theme="dark" title="Edit">
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
            //     <a id="delete" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
            //     <span class="svg-icon svg-icon-md svg-icon-danger">
            //     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            //         <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            //             <rect x="0" y="0" width="24" height="24"></rect>
            //             <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
            //             <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
            //         </g>
            //     </svg>
            // </span>
            //     </a>
            })
            ->rawColumns(['status', 'action'])
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }
        $tags = DB::table('email_tags')->get();
        return view('admin.email.email-category.index', compact('tags', 'add_permission'));
    }

    //TODO: Creating Email Catrgoy
    public function create(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|min:3',
            'email_subject' => 'required|min:3',
        ]);
        if($validator->fails()) return 'Cyber';

        // TODO: Checking if category name exits or not
        $CheckTitleEnglish = EmailCategory::where('category_name', $request->category_name)->first();
        if(!is_null($CheckTitleEnglish)) return 'category_name';

        // TODO: Checking if category name exits or not
        $CheckEmailSubject = EmailCategory::where('email_subject', $request->email_subject)->first();
        if(!is_null($CheckEmailSubject)) return 'email_subject';

        // TODO: Creating Email Category here
        $email_category = $request->except('_token');
        $email_category['create_by'] = Auth::user()->id;
        EmailCategory::create($email_category);
        return 'true';
    }

    //TODO: Upating Email Category here
    public function update(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'category_name' => 'required|min:3',
            'email_subject' => 'required|min:3',
        ]);

        if($validator->fails()) return 'Cyber';

        // TODO: Checking if category name  is already exits or not;
        $CheckTitleEnglish = EmailCategory::where('category_name', $request->category_name)->first();
        if(!is_null($CheckTitleEnglish) && $CheckTitleEnglish->id != $request->id) return 'category_name';

        // TODO: Checking if eamil subject or slug is already exits or not;
        $CheckEmailSubject = EmailCategory::where('email_subject', $request->email_subject)->first();
        if(!is_null($CheckEmailSubject) && $CheckEmailSubject->id != $request->id) return 'email_subject';

        //TODO: Updating Email Category
        $email_category = $request->except('id','_token');
        $email_category['modify_by'] = Auth::user()->id;
        EmailCategory::where('id',$request->id)->update($email_category);
        return 'true';
    }
    //TODO: Deleting Email Category here
    public function delete(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if($validator->fails()) return 'Cyber';
        // TODO: Delete Email Category here
        EmailCategory::find($request->id)->Delete();
        return 'true';
    }

    //TODO: Changing the is_active status
    public function is_active(Request $request)
    {
        if($request->is_active == 1)
        {
            EmailCategory::where('id', $request->id)->update(['is_active' => 0, 'modify_by' => Auth::user()->id]);
        }
        else
        {
            EmailCategory::where('id', $request->id)->update(['is_active' => 1, 'modify_by' => Auth::user()->id]);
        }
    }
}
