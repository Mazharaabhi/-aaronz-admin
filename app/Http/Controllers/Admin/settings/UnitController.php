<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Settings\Unit;
use Yajra\Datatables\Datatables;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        //return 'hello';
        $units =Unit::orderBy('is_default', 'DESC')->get();
       // return $units;
       if($request->ajax())
       {
        return Datatables::of($units)
        ->addIndexColumn()
        ->addColumn('is_default', function($units) {
            if($units->is_default == 1)
            {
                return '<button class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Default</button>';
            }
            else
            {
                return '<button id="make_default" data-id="'.$units->id.'" class="btn btn-danger btn-sm"><i class="fa fa-lock"></i>Make Default</button>';
            }
        })
        ->addColumn('status', function($units){
            if($units->is_default == 0)
            {
                if($units->status == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$units->id.'">
                    <input type="hidden" name="status" value="'.$units->status.'">
                    <a id="change_status" data-id="'.$units->id.'" class="btn btn-icon btn-light btn-hover-success btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Active">
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
                    <input type="hidden" name="id" value="'.$units->id.'">
                    <input type="hidden" name="status" value="'.$units->status.'">
                    <a id="change_status" data-id="'.$units->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Not Active">
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
        ->addColumn('action', function ($units) {
               if($units->static == 0)
               {
                return '
                <input type="hidden" name="status" value="'.$units->status.'">
                <a href="'.route("admin.settings.units.edit", ["id" => $units->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
                <input type="hidden" name="id" value="'.$units->id.'">
               ';
               }
        })
        ->rawColumns(['status', 'action', 'is_default'])
        ->editColumn('id', 'ID: {{$id}}')
        ->make(true);
       }
        return view('admin.settings.units.index', compact('units'));
    }
    //TODO:loading create view
    public function create()
    {
        return view('admin.settings.units.create');
    }
     //TODO:for create new Unit
     public function create_process(Request $request){
        //checking Unit name alrady exists or not
        $check = Unit::where('name', $request->title_english)->first();
        if(!is_null($check)){
            return 'exits';
        }
        //creating new Unit
        $units = new Unit;
        $units->name = $request->title_english;
        $units->save();
        return 'true';
    }
    //TODO:loading Edit view
    public function edit($id)
    {
        $unit = Unit::where('id',$id)->first();
        return view('admin.settings.units.edit', compact('unit'));
    }
    //TODO: EDIT PROCESS START HERE
     public function edit_process(Request $request)
     {
         $units=Unit::all();
         foreach($units as $lang)
         {
             //for duplicate Unit Name
            if (strcasecmp($request->title_english, $lang->name) == 0)
             {
                if ($request->id != $lang->id)
                 {
                    return 'english';
                }
            }
         }
        //edit unit
        $unit = Unit::find($request->id);
        $unit->name = $request->title_english;
        $unit->update();
        return 'true';
    }
    //TODO:for delete Unit
    public function delete(Request $request)
    {
       // return $request->all();
       $lang_del= Unit::where('id', $request->id)->delete();
       //DELETING Languge Records in other tables
    //    if($lang_del)
    //    {
    //      menu::where('lang_id', $request->id)->delete();
    //      Service::where('lang_id', $request->id)->delete();
    //      PackageServiceRank::where('lang_id', $request->id)->delete();
    //      Slider::where('lang_id', $request->id)->delete();
    //      Address::where('lang_id', $request->id)->delete();
    //      Book::where('lang_id', $request->id)->delete();
    //    }

    }
     //TODO:for changing status
     public function change_status(Request $request)
     {
        $lang = Unit::where('id', $request->id)->first();
        if ($lang->status == 1) {
             Unit::where('id', $request->id)->update(['status' => 0]);
            //  menu::where('lang_id', $request->id)->update(['status' => 0]);
        } else {
            Unit::where('id', $request->id)->update(['status' => 1]);
            // menu::where('lang_id', $request->id)->update(['status' => 1]);
        }
        echo $lang->status;
    }

    //TODO:for changing status
    public function make_default(Request $request){
        Unit::where(['is_default' => 1])->update(['is_default' => 0]);

        Unit::where('id', $request->id)->update(['is_default' => 1, 'status' => 1]);
    }

}
