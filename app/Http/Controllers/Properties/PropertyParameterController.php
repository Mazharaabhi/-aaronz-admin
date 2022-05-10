<?php

namespace App\Http\Controllers\Properties;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properties\Amenity;
use App\Models\Properties\Feature;
use App\Models\Admin\Settings\Language;
use App\Models\Admin\Settings\Price;
use App\Models\Locations\LocationCountry;
use App\Models\Admin\Settings\Size;
use App\Models\Locations\Location;
use App\Models\Locations\LocationState;
use App\Models\Properties\View;
use App\Models\Properties\Property;
use App\Models\Properties\Developer;
use App\Models\Properties\Gallary;
use App\Models\Properties\PropertyCategory;
use App\Models\Properties\PropertyImage;
use App\Models\Properties\PropertyType;
use App\Models\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PropertyParameterController extends Controller
{

    //Getting Languages
    public function getLanguages()
    {
        return Language::where('status', 1)->pluck('id')->toArray();
    }

    //Getting Property Categries
    public function get_property_categories(Request $request)
    {
        $categories = PropertyCategory::with(['sub_categories' => function($query){
            $query->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'level' => 1, 'status' => 1, 'property_type_id' => $request->property_type_id])->get();

        $options = '<option value="">---property category---</option>';

        if ($categories->count()){
            foreach ($categories as $item){
                $options .= '<option value="'.$item->id.'" '.($item->sub_categories->count() ? "disabled" : "" ).'>'.$item->name.'</option>';
                if ($item->sub_categories->count()){
                    foreach ($item->sub_categories as $sub_item){
                        $options .= '<option value="'.$sub_item->id.'">-- '.$sub_item->name.'</option>';
                    }
                }
            }

        }

        return $options;

    }

    //Creating Property Category
    public function create_property_categories(Request $request)
    {
        //checking for unique rank name
        if ($request->prop_level == 1) {
            $CheckCategoryName = PropertyCategory::where(['name' => $request->title_english, 'property_type_id' => $request->property_type_id])->first();
        }if ($request->prop_level == 2) {
            $CheckCategoryName = PropertyCategory::where(['name' => $request->title_english, 'property_type_id' => $request->property_type_id, 'property_category_id' => $request->property_category_id])->first();
        }

        if(!is_null($CheckCategoryName)){
            return 'title';
        }

        //creating new PropertyCategory here
        $category = new PropertyCategory;
        $category->name = $request->name;
        $category->property_type_id = $request->property_type_id;
        $category->slug = $request->slug;
        $category->lang_id = 1;
        $category->parent_id = 0;
        if($request->prop_level == 1){
            $category->property_category_id = 0;
            $category->level = 1;
            $category->has_bed = $request->has_bed;
            $category->has_bath = $request->has_bath;
        }
        elseif($request->prop_level == 2){
            //Getting Beds and Bath From PropertyCategory
            $parent_category = PropertyCategory::where(['id' => $request->property_category_id, 'lang_id' => 1])->first();
            $category->property_category_id = $request->property_category_id;
            $category->level = 2;
            $category->has_bed = $parent_category->has_bed;
            $category->has_bath = $parent_category->has_bath;
        }
        $category->save();
        $parent_id =$category->id;
        //UPDATING PARENT ID
        PropertyCategory::where('id',$parent_id)->update(['parent_id'=>$parent_id]);

        //Getting Languages Id To Store other Multi Language Categories
        $languages = $this->getLanguages();
        for($i = 1; $i < count($languages); $i++)
        {
            //creating new PropertyCategory here
            $Multi_level_category = new PropertyCategory;
            $Multi_level_category->name = $request->name;
            $Multi_level_category->property_type_id = $request->property_type_id;
            $Multi_level_category->slug = $request->slug;
            $Multi_level_category->lang_id = $languages[$i];
            $Multi_level_category->parent_id = $parent_id;
            if($request->prop_level == 1){
                $Multi_level_category->property_category_id = 0;
                $Multi_level_category->level = 1;
                $Multi_level_category->has_bed = $request->has_bed;
                $Multi_level_category->has_bath = $request->has_bath;
            }
            elseif($request->prop_level == 2){
                //Getting Beds and Bath From PropertyCategory
                $parent_category = PropertyCategory::where(['id' => $request->property_category_id, 'lang_id' => 1])->first();
                $Multi_level_category->property_category_id = $request->property_category_id;
                $Multi_level_category->level = 2;
                $Multi_level_category->has_bed = $parent_category->has_bed;
                $Multi_level_category->has_bath = $parent_category->has_bath;
            }
            $Multi_level_category->save();
        }

        return 'true';
    }

    //Getting Property Parent Categries
    public function get_property_parent_categories(Request $request)
    {
        $categories = PropertyCategory::with(['sub_categories' => function($query){
            $query->where(['lang_id' => 1, 'status' => 1]);
        }])->orderBy('id', 'DESC')->where(['lang_id' => 1, 'level' => 1, 'status' => 1, 'property_type_id' => $request->property_type_id])->get();

        $options = '<option value="">---property category---</option>';

        if ($categories->count()){
            foreach ($categories as $item){
                $options .= '<option value="'.$item->id.'">'.$item->name.'</option>';
            }

        }

        return $options;

    }

    //Getting Property Status
    public function get_property_status(Request $request)
    {
        $property_status = PropertyType::orderBy('id', 'asc')->where(['lang_id' => 1, 'type_id' => $request->property_type_id, 'status' => 1])->get();

        $options = '<option value="">---property status---</option>';

        if ($property_status->count()){
            foreach ($property_status as $item){
                $options .= '<option value="'.$item->id.'">'.$item->name.'</option>';
            }

        }

        return $options;

    }

    public function create_property_status(Request $request){
        //checking for unique rank name
        $CheckCategoryName = PropertyType::where(['name' => $request->name,  'type_id' => $request->type_id])->first();

        if(!is_null($CheckCategoryName)){
            return 'title';
        }
        //creating new PropertyCategory here
        $category = new PropertyType;
        $category->name = $request->name;
        $category->type_id = $request->type_id;
        $category->lang_id = 1;
        $category->parent_id = 0;
        $category->save();
        $parent_id =$category->id;
        //UPDATING PARENT ID
        PropertyType::where('id',$parent_id)->update(['parent_id'=>$parent_id]);
        //Getting Languages Id To Store other Multi Language Categories
        $languages = $this->getLanguages();
        //CREATEING OTHER views RECORDS
        for($i=1; $i <count($languages) ; $i++ )
        {
            $cat = new PropertyType;
            $cat->name = $request->name;
            $cat->lang_id=$languages[$i];
            $cat->type_id = $request->type_id;
            $cat->parent_id=$parent_id;
            $cat->save();
        }
        return 'true';
    }

     //Getting Property Views
     public function get_property_views(Request $request)
     {
         $views = View::where(['lang_id' => 1, 'status' => 1])->orderBy('id', 'DESC')->get();

         $options = '<option value="">---property view---</option>';

         if ($views->count()){
             foreach ($views as $item){
                 $options .= '<option value="'.$item->id.'">'.$item->title.'</option>';
             }

         }

         return $options;
     }

      //creating new View here
    public function create_property_views(Request $request){
        //checking for unique rank name
        $CheckViewName = View::where('title', $request->name)->first();

        if(!is_null($CheckViewName)){
            return 'title';
        }
        //creating new View here
        $view = new View;
        $view->title = $request->name;
        $view->lang_id = 1;
        $view->parent_id = 0;
        $view->save();
        $parent_id =$view->id;
        //UPDATING PARENT ID
        View::where('id',$parent_id)->update(['parent_id'=>$parent_id]);
        //Getting Languages Id To Store other Multi Language Categories
        $languages = $this->getLanguages();
        //CREATEING OTHER views RECORDS
        for($i=1; $i <count($languages) ; $i++ )
        {
            $ame = new View;
            $ame->title = $request->name;
            $ame->lang_id=$languages[$i];
            $ame->parent_id=$parent_id;
            $ame->save();
        }
        return 'true';
    }

     //Getting Property Developers
     public function get_property_developers(Request $request)
     {
         $developers = Developer::where(['status' => 1, 'lang_id' => 1])->orderBy('id', 'DESC')->get();

         $options = '<option value="">---property developers---</option>';

         if ($developers->count()){
             foreach ($developers as $item){
                 $options .= '<option value="'.$item->id.'">'.$item->name.'</option>';
             }

         }
         return $options;
     }

     public function create_property_developers(Request $request){
        //checking for unique rank name
        $CheckDeveloperName = Developer::where('name', $request->name)->first();

        if(!is_null($CheckDeveloperName)){
            return 'title';
        }
        //creating new rank instance here
        $developer = new Developer;
        $developer->name = $request->name;
        if($request->hasFile('image'))
        {
           $developer->image = $request->file('image')->store('DeveloperImages', 'public');
        }
        $developer->lang_id = 1;
        $developer->parent_id = 0;
        $developer->save();
        $parent_id =$developer->id;
        //UPDATING PARENT ID
        Developer::where('id',$parent_id)->update(['parent_id'=>$parent_id]);
        //Getting Languages Id To Store other Multi Language Categories
        $languages = $this->getLanguages();
        //CREATEING OTHER LANGUAGES RECORDS
        for($i=1; $i <count($languages) ; $i++ )
        {
            $dev = new Developer;
            $dev->name = $request->name;
            if($request->hasFile('image'))
               {
                   $dev->image = $developer->image;
               }
            $dev->lang_id=$languages[$i];
            $dev->parent_id=$parent_id;
            $dev->save();
        }
        return 'true';
    }

     //Getting Property Agents
     public function get_property_agents(Request $request)
     {
         $agents = User::where(['role_id' => 3, 'is_active' => 1, 'company_id' => Auth::user()->id])->orderBy('id', 'DESC')->get();

         $options = '<option value="">---property agents---</option>';

         if ($agents->count()){
             foreach ($agents as $item){
                 $options .= '<option value="'.$item->id.'">'.$item->name.'</option>';
             }

         }
         return $options;
     }

      //TODO: Create Company Process
    public function create_property_agents(Request $request)
    {
        //TODO: Checking if the user email or phone is already exist or not
        $checkEmail = User::where(['email' => $request->email, 'role_id' => 3])->first();
        if(!is_null($checkEmail)) return 'email';

        //TODO: Checking if the user email or phone is already exist or not
        $checkphone = User::where(['phone' => $request->phone])->first();
        if(!is_null($checkphone)) return 'phone';

        //TODO: Creating New Company Here
        $companyData = $request->except('_token');
        $companyData['company_id'] = Auth::user()->id;
        $companyData['create_by'] = Auth::user()->id;
        $companyData['role_id'] = 3;
        $company = User::create($companyData);

        return 'true';
    }

    //TODO: Getting Property States Here
    public function get_property_states()
    {
        $states = LocationState::where(['lang_id' => 1, 'status' => 1])->orderBy('id', 'DESC')->get();

        $options = '<option value="">---property state/cities---</option>';

         if ($states->count()){
             foreach ($states as $item){
                 $options .= '<option value="'.$item->id.'">'.$item->name.'</option>';
             }

         }
         return $options;

    } 

     //creating new LocationState here
     public function create_property_states(Request $request){
        //checking for unique rank name
        $CheckStateName = LocationState::where(['name' => $request->name, 'location_country_id' => 1])->first();

        if(!is_null($CheckStateName)){
            return 'title';
        }
        //creating new rank instance here
        $state = new LocationState;
        $state->name = $request->name;
        $state->location_country_id = 1;
        $state->lang_id = 1;
        $state->parent_id = 0;
        $state->save();
        $parent_id =$state->id;
        //UPDATING PARENT ID
        LocationState::where('id',$parent_id)->update(['parent_id'=>$parent_id]);
        //Getting Languages Id To Store other Multi Language Categories
        $languages = $this->getLanguages();
        //CREATEING OTHER LANGUAGES RECORDS
        for($i=1; $i <count($languages) ; $i++ )
        {
            $stat = new LocationState;
            $stat->name = $request->name;
            $stat->lang_id=$languages[$i];
            $stat->location_country_id = 1;
            $stat->parent_id=$parent_id;
            $stat->save();
        }
        return 'true';
    }

    //TODO: Function for getting area
    public function get_property_areas(Request $request)
    {
        $locations = Location::where(['lang_id' => 1, 'status' => 1, 'location_state_id' => $request->state_id, 'location_id' => 0])->get();
        $option = '<option value="">---select area---</option>';
        if(count($locations) > 0)
        {
            foreach($locations as $item)
            {
                $option .= '<option value="'.$item->id.'">'.$item->name.'</option>';
            }
        }

        return $option;
    }

      //creating new Location here
      public function create_property_areas(Request $request){
        //checking for unique rank name
        $CheckLocationName = Location::where(['name' => $request->name, 'location_country_id' => 1, 'location_state_id' => $request->state_id])->first();

        if(!is_null($CheckLocationName)){
            return 'title';
        }
        //creating new rank instance here
        $location = new Location;
        $location->name = $request->name;
        $location->location_country_id = 1;
        $location->location_state_id = $request->state_id;
        $location->lat = '545456';
        $location->lng = '455465';
        $location->lang_id = 1;
        $location->parent_id = 0;
        $location->save();
        $parent_id =$location->id;
        //UPDATING PARENT ID
        Location::where('id',$parent_id)->update(['parent_id'=>$parent_id]);
        //Getting Languages Id To Store other Multi Language Categories
        $languages = $this->getLanguages();
        //CREATEING OTHER LANGUAGES RECORDS
        for($i=1; $i <count($languages) ; $i++ )
        {
            $locat = new Location;
            $locat->name = $request->name;
            $locat->lang_id=$languages[$i];
            $locat->location_country_id = 1;
            $locat->location_state_id = $request->state_id;
            $locat->lat = '545456';
            $locat->lng = '455465';
            $locat->parent_id=$parent_id;
            $locat->save();
        }
        return 'true';
    }

    //TODO: Function for getting locations
    public function get_property_locations(Request $request)
    {
        $locations = Location::where(['lang_id' => 1, 'status' => 1, 'location_id' => $request->area_id])->get();
        $option = '<option value="">---select locations---</option>';
        if(count($locations) > 0)
        {
            foreach($locations as $item)
            {
                $option .= '<option value="'.$item->id.'">'.$item->name.'</option>';
            }
        }

        return $option;
    }

     //creating new Location here
     public function create_property_locations(Request $request){
        //checking for unique rank name
        $CheckLocationName = Location::where(['name' => $request->name, 'location_country_id' => $request->location_country_id, 'location_state_id' => $request->location_state_id, 'location_id' => $request->location_id])->first();

        if(!is_null($CheckLocationName)){
            return 'title';
        }
        //creating new rank instance here
        $location = new Location;
        $location->name = $request->name;
        $location->location_id = $request->location_id;
        $location->location_country_id = $request->location_country_id;
        $location->location_state_id = $request->location_state_id;
        $location->lat = '132';
        $location->lng = '123';
        $location->lang_id = 1;
        $location->parent_id = 0;
        $location->save();
        $parent_id =$location->id;
        //UPDATING PARENT ID
        Location::where('id',$parent_id)->update(['parent_id'=>$parent_id]);
        //Getting Languages Id To Store other Multi Language Categories
        $languages = $this->getLanguages();
        //CREATEING OTHER LANGUAGES RECORDS
        for($i=1; $i <count($languages) ; $i++ )
        {
            $locat = new Location;
            $locat->name = $request->name;
            $locat->lang_id=$languages[$i];
            $locat->location_id = $request->location_id;
            $locat->location_country_id = $request->location_country_id;
            $locat->location_state_id = $request->location_state_id;
            $locat->lat = '123';
            $locat->lng = '123';
            $locat->parent_id=$parent_id;
            $locat->save();
        }
        return 'true';
    }


}
