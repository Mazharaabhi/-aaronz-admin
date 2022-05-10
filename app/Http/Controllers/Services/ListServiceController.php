<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Settings\Language;
use App\Models\Cms\Navbar;
use App\Models\Locations\LocationCountry;
use Yajra\Datatables\Datatables;
use App\Models\Services\ServiceQuestion;
use App\Models\Services\ListService;
use App\Models\Services\ServiceCategory;
use App\Models\Services\ServiceQuestionOption;
class ListServiceController extends Controller
{
    //TODO: For Loading Service Category Index Page
    public function index(Request $request)
    {
        $services = ListService::with('sub_service', 'service')->orderBy('id', 'ASC')->where(['lang_id' => 1, 'company_id' => auth()->user()->id])->get();
        if($request->ajax())
        {
         return Datatables::of($services)
         ->addIndexColumn()
         ->addColumn('image', function($services) {
             return '<img loading="lazy" src="'.asset('storage').'/'.$services->image.'" height="50px" width="50px"/>';
         })
         ->addColumn('status', function($services) {
            if($services->status == 0)
            {
                return '<label class="label label-lg label-light-warning label-inline">Pending</label>';
            }
            else if($services->status == 1)
            {
                return '<label class="label label-lg label-light-success label-inline">Published</label>';
            }
            else if($services->status == 2)
            {
                return '<label class="label label-lg label-light-danger label-inline">Rejected</label>';
            }
         })
         ->addColumn('live_status', function($services){
            if($services->live_status == 1 && $services->status == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$services->id.'">
                    <input type="hidden" name="live_status" value="'.$services->live_status.'">
                    <a id="live_status" class="btn btn-icon btn-light btn-hover-success btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Online">
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
                elseif($services->live_status == 0 && $services->status == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$services->id.'">
                    <input type="hidden" name="live_status" value="'.$services->live_status.'">
                    <a id="live_status" class="btn btn-icon btn-light btn-hover-danger btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Offline">
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
                else
                {
                    return '
                    <a class="btn btn-icon btn-light btn-hover-danger btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Offline">
                    <span id="no_live_status" class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Lock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
         ->addColumn('action', function ($services) {

                 return '
                 <input type="hidden" name="status" value="'.$services->status.'">
                 <a href="'.route("manage-services.list-service.edit", ["id" => $services->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
                 <input type="hidden" name="id" value="'.$services->id.'">
                    <a id="delete_language" data-id="'.$services->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
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
         ->rawColumns(['status', 'action','image', 'live_status'])
         ->editColumn('id', 'ID: {{$id}}')
         ->make(true);
        }
        return view('services.list-service.index');
    }

    //loading create Service Category
    public function create(){
        $languages = Language::where('status',1)->get();
        $service_categories = get_Service_Categories();
        $location_country = LocationCountry::with(['location_states' => function($query){
            $query->with(['location_areas' => function($query){
                $query->with(['locations' => function($query){
                    $query->with(['buildings' => function($query){
                        $query->where(['lang_id' => 1, 'status' => 1]);
                    }])->where(['lang_id' => 1, 'status' => 1]);
                }])->where(['lang_id' => 1, 'status' => 1]);
            }])->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'is_default' => 1])->first();

        if(auth()->user()->role_id == 1){
            $service_categories = get_Service_Categories();
        }elseif(auth()->user()->role_id == 5){
            $service_categories = ServiceCategory::whereIn('id', explode(',', auth()->user()->services))->get();
        }
        return view('services.list-service.create',compact('languages', 'service_categories', 'location_country'));
    }

    //creating new Service Category here
    public function create_process(Request $request){
         $services_id = explode (",",$request->languages_names);
         $titles = explode (",",$request->titles);
         $descriptions = explode (",",$request->descriptions);
         //creating new Service Category here
         $category = new ListService;
         $category->company_id = auth()->user()->id;
         $category->title = $request->title_english;
         $category->description = $request->desc_english;
         $category->service_category_id = $request->service_category_id;
         $category->service_sub_category_id = $request->service_sub_category_id;
         $category->hourly_charges = $request->hourly_charges;
         $category->daily_charges = $request->daily_charges;
         $category->property_locations = $request->location_id;
         $category->image = $request->file('image')->store('ListServiceImages', 'public');
         $category->lang_id = 1;
         $category->parent_id = 0;
         if(auth()->user()->role_id == 1)
         {
            $category->status = 1;
            $category->live_status = 1;
         }elseif(auth()->user()->role_id == 5)
         {
            $category->status = 0;
            $category->live_status = 0;
         }
         $category->save();
         $parent_id =$category->id;
         //UPDATING PARENT ID
         ListService::where('id',$parent_id)->update(['parent_id'=>$parent_id]);
         //CREATEING OTHER RECORDS
         for($i=1; $i <count($services_id) ; $i++ )
         {
             $cat = new ListService;
             $cat->company_id = auth()->user()->id;
             $cat->title = $titles[$i];
             $cat->property_locations = $request->location_id;
             $cat->description = $descriptions[$i];
             $cat->lang_id=$services_id[$i];
             $cat->service_category_id = $request->service_category_id;
             $cat->service_sub_category_id = $request->service_sub_category_id;
             $cat->hourly_charges = $request->hourly_charges;
             $cat->daily_charges = $request->daily_charges;
             $cat->image = $request->file('image')->store('ListServiceImages', 'public');
             $cat->parent_id=$parent_id;
             if(auth()->user()->role_id == 1)
                {
                    $cat->status = 1;
                    $cat->live_status = 1;
                }elseif(auth()->user()->role_id == 5)
                {
                    $cat->status = 0;
                    $cat->live_status = 0;
                }
             $cat->save();
         }
         return 'true';
     }

      //loading edit Service Category view
    public function edit($id){
        $languages = Language::where('status',1)->get();
        $view = ListService::where('id',$id)->first();
        for($i = 1; $i < count($languages) ; $i++)
        {
            $checkLanguageView = ListService::where(['parent_id' => $id, 'lang_id' => $languages[$i]['id']])->first();
            if(is_null($checkLanguageView))
            {
                $nav = new ListService;
                $nav->service_category_id = $view->service_category_id;
                $nav->service_sub_category_id = $view->service_sub_category_id;
                $nav->hourly_charges = $view->hourly_charges;
                $nav->daily_charges = $view->daily_charges;
                $nav->property_locations = $view->property_locations;
                $nav->image = $view->image;
                $nav->description = $view->description;
                $nav->lang_id=$languages[$i]['id'];
                $nav->slug=$view->slug;
                $nav->level=1;
                $nav->parent_id=$id;
                $nav->save();
            }
        }
        $location_country = LocationCountry::with(['location_states' => function($query){
            $query->with(['location_areas' => function($query){
                $query->with(['locations' => function($query){
                    $query->with(['buildings' => function($query){
                        $query->where(['lang_id' => 1, 'status' => 1]);
                    }])->where(['lang_id' => 1, 'status' => 1]);
                }])->where(['lang_id' => 1, 'status' => 1]);
            }])->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'is_default' => 1])->first();
        $service_categories = get_Service_Categories();
        $storedData = ListService::where(['parent_id'=>$id])->get();
        $property_locations = $storedData[0]->property_locations != "" ? explode(',', $storedData[0]->property_locations) : [];
        // return $property_locations;
        return view('services.list-service.edit', compact('view','languages','storedData', 'location_country', 'service_categories', 'property_locations'));
    }

      //editing new Service Category here
      public function edit_process(Request $request){
         $services_id = explode (",",$request->languages_names);
         $titles = explode (",",$request->titles);
         $descriptions = explode (",",$request->descriptions);

        //Upadating  Service Category here
         //creating new Service Category here
         $category = ListService::find($request->id);
         $category->title = $request->title_english;
         $category->description = $request->desc_english;
         $category->service_category_id = $request->service_category_id;
         $category->service_sub_category_id = $request->service_sub_category_id;
         $category->hourly_charges = $request->hourly_charges;
         $category->daily_charges = $request->daily_charges;
         $category->property_locations = $request->location_id;
         if($request->hasFile('image'))
         {
            $category->image = $request->file('image')->store('ListServiceImages', 'public');
         }
         $category->update();
        for($i=1; $i <count($services_id) ; $i++ )
        {
            $cat = ListService::where(['lang_id'=>$services_id[$i],'parent_id'=>$request->id])->first();
            $cat->title = $titles[$i];
            $cat->description = $descriptions[$i];
            $cat->lang_id=$services_id[$i];
            $cat->service_category_id = $request->service_category_id;
            $cat->service_sub_category_id = $request->service_sub_category_id;
            $cat->hourly_charges = $request->hourly_charges;
            $cat->daily_charges = $request->daily_charges;
            $cat->property_locations = $request->location_id;
            if($request->hasFile('image'))
            {
                $category->image = $request->file('image')->store('ListServiceImages', 'public');
            }
            $cat->update();
        }
        return 'true';
    }

    //TODO: Change status of View
    public function change_status(Request $request)
    {
        $view = ListService::where('id', $request->id)->first();
        $active='';
        if($view->status == 1)
        {
            $active = 0;
        }
        else
        {
            $active = 1;
        }
        ListService::where('parent_id' , $request->id)->update(['status' => $active]);

        return $active;
    }

    //TODO: Change status of View
    public function change_live_status(Request $request)
    {

        if($request->live_status == 1)
        {
            $active = 0;
        }
        else
        {
            $active = 1;
        }
        ListService::where('parent_id' , $request->id)->update(['live_status' => $active]);

        return 'true';
    }

     //TODO:for delete Service Category
     public function delete(Request $request)
     {
        ListService::where('parent_id', $request->id)->delete();
        ListService::where('service_category_id', $request->id)->delete();
        $question= ServiceQuestion::where('service_category_id', $request->id)->orWhere('service_sub_category_id',$request->id)->first();
        ServiceQuestion::where('service_category_id', $request->id)->orWhere('service_sub_category_id',$request->id)->delete();
        ServiceQuestionOption::where('question_id', $question->id)->delete();
    }

    public function get_sub_services(Request $request)
    {
        $sub_services = ServiceCategory::where(['lang_id' => 1, 'status' => 1, 'service_category_id' => $request->service_category_id])->get();
        // return $sub_services;
        $options = '<option value="">Select Sub Category</option>';

        if($sub_services->count()){
            foreach($sub_services as $item){
                $options .= '<option value="'.$item->id.'">'.$item->name.'</option>';
            }
        }

        return $options;
    }
}
