<?php

namespace App\Models\Properties;

use App\Models\Admin\Settings\DocumentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Locations\LocationState;
use App\Models\Locations\LocationArea;
use App\Models\Locations\LocationCountry;
use App\Models\Locations\Location;
use App\Models\Properties\Developer;
use App\Models\Properties\PropertyType;
use App\Models\Properties\PropertyCategory;
use App\Models\Properties\PropertyImage;
use App\Models\Properties\FavProperty;
use App\Models\Document;
use App\Models\Locations\LocationBuilding;
use Carbon\Carbon;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [
              'images', 'languages_names', 'is_from_map', 'address_id',
              'title_english', 'titles', 'build_up_area', 'availablity', 'description',
              'broucher', 'off_plan_heading','off_plan_desc','off_plan_overview','off_plan_title_one',
              'off_plan_title_two','off_plan_omniyat_desc','one_bed_floor_plan','two_bed_floor_plan','three_bed_floor_plan','four_bed_floor_plan',
              'studio_floor_plan','off_plan_down_payment','off_plan_during_consurtion','off_plan_post_handover'
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class, 'developer_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(LocationState::class, 'location_state_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo(LocationArea::class, 'location_area_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(PropertyCategory::class, 'property_category_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'property_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'property_id');
    }

    public function favourite_property()
    {
        return $this->hasMany(PropertyImage::class, 'property_id');
    }

    //**FOR ADVANCE SERCH*/
    // public function scopeFilter($query, $params){

    //     if($params['purpose'] != null){
    //         $query->where('property_type_id',$params['purpose']);
    //     }
    //     if($params['ref_id'] != null){
    //         $query->where('prop_ref_no',$params['ref_id']);
    //     }
    //     $loc = $params['loc'];
    //     if(is_array($loc) &&  !empty($loc[0])){
    //        $query->where(function ($sub) use ($loc){
    //         if($loc != ''){
    //             foreach($loc as  $l){
    //                     $locationsArray = explode(',' , $l);
    //                     $address_level = $locationsArray[0];
    //                     $address_id = $locationsArray[1];
    //                 $sub->orWhere(function ($q) use ( $address_level, $address_id){
    //                     if($address_level == 0){
    //                         $q->where('location_state_id', $address_id);
    //                     }
    //                     else if($address_level == 1)
    //                     {
    //                         $location_area = LocationArea::firstWhere('id', $address_id);
    //                         $q->where('location_state_id', $location_area->location_state_id);
    //                         $q->where('location_area_id', $address_id);
    //                     }
    //                     else if($address_level == 2)
    //                     {
    //                         $location_area = Location::firstWhere('id', $address_id);
    //                         $q->where('location_state_id', $location_area->location_state_id);
    //                         $q->where('location_area_id', $location_area->location_area_id);
    //                         $q->where('location_id', $address_id);
    //                     }
    //                     else if($address_level == 3)
    //                     {
    //                         $location_area = LocationBuilding::firstWhere('id', $address_id);
    //                         $q->where('location_state_id', $location_area->location_state_id);
    //                         $q->where('location_area_id', $location_area->location_area_id);
    //                         $q->where('location_id', $location_area->location_id);
    //                         $q->where('location_building_id', $address_id);
    //                     }
    //                 });
    //             }//loop end
    //         }// not empty
    //     });
    //   }
    //     //**IF BOTH PRICES ARE NOT EMPTY */
    //     if($params['price_min'] != '' && $params['price_max'] != ''){
    //         if($params['price_min'] != '' || $params['price_max'] != '' ){
    //             if($params['price_min'] != '' && $params['price_max'] == '' ){
    //                 $query->where('price', '>=', $params['price_min']);
    //             }else if($params['price_min'] == '' && $params['price_max'] != ''){
    //                 $query->where('price', '<=', $params['price_min']);
    //             }else if($params['price_min'] != '' && $params['price_max'] != '' ){
    //                 $query->whereBetween('price', [$params['price_min'],$params['price_max']]);
    //             }
    //         }
    //      }
    //     //**IF MIN PRICE IS EMPTY */
    //     if($params['price_min'] == '' && $params['price_max'] != ''){
    //             $query->whereBetween('price', [1,$params['price_max']]);
    //     }

    //     if($params['property_status'] != '' && $params['purpose'] == 1){
    //         $query->where('property_status_id', $params['property_status']);
    //     }
    //     if($params['property_category_type'] != ''){
    //         $query->where('property_category_id', $params['property_category_type']);
    //     }

    //     if($params['beds'] != ''){
    //         $query->where('bed_no', $params['beds']);
    //      }
    //     if($params['baths'] != ''){
    //         $query->where('bath_no', $params['baths']);
    //      }
    //     if($params['is_commercial'] != ''){
    //         $query->where('is_commercial', $params['is_commercial']);
    //      }
    //      if($params['assigned'] !=0){
    //         $query->where('agent_id', $params['assigned']);
    //      }
    //      if($params['ref_id'] !=''){
    //         $query->where('prop_ref_no', $params['ref_id']);
    //      }
    //      if($params['category_id'] !=''){
    //         $query->where('property_category_id', $params['category_id']);
    //      }
    //      if($params['hot'] !=''){
    //         $query->where('is_hot',1);
    //      }
    //      if($params['signature'] !=''){
    //         $query->where('is_signature',1);
    //      }
    //      if($params['featured'] !=''){
    //         $query->where('is_featured',1);
    //      }
    //      if($params['basic'] !=''){
    //         $query->where('is_basic',1);
    //      }
    //      if($params['verified'] !=''){
    //         $query->where('is_verified',1);
    //      }
    //      if($params['boostsale'] !=''){
    //         $query->where('is_boost',1);
    //      }
    //    return $query;

    // }

    public function scopeFilter($query, $params)
    {

        if ($params['purpose'] != '0' && $params['purpose'] != 11 && $params['purpose'] != 13) {
            $query->where('property_type_id', $params['purpose']);
        }
        if ($params['purpose'] == 13) {
            $query->where('property_status_id', 13);
        }
        if ($params['purpose'] == 11) {
            $query->where('property_status_id', 11);
        }
        $loc = $params['loc'];
        // $locationsLevel = explode(',' , $loc[0]);
        // $level = $locationsLevel[0];
        // if($level == 0){
        //     $query->where('location_state_id', '!=' ,0);
        // }else if($level == 1){
        //     $query->where('location_state_id', '!=' ,0);
        //     $query->where('location_area_id', '!=' ,0);
        // }else if($level == 2){
        //     $query->where('location_state_id', '!=' ,0);
        //     $query->where('location_area_id', '!=' ,0);
        //     $query->where('location_id', '!=' ,0);
        // }else if($level == 3){
        //     $query->where('location_state_id', '!=' ,0);
        //     $query->where('location_area_id', '!=' ,0);
        //     $query->where('location_id', '!=' ,0);
        //     $query->where('location_building_id', '!=' ,0);
        // }
        if ($loc != '') {
            $query->where(function ($sub) use ($loc) {
                foreach ($loc as $l) {
                    $locationsArray = explode(',', $l);
                    $address_level = $locationsArray[0];
                    $address_id = $locationsArray[1];
                    $sub->orWhere(function ($q) use ($address_level, $address_id) {
                        if ($address_level == 0) {
                            $q->where('location_state_id', $address_id);
                        } else if ($address_level == 1) {
                            $location_area = LocationArea::firstWhere('id', $address_id);
                            $q->where('location_state_id', $location_area->location_state_id);
                            $q->where('location_area_id', $address_id);
                        } else if ($address_level == 2) {
                            $location_area = Location::firstWhere('id', $address_id);
                            $q->where('location_state_id', $location_area->location_state_id);
                            $q->where('location_area_id', $location_area->location_area_id);
                            $q->where('location_id', $address_id);
                        } else if ($address_level == 3) {
                            $location_area = LocationBuilding::firstWhere('id', $address_id);
                            $q->where('location_state_id', $location_area->location_state_id);
                            $q->where('location_area_id', $location_area->location_area_id);
                            $q->where('location_id', $location_area->location_id);
                            $q->where('location_building_id', $address_id);
                        }
                    });
                }//loop end
            });
        }// not empty

        if ($params['price_min'] != '' || $params['price_max'] != '') {
            if ($params['price_min'] != '' && $params['price_max'] == '') {
                $query->where('price', '>=', $params['price_min']);
            } else if ($params['price_min'] == '' && $params['price_max'] != '') {
                $query->where('price', '<=', $params['price_min']);
            } else if ($params['price_min'] != '' && $params['price_max'] != '') {
                $query->whereBetween('price', [$params['price_min'], $params['price_max']]);
            }
        }
        if ($params['property_status'] != 0 && $params['property_status'] != '' && $params['purpose'] == 1) {
            $query->where('property_status_id', $params['property_status']);
        }
        if ($params['property_category_type'] != '') {
            $query->where('property_category_id', $params['property_category_type']);
        }

        if ($params['is_360Tour'] != '' && $params['is_360Tour'] != 0) {
            $query->where('three_d', '!=', '');
        }
        if ($params['is_featured'] != '') {
            $query->where('is_featured', $params['is_featured']);
        }
        if ($params['is_furnished'] != '' && $params['is_furnished'] != 0) {
            $query->where('furnished_type', $params['is_furnished']);
        }
        if ($params['beds'] != '' && $params['beds'] <= 5) {
            $query->where('bed_no', $params['beds']);
        }
        //  if($params['beds'] == 'all'){
        // $query->where('bed_no', '>' , 0);
        //     $query->where('bed_no', 'ST');
        //  }
        if ($params['beds'] != '' && $params['beds'] == 'ST') {
            $query->where('bed_no', $params['beds']);
        }
        if ($params['beds'] != '' && $params['beds'] == 'ABOVE') {
            $query->where('bed_no', '>', 5);
        }
        if ($params['baths'] != '') {
            $query->where('bath_no', $params['baths']);
        }
        if ($params['is_commercial'] != '') {
            $query->where('is_commercial', $params['is_commercial']);
        }
        if ($params['assigned'] != 0) {
            $query->where('agent_id', $params['assigned']);
        }
        if ($params['life_style_area'] != 0) {
            $query->where('location_area_id', $params['life_style_area']);
        }
        if ($params['developer_id'] != '') {
            $query->where('developer_id', $params['developer_id']);
        }
        if ($params['signature'] != '') {
            $query->where('is_signature', 1);
        }
        if ($params['featured'] != '') {
            $query->where('is_featured', 1);
        }
        if ($params['basic'] != '') {
            $query->where('is_basic', 1);
        }
        if ($params['verified'] != '') {
            $query->where('is_verified', 1);
        }
        if ($params['boostsale'] != '') {
            $query->where('is_boost', 1);
        }
        if ($params['ref_id'] != '') {
            $query->where('prop_ref_no', $params['ref_id']);
        }
        //**CHECKING LOW PRICE,MAX PRICE And FEATURED Properties START HERE */
        if (isset($params['price_filter']) && $params['price_filter'] == 3) {
            $query->orderBy('price', 'ASC');
        }
        if (isset($params['price_filter']) && $params['price_filter'] == 5) {
            $query->orderBy('price', 'DESC');
        }
        if (isset($params['price_filter']) && $params['price_filter'] == 1) {
            $query->where('is_featured', $params['price_filter']);
        }
        if (isset($params['price_filter']) && $params['price_filter'] == 0) {
            $query->where('is_featured', $params['price_filter']);
        }

        //**CHECKING LOW AND MAX PRICE START HERE */

        $query->where('lang_id', 1);
        $query->where('status', 2);
        return $query;

    }

    public function scopeOffplan($query, $params)
    {


        $loc = $params['loc'];
        if ($loc != '') {
            $query->where(function ($sub) use ($loc) {
                foreach ($loc as $l) {
                    $locationsArray = explode(',', $l);
                    $address_level = $locationsArray[0];
                    $address_id = $locationsArray[1];
                    $sub->orWhere(function ($q) use ($address_level, $address_id) {
                        if ($address_level == 0) {
                            $q->where('location_state_id', $address_id);
                        } else if ($address_level == 1) {
                            $location_area = LocationArea::firstWhere('id', $address_id);
                            $q->where('location_state_id', $location_area->location_state_id);
                            $q->where('location_area_id', $address_id);
                        } else if ($address_level == 2) {
                            $location_area = Location::firstWhere('id', $address_id);
                            $q->where('location_state_id', $location_area->location_state_id);
                            $q->where('location_area_id', $location_area->location_area_id);
                            $q->where('location_id', $address_id);
                        } else if ($address_level == 3) {
                            $location_area = LocationBuilding::firstWhere('id', $address_id);
                            $q->where('location_state_id', $location_area->location_state_id);
                            $q->where('location_area_id', $location_area->location_area_id);
                            $q->where('location_id', $location_area->location_id);
                            $q->where('location_building_id', $address_id);
                        }
                    });
                }//loop end
            });
        }// not empty

        if ($params['developer_id'] != '') {
            $query->where('developer_id', $params['developer_id']);
        }
        if ($params['project_name'] != '') {
            $query->where('project_name', $params['project_name']);
        }
        if ($params['release_time'] != '') {

            $query->where('off_plan_release_time', $params['release_time']);
        }

        if ($params['year_of_completion'] != '') {
            // Carbon::parse($params['year_of_completion'])->format('Y')
            $query->whereYear('off_plan_expire_date', '=', $params['year_of_completion']);
        }

        //**CHECKING LOW AND MAX PRICE START HERE */

        $query->where('lang_id', 1);
        $query->where('status', 2);
        $query->where('property_status_id', 13);
        return $query;

    }
}
