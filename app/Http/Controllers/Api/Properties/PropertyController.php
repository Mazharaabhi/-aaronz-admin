<?php

namespace App\Http\Controllers\Api\Properties;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properties\Property;
class PropertyController extends Controller
{
    public function get_properties(){
        try {
             $properties = Property::with(
                 'developer:id,name,image',
                 'agent:id,name,email,nationality,specialities,languages,brn,phone,avatar,address,about,residance_number,residance,age,city,company_name,designation,mobile,state,country,company_id,branded_pay_page,branded_email,zip',
                 'state:id,name,location_country_id',
                 'type:id,name',
                 'category:id,name,slug,property_category_id,has_bed,has_bath',
                 )->where(['lang_id' => 1])
                 ->select(
                     'id','title','permit_no','furnished_type_id','prop_ref_no','compact_price','size_sqft',
                     'bed_no','bath_no','views','amenities','features','description','location','lat','lng')
                 ->get();

            if (is_null($properties)) {
                return response()->json(['status' => 400, 'message' => 'No Property Found']);
            }
            return response()->json(['status' => 200, 'message' => 'Success','data'=>$properties]);
        } catch (\Exception $ex) {
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }

    }
}
