<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Services\Service;
use App\Models\Properties\View;
use App\Models\Services\ListService;
use App\Models\Services\ServiceCategory;
use App\Models\Services\ServiceQuestion;
use App\Models\ServiceLeadDetail;
use App\Models\ServiceLead;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request, $service)
    {
        $service_category = ServiceCategory::where(['slug' => $service, 'lang_id' => 1])->first();
        $services = ServiceCategory::withCount('sub_services')->where(['lang_id' => 1, 'level' => 1])->get();
        $list_services = ServiceCategory::withCount('list_services')->with(['list_services' => function($query){
            $query->avg('daily_charges');
        }])->where(['lang_id' => 1, 'service_category_id' => $service_category->id, 'level' => 2])->get();
        $views = View::where(['lang_id' => 1, 'status' => 1])->get();
        // return $list_services;
        return view('website.services.index', compact('list_services', 'service', 'services', 'views', 'service_category'));
    }

    public function get_services_adds(Request $request, $service)
    {
        $service_sub_category = ServiceCategory::where(['slug' => $service, 'lang_id' => 1])->first();
        $services = ServiceCategory::withCount('sub_services')->where(['lang_id' => 1, 'level' => 1])->get();
        $list_services = ListService::with('company', 'sub_service')->where(['lang_id' => 1, 'status' => 1, 'live_status' => 1, 'service_sub_category_id' => $service_sub_category->id])->get();
        // return $list_services[0]->company;
        return view('website.services.adds', compact('list_services', 'service_sub_category', 'services'));
    }

    public function request_services_adds(Request $request, $id){
        $list_service = ListService::with('company')->where('id',$id)->first();
       // return $list_service->service_sub_category_id;
        $questions = ServiceQuestion::with('QuestionOptions')->where(['service_sub_category_id' => $list_service->service_sub_category_id, 'lang_id' => 1])->get();
        return view('website.services.service_request', compact('list_service', 'questions'));
    }

    public function services(Request $request){
        $services = ServiceCategory::withCount('sub_services')->where(['lang_id' => 1, 'level' => 1])->get();
        $views = View::where(['lang_id' => 1, 'status' => 1])->get();
        return view('website.services.service', compact('views', 'services'));
    }

    public function get_service_sub_categories(){
        $sub_services = ServiceCategory::withCount('list_services')->with(['list_services' => function($query){
            $query->avg('daily_charges');
        }])->where(['lang_id' => 1, 'level' => 2])->get();
        $html = '';
        if ($sub_services->count()){
            foreach ($sub_services as $service_item){
                $html .= '
                <div class="col-sm-12 col-md-3 col-lg-3">
                <a href="'.route('services.get_services_adds', $service_item->slug).'"><div class="service_grid">
                    <div class="thumb">
                        <img class="img-fluid w100" src="'.asset('storage/'.$service_item->image).'" alt="1.jpg">
                    </div>
                    <div class="details">
                        <h4 style="color:black">'.$service_item->name.'</h4>
                        <br>
                        <p><span class="float-left">Total Adds <b>'.$service_item->list_services_count.'</b></span> <span class="float-right">Average Price <b>AED  '.(count($service_item->list_services) > 0 ? $service_item->list_services[0]->hourly_charges : 0).' / Hour</b></span></p>
                    </div>
                </div></a>
                </div>
                ';
            }
        }
        return $html;
    }
    //SERVICE REQUEST LEAD START HERE//
    public function service_request_lead(Request $request)
    {
        $service_lead = new ServiceLead;
        $service_lead->name=$request->name;
        $service_lead->email=$request->email;
        $service_lead->phone=$request->phone;
        $service_lead->service_id=$request->service_id;
        $service_lead->company_id=$request->company_id;
        $service_lead->location=$request->location;
        $service_lead->details=$request->details;
        $service_lead->save();
        $service_lead_id = $service_lead->id;
        for($i=0; $i<count($request->questions); $i++)
        {
            $deatil = new ServiceLeadDetail;
            $deatil->service_lead_id = $service_lead_id;
            $deatil->question = $request->question_names[$i];
            $deatil->answer = $request->answers[$i];
            $deatil->save();
        }
        return 'true';
    }

}
