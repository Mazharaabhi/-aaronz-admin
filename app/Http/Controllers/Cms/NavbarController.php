<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Validator;
use App\Models\User;
use App\Models\Cms\Navbar;
use App\Models\Admin\Settings\Language;
use App\Models\Cms\Page;
use Illuminate\Support\Facades\Auth;
class NavbarController extends Controller
{
    //TODO: Loading Manage Navbar View Page
    public function index(Request $request)
    {
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        //TODO: Passing Data to yajra Datatables
        if($request->ajax())
        {
         $navbars = Navbar::orderBy('sort', 'asc')->where('lang_id', 1)->get();
         return Datatables::of($navbars)
         ->addIndexColumn()
            ->addColumn('status', function($navbars) {
             if($navbars->status == 1)
                 {
                     return '<input type="hidden" name="id" value="'.$navbars->id.'">
                     <input type="hidden" name="active" value="'.$navbars->status.'">
                     <a id="change_status" data-id="'.$navbars->id.'" class="btn btn-icon btn-light btn-hover-success btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Active">
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
                     <input type="hidden" name="id" value="'.$navbars->id.'">
                     <input type="hidden" name="status" value="'.$navbars->status.'">
                     <a id="change_status" data-id="'.$navbars->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Not Active">
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
         })
         ->addColumn('action', function ($navbars) {
                 return '
                 <input type="hidden" name="status" value="'.$navbars->status.'">
                 <a href="'.route("cms.navbar-menu.edit", ["id" => $navbars->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
                 <input type="hidden" name="id" value="'.$navbars->id.'">
                    <a id="delete_language" data-id="'.$navbars->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
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

         })
         ->rawColumns(['status', 'action', 'sort'])
         ->editColumn('id', 'ID: {{$id}}')
         ->make(true);
        }
        return view('cms.navbar.index');
    }

    //TODO: Loading Create Navbar Menu View
    public function create()
    {
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        $languages = Language::where('status',1)->get();
        return view('cms.navbar.create', compact('languages'));
    }
       //loading edit View view
    public function edit($id){
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        $languages = Language::where('status',1)->get();
        $view = Navbar::where('id',$id)->first();
        for($i = 1; $i < count($languages) ; $i++)
        {
            $checkLanguageView = Navbar::where(['parent_id' => $id, 'lang_id' => $languages[$i]['id']])->first();
            if(is_null($checkLanguageView))
            {
                $nav = new Navbar;
                $nav->title = '';
                $nav->lang_id=$languages[$i]['id'];
                $nav->slug=$languages[$i]['slug'];
                $nav->parent_id=$id;
                $nav->save();
            }
        }
        $storedData = Navbar::where(['parent_id'=>$id])->get();
        return view('cms.navbar.edit', compact('view','languages','storedData'));
    }

     //creating new Navbar here
     public function create_process(Request $request){
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        $lang_ids = explode (",",$request->languages_names);
        $titles = explode (",",$request->titles);
        //checking for unique rank name
        $CheckViewName = Navbar::where('name', $request->title_english)->first();

        if(!is_null($CheckViewName)){
            return 'title';
        }
        //creating new Navbar here
        $navbar = new Navbar;
        $navbar->name = $request->title_english;
        $navbar->slug = $request->slug;
        $navbar->lang_id = 1;
        $navbar->parent_id = 0;
        $navbar->save();
        $parent_id =$navbar->id;
        //UPDATING PARENT ID
        Navbar::where('id',$parent_id)->update(['parent_id'=>$parent_id]);
        //CREATEING OTHER views RECORDS
        for($i=1; $i <count($lang_ids) ; $i++ )
        {
            $nav = new Navbar;
            $nav->name = $titles[$i];
            $nav->slug = $request->slug;
            $nav->lang_id=$lang_ids[$i];
            $nav->parent_id=$parent_id;
            $nav->save();
        }
        return 'true';
    }

     //loading edit View view


    //editing new Navbar here
    public function edit_process(Request $request){
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        $lang_ids = explode (",",$request->languages_names);
        $titles = explode (",",$request->titles);
        //checking for unique View name
        $CheckViewName = Navbar::where('name', $request->title_english)->first();

        if(!is_null($CheckViewName)){
            if($CheckViewName->id != $request->id){
            return 'title';
            }
        }
        //Upadating new Navbar here
        $nav = Navbar::find($request->id);
        $nav->name = $request->title_english;
        $nav->slug = $request->slug;
        $nav->update();
        for($i=1; $i <count($lang_ids) ; $i++ )
        {
            $navbar = Navbar::where(['lang_id'=>$lang_ids[$i],'parent_id'=>$request->id])->first();
            $navbar->name = $titles[$i];
            $navbar->slug = $request->slug;
            $navbar->lang_id=$lang_ids[$i];
            $navbar->parent_id=$request->id;
            $navbar->update();
        }
        return 'true';
    }

    //TODO: Deleting Navbar Menu here
    public function delete(Request $request)
    {
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if($validator->fails()) return 'Cyber';
        // TODO: Delete Navbar Menu here
        Navbar::find($request->id)->Delete();
        Page::where('menu_id',$request->id)->Delete();
        return 'true';
    }

    //TODO: Sort Navbar Menu here
    public function sort(Request $request)
    {
        // TODO: Getting Navbar Menu here
        $navbars = Navbar::where('lang_id',1)->get();

        // TODO: Sorting here
        foreach ($navbars as $navbar)
        {
            foreach ($request->sort as $sort) {
                if ($sort['id'] == $navbar->id) {
                    $navbar->update(['sort' => $sort['position']]);
                }
            }
        }

        return 'true';
    }
     //TODO:for changing status
     public function change_status(Request $request){
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        $ctype = Navbar::where('id', $request->id)->first();

        if ($ctype->status == 1) {
            Navbar::where('parent_id', $request->id)->update(['status' => 0]);
        } else {
            Navbar::where('parent_id', $request->id)->update(['status' => 1]);
        }

        echo $ctype->status;
    }

}
