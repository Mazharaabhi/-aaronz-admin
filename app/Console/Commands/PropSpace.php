<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\Admin\Portal;
use App\Models\Properties\Amenity;
use App\Models\Properties\Feature;
use App\Models\Admin\Settings\Language;
use App\Models\Admin\Settings\Price;
use App\Models\Locations\LocationCountry;
use App\Models\Admin\Settings\Size;
use App\Models\Document;
use App\Models\Locations\Location;
use App\Models\Locations\LocationState;
use App\Models\Locations\LocationArea;
use App\Models\Locations\LocationBuilding;
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
use App\Models\WaterMarkImages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class PropSpace extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:propspace';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Will Synic All Properties from PropSpace';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // xml file path
        $path = "http://xml.propspace.com/feed/xml.php?cl=3410&pid=9922&acc=1154";

        // Read entire file into string
        $xmlfile = file_get_contents($path);

        // Convert xml string into an object
        $new = simplexml_load_string($xmlfile,NULL,LIBXML_NOCDATA);

        // Convert into json
        $con = json_encode($new);

        // Convert into associative array
        $newArr = json_decode($con, true);
        // $newArr['Listing'][0]['Web_Remarks'];
        //return ;
        //Saving Property Here
       for($i=0; $i<count($newArr['Listing']); $i++){
           //**CHECKING DUPLICATE PROPERTIES HERE */
         //  $check_property = Property::where('prop_ref_no',$newArr['Listing'][$i]['Property_Ref_No'])->first();
           $check_property = Property::where(['prop_ref_no' => $newArr['Listing'][$i]['Property_Ref_No'] , 'is_propspace' => 1])->first();
           if(!$check_property){
               //**TO FIND NUMBERS OF BEDS//
               $beds=0;
               if(is_array($newArr['Listing'][$i]['Bedrooms'])){
                   !empty($newArr['Listing'][$i]['Bedrooms'])  ? $beds = $newArr['Listing'][$i]['Bedrooms'][0] : $beds=0;
               }else {
                   $beds = $newArr['Listing'][$i]['Bedrooms'];
               }
               //**END HERE TO DIF No. OF BEDS */

               //**TO FIND NUMBERS OF latitude//
               $latitude='';
               if(is_array($newArr['Listing'][$i]['Latitude'])){
                   !empty($newArr['Listing'][$i]['Latitude'])  ? $latitude = $newArr['Listing'][$i]['Latitude'][0] : $latitude='';
               }else {
                   $latitude = $newArr['Listing'][$i]['Latitude'];
               }
               //**END HERE TO DIF No. OF latitude */

                //**TO FIND NUMBERS OF BEDS//
                $bath=0;
                if(is_array($newArr['Listing'][$i]['No_of_Bathroom'])){
                    !empty($newArr['Listing'][$i]['No_of_Bathroom'])  ? $bath = $newArr['Listing'][$i]['No_of_Bathroom'][0] : $bath=0;
                }else {
                    $bath = $newArr['Listing'][$i]['No_of_Bathroom'];
                }
                //**END HERE TO DIF No. OF BEDS */

               //**TO FIND PARKING START HERE */
               $parking=0;
               if(is_array($newArr['Listing'][$i]['Parking'])){
               !empty($newArr['Listing'][$i]['Parking'])  ? $parking = $newArr['Listing'][$i]['Parking'][0] : $parking=0;
               }else {
                $newArr['Listing'][$i]['Parking']  !='' ? $parking = $newArr['Listing'][$i]['Parking'] : '' ;
               }
               //**To FIND PARKING END HERE */

               $property = new Property;
               //**PROPERTY LOCATION */
               $pro_state =LocationState::where(['name' => $newArr['Listing'][$i]['Emirate'], 'lang_id' =>1 ])->first();
               $state_id =0;
               if($pro_state){
                   $property->location_state_id = $pro_state->id;
                   $state_id = $pro_state->id;
               }else {
                   $location_state = new LocationState;
                   $location_state->location_country_id = 1;
                   $location_state->name = $newArr['Listing'][$i]['Emirate'];
                   $location_state->slug = strtolower($newArr['Listing'][$i]['Emirate']);
                   $location_state->save();
                   $property->location_state_id = $location_state->id;
                   $state_id = $location_state->id;
               }
               //**PROPERTY AREA */
               $pro_area =LocationArea::where(['name' => $newArr['Listing'][1]['Community'], 'lang_id' =>1 ])->first();
               if($pro_area){
                   $property->location_area_id = $pro_area->id;
               }else {
                   $location_area = new LocationArea;
                   $location_area->location_country_id = 1;
                   $location_area->location_state_id = $state_id;
                   $location_area->name = $newArr['Listing'][$i]['Community'];
                   $location_area->slug = strtolower($newArr['Listing'][$i]['Community']);
                   $location_area->save();
                   $property->location_area_id = $location_area->id;
               }
               //**GET PROPERTY TYPE (SALE OR RENT) */
               $pro_type =PropertyType::where(['name' => $newArr['Listing'][$i]['Ad_Type'], 'lang_id' =>1 ])->first();
               $property_category=PropertyCategory::where('name','LIKE','%'. $newArr['Listing'][$i]['Unit_Type']. '%')->where('property_type_id',$pro_type->id)->first();
               if($property_category) {
                   //**SET CATEGORY ID AND CATEGORY TPYE ID IF CATEGORY EXISTS */
                   $property->property_category_id=$property_category->id ;
                   $property->property_type_id=$pro_type->id;
               } else {
                   //**CREATE NEW CATEGORY IF NOT EXISTS */
                   $PropertyCategory = new PropertyCategory;
                   $PropertyCategory->property_type_id = $pro_type->id;
                   $PropertyCategory->name = $newArr['Listing'][$i]['Unit_Type'];
                   $PropertyCategory->slug = strtolower($newArr['Listing'][$i]['Unit_Type']).'-for-'.strtolower($newArr['Listing'][$i]['Ad_Type']);
                   $PropertyCategory->property_category_id = 0;
                   $PropertyCategory->is_commercial = 0;
                   $PropertyCategory->level = 1;
                   $PropertyCategory->lang_id = 1;
                   $PropertyCategory->parent_id = 0;
                   $PropertyCategory->status = 0;
                   $PropertyCategory->save();
                   PropertyCategory::where('id',$PropertyCategory->id)->update(['parent_id'=>$PropertyCategory->id]);
                   $property->property_category_id = $PropertyCategory->id ;
                   $property->property_type_id = $pro_type->id;
               }
               //**CHECK AGENT IF EXIST*/
               $agent = User::where(['email' => $newArr['Listing'][$i]['Listing_Agent_Email'], 'role_id'=> 3])->first();
               if($agent) {
                   $property->agent_id = $agent->id;
               }else {
                   //**CREATING NEW AGENT */
                   $create_agent = new User;
                   $create_agent->name = $newArr['Listing'][$i]['Listing_Agent'];
                   $create_agent->email = $newArr['Listing'][$i]['Listing_Agent_Email'];
                   $create_agent->phone = $newArr['Listing'][$i]['Listing_Agent_Phone'];
                   $create_agent->avatar = $newArr['Listing'][$i]['Listing_Agent_Photo'] ? $newArr['Listing'][$i]['Listing_Agent_Photo'][0] : '';
                   $create_agent->password = 112233;
                   $create_agent->real_password = 112233;
                   //TODO: COMPNAY ID = 1 is Aaronz
                   $create_agent->company_id = 1;
                   $create_agent->role_id = 3;
                   $create_agent->save();
                   $property->agent_id = $create_agent->id;
               }
               //**CHECKING VIEW IF EXISTS */
               if($newArr['Listing'][$i]['Primary_View']){
                   $view=View::where('title','LIKE','%'. $newArr['Listing'][$i]['Primary_View']. '%')->where('lang_id',1)->first();
                   if($view) {
                       $property->views = $view->id;
                   }else {
                       $create_view = new View;
                       $create_view->title = $newArr['Listing'][$i]['Primary_View'][0];
                       $create_view->lang_id = 1;
                       $create_view->parent_id = 0;
                       $create_view->status = 1;
                       $create_view->save();
                       View::where('id',$create_view->id)->update(['parent_id' => $create_view->id]);
                       $property->views = $create_view->id;
                   }
               }
               //**CHECKING AMINITIES START HERE**//
               $p_amenities=[];
               if(!empty($newArr['Listing'][$i]['Facilities']['facility'])){
                   for($k=0; $k < count($newArr['Listing'][$i]['Facilities']['facility']); $k++){
                       //**CRAETING AMINIRY IF NOT EXISTS */
                       $amanity = Amenity::where('name','LIKE','%'. $newArr['Listing'][$i]['Facilities']['facility'][$k]. '%')->where('lang_id',1)->first();
                       if($amanity) {
                           array_push($p_amenities,$amanity->id);
                       }else {
                           $craete_amenity = new Amenity;
                           $craete_amenity->name = $newArr['Listing'][$i]['Facilities']['facility'][$k];
                           $craete_amenity->lang_id = 1;
                           $craete_amenity->parent_id = 0;
                           $craete_amenity->save();
                           Amenity::where('id',$craete_amenity->id)->update(['parent_id' => $craete_amenity->id]);
                           array_push($p_amenities,$craete_amenity->id);
                       }
                   }
                   $amenities = implode(', ', $p_amenities);
                   $property->amenities           = $amenities;
               }
               $property->company_id           = 1;
               $property->title                = $newArr['Listing'][$i]['Property_Title'];
               $property->garage_size          = $newArr['Listing'][$i]['Unit_Builtup_Area'];   // NEED TO CHANGE COLUMN NAME
               $property->bath_no              = $bath;
               $property->bed_no               = $beds;
               $property->price                = $newArr['Listing'][$i]['Price'];
               $property->description          = $newArr['Listing'][$i]['Web_Remarks'];
               $property->furnished_type       = $newArr['Listing'][$i]['Furnished'];
               $property->size_sqft            = $newArr['Listing'][$i]['Plot_Size'];
               $property->is_propspace            = 1;
               $property->prop_ref_no          = $newArr['Listing'][$i]['Property_Ref_No'];
               $property->permit_no             = $newArr['Listing'][$i]['permit_number'];
               $property->project_name          = $newArr['Listing'][$i]['Property_Name'];
               $property->price_on_application    = $newArr['Listing'][$i]['price_on_application'] == 'NO' ? 1 : 0;
               $property->parking_no              = $parking;
               // $property->rent_frequency                 = $newArr['Listing'][$i]['Frequency'];
               $property->lat                        = $latitude;
               $property->lng                        = $newArr['Listing'][$i]['Longitude'];
               $property->is_featured                = $newArr['Listing'][$i]['Featured'] == 0 ? 0 : 1;
               $property->status=2;
               $property->property_status_id = $newArr['Listing'][$i]['off_plan'] == 1 ? 13  : 19;
               $property->address_level=2;
               $property->lang_id=1;
               $property->save();

               $slug = 'details-'.$property->id.'.html';
               Property::where('id', $property->id)->update([
                   'slug' => $slug,
                   'parent_id' => $property->id,
                   'modify_by' => 1
               ]);
               //Uploading images here
               if(count($newArr['Listing'][$i]['Images']['image']) > 0){
                   for($m=0; $m < count($newArr['Listing'][$i]['Images']['image']); $m++){
                       $propertyImages = new PropertyImage;
                       $propertyImages->property_id = $property->id;
                       $propertyImages->image = $newArr['Listing'][$i]['Images']['image'][$m];
                       $propertyImages->type = 1;
                       $propertyImages->save();
                   }
               }
           }else {
               //**UPDATING TITLE AND DESC START HERE */
               $check_property->title=$newArr['Listing'][$i]['Property_Title'];
               $check_property->description=$newArr['Listing'][$i]['Web_Remarks'];
               $check_property->is_propspace  = 1;
               $check_property->update();
               //**UPDATING TITLE AND DESC END HERE */
           }
      }
      DB::table('sync_properies')->insert(
          [
              'message' =>'PropSpace Properties Imported Successfully!'
          ]);
          echo 'done';
  }
}
