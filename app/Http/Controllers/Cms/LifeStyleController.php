<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properties\Icon;
use App\Models\Admin\Settings\Language;
use Yajra\Datatables\Datatables;
use App\Models\Cms\Slider;
use App\Models\Cms\LifeStyle;
use App\Models\Locations\LocationArea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class LifeStyleController extends Controller
{
    //TODO: For Loading Aminites Index Page
    public function index(Request $request)
    {
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404</h1></center>';
        }
        if($request->ajax())
        {
            $life_styles = LifeStyle::orderBy('id', 'DESC')->get();
            return Datatables::of($life_styles)
            ->addIndexColumn()
            ->addColumn('image', function($life_styles) {
                    return '<img loading="lazy" src="'.$life_styles->image.'" height="50px" width="50px"/>';
            })
            ->addColumn('action', function ($life_styles){
                    return '
                     <a href="'.route('cms.life-styles.edit', ['id' => $life_styles->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
                    <input type="hidden" name="id" value="'.$life_styles->id.'">
                   <a id="delete_language" data-id="'.$life_styles->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
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
            ->rawColumns(['action','image'])
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }
        return view('cms.life-styles.index');
    }

    //loading create view
    public function create(){
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        $languages = Language::where('status',1)->get();
        $areas = LocationArea::where('lang_id',1)->get();
        return view('cms.life-styles.create',compact('languages','areas'));
    }

    //creating new amenity here
    public function create_process(Request $request){
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        $Checkslug = LifeStyle::where('slug',$request->slug)->first();
        if(!is_null($Checkslug)){
            return 'slug';
        }
        $areas = implode(',', $request->areas);
        //creating new rank instance here
        $lifestyle = new LifeStyle;
        $lifestyle->title = $request->title;
        $lifestyle->sub_title = $request->sub_title;
        $lifestyle->description = $request->lifestyle_desc;
        $lifestyle->link = $request->button_link;
        $lifestyle->areas = $areas;
        $lifestyle->slug = $request->slug;
        $lifestyle->meta_title = $request->meta_title;
        $lifestyle->meta_description = $request->meta_description;
        if($request->hasFile('image')){
            $file=$request->file('image')->store('LifeStylesImages', 's3');
                $url = Storage::disk('s3')->url($file);
            $lifestyle->image =  $url;
        }
        $lifestyle->save();
         return 'true';
     }

      //loading edit amenity view
     public function edit($id){
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        $area = LifeStyle::where('id',$id)->first();
        $areas = LocationArea::where('lang_id',1)->get();
        $loc_areas = explode(',', $area->areas);
        $area->areas = $loc_areas;
        return view('cms.life-styles.edit', compact('area','areas'));
    }
      //editing new rank here
      public function edit_process(Request $request){
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404</h1></center>';
        }

        $CheckPageSlug = LifeStyle::where('slug',$request->slug)->first();
        if(!is_null($CheckPageSlug)){
            if($CheckPageSlug->id != $request->id){
             return 'slug';
            }
        }

        $areas = implode(',', $request->areas);

        $lifestyle = LifeStyle::find($request->id);
        $lifestyle->title = $request->title;
        $lifestyle->sub_title = $request->sub_title;
        $lifestyle->description = $request->lifestyle_desc;
        $lifestyle->link = $request->button_link;
        $lifestyle->slug = $request->slug;
        $lifestyle->meta_title = $request->meta_title;
        $lifestyle->areas = $areas;
        $lifestyle->meta_description = $request->meta_description;
        if($request->hasFile('image')){
            $file=$request->file('image')->store('LifeStylesImages', 's3');
                $url = Storage::disk('s3')->url($file);
            $lifestyle->image =  $url;
        }
        $lifestyle->update();
        return 'true';
    }
     //TODO:for delete Lifestyle
     public function delete(Request $request)
     {
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
           LifeStyle::where('id', $request->id)->delete();
     }
}
