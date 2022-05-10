<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Leads\Lead;
use App\Models\Admin\Settings\Price;
use App\Models\Properties\Amenity;
use App\Models\Properties\Feature;
use Illuminate\Http\Request;
use App\Models\Properties\Property;
use App\Models\Properties\FavProperty;
use App\Models\Properties\PropertyCategory;
use App\Models\Locations\LocationState;
use App\Models\Locations\LocationArea;
use App\Models\Locations\Location;
use App\Models\Properties\PaymentMethod;
use App\Models\Locations\LocationBuilding;
use App\Models\Locations\LocationCountry;
use App\Models\Properties\View;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use phpseclib3\System\SSH\Agent;

class PropertyController extends Controller
{

    public function search(Request $request)
    {
        $location_data = explode(",", $request->l);
        $t = $request->t;
        $c = $request->c;
        $mnp = $request->mnp;
        $mxp = $request->mxp;
        $bd = $request->bd;
        $bh = $request->bh;
        $mnz = $request->mnz;
        $mxz = $request->mxz;
        $v = $request->v;
        $level = $location_data[0];
        $location = $location_data[1];
        $property_type_id = $request->t;
        $property_category_id = $request->c;
        $location_country = [];
        $type = '';
        if ($property_type_id == 1) {
            $type = 'Sale';
        } else {
            $type = 'Rent';
        }
        $views = View::where(['lang_id' => 1, 'status' => 1])->get();

        $property_category = PropertyCategory::where(['lang_id' => 1, 'id' => $property_category_id, 'status' => 1])->first();

        $location_state = LocationState::where(['lang_id' => 1, 'id' => $location])->first();

        $title = $property_category->name . ' For '. $type . ' in ' . $location_state->name;
        if($level == 0)
        {
        $areas = LocationArea::withCount('properties')->where(['location_state_id' => $location_state->id, 'lang_id' => 1])->get();
        $properties = Property::with('images', 'company')->with('developer')->where(['property_category_id' => $property_category_id,'lang_id' => 1, 'location_state_id' => $location_state->id, 'status' => 2])->get();
        $location_name = 'your location';
        return view('website.search.propertyByState', compact('t', 'views', 'c', 'title', 'property_category_id', 'properties', 'areas', 'location_state', 'location_country', 'location_data', 'property_type_id', 'mnp', 'mxp', 'bd', 'bh', 'mnz', 'mxz', 'v', 'location_name'));
        }else if($level == 1)
        {
            $location_area = LocationArea::where(['lang_id' => 1, 'id' => $location])->first();
            $location_state = LocationState::where(['lang_id' => 1, 'id' => $location_area->location_state_id])->first();
            $title = $property_category->name . ' For '. $type . ' in ' . $location_area->name;

            $locations = Location::withCount('properties')->where(['location_area_id' => $location_area->id, 'lang_id' => 1])->get();
            $properties = Property::with('images', 'company')->with('developer')->where(['property_category_id' => $property_category_id,'lang_id' => 1, 'location_area_id' => $location_area->id, 'status' => 2])->get();
            $location_name = 'your location';
            return view('website.search.propertyByAreas', compact('t', 'views', 'c', 'title', 'location_state', 'property_category_id', 'properties', 'locations', 'location_area', 'location_country', 'location_data', 'property_type_id', 'mnp', 'mxp', 'bd', 'bh', 'mnz', 'mxz', 'v', 'location_name'));
        }
        else if($level == 2)
        {
            $location = Location::where(['lang_id' => 1, 'id' => $location])->first();
            $location_area = LocationArea::where(['lang_id' => 1, 'id' => $location->id])->first();
            $location_state = LocationState::where(['lang_id' => 1, 'id' => $location_area->location_state_id])->first();
            $title = $property_category->name . ' For '. $type . ' in ' . $location_area->name;

            $buildings = LocationBuilding::withCount('properties')->where(['location_id' => $location->id, 'lang_id' => 1])->get();
            $properties = Property::with('images', 'company')->with('developer')->where(['property_category_id' => $property_category_id,'lang_id' => 1, 'location_area_id' => $location_area->id, 'status' => 2])->get();
            $location_name = 'your location';
            return view('website.search.propertyByLocations', compact('t', 'views', 'c', 'title', 'location', 'location_state', 'property_category_id', 'properties', 'buildings', 'location_area', 'location_country', 'location_data', 'property_type_id', 'mnp', 'mxp', 'bd', 'bh', 'mnz', 'mxz', 'v', 'location_name'));
        }
        else if($level == 3)
        {
            $building = LocationBuilding::where(['lang_id' => 1, 'id' => $location])->first();
            $location = Location::where(['lang_id' => 1, 'id' => $building->id])->first();
            $location_area = LocationArea::where(['lang_id' => 1, 'id' => $location->id])->first();
            $location_state = LocationState::where(['lang_id' => 1, 'id' => $location_area->location_state_id])->first();
            $title = $property_category->name . ' For '. $type . ' in ' . $building->name;

            $buildings = LocationBuilding::withCount('properties')->where(['location_id' => $location->id, 'lang_id' => 1])->get();
            $properties = Property::with('images', 'company')->with('developer')->where(['property_category_id' => $property_category_id,'lang_id' => 1, 'location_area_id' => $location_area->id, 'status' => 2])->get();
            $location_name = 'your location';
            return view('website.search.propertyByBuildings', compact('t', 'views', 'c', 'title', 'location', 'location_state', 'property_category_id', 'properties', 'buildings', 'location_area', 'location_country', 'location_data', 'property_type_id', 'mnp', 'mxp', 'bd', 'bh', 'mnz', 'mxz', 'v', 'location_name'));
        }

    }


    public function search_locations(Request $request){
        $search = $request->search;
        $country_locations = LocationCountry::with(['location_states' => function($query) use($search){
            $query->where('name', 'like', '%'.$search.'%')->with(['location_areas' => function($query) use($search){
                $query->where('name', 'like', '%'.$search.'%')->with(['locations' => function($query) use($search){
                    $query->where('name', 'like', '%'.$search.'%')->with(['buildings' => function($query) use($search){
                        $query->where(['lang_id' => 1, 'status' => 1]);
                    }])->where(['lang_id' => 1, 'status' => 1]);
                }])->where(['lang_id' => 1, 'status' => 1]);
            }])->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'is_default' => 1])->first();

        $html = '';
        $location_array = [];
        if(!is_null($country_locations)){
            /**Location States First*/
            if(count($country_locations->location_states) > 0){
                foreach($country_locations->location_states as $state){
                    $html .= '<option value="0,'.$state->id.'">'.$state->name.'</option>';
                    // array_push($location_array, ['0,'.$state->id => $state->name]);
                    // array_push($location_array, $state->name);
                    /**Location State Areas Second*/
                    if(count($state->location_areas) > 0){
                        foreach($state->location_areas as $area){
                            $html .= '<option value="1,'.$area->id.'">'.$area->name.', '.$state->name.'</option>';
                            // array_push($location_array, ['1,'.$area->id => $area->name.', '.$state->name]);
                            // array_push($location_array, $area->name.', '.$state->name);
                        }
                         /**Location Area Locations Third*/
                        if(count($area->locations) > 0){
                            foreach($area->locations as $location){
                                $html .= '<option value="2,'.$location->id.'">'.$location->name.' ,'.$area->name.', '.$state->name.'</option>';
                                // array_push($location_array, ['2,'.$location->id => $location->name.' ,'.$area->name.', '.$state->name]);
                                // array_push($location_array, $location->name.' ,'.$area->name.', '.$state->name);
                            }
                                /**Locations Location's Buildings Fourth*/
                                if(count($location->buildings) > 0){
                                    foreach($location->buildings as $building){
                                        $html .= '<option value="3,'.$building->id.'">'.$building->name.' , '.$location->name.' ,'.$area->name.', '.$state->name.'</option>';
                                        // array_push($location_array, ['3,'.$building->id => $building->name.' , '.$location->name.' ,'.$area->name.', '.$state->name]);
                                        // array_push($location_array, $building->name.' , '.$location->name.' ,'.$area->name.', '.$state->name);
                                    }
                                }

                        }
                    }


                }
            }

        }

        return $html;
    }

    public function get_property_categories(Request $request)
    {
        $property_categroies = PropertyCategory::where(['lang_id' => 1, 'property_type_id' => $request->type])->get();
        $property_prices = Price::where(['type_id' => $request->type])->get();
        $sizes = get_property_sizes();
        $categories = '';
        $mnp = '<option value="">Min Price</option>';
        $mxp = '<option value="">Max Price</option>';
        $mnz = '<option value="">Min Size</option>';
        $mxz = '<option value="">Max Size</option>';
        if($property_categroies->count()){
            foreach($property_categroies as $item)
            {
                $categories .= '<option value="'.$item->id.'">'.$item->name.'</option>';
            }
        }

        if($property_prices->count()){
            foreach($property_prices as $pp)
            {
                if($pp->amount > 0){
                    $mnp .= '<option value="'.$pp->amount.'">'.number_format($pp->amount).'</option>';
                    $mxp .= '<option value="'.$pp->amount.'">'.number_format($pp->amount).'</option>';
                }
            }
        }

        if($sizes->count()){
            foreach($sizes as $sz)
            {
                $mnz .= '<option value="'.$sz->id.'">'.number_format($sz->size).'</option>';
                $mxz .= '<option value="'.$sz->id.'">'.number_format($sz->size).'</option>';
            }
        }


        return json_encode(['categories' => $categories, 'mnp' => $mnp , 'mxp' => $mxp, 'mnz' => $mnz, 'mxz' => $mxz]);
    }

    public function get_sale_properties()
    {
        $propertyCategories = PropertyCategory::withCount('properties')->where(['lang_id' => 1, 'property_type_id' => 1])->get();
        $properties = Property::with('images', 'company', 'developer')->where(['lang_id' => 1, 'property_type_id' => 1, 'status' => 2])->get();
        $views = View::where(['lang_id' => 1, 'status' => 1])->get();
        $location_name = 'your location';
        return view('website.properties.index', compact('propertyCategories', 'properties', 'views', 'location_name'));

    }

    public function get_single_sale_properties($slug)
    {
        /**Getting Single Property Details */
        $property = Property::with(['company' => function($query){
            $query->withCount('properties');
        }])->with('category', 'type', 'images', 'developer', 'agent')->where(['slug' => $slug ,'lang_id' => 1])->first();

        /**Getting Similar Properties */
        $similar_properties = Property::with('images', 'company')->with('developer')->where(['status' => 1, 'property_category_id' => $property->property_category_id,'lang_id' => 1, 'property_type_id' => $property->property_type_id])->get();
        $amenities = $property->amenities ? explode(',' , $property->amenities) : [];
        $features = $property->features ? explode(',' , $property->features) : [];
        $payment_methods = PaymentMethod::where(['status' => 1, 'lang_id' => 1])->get();
        $maneities_array = [];
        if(count($amenities) > 0)
        {
            foreach($amenities as $item){
             $maneities_array[] = Amenity::where('id', $item)->pluck('name')->first();
            }
        }

        if(count($features) > 0)
        {
            foreach($features as $item){
             $maneities_array[] = Feature::where('id', $item)->pluck('name')->first();
            }
        }
       //  return $property;
        $message = "Hi, I found your property with ref: ".$property->prop_ref_no." on Aaronz Property. Please contact me. Thank you.";
        return view('website.properties.buy-property-detail', compact('property', 'maneities_array', 'message', 'payment_methods', 'similar_properties'));

    }
    //** MORTGAGE REQUEST START HERE */
    public function submit_mortgage_request(Request $request){
       $mortgage_lead= new Lead;
       $mortgage_lead->property_id=$request->property_id;
       $mortgage_lead->user_id=Auth::user()->id;
       $mortgage_lead->name=$request->ml_name;
       $mortgage_lead->phone=$request->ml_phone;
       $mortgage_lead->email=$request->ml_email;
       $mortgage_lead->description=$request->ml_description;
       $mortgage_lead->no_of_installment=$request->loan_duration * 12;
       $mortgage_lead->dowm_payment=$request->down_payment;
       $mortgage_lead->monthly_installment=$request->installment;
       $mortgage_lead->intrust_rate=$request->intrust_rate;
       $mortgage_lead->type= 3;
       $mortgage_lead->save();
        return 'true';

    }
    //** MORTGAGE REQUEST END HERE */
    public function get_single_rent_properties($slug)
    {
        /**Getting Single Property Details */
        $property = Property::with(['company' => function($query){
            $query->withCount('properties');
        }])->with('agent', 'category', 'type', 'images', 'developer')->where(['slug' => $slug ,'lang_id' => 1])->first();

        /**Getting Similar Properties */
        $similar_properties = Property::with('images', 'company')->with('developer')->where(['status' => 1, 'property_category_id' => $property->property_category_id,'lang_id' => 1, 'property_type_id' => $property->property_type_id])->get();
        $amenities = $property->amenities ? explode(',' , $property->amenities) : [];
        $features = $property->features ? explode(',' , $property->features) : [];
        $maneities_array = [];
        if(count($amenities) > 0)
        {
            foreach($amenities as $item){
             $maneities_array[] = Amenity::where('id', $item)->pluck('name')->first();
            }
        }

        if(count($features) > 0)
        {
            foreach($features as $item){
             $maneities_array[] = Feature::where('id', $item)->pluck('name')->first();
            }
        }
        $message = "Hi, I found your property with ref: ".$property->prop_ref_no." on Aaronz Property. Please contact me. Thank you.";
        return view('website.properties.rent-property-detail', compact('property', 'maneities_array', 'message', 'similar_properties'));

    }

    public function get_rent_properties()
    {
        $propertyCategories = PropertyCategory::withCount('properties')->where(['lang_id' => 1, 'property_type_id' => 3])->get();
        $properties = Property::with('images', 'company')->with('developer')->where(['lang_id' => 1, 'property_type_id' => 3 ,'status' => 2])->get();
        $views = View::where(['lang_id' => 1, 'status' => 1])->get();
        $location_name = 'your location';
        return view('website.properties.rent', compact('propertyCategories', 'properties', 'views', 'location_name'));

    }


    public function properties_by_city(Request $requst, $city)
    {
        $propertyCategories = PropertyCategory::withCount('properties')->where(['lang_id' => 1, 'property_type_id' => 1])->get();
         $location_state = LocationState::where(['lang_id' => 1, 'slug' => $city])->first();
         $areas = LocationArea::withCount('properties')->where(['location_state_id' => $location_state->id, 'lang_id' => 1])->get();
         $properties = Property::with('images', 'company')->with('developer')->where(['lang_id' => 1, 'location_state_id' => $location_state->id, 'status' => 1])->get();
         $views = View::where(['lang_id' => 1, 'status' => 1])->get();
         return view('website.properties.propertyByState', compact('propertyCategories', 'properties', 'areas', 'city', 'location_state', 'views'));
    }

     //TODO: Get Properties By Property Area
     public function properties_by_city_area(Request $request, $city, $area)
     {
         $propertyCategories = PropertyCategory::withCount('properties')->where(['lang_id' => 1, 'property_type_id' => 1])->get();
         $location_state = LocationState::where(['lang_id' => 1, 'slug' => $city])->first();
         $location_area = LocationArea::where(['lang_id' => 1, 'slug' => $area])->first();
         $locations = Location::withCount('properties')->where(['location_area_id' => $location_area->id, 'lang_id' => 1])->get();
        //  return $areas;
         $properties = Property::with('images', 'company')->with('developer')->where(['lang_id' => 1, 'location_area_id' => $location_area->id, 'status' => 1])->get();
         // return $areas;
        $views = View::where(['lang_id' => 1, 'status' => 1])->get();
         return view('website.properties.propertyByAreas', compact('propertyCategories', 'properties', 'locations', 'city', 'location_area', 'location_state', 'views'));
    }

    public function properties_by_city_area_location(Request $request, $city, $area, $location){
        $propertyCategories = PropertyCategory::withCount('properties')->where(['lang_id' => 1, 'property_type_id' => 1])->get();
        $location_state = LocationState::where(['lang_id' => 1, 'slug' => $city])->first();
        $location_area = LocationArea::where(['lang_id' => 1, 'slug' => $area])->first();
        $location = Location::where(['lang_id' => 1, 'slug' => $location])->first();
        $buildings = LocationBuilding::withCount('properties')->where(['location_id' => $location->id, 'lang_id' => 1])->get();
        $properties = Property::with('images', 'company')->with('developer')->where(['lang_id' => 1, 'location_id' => $location->id, 'status' => 1])->get();
        // return $areas;
        $views = View::where(['lang_id' => 1, 'status' => 1])->get();
        return view('website.properties.propertyByLocations', compact('propertyCategories', 'properties', 'buildings', 'city', 'location_area', 'location_state', 'location', 'views'));
    }

    public function properties_by_city_area_location_building(Request $request, $city, $area, $location, $building){
        $propertyCategories = PropertyCategory::withCount('properties')->where(['lang_id' => 1, 'property_type_id' => 1])->get();
        $location_state = LocationState::where(['lang_id' => 1, 'slug' => $city])->first();
        $location_area = LocationArea::where(['lang_id' => 1, 'slug' => $area])->first();
        $location = Location::where(['lang_id' => 1, 'slug' => $location])->first();
        $location_building = LocationBuilding::where(['lang_id' => 1, 'slug' => $building])->first();
        $buildings = LocationBuilding::withCount('properties')->where(['location_id' => $location->id, 'lang_id' => 1])->get();
        $properties = Property::with('images', 'company')->with('developer')->where(['lang_id' => 1, 'location_building_id' => $location_building->id, 'status' => 1])->get();
        // return $areas;
        $views = View::where(['lang_id' => 1, 'status' => 1])->get();
        return view('website.properties.propertyByBuildings', compact('propertyCategories', 'properties', 'buildings', 'city', 'location_area', 'location_state', 'location', 'views'));
    }


    /**Adding Property To Favourite Properties */
    public function add_property_to_favourite(Request $request)
    {
        $checkProperty = FavProperty::where(['property_id' => $request->property_id, 'user_id' => auth()->user()->id ])->first();

        if(!is_null($checkProperty)){
            FavProperty::find($checkProperty->id)->delete();
        }

        /**Adding Propety To Favoutie Table */
        $fav = new FavProperty;
        $fav->property_id = $request->property_id;
        $fav->user_id = auth()->user()->id;
        $fav->save();

        return 'true';

    }

    /**Submitting Property Review */
    public function submit_property_review(Request $request){
        Review::create([
            'property_id' => $request->property_id,
            'user_id' => auth()->user()->id,
            'rate' => $request->rate,
            'review' => $request->review,
        ]);

        return 'true';
    }

    /**Getting Property Reviews */
    public function get_property_review(Request $request){
        $reviews = Review::with('user')->orderBy('id', 'DESC')->where('property_id', $request->property_id)->get();
        $html = '';

        if($reviews->count())
        {
            foreach($reviews as $item){
                $html .= '
                <div class="col-md-6" style="padding: 20px">
                <button style="border: none;"><i class="fa fa-quote-left testimonial_fa" aria-hidden="true"></i></button>
                <div class="row">
                        <div class="col-sm-2">
                            <img loading="lazy" src="'.asset('storage/'.$item->user->avatar).'" class="img-responsive" style="width: 80px">
                        </div>
                        <div class="col-sm-10">
                            <h4><strong>'.$item->user->name.'</strong></h4>
                            <span>
                            <div class="sspd_review dif">
                                <ul class="ml10">
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="list-inline-item"></li>
                                </ul>
                            </div>
                        </span>
                            <p class="testimonial_subtitle"><span>'.$item->review.'</span><br>

                          </p>
                        </div>
                </div>
            </div>
                ';
            }

        }

        return $html;

    }
}
