<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\AgentContact;
use Illuminate\Http\Request;
use App\Models\Properties\Amenity;
use App\Models\Properties\Feature;
use App\Models\Properties\Property;
use App\Models\Properties\PropertyCategory;
use App\Models\Locations\LocationState;
use App\Models\Locations\LocationArea;
use App\Models\Locations\LocationCountry;
use App\Models\Locations\Location;
use App\Models\Properties\PaymentMethod;
use App\Models\Properties\PropertyType;
use App\Models\Locations\LocationBuilding;
use App\Models\Admin\Leads\Lead;
use Illuminate\Support\Carbon;
use App\Models\Properties\Developer;
use App\Models\Properties\FavProperty;
use App\Models\ServiceLead;
use App\Models\ServiceLeadDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Services\ListService;
use App\Models\Services\ServiceCategory;
use App\Models\Services\ServiceQuestion;
use App\Models\Services\ServiceQuestionOption;
use App\Models\AssignedServiceLead;
use App\Models\Cms\News;
use App\Models\Admin\LifeAtAaronz;
use App\Models\Cms\Slider;
use App\Models\User;
use App\Models\Cms\Page;
use App\Models\Cms\AronzStory;
use App\Models\Cms\AronzReview;
use App\Models\Cms\HeaderFooter;
use App\Models\Cms\Navbar;
use Illuminate\Support\Facades\Mail;
use App\Models\Properties\View;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**Get Property Types */
    public function get_properties(Request $request)
    {

        try {
            $properties = Property::with('agent', 'category', 'type', 'images', 'developer')->where(['lang_id' => 1, 'status' => 2])->get();
            foreach ($properties as $property) {
                $amenities = $property->amenities ? explode(',', $property->amenities) : [];
                $payment_methods = PaymentMethod::where(['status' => 1, 'lang_id' => 1])->get();
                $maneities_array = [];
                $features_array = [];
                if (count($amenities) > 0) {
                    foreach ($amenities as $item) {
                        $maneities_array[] = Amenity::where('id', $item)->pluck('name')->first();
                    }
                }
                // if(count($features) > 0)
                // {
                //     foreach($features as $item){
                //     $features_array[] = Feature::where('id', $item)->pluck('name')->first();
                //     }
                // }
                $message = "Hi, I found your property with ref: " . $property->prop_ref_no . " on Aaronz Property. Please contact me. Thank you.";
                $property->amenities_array = $maneities_array;
                // $property->features_array = $features_array;
                $property->message = $message;
            }
            ///CHECHING FAVOURITE PROPERTIES HERE//
            foreach ($properties as $pr) {
                $pr->is_favourite = 'false';

                //  foreach($fav_property as $fav_pr)
                //  {
                //      if($pr->id == $fav_pr->property_id)
                //      {
                //          $pr->is_favourite = 'true';
                //      }
                //  }
                //**CHECKING  PROPERTY TYPE HERE */
                if ($pr->property_type_id == 1) {
                    $pr->property_type = 'Sale';
                } elseif ($pr->property_type_id == 3) {
                    $pr->property_type = 'Rent';
                } else {
                    $pr->property_type = 'N/A';
                }
                //**CHECKING PROPERTY TYPE (Furnished or not) HERE */
                if ($pr->furnished_type == 1) {
                    $pr->furnished_type_status = 'Furnished';
                } elseif ($pr->furnished_type == 2) {
                    $pr->property_type_status = 'Un-Furnished';
                } else {
                    $pr->furnished_type_status = 'Partial Furnished';
                }
            }
            ///END CHECHING FAVOURITE PROPERTIES HERE//

            return response()->json(['code' => 200, 'message' => 'Properties', 'response' => $properties]);

        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    /**Get Property Types */
    public function get_off_plan_properties(Request $request)
    {

        try {
            $properties = Property::with('agent', 'category', 'type', 'images', 'developer')->where(['lang_id' => 1, 'status' => 2, 'property_status_id' => 1])->get();
            // $fav_property=FavProperty::where('user_id',Auth::user()->id)->get();
            foreach ($properties as $property) {
                $amenities = $property->amenities ? explode(',', $property->amenities) : [];
                // $features = $property->features ? explode(',' , $property->features) : [];
                $payment_methods = PaymentMethod::where(['status' => 1, 'lang_id' => 1])->get();
                $maneities_array = [];
                $features_array = [];
                if (count($amenities) > 0) {
                    foreach ($amenities as $item) {
                        $maneities_array[] = Amenity::where('id', $item)->pluck('name')->first();
                    }
                }
                // if(count($features) > 0)
                // {
                //     foreach($features as $item){
                //     $features_array[] = Feature::where('id', $item)->pluck('name')->first();
                //     }
                // }
                $message = "Hi, I found your property with ref: " . $property->prop_ref_no . " on Aaronz Property. Please contact me. Thank you.";
                $property->amenities_array = $maneities_array;
                // $property->features_array = $features_array;
                $property->message = $message;
            }
            ///CHECHING FAVOURITE PROPERTIES HERE//
            foreach ($properties as $pr) {
                $pr->is_favourite = 'false';

                //  foreach($fav_property as $fav_pr)
                //  {
                //      if($pr->id == $fav_pr->property_id)
                //      {
                //          $pr->is_favourite = 'true';
                //      }
                //  }
                //**CHECKING  PROPERTY TYPE HERE */
                if ($pr->property_type_id == 1) {
                    $pr->property_type = 'Sale';
                } elseif ($pr->property_type_id == 3) {
                    $pr->property_type = 'Rent';
                } else {
                    $pr->property_type = 'N/A';
                }
                //**CHECKING PROPERTY TYPE (Furnished or not) HERE */
                if ($pr->furnished_type == 1) {
                    $pr->furnished_type_status = 'Furnished';
                } elseif ($pr->furnished_type == 2) {
                    $pr->property_type_status = 'Un-Furnished';
                } else {
                    $pr->furnished_type_status = 'Partial Furnished';
                }
            }
            ///END CHECHING FAVOURITE PROPERTIES HERE//

            return response()->json(['code' => 200, 'message' => 'Properties', 'response' => $properties]);

        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    /**Get Latest Types */
    public function get_latest_properties(Request $request)
    {
        try {
            $properties = Property::with('images')->with('developer')->where(['lang_id' => 1, 'status' => 1])->orderBy('id', 'DESC')->limit(10)->get();
            return response()->json(['code' => 200, 'message' => 'Latest Properties', 'response' => $properties]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    /**Get Latest Types */
    public function get_featured_properties(Request $request)
    {
        try {
            $properties = Property::with('images')->with('developer')->where(['lang_id' => 1, 'status' => 2, 'is_featured' => 1])->orderBy('id', 'DESC')->get();
            return response()->json(['code' => 200, 'message' => 'Featured Properties', 'response' => $properties]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    /**Get Property Details */
    public function get_property_detail(Request $request, $id)
    {
        try {
            $property = Property::with('agent', 'category', 'type', 'images', 'developer')->where(['id' => $id ,'lang_id' => 1, 'status' => 2])->first();
         //  return $property;
            $property->youtube_link = str_replace("watch?v=", "embed/", $property->youtube_link);
            $property->video_link = str_replace("watch?v=", "embed/", $property->video_link);
            if ($property) {
                //*** MAKING FLOOR PLAN OBJECT START HERE ***/
                $one_bed_floor_plan = (object) ['name' => '1 Bedroom', 'type' => 'Floor Plan', 'file_link' => $property->one_bed_floor_plan];
                $two_bed_floor_plan = (object) ['name' => '2 Bedroom', 'type' => 'Floor Plan', 'file_link' => $property->two_bed_floor_plan];
                $three_bed_floor_plan =(object)  ['name' => '3 Bedroom', 'type' => 'Floor Plan', 'file_link' => $property->three_bed_floor_plan];
                $four_bed_floor_plan = (object) ['name' => '4 Bedroom', 'type' => 'Floor Plan', 'file_link' => $property->four_bed_floor_plan];
                $studio_floor_plan =  (object) ['name' => 'Studio', 'type' => 'Floor Plan', 'file_link' => $property->studio_floor_plan];
                $floor_plan = [$one_bed_floor_plan,$two_bed_floor_plan,$three_bed_floor_plan,$four_bed_floor_plan,$studio_floor_plan];
                $property->floor_plan = $floor_plan;
                //***  SHOW COMPANY PROFILE IF IS COMPANY ACTIVATED ***//

                if ($property->agent->is_company == 1) {
                    $company = User::where('role_id', 1)->first();
                    $property->agent->phone = $company->phone;
                    $property->agent->mobile = $company->mobile;
                    $property->agent->email = $company->email;
                }
                $aaronzStory = AronzStory::get();
                $amenities = $property->amenities != '' ? explode(',', $property->amenities) : [];
                $features = $property->features != '' ? explode(',', $property->features) : [];
                $maneities_array = [];
                $features_array = [];
                if (count($amenities) > 0) {
                    foreach ($amenities as $item) {

                        $maneities_array[] = Amenity::where('id', $item)->first();

                    }
                }

                if (count($features) > 0) {
                    foreach ($features as $item) {
                        $features_array[] = Feature::where('id', $item)->pluck('name')->first();
                    }
                }

                $message = "Hi, I found your property with ref: " . $property->prop_ref_no . " on Aaronz Property. Please contact me. Thank you.";

                $property->amenities_array = $maneities_array;
                $property->features_array = $features_array;
                $property->message = $message;
                $property->aaronz_story = $aaronzStory;
                //***GETTING PROPERTY LOCATION TEXT**//
                $property['location_text'] = $this->get_location_text($property->address_level, $property->address_id);
                $property['cords'] = $this->get_lat_lng($property->address_level, $property->address_id);
                // if($property->address_level == 0){
                //     $address =  $this->get_location_text($property->address_level, $property->location_state_id);
                //     $property->property_location = $address[0];
                //   }else if($property->address_level == 1){
                //     $address = $this->get_location_text($property->address_level, $property->location_area_id);
                //     $property->property_location = $address[0];
                //   }else if($property->address_level == 2){
                //       // return $property->location_id ;
                //      $address =  $this->get_location_text($property->address_level, $property->location_id);
                //      $property->property_location = $address[0];
                // }else if($property->address_level == 3){
                //     $address =  $this->get_location_text($property->address_level, $property->location_building_id);
                //      $property->property_location = $address[0];
                //   }else{
                //        $property->property_location = '';
                //   }
                //***GETTING PROPERTY LOCATION TEXT END HERE**//

                return response()->json(['code' => 200, 'message' => 'Properties', 'response' => $property]);
            } else {
                return response()->json(['code' => 200, 'message' => 'Properties', 'response' => []]);
            }
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    //** ENQUIRE NOW EMAIL */
    public function enquire_now_detail_page(Request $request){
        //  return $request->all();
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required',
                'country_code' => 'required',
                'number' => 'required',
                'country_of_residence' => 'required',
            ]);

            if($validator->fails()){
                return response()->json(['code' => 400, 'message' => 'Request Errors', 'response' => $validator->errors()]);
            }
            // return $request->all();
            $data["name"] = $request->name;
            $data["email"] = $request->email;
            $data["country_code"] = $request->country_code;
            $data["number"] = $request->number;
            $data["country_of_residence"] = $request->country_of_residence;
            $data["title"] = 'Enquire Now';
            $emails = ['info@aaronz.co'];
            // $emails = ['meharmani212@gmail.com'];
            Mail::send('emails.enquire-now', $data, function($message)use($data,$emails) {
                $message->to($emails)
                    ->subject($data["title"]);
            });
            return response()->json(['code' => 200, 'message' => 'Your Request has been sent Successfully!', 'response' =>'Success']);
        }catch(\Exception $ex)
        {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }
    //**GETTING LAT AND LONG OF PROPERTY */
    public function get_lat_lng($level, $id)
    {
        if ($level == 0) {
            $state = LocationState::where(['id' => $id, 'lang_id' => 1])->first();
            $cords = ['lat' => $state->latitude, 'lng' => $state->longitude];
            return $cords;
        } else if ($level == 1) {
            $area = LocationArea::where(['id' => $id, 'lang_id' => 1])->first();
            $cords = ['lat' => $area->latitude, 'lng' => $area->longitude];
            return $cords;
        } else if ($level == 2) {
            $location = Location::where(['id' => $id, 'lang_id' => 1])->first();
            $cords = ['lat' => $location->latitude, 'lng' => $location->longitude];
            return $cords;
        } else if ($level == 3) {
            $building = LocationBuilding::where(['id' => $id, 'lang_id' => 1])->first();
            $cords = ['lat' => $building->latitude, 'lng' => $building->longitude];
            return $cords;
        }
    }

    /** Custom Search Api */
    public function fields_quick_search(Request $request)
    {
        $location_country = LocationCountry::with(['location_states' => function ($query) {
            $query->with(['location_areas' => function ($query) {
                $query->with(['locations' => function ($query) {
                    $query->with(['buildings' => function ($query) {
                        $query->where(['lang_id' => 1, 'status' => 1]);
                    }])->where(['lang_id' => 1, 'status' => 1]);
                }])->where(['lang_id' => 1, 'status' => 1]);
            }])->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'is_default' => 1])->first();
        $property_category = PropertyCategory::all();
        $agentusers = User::where('role_id', 3)->orderBy('id', 'DESC')->get();
        $property_types = PropertyType::where(['lang_id' => 1, 'type_id' => 0, 'status' => 1])->get();
        $categories = PropertyCategory::with(['sub_categories' => function ($query) {
            $query->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'level' => 1, 'status' => 1, 'property_type_id' => $property_types[0]->id])->get();

        try {

            $data = [
                'property_category' => $property_category,
                'agentusers' => $agentusers,
                'location_country' => $location_country,
                'categories' => $categories
            ];

            return response()->json(['code' => 200, 'message' => 'fields quick search', 'response' => $data]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }


    }

    public function quick_search(Request $request)
    {
        try {
            $searches = [];
            //$searches[]=['lang_id', '=', 1];

            if ($request->get('location_id') != '') {
                $locationsArray = explode(',', $request->get('location_id'));
                $address_level = $locationsArray[0];
                $address_id = $locationsArray[1];
                if ($address_level == 0) {
                    $searches[] = ['location_state_id', '=', $address_id];
                } else if ($address_level == 1) {
                    $location_area = LocationArea::firstWhere('id', $address_id);
                    $searches[] = ['location_state_id', '=', $location_area->location_state_id];
                    $searches[] = ['location_area_id', '=', $address_id];
                } else if ($address_level == 2) {
                    $location_area = Location::firstWhere('id', $address_id);
                    $searches[] = ['location_state_id', '=', $location_area->location_state_id];
                    $searches[] = ['location_area_id', '=', $location_area->location_area_id];
                    $searches[] = ['location_id', '=', $address_id];
                } else if ($address_level == 3) {
                    $location_area = LocationBuilding::firstWhere('id', $address_id);

                    $searches[] = ['location_state_id', '=', $location_area->location_state_id];
                    $searches[] = ['location_area_id', '=', $location_area->location_area_id];
                    $searches[] = ['location_id', '=', $location_area->location_id];
                    $searches[] = ['location_building_id', '=', $address_id];
                }
            }// not empty
            //return $searches;

            if ($request->get('purpose') != 0) {
                $searches[] = ['property_type_id', '=', $request->get('purpose')];
            }
            if ($request->get('ref_id') != '') {
                $searches[] = ['prop_ref_no', '=', $request->get('ref_id')];
            }
            if ($request->get('category_id') != '') {
                $searches[] = ['property_category_id', '=', $request->get('category_id')];
            }
            if ($request->get('assigned') != '') {
                $searches[] = ['agent_id', '=', $request->get('assigned')];
            }
            if ($request->get('verified') != 0) {
                $searches[] = ['is_verified', '=', $request->get('verified')];
            }
            if ($request->get('featured') != 0) {
                $searches[] = ['is_featured', '=', $request->get('featured')];
            }
            if ($request->get('hot') != 0) {
                $searches[] = ['is_hot', '=', $request->get('hot')];
            }
            if ($request->get('signature') != 0) {
                $searches[] = ['is_signature', '=', $request->get('signature')];
            }
            if ($request->get('basic') != 0) {
                $searches = ['is_basic', 'like', '%' . $request->get('basic') . '%'];
            }
            if ($request->get('boostsale') != 0) {
                $searches[] = ['is_boost', '=', $request->get('boostsale')];
            }

            if ($request->get('beds_min') != '') {
                $searches[] = ['bed_no', '<=', $request->get('beds_min')];
            }
            if ($request->get('beds_max') != '') {
                $searches[] = ['bed_no', '>=', $request->get('beds_max')];
            }
            //return $searches;


            if (Auth::user()->role_id != 1) {
                $properties = Property::with('developer', 'state', 'type', 'category')
                    ->where('create_by', Auth::user()->id)
                    ->where($searches)
                    ->get();
            } else {
                $properties = Property::with('developer', 'state', 'type', 'category')
                    ->where($searches)
                    ->get();
            }

            if ($properties->count()) {

                return response()->json(['code' => 200, 'message' => 'Properties', 'response' => $properties]);

            } else {
                return response()->json(['code' => 200, 'message' => 'Properties', 'response' => 'no record found']);

            }

        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    /**Property Search Api */
    public function search_properties(Request $request)
    {
        //return 'hello';
        try {
            $location_data = explode(",", $request->l);
            $t = $request->t;
            $c = $request->c;
            $level = $location_data[0];
            $location = $location_data[1];
            $property_type_id = $request->t;
            $property_category_id = $request->c;
            $location_country = get_locations();
            $type = '';
            if ($property_type_id == 1) {
                $type = 'Sale';
            } else {
                $type = 'Rent';
            }


            $property_category = PropertyCategory::where(['lang_id' => 1, 'id' => $property_category_id, 'status' => 1])->first();
            if ($level == 0) {
                $location_state = LocationState::where(['lang_id' => 1, 'id' => $location])->first();

                $title = $property_category->name . ' For ' . $type . ' in ' . $location_state->name;

                $areas = LocationArea::withCount('properties')->where(['location_state_id' => $location_state->id, 'lang_id' => 1])->get();
                $properties = Property::with('images')->with('developer')->where(['status' => 1, 'property_category_id' => $property_category_id, 'lang_id' => 1, 'location_state_id' => $location_state->id, 'status' => 1])->get();
                // return view('website.search.propertyByState', compact('t', 'c', 'title', 'property_category_id', 'properties', 'areas', 'location_state', 'location_country', 'location_data', 'property_type_id'));
            } else if ($level == 1) {
                $location_area = LocationArea::where(['lang_id' => 1, 'id' => $location])->first();
                $location_state = LocationState::where(['lang_id' => 1, 'id' => $location_area->location_state_id])->first();
                $title = $property_category->name . ' For ' . $type . ' in ' . $location_area->name;

                $locations = Location::withCount('properties')->where(['location_area_id' => $location_area->id, 'lang_id' => 1])->get();
                $properties = Property::with('images')->with('developer')->where(['status' => 1, 'property_category_id' => $property_category_id, 'lang_id' => 1, 'location_area_id' => $location_area->id, 'status' => 1])->get();
                // return view('website.search.propertyByAreas', compact('t', 'c', 'title', 'location_state', 'property_category_id', 'properties', 'locations', 'location_area', 'location_country', 'location_data', 'property_type_id'));
            } else if ($level == 2) {
                $location = Location::where(['lang_id' => 1, 'id' => $location])->first();
                $location_area = LocationArea::where(['lang_id' => 1, 'id' => $location->id])->first();
                $location_state = LocationState::where(['lang_id' => 1, 'id' => $location_area->location_state_id])->first();
                $title = $property_category->name . ' For ' . $type . ' in ' . $location_area->name;

                $buildings = LocationBuilding::withCount('properties')->where(['location_id' => $location->id, 'lang_id' => 1])->get();
                $properties = Property::with('images')->with('developer')->where(['status' => 2, 'property_category_id' => $property_category_id, 'lang_id' => 1, 'location_area_id' => $location_area->id, 'status' => 1])->get();
                // return view('website.search.propertyByLocations', compact('t', 'c', 'title', 'location', 'location_state', 'property_category_id', 'properties', 'buildings', 'location_area', 'location_country', 'location_data', 'property_type_id'));
            } else if ($level == 3) {
                $building = LocationBuilding::where(['lang_id' => 1, 'id' => $location])->first();
                $location = Location::where(['lang_id' => 1, 'id' => $building->id])->first();
                $location_area = LocationArea::where(['lang_id' => 1, 'id' => $location->id])->first();
                $location_state = LocationState::where(['lang_id' => 1, 'id' => $location_area->location_state_id])->first();
                $title = $property_category->name . ' For ' . $type . ' in ' . $building->name;

                $buildings = LocationBuilding::withCount('properties')->where(['location_id' => $location->id, 'lang_id' => 1])->get();
                $properties = Property::with('images')->with('developer')->where(['status' => 2, 'property_category_id' => $property_category_id, 'lang_id' => 1, 'location_area_id' => $location_area->id, 'status' => 1])->get();
                // return view('website.search.propertyByBuildings', compact('t', 'c', 'title', 'location', 'location_state', 'property_category_id', 'properties', 'buildings', 'location_area', 'location_country', 'location_data', 'property_type_id'));
            }

            $properties->title = $title;

            return response()->json(['code' => 200, 'message' => 'Properties', 'response' => $properties]);

        } catch (\Exception $ex) {

        }
    }

    /**Get Property Locations */
    public function get_locations(Request $request)
    {
        try {
            $location_country = LocationCountry::with(['location_states' => function ($query) {
                $query->with(['location_areas' => function ($query) {
                    $query->with(['locations' => function ($query) {
                        $query->with(['buildings' => function ($query) {
                            $query->where(['lang_id' => 1, 'status' => 1]);
                        }])->where(['lang_id' => 1, 'status' => 1]);
                    }])->where(['lang_id' => 1, 'status' => 1]);
                }])->where(['lang_id' => 1, 'status' => 1]);
            }])->where(['lang_id' => 1, 'is_default' => 1])->first();

            return response()->json(['code' => 200, 'message' => 'Property Locations', 'response' => $location_country]);

        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    /**Get Property Types */
    public function get_property_type(Request $request)
    {
        try {
            $propertyTypes = PropertyType::where(['lang_id' => 1, 'type_id' => 0])->get(['id', 'name']);
            return response()->json(['code' => 200, 'message' => 'Property Types', 'response' => $propertyTypes]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    /**Get Property Types */
    public function get_property_category(Request $request, $id)
    {
        try {
            $propertyTypes = PropertyCategory::where(['lang_id' => 1, 'property_type_id' => $id, 'status' => 1])->get(['id', 'name']);
            return response()->json(['code' => 200, 'message' => 'Property Categories', 'response' => $propertyTypes]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }


    /**Get Property Developers */
    public function get_developers(Request $request)
    {
        try {
            $developers = Developer::where(['lang_id' => 1, 'status' => 1])->get(['id', 'name', 'image']);

            return response()->json(['code' => 200, 'message' => 'Property Developers', 'response' => $developers]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    /**Send Lead Here */
    public function send_lead(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'property_id' => 'required',
                'name' => 'required|min:3',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required|min:10',
            ]);
            $lead = '';
            if ($validator->fails()) {
                return response()->json(['code' => 400, 'message' => 'Request Errors', 'response' => $validator->errors()]);
            }
            if (isset($request->property_id) && !isset($request->agent_id)) {
                $lead = Lead::create([
                    'property_id' => $request->property_id,
                    // 'user_id' => Auth::user()->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'description' => $request->message,
                    'status' => 0,
                    'type' => 1
                ]);
                $property = Property::find($request->property_id);
                //**SEND EMAIL FOR LEAD */
                $data["name"] = $request->name;
                $data["email"] = $request->email;
                $data["phone"] = $request->phone;
                $data["description"] = $request->message;
                $data["property"] = $property->title;
                $data["title"] = 'Property Lead';
                //return $data;
                $emails = ['career@aaronz.co'];
                Mail::send('emails.property-lead', $data, function ($message) use ($data, $emails) {
                    $message->to($emails)
                        ->subject($data["title"]);
                });
                //**SEND EMAIL FOR LEAD END HERE*/
            } else if (isset($request->agent_id) && isset($request->property_id)) {
                $lead = AgentContact::create([
                    'property_id' => $request->property_id,
                    'agent_id' => $request->agent_id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'description' => $request->message,
                    'type' => 2,
                    'status' => 0,
                ]);
                $property = Property::find($request->property_id);
                $agent = User::where('id', $request->agent_id)->first();
                //**SEND EMAIL FOR LEAD */
                $data["name"] = $request->name;
                $data["email"] = $request->email;
                $data["phone"] = $request->phone;
                $data["description"] = $request->message;
                $data["agent"] = $agent->name;
                $data["property"] = $property->title;
                $data["title"] = 'Agent Contact';
                //return $data;
                $emails = ['career@aaronz.co'];
                Mail::send('emails.agent-lead', $data, function ($message) use ($data, $emails) {
                    $message->to($emails)
                        ->subject($data["title"]);
                });
            }

            return response()->json(['code' => 200, 'message' => 'Your Request has been sent Successfully!', 'response' => $lead]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    /**Adding Property To Favourite Properties */
    public function add_remove_favourite_property(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'property_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['code' => 400, 'message' => 'Request Errors', 'response' => $validator->errors()]);
            }
            $checkProperty = FavProperty::where(['property_id' => $request->property_id, 'user_id' => auth()->user()->id])->first();

            if (!is_null($checkProperty)) {
                FavProperty::find($checkProperty->id)->delete();
                return response()->json(['code' => 200, 'message' => 'Removed From Favourite Property Successfully!', 'response' => []]);
            }

            /**Adding Propety To Favoutie Table */
            $fav_property = FavProperty::where(['property_id' => $request->property_id, 'user_id' => auth()->user()->id])->first();
            if ($fav_property) {
                FavProperty::where(['property_id' => $request->property_id, 'user_id' => auth()->user()->id])->delete();
            } else {
                $fav = new FavProperty;
                $fav->property_id = $request->property_id;
                $fav->user_id = auth()->user()->id;
                $fav->save();
            }
            return response()->json(['code' => 200, 'message' => 'Added To Favourite Property Successfully!', 'response' => []]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    /**Adding Property To Favourite Properties */
    public function check_favourite_property(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'property_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['code' => 400, 'message' => 'Request Errors', 'response' => $validator->errors()]);
            }
            $checkProperty = FavProperty::where(['property_id' => $request->property_id, 'user_id' => auth()->user()->id])->first();

            if (!is_null($checkProperty)) {
                return response()->json(['code' => 200, 'message' => 'Added to favourite Property', 'response' => 'true']);
            }

            return response()->json(['code' => 200, 'message' => 'Not Added to favourite Property', 'response' => 'false']);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }

    }

    public function get_favourite_properties(Request $request)
    {
        try {

            $properties = FavProperty::with(['properties' => function ($query) {
                $query->with('images')->with('developer')->where(['lang_id' => 1, 'status' => 1]);
            }])->where(['user_id' => auth()->user()->id])->get();
            return response()->json(['code' => 200, 'message' => 'Favourite Properties', 'response' => $properties]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    public function get_home_data()
    {
        try {
            $nav_bar = Navbar::where(['lang_id' => 1, 'status' => 1])->get(['name', 'slug', 'id']);

            $developers = Developer::where(['lang_id' => 1, 'status' => 1])->get();

            $property_types = Navbar::where(['lang_id' => 1, 'status' => 1])->WhereIn('slug', ['/off-plan', '/signature', '/secondary'])->orderBy('sort', 'ASC')->get(['id', 'name', 'slug']);

            $propertySearchType = PropertyType::where(['lang_id' => 1, 'status' => 1, 'type_id' => 0])->get(['id', 'name', 'slug']);

            $aaronzStory = AronzStory::get(['id', 'title', 'heading', 'description', 'image', 'button_link']);

            $propertyCategoriesForSale = PropertyCategory::where(['lang_id' => 1, 'status' => 1, 'property_type_id' => 1])->get(['name', 'id', 'slug']);

            $propertyCategoriesForRent = PropertyCategory::where(['lang_id' => 1, 'status' => 1, 'property_type_id' => 3])->get(['name', 'id', 'slug']);

            $headerFooter = HeaderFooter::where('lang_id', 1)->first();

            $team_members = User::where(['role_id' => 3, 'is_active' => 1])->orderBy('sort_order', 'ASC')->get(['name', 'id', 'phone', 'avatar', 'designation']);

            $videos_links = LifeAtAaronz::where('status', 1)->orderBy('sort_order', 'ASC')->get();

            $team_page = Page::where(['slug' => '/our-team', 'lang_id' => 1])->first();

            $team_members_data = ['team_page' => $team_page, 'team_members' => $team_members, 'videos_links' => $videos_links];

            $aaronzReviews = AronzReview::where(['lang_id' => 1, 'status' => 1])->get(['id', 'title', 'company_name', 'designation', 'review']);

            $sliders = Slider::orderBy('id', 'DESC')->get(['id', 'title', 'heading', 'description', 'image', 'button_link']);

            $states = LocationArea::withCount('properties')->with(['properties' => function ($q) {
                $q->with('images');
            }])->with('location_states:id,name,image')->where(['lang_id' => 1, 'location_country_id' => 1, 'is_show' => 1, 'status' => 1])->get(['id', 'image', 'name', 'location_state_id', 'location_country_id']);

            //**GETTING LOCATIONS HERE */
            //  $locations = LocationCountry::with(['location_states' => function($query){
            //     $query->where(['slug' => 'dubai','lang_id' => 1])->with(['location_areas' => function($query){
            //         $query->where(['location_state_id' => 1 ,'lang_id' => 1])->with(['locations' => function($query){
            //             $query->with(['buildings' => function($query){
            //                 $query->where(['lang_id' => 1, 'status' => 1]);
            //             }])->where(['lang_id' => 1, 'status' => 1]);
            //         }])->where(['lang_id' => 1, 'status' => 1]);
            //     }])->where(['lang_id' => 1, 'status' => 1]);
            // }])->where(['lang_id' => 1, 'is_default' => 1])->first();

            $locations = LocationCountry::with(['location_states' => function ($query) {
                $query->with(['location_areas' => function ($query) {
                    $query->with('locations')->where(['lang_id' => 1, 'status' => 1, 'location_state_id' => 1]);
                }])->where(['lang_id' => 1, 'status' => 1]);
            }])->where(['lang_id' => 1, 'is_default' => 1])->first();

            //**GETTING LOCATIONS END HERE */
            $featured_properties = Property::where(['status' => 2, 'is_featured' => 1, 'lang_id' => 1])->with('agent')->with('images')->orderBy('sort_order', 'ASC')->take(4)->get(
                [
                    'title', 'id', 'property_type_id', 'size_sqft', 'broucher', 'size_sqmtr', 'project_name', 'price', 'year_price', 'address_level', 'address_id', 'agent_id', 'features', 'amenities', 'is_featured'
                ]);

            //******* GETTING AMINITES AND LOCATION START HERE *******/

            $amenities = Amenity::where(['lang_id' => 1, 'status' => 1])->get();

            foreach ($featured_properties as $pro) {

                $pro->location_text = $this->get_location_text($pro->address_level, $pro->address_id);
                $pro->cords = $this->get_lat_lng($pro->address_level, $pro->address_id);

                $amenities_html = [];

                $amenities_arr = explode(",", $pro->amenities);

                for ($i = 0; $i < count($amenities_arr); $i++) {

                    foreach ($amenities as $amnty) {

                        if ($amnty->id == $amenities_arr[$i]) {

                            array_push($amenities_html, $amnty->name);
                        }
                    }
                }
                $pro->amenities = $amenities_html;
            }
            //******* GETTING AMINITES END HERE *******/

            //******* GETTING AMINITES START HERE *******/
            $features = Feature::where(['lang_id' => 1, 'status' => 1])->get();

            foreach ($featured_properties as $pro) {

                $feature_html = [];

                $feature_arr = explode(",", $pro->features);

                for ($i = 0; $i < count($feature_arr); $i++) {

                    foreach ($features as $feature) {

                        if ($feature->id == $feature_arr[$i]) {

                            array_push($feature_html, $feature->name);
                        }
                    }
                }

                $pro->features = $feature_html;
            }
            //******* GETTING FEATURES END HERE *******/

            $obj = [
                'menu' => $nav_bar,
                'sliders' => $sliders,
                'property_types' => $property_types,
                'property_categories_for_rent' => $propertyCategoriesForRent,
                'property_categories_for_sale' => $propertyCategoriesForSale,
                'states' => $states,
                'search_type' => $propertySearchType,
                'aaronz_story' => $aaronzStory,
                'aaronz_reviews' => $aaronzReviews,
                'team_members_data' => $team_members_data,
                'featured_homes' => $featured_properties,
                'header_footer' => $headerFooter,
                'locations' => $locations
            ];
            return response()->json(['code' => 200, 'message' => 'Home Page Data', 'response' => $obj]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    public function get_detail_page_data(Request $request)
    {
        try {

            $property_type = Navbar::where('slug', $request->slug)->first();

            $page_detail = Page::where(['lang_id' => 1, 'status' => 1, 'menu_id' => $property_type->id])->first();

            // $property_type =  Navbar::where('slug',$request->property_type_id)->first();

            $type = PropertyType::where('name', 'like', '%' . $property_type->name . '%')->where('type_id', 1)->first();

            ///return $property_type;

            $properties = Property::where(['property_status_id' => $type->id, 'status' => 2, 'lang_id' => 1])->with('agent')->with('images')->orderBy('id', 'DESC')->get(
                [
                    'id',
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
                    'broucher',
                    'signature_title',
                    'signature_desc',
                    'signature_image',
                    'signature_section_two_title',
                    'signature_section_two_desc',
                    'signature_section_two_image',
                    'signature_section_three_title',
                    'signature_section_three_desc',
                    'signature_section_three_image'
                ]);

            if ($type->name == 'Signature') {
                $properties = Property::where(['is_signature' => 1, 'status' => 2, 'lang_id' => 1])->with('agent:id,name,email,phone,avatar')->with('images:id,property_id,image', 'category:id,name', 'type:id,name')->orderBy('id', 'DESC')->get(
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
                        'broucher',
                        'is_signature',
                        'signature_title',
                        'signature_desc',
                        'signature_image',
                        'signature_section_two_title',
                        'signature_section_two_desc',
                        'signature_section_two_image',
                        'signature_section_three_title',
                        'signature_section_three_desc',
                        'signature_section_three_image'
                    ]);
            }

            //$views = View::where(['lang_id' => 1, 'status' => 1])->get();

            $off_plan_page = [];

            if ($page_detail->slug == '/off-plan') {

                $sale_apartment_properties = PropertyCategory::where('lang_id', 1)->where('slug', 'apartments-for-sale')->first();
                $sale_villas_properties = PropertyCategory::where('lang_id', 1)->where('slug', 'villas-for-sale')->first();
                $sale_townhouse_properties = PropertyCategory::where('lang_id', 1)->where('slug', 'townhouses-for-sale')->first();
                $sale_penthouses_properties = PropertyCategory::where('lang_id', 1)->where('slug', 'penthouses-for-sale')->first();
                $sale_apartment_properties != '' ? $sale_apartment_properties = Property::where(['property_category_id' => $sale_apartment_properties->id, 'status' => 2, 'lang_id' => 1])->with('agent:id,name,email,phone,avatar')->with('images:id,property_id,image', 'category:id,name', 'type:id,name')->orderBy('id', 'DESC')->take(4)->get(

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
                        'broucher',
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
                $sale_villas_properties != '' ? $sale_villas_properties = Property::where(['property_category_id' => $sale_villas_properties->id, 'status' => 2, 'lang_id' => 1])->with('agent:id,name,email,phone,avatar')->with('images:id,property_id,image', 'category:id,name', 'type:id,name', 'developer:id,name,image')->orderBy('id', 'DESC')->take(4)->get(
                    [
                        'id',
                        'developer_id',
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
                        'broucher',
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
                $sale_townhouse_properties != '' ? $sale_townhouse_properties = Property::where(['property_category_id' => $sale_townhouse_properties->id, 'status' => 2, 'lang_id' => 1])->with('agent:id,name,email,phone,avatar')->with('images:id,property_id,image', 'category:id,name', 'type:id,name')->orderBy('id', 'DESC')->take(4)->get(
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
                        'broucher',
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
                $sale_penthouses_properties != '' ? $sale_penthouses_properties = Property::where(['property_category_id' => $sale_penthouses_properties->id, 'status' => 2, 'lang_id' => 1])->with('agent:id,name,email,phone,avatar')->with('images:id,property_id,image', 'category:id,name', 'type:id,name')->orderBy('id', 'DESC')->take(4)->get(
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
                        'broucher',
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

                $off_plan_page['appartments_for_sale'] = $sale_apartment_properties;
                $off_plan_page['sale_villas'] = $sale_villas_properties;
                $off_plan_page['sale_townhouses'] = $sale_townhouse_properties;
                $off_plan_page['sale_penthouses'] = $sale_penthouses_properties;

            }

            $states = LocationArea::withCount('properties')->with('location_states')->where(['lang_id' => 1, 'location_country_id' => 1, 'is_show' => 1, 'status' => 1])->get();

            //******* GETTING AMINITES START HERE *******/

            $amenities = Amenity::where(['lang_id' => 1, 'status' => 1])->get();

            foreach ($properties as $pro) {

                $amenities_html = [];

                $amenities_arr = explode(",", $pro->amenities);

                for ($i = 0; $i < count($amenities_arr); $i++) {

                    foreach ($amenities as $amnty) {

                        if ($amnty->id == $amenities_arr[$i]) {

                            array_push($amenities_html, $amnty->name);
                        }
                    }
                }

                $pro->amenities = $amenities_html;
            }

            //******* GETTING AMINITES END HERE *******/

            //******* GETTING AMINITES START HERE *******/
            $features = Feature::where(['lang_id' => 1, 'status' => 1])->get();

            foreach ($properties as $pro) {

                $feature_html = [];

                $feature_arr = explode(",", $pro->features);

                for ($i = 0; $i < count($feature_arr); $i++) {

                    foreach ($features as $feature) {

                        if ($feature->id == $feature_arr[$i]) {

                            array_push($feature_html, $feature->name);
                        }
                    }
                }

                $pro->features = $feature_html;
            }
            //******* GETTING FEATURES END HERE *******/

            $obj = [
                'properties' => $properties,
                'page_details' => $page_detail,
                'off_plan_page' => $off_plan_page
            ];
            return response()->json(['code' => 200, 'message' => 'Details Page Data', 'response' => $obj]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    public function get_signature_page(Request $request)
    {
        try {

            $property_type = Navbar::where('slug', $request->slug)->first();

            $page_detail = Page::where(['lang_id' => 1, 'status' => 1, 'menu_id' => $property_type->id])->first();

            // $property_type =  Navbar::where('slug',$request->property_type_id)->first();

            if ($page_detail->slug == '/signature') {
                $properties = Property::where(['is_signature' => 1, 'status' => 2, 'lang_id' => 1, 'property_type_id' => 1])->with('agent:id,name,email,phone,avatar')->with('images:id,property_id,image', 'category:id,name', 'type:id,name')->orderBy('id', 'DESC')->get(
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
                        'broucher',
                        'is_signature',
                        'signature_title',
                        'signature_desc',
                        'signature_image',
                        'signature_section_two_title',
                        'signature_section_two_desc',
                        'signature_section_two_image',
                        'signature_section_three_title',
                        'signature_section_three_desc',
                        'signature_section_three_image'
                    ]);
            } elseif ($page_detail->slug == '/signature-rental') {
                $properties = Property::where(['is_signature' => 1, 'status' => 2, 'lang_id' => 1, 'property_type_id' => 3])->with('agent:id,name,email,phone,avatar')->with('images:id,property_id,image', 'category:id,name', 'type:id,name')->orderBy('id', 'DESC')->get(
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
                        'broucher',
                        'is_signature',
                        'signature_title',
                        'signature_desc',
                        'signature_image',
                        'signature_section_two_title',
                        'signature_section_two_desc',
                        'signature_section_two_image',
                        'signature_section_three_title',
                        'signature_section_three_desc',
                        'signature_section_three_image'
                    ]);
            } else {
                $properties = [];
            }

            //$views = View::where(['lang_id' => 1, 'status' => 1])->get();


            $states = LocationArea::withCount('properties')->with('location_states')->where(['lang_id' => 1, 'location_country_id' => 1, 'is_show' => 1, 'status' => 1])->get();

            //******* GETTING AMINITES START HERE *******/

            $amenities = Amenity::where(['lang_id' => 1, 'status' => 1])->get();
            if (count($properties) > 0) {
                foreach ($properties as $pro) {

                    $amenities_html = [];

                    $amenities_arr = explode(",", $pro->amenities);

                    for ($i = 0; $i < count($amenities_arr); $i++) {

                        foreach ($amenities as $amnty) {

                            if ($amnty->id == $amenities_arr[$i]) {

                                array_push($amenities_html, $amnty->name);
                            }
                        }
                    }

                    $pro->amenities = $amenities_html;
                }
            }

            //******* GETTING AMINITES END HERE *******/

            //******* GETTING AMINITES START HERE *******/
            $features = Feature::where(['lang_id' => 1, 'status' => 1])->get();

            if (count($properties) > 0) {

                foreach ($properties as $pro) {

                    $feature_html = [];

                    $feature_arr = explode(",", $pro->features);

                    for ($i = 0; $i < count($feature_arr); $i++) {

                        foreach ($features as $feature) {

                            if ($feature->id == $feature_arr[$i]) {

                                array_push($feature_html, $feature->name);
                            }
                        }
                    }

                    $pro->features = $feature_html;
                }
            }
            //******* GETTING FEATURES END HERE *******/

            $obj = [
                'properties' => $properties,
                'page_details' => $page_detail
            ];
            return response()->json(['code' => 200, 'message' => 'Signature Page', 'response' => $obj]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    //***GETING PROPERTY LEADS HERE***//
    public function get_property_leads(Request $request)
    {
        try {
            $leads = Lead::with(['lead_property' => function ($q) {
                $q->with('images', 'agent');
            }])->with('tenancy')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
            foreach ($leads as $lead) {
                //**Checking Lead Status */
                if ($lead->status == 0) {
                    $lead->lead_status = 'New';
                } elseif ($lead->status == 1) {
                    $lead->lead_status = 'In Progress';
                } elseif ($lead->status == 2) {
                    $lead->lead_status = 'Completed';
                } elseif ($lead->status == 3) {
                    $lead->lead_status = 'On Hold';
                } else {
                    $lead->status = 'Cancelled';
                }
                //**CHECKING  PROPERTY TYPE HERE */
                if ($lead->lead_property != '') {
                    if ($lead->lead_property->property_type_id == 1) {
                        $lead->lead_property->property_type = 'Sale';
                    } elseif ($lead->lead_property->property_type_id == 3) {
                        $lead->lead_property->property_type = 'Rent';
                    } else {
                        $lead->lead_property->property_type = 'N/A';
                    }
                    //**CHECKING PROPERTY TYPE (Furnished or not) HERE */
                    if ($lead->lead_property->furnished_type == 1) {
                        $lead->lead_property->furnished_type_status = 'Furnished';
                    } elseif ($lead->lead_property->furnished_type == 2) {
                        $lead->lead_property->property_type_status = 'Un-Furnished';
                    } else {
                        $lead->lead_property->furnished_type_status = 'Partial Furnished';
                    }
                }

            }
            return response()->json(['code' => 200, 'message' => 'leads', 'response' => $leads]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    //**ADVANCE SEARCH START HERE */
    public function advance_search(Request $request)
    {
        try {
            $properties = Property::with('agent', 'images', 'category')->filter($request)->latest()
                ->paginate(12);
            foreach ($properties as $property) {
                $views_tags = [];
                $vs = explode(',', $property->views);

                foreach ($vs as $v_id) {
                    $views_tags = View::where('id', $v_id)->where('lang_id', 1)->get();
                }
                $property['view_tags'] = $views_tags;

                if ($property->address_level == 0) {
                    $property['location_text'] = $this->get_location_text($property->address_level, $property->location_state_id);
                } else if ($property->address_level == 1) {
                    $property['location_text'] = $this->get_location_text($property->address_level, $property->location_area_id);
                    // return $property['location_text']
                } else if ($property->address_level == 2) {
                    // return $property->location_id ;
                    $property['location_text'] = $this->get_location_text($property->address_level, $property->location_id);
                } else if ($property->address_level == 3) {
                    $property['location_text'] = $this->get_location_text($property->address_level, $property->location_building_id);
                } else {
                    $property['location_text'] = '';
                }
            }

            return response()->json(['code' => 200, 'message' => 'Properties', 'response' => $properties]);


        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    //**OffPlan ADVANCE SEARCH START HERE */
    public function offplan_advance_search(Request $request)
    {
        try {
            $properties = Property::with('agent', 'images', 'category')->where(['property_status_id' => 13])->offplan($request)->latest()
                ->paginate(12);
            foreach ($properties as $property) {

                if ($property->address_level == 0) {
                    $property['location_text'] = $this->get_location_text($property->address_level, $property->location_state_id);
                } else if ($property->address_level == 1) {
                    $property['location_text'] = $this->get_location_text($property->address_level, $property->location_area_id);
                    // return $property['location_text']
                } else if ($property->address_level == 2) {
                    // return $property->location_id ;
                    $property['location_text'] = $this->get_location_text($property->address_level, $property->location_id);
                } else if ($property->address_level == 3) {
                    $property['location_text'] = $this->get_location_text($property->address_level, $property->location_building_id);
                } else {
                    $property['location_text'] = '';
                }
            }

            return response()->json(['code' => 200, 'message' => 'Properties', 'response' => $properties]);


        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }


    //**GET LOCATION TEXT ACCORDING TO ID AND ADDRESS LEVEL */
    public function get_location_text($level, $id)
    {
        $name_slug = [];
        if ($level == 0) {
            $state = LocationState::where(['id' => $id, 'lang_id' => 1])->first();
            $name_slug[] = $state->name;
            $name_slug[] = $state->slug;
            return $name_slug;
        } else if ($level == 1) {
            $area = LocationArea::where(['id' => $id, 'lang_id' => 1])->first();
            return $area;
            $state = LocationState::where(['id' => $area->location_state_id, 'lang_id' => 1])->first();
            $name_slug[] = $area->name . ', ' . $state->name;
            $name_slug[] = $state->slug . '/' . $area->slug;
            return $name_slug;
        } else if ($level == 2) {
            $location = Location::where(['id' => $id, 'lang_id' => 1])->first();
            $state = LocationState::where(['id' => $location->location_state_id, 'lang_id' => 1])->first();
            $area = LocationArea::where(['id' => $location->location_area_id, 'lang_id' => 1])->first();

            $name_slug[] = $location->name . ', ' . $area->name . ', ' . $state->name;
            $name_slug[] = $state->slug . '/' . $area->slug . '/' . $location->slug;
            return $name_slug;
        } else if ($level == 3) {
            $building = LocationBuilding::where(['id' => $id, 'lang_id' => 1])->first();
            $location = Location::where(['id' => $building->location_id, 'lang_id' => 1])->first();
            $state = LocationState::where(['id' => $building->location_state_id, 'lang_id' => 1])->first();
            $area = LocationArea::where(['id' => $building->location_area_id, 'lang_id' => 1])->first();

            $name_slug[] = $building->name . ', ' . $location->name . ', ' . $area->name . ', ' . $state->name;
            $name_slug[] = $state->slug . '/' . $area->slug . '/' . $location->slug . '/' . $building->slug;
            return $name_slug;
        }
    }

    /**Get Property tenancy contract */
    public function property_tenancy_contract(Request $request)
    {
        try {
            $property_tenancy_contract = Lead::has('lead_property')->with(['lead_property' => function ($q) {
                $q->with('images', 'agent');
            }])->has('tenancy')->with(['tenancy' => function ($quesry) {
                $quesry->with('cheques', 'tenant_images', 'owner_images');
            }])->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
            return response()->json(['code' => 200, 'message' => 'Tenancy Contracts', 'response' => $property_tenancy_contract]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }
    /**Get Property tenancy contract end Here*/

    //*****TODO:SERVICES APIs START FROM HERE NOT USED IN AARONZ******//

    /**GET SERVICES START Here*/
    public function get_service(Request $request)
    {
        try {
            $services = ServiceCategory::with(['sub_services' => function ($q) {
                $q->with('list_services')->with('service_questions');
            }])->where('lang_id', 1)->get();
            return response()->json(['code' => 200, 'message' => 'Services', 'response' => $services]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    /**SEND SERVICE LEAD START Here (NOT USED IN AARONZ)*/
    public function send_service_lead(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'service_id' => 'required',
                'name' => 'required|min:3',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
                'question_names' => 'required|array|min:1',
                'question_names.*' => 'required|string|distinct|min:1',
                'answers' => 'required|array|min:1',
                'answers.*' => 'required|string|distinct|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json(['code' => 400, 'message' => 'Request Errors', 'response' => $validator->errors()]);
            }
            $company = ListService::where('id', $request->service_id)->first();
            //return $company;
            $service_lead = ServiceLead::create([
                'service_id' => $request->service_id,
                'company_id' => $company->company_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'details' => $request->message,
                'status' => 0,
            ]);
            $service_lead_id = $service_lead->id;
            for ($i = 0; $i < count($request->question_names); $i++) {
                $deatil = new ServiceLeadDetail;
                $deatil->service_lead_id = $service_lead_id;
                $deatil->question = $request->question_names[$i];
                $deatil->answer = $request->answers[$i];
                $deatil->save();
            }

            return response()->json(['code' => 200, 'message' => 'Your Request has been sent Successfully!', 'response' => $service_lead]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    /**Get Service Leads */
    public function get_service_leads(Request $request)
    {
        try {
            $leads = AssignedServiceLead::with('user:id,name,email,phone,avatar')->with(['service_lead' => function ($q) {
                $q->with('service_lead_deatils');
            }])->where('assigned_to', Auth::user()->id)->orderBy('id', 'DESC')->get();
            foreach ($leads as $lead) {
                if ($lead->service_lead->status == 0) {
                    $lead->service_lead->lead_status = 'New';
                } elseif ($lead->service_lead->status == 1) {
                    $lead->service_lead->lead_status = 'In Progress';
                } elseif ($lead->service_lead->status == 2) {
                    $lead->service_lead->lead_status = 'Completed';
                } elseif ($lead->service_lead->status == 3) {
                    $lead->service_lead->lead_status = 'On Hold';
                } else {
                    $lead->service_lead->status = 'Cancelled';
                }
            }
            return response()->json(['code' => 200, 'message' => 'Service Leads', 'response' => $leads]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }
    //GETTING  Service LEADS END HERE

    //**GETING ASSIGNED PROPERTY LEADS HERE//
    public function get_assigned_property_leads(Request $request)
    {
        try {
            $leads = Lead::with(['assigned_to' => function ($query) {
                $query->where('assigned_to', Auth::user()->id);
            }])->with(['lead_property' => function ($q) {
                $q->with('images');
            }])->with('tenancy')->orderBy('id', 'DESC')->get();
            foreach ($leads as $lead) {
                //**Checking Lead Status */
                if ($lead->status == 0) {
                    $lead->lead_status = 'New';
                } elseif ($lead->status == 1) {
                    $lead->lead_status = 'In Progress';
                } elseif ($lead->status == 2) {
                    $lead->lead_status = 'Completed';
                } elseif ($lead->status == 3) {
                    $lead->lead_status = 'On Hold';
                } else {
                    $lead->status = 'Cancelled';
                }
                //**CHECKING  PROPERTY TYPE HERE */
                if ($lead->lead_property != '') {
                    if ($lead->lead_property->property_type_id == 1) {
                        $lead->lead_property->property_type = 'Sale';
                    } elseif ($lead->lead_property->property_type_id == 3) {
                        $lead->lead_property->property_type = 'Rent';
                    } else {
                        $lead->lead_property->property_type = 'N/A';
                    }
                    //**CHECKING PROPERTY TYPE (Furnished or not) HERE */
                    if ($lead->lead_property->furnished_type == 1) {
                        $lead->lead_property->furnished_type_status = 'Furnished';
                    } elseif ($lead->lead_property->furnished_type == 2) {
                        $lead->lead_property->property_type_status = 'Un-Furnished';
                    } else {
                        $lead->lead_property->furnished_type_status = 'Partial Furnished';
                    }
                }

            }
            return response()->json(['code' => 200, 'message' => 'leads', 'response' => $leads]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }
    //**GETTING ASSIGNED PROPERTY LEADS END HERE///

    //**GETTING MENUS DETAILS */
    public function home_page_menu()
    {

        try {
            $home_menu = Navbar::where('lang_id', 1)->whereIn('slug', ['/buy', '/rent', '/about-us', '/off-plan', '/signature'])->get(['id', 'name', 'slug']);

            $sale = PropertyType::where('name', 'LIKE', '%' . 'Sale' . '%')->first();

            $rent = PropertyType::where('name', 'LIKE', '%' . 'Rent' . '%')->first();

            $sale_property = Property::where('property_type_id', $sale->id)->with('images')->where(['lang_id' => 1, 'status' => 2])->take(1)->first(['id', 'title', 'description', 'slug']);

            $rent_property = Property::where('property_type_id', $rent->id)->with('images')->where(['lang_id' => 1, 'status' => 2])->take(1)->first(['id', 'title', 'description', 'slug']);


            $cummercial_sab_menu = PropertyCategory::where(['property_type_id' => $sale->id, 'lang_id' => 1, 'is_commercial' => 0, 'status' => 1])->get(['id', 'name', 'slug']);

            $residencial_sab_menu = PropertyCategory::where(['property_type_id' => $sale->id, 'lang_id' => 1, 'is_commercial' => 1, 'status' => 1])->get(['id', 'name', 'slug']);

            $rent_cummercial_sab_menu = PropertyCategory::where(['property_type_id' => $rent->id, 'lang_id' => 1, 'is_commercial' => 0, 'status' => 1])->get(['id', 'name', 'slug']);

            $rent_residencial_sab_menu = PropertyCategory::where(['property_type_id' => $rent->id, 'lang_id' => 1, 'is_commercial' => 1, 'status' => 1])->get(['id', 'name', 'slug']);

            //ADDIN NEW KEY FOR SUB MENU//
            foreach ($home_menu as $menu) {
                if ($menu->slug == '/buy') {
                    $menu->cummercial_sab_menu = $cummercial_sab_menu;
                    $menu->residencial_sab_menu = $residencial_sab_menu;
                }
                if ($menu->slug == '/rent') {
                    $menu->cummercial_sab_menu = $rent_cummercial_sab_menu;
                    $menu->residencial_sab_menu = $rent_residencial_sab_menu;

                }
            }

            return response()->json(['code' => 200, 'message' => 'Home Page Menu', 'response' => $home_menu, 'sale_property' => $sale_property, 'rent_property' => $rent_property]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }

    }
    //**GETTING MENUS DETAILS END HETE*/


    //***GETTING OFF-LINE PROPERTIES */
    public function get_offplan_properties()
    {
        try {
            $page_details = Page::where(['slug' => '/off-plan-properties', 'lang_id' => 1])->first();

            $offplan_properties = Property::where('property_status_id', 13)->with('images')->where(['lang_id' => 1, 'status' => 2])->get();

            $loc = [];
            $year_of_completions = [];
            $project_names = [];
            $developers = [];
            foreach ($offplan_properties as $property) {
                //*** GETTING PROJECT NAME ***/
                if ($property->project_name) {
                    $project_names[] = $property->project_name;
                }
                if ($property->developer_id) {
                    $developers[] = $property->developer_id;
                }
                //**GETTING OFF PLAN EXPIRY DATE */
                if ($property->off_plan_expire_date) {
                    $year = Carbon::createFromFormat('Y-m-d', $property->off_plan_expire_date)->year;
                    $year_of_completions[] = (string)$year;
                }
                if ($property->address_level == 0) {
                    $state = LocationState::where(['id' => $property->address_id, 'lang_id' => 1])->first();
                    $state->level = $property->address_level . ',' . $property->address_id;
                    $loc[] = $state;
                } else if ($property->address_level == 1) {
                    $area = LocationArea::where(['id' => $property->address_id, 'lang_id' => 1])->first();
                    $area->level = $property->address_level . ',' . $property->address_id;
                    $loc[] = $area;

                } else if ($property->address_level == 2) {
                    $location = Location::where(['id' => $property->address_id, 'lang_id' => 1])->first();
                    $location->level = $property->address_level . ',' . $property->address_id;
                    $loc[] = $location;

                } else if ($property->address_level == 3) {
                    $building = LocationBuilding::where(['id' => $property->address_id, 'lang_id' => 1])->first();
                    $building->level = $property->address_level . ',' . $property->address_id;
                    $loc[] = $building;
                }
            }
            //return $loc;
            $loc = collect($loc)->unique();
            $result = [];
            foreach ($loc as $l) {
                $result[] = $l;
            }
            $developers = Developer::whereIn('id', $developers)->get(['id', 'name']);

            $page_details->offplan_properties = $offplan_properties;

            $page_details->developers = $developers;

            $page_details->locations = $result;

            $page_details->year_of_completion = array_values(array_unique($year_of_completions));

            $page_details->project_names = $project_names;

            return response()->json(['code' => 200, 'message' => 'Offplan Properties', 'response' => $page_details]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    //**GETTING ALL PAGES */
    public function get_all_pages()
    {
        try {
            $data = Page::where(['lang_id' => 1, 'status' => 1])->get(['id', 'slug', 'title', 'description', 'image', 'bg_image', 'meta_title', 'meta_description', 'facebook', 'instagram', 'twitter', 'whatsapp']);

            if ($data == '') {
                return response()->json(['code' => 400, 'message' => 'Pages Not Found', 'response' => []]);
            }
            return response()->json(['code' => 200, 'message' => 'Your Requested Pages Found Successfully!', 'response' => $data]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    //**GETTING Page DETAILS */
    public function get_page_detail($id)
    {
        try {
            // return $id;
            $data = '';
            if (is_numeric($id)) {
                $data = Page::where(['id' => $id, 'lang_id' => 1])->first(['id', 'title', 'slug', 'description', 'image', 'bg_image', 'meta_title', 'meta_description', 'facebook', 'instagram', 'twitter', 'whatsapp']);
                if ($data == '') {
                    return response()->json(['code' => 400, 'message' => 'Page Not Found', 'response' => []]);
                }
                return response()->json(['code' => 200, 'message' => 'Your Requested Page Found Successfully!', 'response' => $data]);
            } else {
                $data = Page::where(['slug' => '/' . $id, 'lang_id' => 1])->first(['id', 'title', 'slug', 'description', 'image', 'bg_image', 'meta_title', 'meta_description', 'facebook', 'instagram', 'twitter', 'whatsapp']);
                if ($data == '') {
                    return response()->json(['code' => 400, 'message' => 'Page Not Found', 'response' => []]);
                }
                return response()->json(['code' => 200, 'message' => 'Your Requested Page Found Successfully!', 'response' => $data]);
            }
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }
    //**GETTING PAGE DETAILS END HETE*/

    //** MORTGAGE PROPERTY LEAD**//
    /**Send Lead Here */
    public function send_mortgage_lead(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'property_id' => 'required',
                'name' => 'required|min:3',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
                'down_payment' => 'required',
                'no_of_installment' => 'required',
                'monthly_installment' => 'required',
                'intrust_rate' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['code' => 400, 'message' => 'Request Errors', 'response' => $validator->errors()]);
            }
            // return $request->all();
            $lead = Lead::create([
                'property_id' => $request->property_id,
                // 'user_id' => Auth::user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'description' => $request->message,
                'dowm_payment' => $request->dowm_payment,
                'no_of_installment' => $request->no_of_installment,
                'monthly_installment' => $request->monthly_installment,
                'intrust_rate' => $request->intrust_rate,
                'status' => 0,
                'type' => 3
            ]);
            $property = Property::find($request->property_id);
            //**SEND EMAIL FOR LEAD */
            $data["name"] = $request->name;
            $data["email"] = $request->email;
            $data["phone"] = $request->phone;
            $data["description"] = $request->message;
            $data["dowm_payment"] = $request->dowm_payment;
            $data["no_of_installment"] = $request->no_of_installment;
            $data["monthly_installment"] = $request->monthly_installment;
            $data["intrust_rate"] = $request->intrust_rate;
            $data["property"] = $property->title;
            $data["title"] = 'Mortgage Lead';
            //return $data;
            $emails = ['career@aaronz.co'];
            Mail::send('emails.mortgage-lead', $data, function ($message) use ($data, $emails) {
                $message->to($emails)
                    ->subject($data["title"]);
            });
            //**SEND EMAIL FOR LEAD END HERE*/

            return response()->json(['code' => 200, 'message' => 'Your Request has been sent Successfully!', 'response' => $lead]);
        } catch (\Exception $ex) {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }
}
