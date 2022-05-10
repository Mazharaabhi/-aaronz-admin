<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Paylinks\Transaction;
use Illuminate\Support\Carbon;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Company\Paytab;
use App\Models\Administrator\Operation;
use App\Models\Administrator\Privileg;
use App\Models\Admin\Accounts\TransferableAmount;
use App\Models\User;
use App\Models\Properties\Property;
use App\Models\Admin\Leads\Lead;
use App\Models\Admin\Leads\AssignedLead;
use App\Models\AssignedServiceLead;
use App\Models\Services\ListService;
use Yajra\Datatables\Datatables;
class DashboardController extends Controller
{
    //TODO: Loading admin dashboard page view
    public function index(Request $request)
    {
        $total_companies = User::where('role_id', '!=',3)->where('role_id', '!=',7)->count();
        $off_plans = Property::where(['lang_id' => 1,'property_status_id' => 13])->count();
        $rent = Property::where(['lang_id' => 1,'property_type_id' => 3])->count();
        $sale = Property::where(['lang_id' => 1,'property_type_id' => 1])->count();
        $new_leads = Lead::where('status',0)->count();
       if(Auth::user()->user_role ==1){
        $total_properties = Property::where('lang_id', 1)->count();
        $total_lead = Lead::count();
        $total_services = ListService::count();
        // return $total_services;
       }else{
        $total_properties = Property::where(['lang_id'=> 1,'company_id' => Auth::user()->id])->count();
        $total_lead = AssignedLead::where('assigned_to',Auth::user()->id)->count();
        $total_services = AssignedServiceLead::where('assigned_to',Auth::user()->id)->count();
       }

        return view('admin.dashboard.index', compact('off_plans','rent','sale','new_leads','total_companies', 'total_properties', 'total_lead','total_services'));
    }


    public function admin_get_properties()
   {

         Property::where('agent_id',0)->update(['agent_id' => 115]);
        $properties = Property::with('state', 'type', 'category')->orderBy('id','DESC')->where(['lang_id' => 1 , 'property_status_id' => 19])->get();

        if(request()->ajax())
        {
            return Datatables::of($properties)
            ->addIndexColumn()
            ->addColumn('price', function($properties){
                if($properties->price == "")
                {
                    return number_format($properties->month_price) . ' /mon';
                }
                else{
                    return number_format($properties->price);
                }
            })
            ->addColumn('expire_date', function($properties){
               return Carbon::parse($properties->expire_date)->format('d-M-Y');
            })
            ->addColumn('title', function($properties){
                $html = '<a href="'.route('manage-properties.property.edit', ['id' => $properties->id]).'">'.$properties->title.'</a>';
                $html .= '<p style="margin:0px"> ';
                if($properties->price == "")
                {
                    $html .= number_format($properties->month_price) . ' /mon';
                }
                else{
                    $html .= number_format($properties->price);
                }
                $html .= ' | ' . $properties->category->name . ' | '. $properties->type->name . ' | '. $properties->agent->name;

                return $html;
            })
            ->addColumn('status', function($properties){

                $html = '
                <input type="hidden" name="id" value="'.$properties->id.'"/>
                <input type="hidden" name="status" value="'.$properties->status.'"/>
                <select id="property_status" clas="form-control">
                <option value="0" '.($properties->status == 0 ? "selected" : "" ).'>Pending</option>
                <option value="2" '.($properties->status == 2 ? "selected" : "" ).'>Published</option>
                <option value="3" '.($properties->status == 3 ? "selected" : "" ).'>Rejected</option>
                </select>';
                return $html;
            })
            ->addColumn('is_signature', function($properties){
                if($properties->is_signature == 1)
                {
                  //  return 'Signature';
                    return '
                    <input type="hidden" name="id" value="'.$properties->id.'"/>
                    <input type="checkbox" id="is_signature" data-id="'.$properties->is_signature.'" style="cursor:pointer" checked="checked" name="is_signature"/>
                    ';
                }
                else {
                    return '
                    <input type="hidden" name="id" value="'.$properties->id.'"/>
                    <input type="checkbox" id="is_signature" data-id="'.$properties->is_signature.'" style="cursor:pointer" name="is_signature"/>
                    ';
                }
            })
            ->addColumn('is_featured', function($properties){

                if($properties->is_featured == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$properties->id.'"/>
                    <input type="checkbox" id="is_featured" data-id="'.$properties->is_featured.'" style="cursor:pointer" checked="checked" name="is_featured"/>
                    ';
                }
                else {
                    return '
                    <input type="hidden" name="id" value="'.$properties->id.'"/>
                    <input type="checkbox" id="is_featured" data-id="'.$properties->is_featured.'" style="cursor:pointer" name="is_featured"/>
                    ';
                }
            })
            ->addColumn('is_verified', function($properties){

                if($properties->is_verified == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$properties->id.'"/>
                    <input type="checkbox" id="is_verified" data-id="'.$properties->is_verified.'" style="cursor:pointer" checked="checked" name="is_verified"/>
                    ';
                }
                else {
                    return '
                    <input type="hidden" name="id" value="'.$properties->id.'"/>
                    <input type="checkbox" id="is_verified" data-id="'.$properties->is_verified.'" style="cursor:pointer" name="is_verified"/>
                    ';
                }
            })
            ->addColumn('sort_order', function($properties){
                return '<input type="number" name="property_sort_order" data-id="'.$properties->id.'" id="property_sort_order" value="'.$properties->sort_order.'" class="form-control"/>';
            })
            ->addColumn('is_boost', function($properties){

                if($properties->is_boost == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$properties->id.'"/>
                    <input type="checkbox" id="is_boost" data-id="'.$properties->is_boost.'" style="cursor:pointer" checked="checked" name="is_boost"/>
                    ';
                }
                else {
                    return '
                    <input type="hidden" name="id" value="'.$properties->id.'"/>
                    <input type="checkbox" id="is_boost" data-id="'.$properties->is_boost.'" style="cursor:pointer" name="is_boost"/>
                    ';
                }
            })

            ->addColumn('action', function ($properties){
                    return '
                     <a href="'.route('manage-properties.property.edit', ['id' => $properties->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
                    <input type="hidden" name="id" value="'.$properties->id.'">
                   <a id="delete_language" data-id="'.$properties->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
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
            ->rawColumns(['action', 'price', 'status','sort_order','is_verified','is_signature','is_featured', 'is_boost', 'title'])
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }
   }

    public function get_properties()
   {

        if(auth()->user()->role_id == 1)
        {
            $properties = Property::with('developer', 'agent', 'state', 'type', 'category')->orderBy('id','DESC')->where(['lang_id' => 1, 'status' => 0])->get();
        }
        else if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
        {
            $properties = Property::with('developer', 'agent', 'state', 'type', 'category')->orderBy('id','DESC')->where(['lang_id' => 1, 'create_by' => Auth::user()->id])->get();
        }
        if(request()->ajax())
        {
            return Datatables::of($properties)
            ->addIndexColumn()
            ->addColumn('price', function($properties){
                if($properties->price == "")
                {
                    return number_format($properties->month_price) . ' /mon';
                }
                else{
                    return number_format($properties->price);
                }
            })
            ->addColumn('expire_date', function($properties){
                return Carbon::parse($properties->expire_date)->format('d-M-Y');
             })
             ->addColumn('title', function($properties){
                 $html = '<a href="'.route('manage-properties.property.edit', ['id' => $properties->id]).'">'.$properties->title.'</a>';
                 $html .= '<p style="margin:0px"> ';
                 if($properties->price == "")
                 {
                     $html .= number_format($properties->month_price) . ' /mon';
                 }
                 else{
                     $html .= number_format($properties->price);
                 }
                 $html .= ' | ' . $properties->category->name . ' | '. $properties->type->name . ' | ';

                 return $html;
             })
            ->addColumn('status', function($properties){
                if($properties->status == "0")
                {
                    return 'Pending';
                }
                else if($properties->status == "2")
                {
                    return 'Published';
                }
                else if($properties->status == "3")
                {
                    return 'Rejected';
                }
            })
            ->addColumn('action', function ($properties){
                    return '
                     <a href="'.route('manage-properties.property.edit', ['id' => $properties->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
                    <input type="hidden" name="id" value="'.$properties->id.'">
                   <a id="delete_language" data-id="'.$properties->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
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
            ->rawColumns(['action', 'price', 'expire_date', 'title'])
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }
   }


   public function change_property_status(Request $request)
   {
       Property::where('id', $request->id)->update(['status' => $request->status]);
   }

   public function change_service_status(Request $request)
   {
       ListService::where('id', $request->id)->update(['status' => $request->status]);
   }

   public function change_is_featured(Request $request)
   {
       Property::where('id', $request->id)->update(['is_featured' => $request->is_featured == 1 ? 0 : 1]);
   }

   public function change_is_signatured(Request $request)
   {
       Property::where('id', $request->id)->update(['is_signature' => $request->is_signature == 1 ? 0 : 1]);
   }

   public function change_is_verified(Request $request)
   {
       Property::where('id', $request->id)->update(['is_verified' => $request->is_verified == 1 ? 0 : 1]);
   }

   public function change_is_boost(Request $request)
   {
       Property::where('id', $request->id)->update(['is_boost' => $request->is_boost == 1 ? 0 : 1]);
   }


   public function admin_get_services(Request $request){
    if(auth()->user()->role_id == 1){
        $services = ListService::with('company')->orderBy('id', 'ASC')->where(['lang_id' => 1])->where('company_id' ,'!=', auth()->user()->id)->get();
    }else{
        $services = ListService::with('company')->orderBy('id', 'ASC')->where(['lang_id' => 1])->where('company_id', auth()->user()->id)->get();
    }
     return Datatables::of($services)
     ->addIndexColumn()
     ->addColumn('image', function($services) {
         return '<img loading="lazy" src="'.asset('storage').'/'.$services->image.'" height="50px" width="50px"/>';
     })
    ->addColumn('daily_charges', function($services) {
        return number_format($services->daily_charges);
    })
    ->addColumn('hourly_charges', function($services) {
        return number_format($services->hourly_charges);
    })
    ->addColumn('image', function($services) {
        return '<img loading="lazy" src="'.asset('storage').'/'.$services->image.'" height="50px" width="50px"/>';
    })
     ->addColumn('status', function($services) {
        if(auth()->user()->role_id == 1){
            $html = '
            <input type="hidden" name="id" value="'.$services->id.'"/>
            <input type="hidden" name="status" value="'.$services->status.'"/>
            <select id="service_status" clas="form-control">
            <option value="0" '.($services->status == 0 ? "selected" : "" ).'>Pending</option>
            <option value="1" '.($services->status == 1 ? "selected" : "" ).'>Published</option>
            <option value="2" '.($services->status == 2 ? "selected" : "" ).'>Rejected</option>
            </select>';
            return $html;
        }elseif(auth()->user()->role_id == 5){
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
     ->rawColumns(['status', 'action','image','daily_charges','hourly_charges', 'live_status'])
     ->editColumn('id', 'ID: {{$id}}')
     ->make(true);

   }
}
