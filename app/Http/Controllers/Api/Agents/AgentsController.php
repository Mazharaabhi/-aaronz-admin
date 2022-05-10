<?php

namespace App\Http\Controllers\Api\Agents;

use App\Http\Controllers\Controller;
use App\Models\Properties\Property;
use App\Models\Properties\PropertyCategory;
use Illuminate\Http\Request;
use App\Models\User;
class AgentsController extends Controller
{
    public function index(Request $request){
        try{

            $agents = User::where(['role_id'=>3 , 'is_active' => 1])->orderBy('sort_order', 'ASC')->get();
            return response()->json(['code' => 200, 'message' => 'agents', 'response' => $agents]);
        }catch(\Exception $ex)
        {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }
    //GET AGENT PROFILE//
    public function profile($id){
        try{
               $agent = User::where(['role_id' => 3,'id' => $id])->first();
               if($agent->is_company == 1){
                   $company = User::where('role_id',1)->first();
                    $agent->phone = $company->phone;
                    $agent->mobile = $company->mobile;
                    $agent->email = $company->email;
                 }
                $sale_apartment_properties = PropertyCategory::where('lang_id',1)->where('slug','apartments-for-sale')->first();
                $sale_villas_properties =    PropertyCategory::where('lang_id',1)->where('slug','villas-for-sale')->first();
                $sale_townhouse_properties = PropertyCategory::where('lang_id',1)->where('slug','townhouses-for-sale')->first();
                $sale_penthouses_properties = PropertyCategory::where('lang_id',1)->where('slug','penthouses-for-sale')->first();
                $apartment_id = $sale_apartment_properties->id;
                $villa_id = $sale_villas_properties->id;
                $townhouse_id = $sale_townhouse_properties->id;
                $penthouse_id = $sale_penthouses_properties->id;
                $sale_apartment_properties !='' ? $sale_apartment_properties  = Property::where(['property_category_id' => $sale_apartment_properties->id, 'status' => 2 ,'lang_id' => 1 ,'agent_id' => $agent->id])->with('agent:id,name,email,phone,avatar')->with('images:id,property_id,image','category:id,name', 'type:id,name')->orderBy('id', 'DESC')->take(4)->get(
                [
                   'id',
                   'property_type_id',
                   'property_category_id',
                   'property_status_id',
                   'title',
                   'description',
                   'amenities',
                   'features',
                   'agent_id',
                   'price',
                   'bath_no',
                   'size_sqft',
                   'size_sqmtr',
                   'bed_no',
                   'year_price',
                   'signature_title',
                   'signature_desc',
                   'signature_image',
                   'signature_section_two_title',
                   'signature_section_two_desc',
                   'signature_section_two_image',
                   'signature_section_three_title',
                   'signature_section_three_desc',
                   'signature_section_three_image'
                ]) : '';
                $sale_villas_properties != '' ? $sale_villas_properties  = Property::where(['property_category_id' => $sale_villas_properties->id, 'status' => 2 ,'lang_id' => 1 ,'agent_id' => $agent->id])->with('agent:id,name,email,phone,avatar')->with('images:id,property_id,image','category:id,name', 'type:id,name')->orderBy('id', 'DESC')->take(4)->get(
                 [
                   'id',
                   'property_type_id',
                   'property_category_id',
                   'property_status_id',
                   'title',
                   'description',
                   'amenities',
                   'features',
                   'agent_id',
                   'price',
                   'year_price',
                   'bath_no',
                   'size_sqft',
                   'size_sqmtr',
                   'bed_no',
                   'signature_title',
                   'signature_desc',
                   'signature_image',
                   'signature_section_two_title',
                   'signature_section_two_desc',
                   'signature_section_two_image',
                   'signature_section_three_title',
                   'signature_section_three_desc',
                   'signature_section_three_image'
                   ]) : '';
                $sale_townhouse_properties != ''  ? $sale_townhouse_properties  = Property::where(['property_category_id' => $sale_townhouse_properties->id, 'status' => 2 , 'lang_id' => 1 ,'agent_id' => $agent->id])->with('agent:id,name,email,phone,avatar')->with('images:id,property_id,image','category:id,name', 'type:id,name')->orderBy('id', 'DESC')->take(4)->get(
                 [
                   'id',
                   'property_type_id',
                   'property_category_id',
                   'property_status_id',
                   'title',
                   'description',
                   'amenities',
                   'features',
                   'agent_id',
                   'year_price',
                   'price',
                   'bath_no',
                   'size_sqft',
                   'size_sqmtr',
                   'bed_no',
                   'signature_title',
                   'signature_desc',
                   'signature_image',
                   'signature_section_two_title',
                   'signature_section_two_desc',
                   'signature_section_two_image',
                   'signature_section_three_title',
                   'signature_section_three_desc',
                   'signature_section_three_image'
                   ]) : '';
                $sale_penthouses_properties != ''  ? $sale_penthouses_properties  = Property::where(['property_category_id' => $sale_penthouses_properties->id, 'status' => 2 , 'lang_id' => 1 ,'agent_id' => $agent->id])->with('agent:id,name,email,phone,avatar')->with('images:id,property_id,image','category:id,name', 'type:id,name')->orderBy('id', 'DESC')->take(4)->get(
                 [
                   'id',
                   'property_type_id',
                   'property_category_id',
                   'property_status_id',
                   'title',
                   'description',
                   'amenities',
                   'features',
                   'agent_id',
                   'price',
                   'year_price',
                   'bath_no',
                   'size_sqft',
                   'size_sqmtr',
                   'bed_no',
                   'signature_title',
                   'signature_desc',
                   'signature_image',
                   'signature_section_two_title',
                   'signature_section_two_desc',
                   'signature_section_two_image',
                   'signature_section_three_title',
                   'signature_section_three_desc',
                   'signature_section_three_image'
                   ]) : '';

                   $arra = ['appartments' => $sale_apartment_properties ? $sale_apartment_properties : ''];
                  //return $arra;
                   $prop_obj_1 = (object) [
                    'name' => 'apartments',
                    'id'  => $apartment_id,
                    'properties' => $sale_apartment_properties ? $sale_apartment_properties : '',
                ];
                $prop_obj_2 = (object) [
                    'name' => 'villas',
                    'id'  => $villa_id,
                    'properties' => $sale_villas_properties ? $sale_villas_properties : '',
                ];
                $prop_obj_3 = (object) [
                    'name' => 'townhouses',
                    'id'  => $townhouse_id,
                    'properties' => $sale_townhouse_properties ? $sale_townhouse_properties : '',
                ];
                $prop_obj_4 = (object) [
                    'name' => 'penthouses',
                    'id'   => $penthouse_id,
                    'properties' => $sale_penthouses_properties ? $sale_penthouses_properties : '',
                ];



                $all_properties = Property::where(['status' => 2 ,'lang_id' => 1 ,'agent_id' => $agent->id])->with('agent:id,name,email,phone,avatar')->with('images:id,property_id,image','category:id,name', 'type:id,name')->orderBy('id', 'DESC')->get(

                    [
                       'id',
                       'property_type_id',
                       'property_category_id',
                       'property_status_id',
                       'title',
                       'description',
                       'amenities',
                       'features',
                       'agent_id',
                       'price',
                       'year_price',
                       'bath_no',
                       'size_sqft',
                       'size_sqmtr',
                       'bed_no',
                       'signature_title',
                       'signature_desc',
                       'signature_image',
                       'signature_section_two_title',
                       'signature_section_two_desc',
                       'signature_section_two_image',
                       'signature_section_three_title',
                       'signature_section_three_desc',
                       'signature_section_three_image'
                    ]) ;

                    $prop_obj_5 = (object) [
                        'name' => 'all',
                        'id' => 0,
                        'properties' => $all_properties
                    ];

                $properties_array = [$prop_obj_5,$prop_obj_1,$prop_obj_2,$prop_obj_3,$prop_obj_4];


                $agent->agent_properties  =  $properties_array;


            return response()->json(['code' => 200, 'message' => 'agent-profile', 'response' => $agent]);
        }catch(\Exception $ex)
        {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }
}
