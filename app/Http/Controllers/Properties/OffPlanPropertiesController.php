<?php

namespace App\Http\Controllers\Properties;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Settings\DocumentType;
use App\Models\Properties\Amenity;
use App\Models\Properties\Feature;
use App\Models\Admin\Settings\Language;
use App\Models\Admin\Settings\Price;
use App\Models\Locations\LocationCountry;
use App\Models\Admin\Settings\Size;
use App\Models\Document;
use App\Models\Admin\Portal;
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
use Illuminate\Support\Carbon;
use App\Models\WaterMarkImages;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Mpdf\Mpdf;
use Spatie\ArrayToXml\ArrayToXml;
use Intervention\Image\Facades\Image;
use function GuzzleHttp\Promise\all;;
class OffPlanPropertiesController extends Controller
{
    //Loading Property View Index Page
    public function index(Request $request)
    {

        $props = Property::where('address_id', 0)->get();
        foreach ($props as $pro) {
            if ($pro->address_level == 0) {
                Property::where('id', $pro->id)->update(['address_id' => $pro->location_state_id]);
            } elseif ($pro->address_level == 1) {
                Property::where('id', $pro->id)->update(['address_id' => $pro->location_area_id]);
            } elseif ($pro->address_level == 2) {
                Property::where('id', $pro->id)->update(['address_id' => $pro->location_id]);
            } elseif ($pro->address_level == 3) {
                Property::where('id', $pro->id)->update(['address_id' => $pro->location_building_id]);
            }
        }
        Property::where('agent_id', 0)->update(['agent_id' => 115]);

        Property::where(['address_level' => 2, 'location_id' => 0])->update(['location_id' => 1]);


        $location_country = LocationCountry::with(['location_states' => function ($query) {
            $query->with(['location_areas' => function ($query) {
                $query->where(['lang_id' => 1, 'status' => 1, 'location_state_id' => 1]);
            }])->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'is_default' => 1])->first();

        $property_category = PropertyCategory::all();
        $amenities         = Amenity::where(['lang_id' => 1, 'status' => 1])->get();
        $agentusers        = User::where('role_id', 3)->orderBy('id', 'DESC')->get();
        $property_types    = PropertyType::where(['lang_id' => 1, 'type_id' => 0, 'status' => 1])->get();
        $categories        = PropertyCategory::with(['sub_categories' => function ($query) {
            $query->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'level' => 1, 'status' => 1, 'property_type_id' => $property_types[0]->id])->get();

        //=========================================================//

        $properties = Property::with('state', 'type', 'category')->orderBy('id', 'DESC')->where(['lang_id' => 1, 'property_status_id' => 13])->get();
        //  return count($properties);
        if (request()->ajax()) {
            return Datatables::of($properties)
                ->addIndexColumn()
                ->addColumn('price', function ($properties) {
                    if ($properties->price == "") {
                        return number_format(0);
                    } else {
                        return number_format($properties->price);
                    }
                })
                ->addColumn('expire_date', function ($properties) {
                    return Carbon::parse($properties->expire_date)->format('d-M-Y');
                })
                ->addColumn('title', function ($properties) {
                    $html = '<a href="' . route('offplan.property.edit', ['id' => $properties->id]) . '">' . $properties->title . '</a>';
                    $html .= '<p style="margin:0px"> ';
                    if ($properties->price == "") {
                        $html .= number_format(0);
                    } else {
                        $html .= number_format($properties->price);
                    }
                    $html .= ' | ' . $properties->category->name . ' | ' . $properties->type->name . ' | ' . $properties->agent  ? $properties->agent->name : 'N/A';

                    return $html;
                })
                ->addColumn('status', function ($properties) {
                    $html = '
                  <input type="hidden" name="id" value="' . $properties->id . '"/>
                  <input type="hidden" name="status" value="' . $properties->status . '"/>
                  <select id="property_status" clas="form-control">
                  <option value="0" ' . ($properties->status == 0 ? "selected" : "") . '>Pending</option>
                  <option value="2" ' . ($properties->status == 2 ? "selected" : "") . '>Published</option>
                  <option value="3" ' . ($properties->status == 3 ? "selected" : "") . '>Rejected</option>
                  </select>';
                    return $html;
                })
                ->addColumn('sort_order', function ($properties) {
                    return '<input type="number" name="property_sort_order" data-id="' . $properties->id . '" id="property_sort_order" value="' . $properties->sort_order . '" class="form-control"/>';
                })
                ->addColumn('action', function ($properties) {
                    return '
                       <a href="' . route('offplan.property.edit', ['id' => $properties->id]) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
                      <input type="hidden" name="id" value="' . $properties->id . '">
                     <a id="delete_language" data-id="' . $properties->id . '" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
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
                ->rawColumns(['action', 'price', 'status', 'sort_order', 'is_signatured', 'is_verified', 'is_featured', 'is_boost', 'title'])
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }
        return view('properties.list-off-plan-properties.index')
            ->with('property_category', $property_category)
            ->with('agentusers', $agentusers)
            ->with('location_country', $location_country)
            ->with('categories', $categories)
            ->with('amenities', $amenities);
    }
    //=========================================================
    //CREATE XML FILE FOR DOBIZEL//
    //=========================================================

    public function quick_search(Request $request)
    {
        // return $request->all();
        $searches = [];
        $properties = Property::with('category', 'type', 'state')->filter($request)->get();

        $location_country = LocationCountry::with(['location_states' => function ($query) {
            $query->with(['location_areas' => function ($query) {
                $query->with(['locations' => function ($query) {
                    $query->with(['buildings' => function ($query) {
                        $query->where(['lang_id' => 1, 'status' => 1]);
                    }])->where(['lang_id' => 1, 'status' => 1]);
                }])->where(['lang_id' => 1, 'status' => 1]);
            }])->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'is_default' => 1])->first();
        $html = '
          <thead>
          <tr>
              <th width="5%">Id</th>
              <th>Title</th>
              <th>Expiry Date</th>
              <th>Cities</th>
              <th>Verify</th>
              <th>Feature</th>
              <th>Boost</th>
              <th>Status</th>
              <th class="text-center" width="10%">Action</th>
              </tr>
          </thead>';
        if ($properties->count()) {

            foreach ($properties as $property) {
                if ($property->status == "0") {
                    $status = 'Pending';
                } else if ($property->status == "2") {
                    $status = 'Published';
                } else if ($property->status == "3") {
                    $status = 'Rejected';
                }
                //CHECK IS FEATURED//
                if ($properties->is_featured == 1) {
                    $is_featured = '<input type="hidden" name="id" value="' . $properties->id . '"/>
                                      <input type="checkbox" id="is_featured" data-id="' . $properties->is_featured . '" style="cursor:pointer" checked="checked" name="is_featured"/>';
                } else {
                    $is_featured = '<input type="hidden" name="id" value="' . $properties->id . '"/>
                                      <input type="checkbox" id="is_featured" data-id="' . $properties->is_featured . '" style="cursor:pointer" name="is_featured"/>';
                }
                //CHECI IS VERIFIED//
                if ($properties->is_verified == 1) {
                    $is_verified =  '<input type="hidden" name="id" value="' . $properties->id . '"/>
                                       <input type="checkbox" id="is_verified" data-id="' . $properties->is_verified . '" style="cursor:pointer" checked="checked" name="is_verified"/>';
                } else {
                    $is_verified =  '<input type="hidden" name="id" value="' . $properties->id . '"/>
                                       <input type="checkbox" id="is_verified" data-id="' . $properties->is_verified . '" style="cursor:pointer" name="is_verified"/>';
                }
                //CHECK IS BOOST
                if ($properties->is_boost == 1) {
                    $is_boost = '<input type="hidden" name="id" value="' . $properties->id . '"/>
                                   <input type="checkbox" id="is_boost" data-id="' . $properties->is_boost . '" style="cursor:pointer" checked="checked" name="is_boost"/>';
                } else {
                    $is_boost = '<input type="hidden" name="id" value="' . $properties->id . '"/>
                                   <input type="checkbox" id="is_boost" data-id="' . $properties->is_boost . '" style="cursor:pointer" name="is_boost"/>';
                }
                $html .= '<tr>
                          <td>' . $property->id . '</td>
                          <td>' . $property->title . '|<br>' . $property->price . '|' . $property->category['name'] . '|' . $property->agent['name'] . '</td>
                          <td>' . $property->expire_date . '</td>
                          <td>' . $property->state['name'] . '</td>
                          <td>' . $is_featured . '</td>
                          <td>' . $is_verified . '</td>
                          <td>' . $is_boost . '</td>
                          <td>' . $status . '</td>
                          <td>
                          <a href="' . route('offplan.property.edit', ['id' => $property->id]) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
                         <input type="hidden" name="id" value="' . $property->id . '">
                        <a id="delete_language" data-id="' . $property->id . '" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
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
                          </td>

                      </tr>';
            }
        } else {
            return $html .= '<tr><td colspan="12" align="center">Record not found</td></tr>';
        }
        return $html;
    }

    //Loading Property View Index Page
    public function create(Request $request)
    {
        // $location_country = LocationCountry::with(['location_states' => function($query){
        //     $query->with(['location_areas' => function($query){
        //         $query->with(['locations' => function($query){
        //             $query->with(['buildings' => function($query){
        //                 $query->where(['lang_id' => 1, 'status' => 1]);
        //             }])->where(['lang_id' => 1, 'status' => 1]);
        //         }])->where(['lang_id' => 1, 'status' => 1 ]);
        //     }])->where(['lang_id' => 1, 'status' => 1]);
        // }])->where(['lang_id' => 1, 'is_default' => 1])->first();

        $location_country = LocationCountry::with(['location_states' => function ($query) {
            $query->with(['location_areas' => function ($query) {
                $query->where(['lang_id' => 1, 'status' => 1, 'location_state_id' => 1]);
            }])->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'is_default' => 1])->first();

        $languages = Language::where('status', 1)->get();

        $property_types = PropertyType::where(['lang_id' => 1, 'type_id' => 0, 'status' => 1])->get();
        $categories = PropertyCategory::with(['sub_categories' => function ($query) {
            $query->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'level' => 1, 'status' => 1, 'property_type_id' => $property_types[0]->id])->get();

        $portals = Portal::where('portal_type', 1)->get(['id', 'name']);

        $property_status = PropertyType::where(['lang_id' => 1, 'type_id' => $property_types[0]->id, 'status' => 1])->orderBy('id', 'DESC')->get();

        $cities = LocationState::where(['lang_id' => 1, 'status' => 1])->orderBy('id', 'DESC')->get();
        $sizes = Size::orderBy('size', 'ASC')->get();
        $views = View::where(['lang_id' => 1, 'status' => 1])->orderBy('id', 'DESC')->get();
        $gallaries = Gallary::where(['lang_id' => 1, 'status' => 1])->orderBy('id', 'DESC')->get();
        $developers = Developer::where(['status' => 1, 'lang_id' => 1])->orderBy('id', 'DESC')->get();
        $agents = User::where(['role_id' => 3, 'is_active' => 1])->orderBy('id', 'DESC')->get();
        $prices = Price::orderBy('amount', 'asc')->where(['type_id' => $property_types[0]->id])->get();
        $document_types = DocumentType::where(['status' => 1])->get();
        return view('properties.list-off-plan-properties.create', compact('languages', 'portals', 'location_country', 'document_types', 'prices', 'property_status', 'agents', 'developers', 'property_types', 'categories', 'cities', 'sizes', 'views', 'gallaries'));
    }

    //Creating Property
    public function create_process(Request $request)
    {
        //Getting Property Titles and Converting to array for stroing data in multi language format
        $titles = explode(",", $request->titles);
        //Saving Property Here
        $propertyDataArray = $request->all();
        $propertyDataArray['company_id'] = Auth::user()->id;
        $propertyDataArray['description'] = $request->descriptions[0];
        $propertyDataArray['title'] = $request->title_english;
        $propertyDataArray['lang_id'] = 1;
        $propertyDataArray['off_plan_expire_date'] = $request->expire_date;

        $propertyDataArray['create_by'] = Auth::user()->id;
        //location ID And Leavel Work
        $locationsArray = explode(',', $request->address_id);
        // return $request->address_id;
        $address_level = $locationsArray[0];
        $address_id = $locationsArray[1];
        if ($address_level == 0) {
            $propertyDataArray['location_state_id'] = $address_id;
        } else if ($address_level == 1) {
            $location_area = LocationArea::firstWhere('id', $address_id);
            $propertyDataArray['location_state_id'] = $location_area->location_state_id;
            $propertyDataArray['location_area_id'] = $address_id;
        } else if ($address_level == 2) {
            $location_area = Location::firstWhere('id', $address_id);
            $propertyDataArray['location_state_id'] = $location_area->location_state_id;
            $propertyDataArray['location_area_id'] = $location_area->location_area_id;
            $propertyDataArray['location_id'] = $address_id;
        } else if ($address_level == 3) {
            $location_area = LocationBuilding::firstWhere('id', $address_id);
            $propertyDataArray['location_state_id'] = $location_area->location_state_id;
            $propertyDataArray['location_area_id'] = $location_area->location_area_id;
            $propertyDataArray['location_id'] = $location_area->location_id;
            $propertyDataArray['location_building_id'] = $address_id;
        }
        $propertyDataArray['address_level'] = $address_level;
        $propertyDataArray['address_id'] = $address_id;
        $propertyDataArray['property_status_id'] = $request->property_status_id ? $request->property_status_id : 0;

        if (Auth::user()->role_id == 1) {
            $propertyDataArray['status'] = 2;
        }

        $popp = Property::create($propertyDataArray);


        //Updating Property Latest Inserted Record
        $last_inserted_record = Property::orderBy('id', 'DESC')->limit(1)->first();
        $property_type = $last_inserted_record->property_type_id == 1 ? 'S' : 'R';
        $slug = 'details-' . $last_inserted_record->id . '.html';

        $prop_ref_no = 'ARZ-' . $property_type . '-' . $last_inserted_record->id;
        //return $prop_ref_no;

        Property::where('id', $last_inserted_record->id)->update([
            'slug'        => $slug,
            'parent_id'   => $last_inserted_record->id,
            'prop_ref_no' => $prop_ref_no,
            'modify_by'   => Auth::user()->id
        ]);

        //Creating Records for Multi Languages
        if ($request->has('languages_names')) {
            $languages_id = explode(",", $request->languages_names);

            for ($i = 1; $i < count($languages_id); $i++) {

                $propertyDataArray = $request->all();
                $propertyDataArray['company_id'] = Auth::user()->id;
                $propertyDataArray['title'] = $titles[$i];
                $propertyDataArray['description'] = $request->descriptions[$i];
                $propertyDataArray['lang_id'] = $languages_id[$i];
                $propertyDataArray['off_plan_expire_date'] = $request->expire_date;
                $propertyDataArray['off_plan_url'] = $request->off_plan_url;
                $propertyDataArray['create_by'] = Auth::user()->id;


                //location ID And Leavel Work
                $locationsArray = explode(',', $request->address_id);
                $address_level = $locationsArray[0];
                $address_id = $locationsArray[1];
                if ($address_level == 0) {
                    $propertyDataArray['location_state_id'] = $address_id;
                } else if ($address_level == 1) {
                    $location_area = LocationArea::firstWhere('id', $address_id);
                    $propertyDataArray['location_state_id'] = $location_area->location_state_id;
                    $propertyDataArray['location_area_id'] = $address_id;
                } else if ($address_level == 2) {
                    $location_area = Location::firstWhere('id', $address_id);
                    $propertyDataArray['location_state_id'] = $location_area->location_state_id;
                    $propertyDataArray['location_area_id'] = $location_area->location_area_id;
                    $propertyDataArray['location_id'] = $address_id;
                } else if ($address_level == 3) {
                    $location_area = LocationBuilding::firstWhere('id', $address_id);
                    $propertyDataArray['location_state_id'] = $location_area->location_state_id;
                    $propertyDataArray['location_area_id'] = $location_area->location_area_id;
                    $propertyDataArray['location_id'] = $location_area->location_id;
                    $propertyDataArray['location_building_id'] = $address_id;
                }
                $propertyDataArray['address_level'] = $address_level;
                $propertyDataArray['address_id'] = $address_id;
                $propertyDataArray['slug'] = $slug;
                $propertyDataArray['prop_ref_no'] = $prop_ref_no;
                $propertyDataArray['parent_id'] = $last_inserted_record->id;
                $propertyDataArray['property_status_id'] = $request->property_status_id ? $request->property_status_id : 0;
                if (Auth::user()->role_id == 1) {
                    $propertyDataArray['status'] = 2;
                }
                Property::create($propertyDataArray);
            }
        }
        //Uploading images here
        if ($request->hasFile('images')) {
            $logoimg = WaterMarkImages::find(1);
            for ($i = 0; $i < count($request->images); $i++) {
                $watermark = Image::make($logoimg->file_name)->opacity($logoimg->opacity);
                $image = $request->file('images')[$i];

                $imgFile = Image::make($image->getRealPath());
                $imgFile->insert($watermark, $logoimg->position, 10, 10,); //'bottom-right',
                $imagefilename = time();
                $imgFile->save(storage_path('app/' . $imagefilename . '.jpg'));
                $url = storage_path('app/' . $imagefilename . '.jpg');
                $contents = file_get_contents($url);
                $name  = 'PropertyImages/' . substr($url, strrpos($url, '/') + 1);

                Storage::disk('s3')->put($name, $contents);
                $finalurl = Storage::disk('s3')->url($name);
                unlink(storage_path('app/' . $imagefilename . '.jpg'));

                $propertyImages = new PropertyImage;
                $propertyImages->property_id = $last_inserted_record->id;
                $propertyImages->image = $finalurl; // $request->file('images')[$i]->store('PropertyImages', 'public');
                $propertyImages->type = 1;
                $propertyImages->save();
            }
        }
        return 'true';
    }
    //Loading Property View Index Page
    public function edit(Request $request)
    {
        Property::where('location_id', 0)->where('location_area_id', '!=', 0)->update(['address_level' => 1]);

        Property::where('location_area_id', 0)->update(['address_level' => 0]);

        $property = Property::where('id', $request->id)->first();
        $lat = '';
        $lng = '';
        $level_id = $property->address_level;
        $arid = '';
        // return $property;
        if ($property->address_level == 0 || $property->location_area_id == 0) {
            $loc = LocationState::where('id', $property->location_state_id)->first();
            $lat = $loc->latitude != '' ? $loc->latitude : '';
            $lng = $loc->longitude != '' ? $loc->longitude : '';
        } else if ($property->address_level == 1) {
            $loc = LocationArea::where('id', $property->location_area_id)->first();
            $lat = $loc->latitude != '' ? $loc->latitude : '';
            $lng = $loc->longitude != '' ? $loc->longitude : '';
            $arid = $loc->id;
        } else if ($property->address_level == 2) {
            $loc = Location::where('id', $property->location_id)->first();
            $lng = $loc->longitude != '' ? $loc->longitude : '';
            $lat = $loc->latitude != '' ? $loc->latitude : '';
            $arid = $loc->id;
        } else if ($property->address_level == 3) {
            $loc = LocationBuilding::where('id', $property->location_building_id)->first();
            $lng = $loc->longitude != '' ? $loc->longitude : '';
            $lat = $loc->latitude != '' ? $loc->latitude : '';
            $arid = $loc->id;
        } else {
            $lat = $property->lat;
            $lng = $property->lng;
        }
        $languages = Language::where('status', 1)->get();
        //  return $languages;
        if ($property->address_level == 0) {
            $property['location_text'] = $this->get_location_text($property->address_level, $property->location_state_id);
        } else if ($property->address_level == 1) {
            $property['location_text'] = $this->get_location_text($property->address_level, $property->location_area_id);
            // return $property['location_text'];
        } else if ($property->address_level == 2) {
            $property['location_text'] = $this->get_location_text($property->address_level, $property->location_id);
        } else if ($property->address_level == 3) {
            $property['location_text'] = $this->get_location_text($property->address_level, $property->location_building_id);
        } else {
            $property['location_text'] = '';
        }
        //Creating Records for Multi Languages
        for ($i = 0; $i < count($languages); $i++) {
            $checkProperty = Property::where(['lang_id' => $languages[$i]->id, 'parent_id' => $property->id])->first();
            if (is_null($checkProperty)) {
                $prop = new Property;
                $prop->company_id = $property->company_id;
                $prop->title = $property->title;
                $prop->slug = $property->slug;
                $prop->prop_ref_no = $property->prop_ref_no;
                $prop->project_name = $property->project_name;
                $prop->street_name = $property->street_name;
                $prop->street_no = $property->street_no;
                $prop->unit_no = $property->unit_no;
                $prop->property_category_id = $property->property_category_id;
                $prop->property_status_id = $property->property_status_id;
                $prop->rent_frequency = $property->rent_frequency;
                $prop->size_sqft = $property->size_sqft;
                $prop->size_sqmtr = $property->size_sqmtr;
                $prop->prop_ref_no = $property->prop_ref_no;
                $prop->location_state_id = $property->location_state_id;
                $prop->location_area_id = $property->location_area_id;
                $prop->location_id = $property->location_id;
                $prop->location_building_id = $property->location_building_id;
                $prop->views = $property->views;
                $prop->portals = $property->portals;
                $prop->developer_id = $property->developer_id;
                $prop->status = $property->status;
                // $prop->agent_id = $property->agent_id;
                $prop->address_level = $property->address_level;
                $prop->address_id = $property->address_id;
                $prop->lat = $property->lat;
                $prop->lng = $property->lng;
                $prop->lang_id = $languages[$i]->id;
                $prop->parent_id = $property->id;
                $prop->expire_after = $property->expire_after;
                $prop->youtube_link = $property->youtube_link;
                $prop->video_link = $property->video_link;
                $prop->expire_date = $property->expire_date;
                $prop->create_by = $property->create_by;
                $prop->save();
            }
        }
        $property_types = PropertyType::where(['lang_id' => 1, 'type_id' => 0, 'status' => 1])->get();

        $categories = PropertyCategory::with(['sub_categories' => function ($query) {
            $query->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'level' => 1, 'status' => 1, 'property_type_id' => 1])->get();

        $property_status = PropertyType::where(['lang_id' => 1, 'type_id' => $property->property_type_id, 'status' => 1])->orderBy('id', 'DESC')->get();

        $cities = LocationState::where(['lang_id' => 1, 'status' => 1])->orderBy('id', 'DESC')->get();
        $sizes = Size::orderBy('size', 'ASC')->get();
        $views = View::where(['lang_id' => 1, 'status' => 1])->orderBy('id', 'DESC')->get();
        $portals = Portal::where('portal_type', 1)->get(['id', 'name']);
        $gallaries = Gallary::where(['lang_id' => 1, 'status' => 1])->orderBy('id', 'DESC')->get();
        $developers = Developer::where(['status' => 1, 'lang_id' => 1])->orderBy('id', 'DESC')->get();
        $agents = User::where(['role_id' => 3])->orderBy('id', 'DESC')->get();
        $prices = Price::orderBy('amount', 'asc')->where(['type_id' => $property->property_type_id])->get();
        $propertyData = Property::with(['documents' => function ($query) {
            $query->with('document_type');
        }])->where('parent_id', $request->id)->get();

        $rent_frequency = $propertyData[0]->rent_frequency != "" ? explode(',', $propertyData[0]->rent_frequency) : [];
        $property_views = $propertyData[0]->views != "" ? explode(',', $propertyData[0]->views) : [];
        $property_portals = $propertyData[0]->portals != "" ? explode(',', $propertyData[0]->portals) : [];
        $property_amenities = $propertyData[0]->amenities != "" ? explode(',', $propertyData[0]->amenities) : [];
        $property_features = $propertyData[0]->features != "" ? explode(',', $propertyData[0]->features) : [];
        $property_financial_status = $propertyData[0]->financial_status != "" ? explode(',', $propertyData[0]->financial_status) : [];

        $location_country = LocationCountry::with(['location_states' => function ($query) {
            $query->with(['location_areas' => function ($query) {
                $query->where(['lang_id' => 1, 'status' => 1, 'location_state_id' => 1]);
            }])->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'is_default' => 1])->first();
        $document_types = DocumentType::where(['status' => 1])->get();
        $property_images = PropertyImage::where('property_id', $request->id)->get(['id', 'property_id', 'image']);
       // return $propertyData;
        return view('properties.list-off-plan-properties.edit', compact('propertyData', 'document_types','arid', 'level_id', 'lat', 'lng', 'property', 'location_country', 'rent_frequency', 'property_portals', 'property_views', 'property_amenities', 'property_features', 'property_financial_status',  'languages', 'prices', 'property_status', 'agents', 'developers', 'portals', 'property_types', 'categories', 'cities', 'sizes', 'views', 'gallaries', 'property_images'));
    }
    //Edit Property Here
    public function edit_process(Request $request)
    {
        //Getting Languages and Converting to array for stroing data in multi language format
        $languages_id = explode(",", $request->languages_names);
        //Getting Descriptions Locations and Converting to array for stroing data in multi language format

        //Getting Property Titles and Converting to array for stroing data in multi language format
        $titles = explode(",", $request->titles);
        //Saving Property Here
        $property = Property::find($request->id);
        $propertyDataArray = $request->except('title_english', 'images', 'titles', 'languages_names', 'build_up_area', 'availablity', 'descriptions', '_token', 'id');
        $propertyDataArray['company_id'] = Auth::user()->id;
        $propertyDataArray['title'] = $request->title_english;
        $propertyDataArray['description'] =  $request->descriptions[0];
        $propertyDataArray['off_plan_expire_date'] = $request->expire_date;
        $propertyDataArray['off_plan_release_time'] = $request->off_plan_release_time;
        $propertyDataArray['modify_by'] = Auth::user()->id;
        //location ID And Leavel Work
        $locationsArray = explode(',', $request->address_id);
        $address_level = $locationsArray[0];
        $address_id = $locationsArray[1];
        if ($address_level == 0) {
            $propertyDataArray['location_state_id'] = $address_id;
            $propertyDataArray['location_area_id'] = null;
            $propertyDataArray['location_id'] = null;
            $propertyDataArray['location_building_id'] = null;
        } else if ($address_level == 1) {
            $location_area = LocationArea::firstWhere('id', $address_id);
            $propertyDataArray['location_state_id'] = $location_area->location_state_id;
            $propertyDataArray['location_area_id'] = $address_id;
            $propertyDataArray['location_id'] = null;
            $propertyDataArray['location_building_id'] = null;
        } else if ($address_level == 2) {
            $location_area = Location::firstWhere('id', $address_id);
            $propertyDataArray['location_state_id'] = $location_area->location_state_id;
            $propertyDataArray['location_area_id'] = $location_area->location_area_id;
            $propertyDataArray['location_id'] = $address_id;
            $propertyDataArray['location_building_id'] = null;
        } else if ($address_level == 3) {
            $location_area = LocationBuilding::firstWhere('id', $address_id);
            $propertyDataArray['location_state_id'] = $location_area->location_state_id;
            $propertyDataArray['location_area_id'] = $location_area->location_area_id;
            $propertyDataArray['location_id'] = $location_area->location_id;
            $propertyDataArray['location_building_id'] = $address_id;
        }
        $propertyDataArray['address_level'] = $address_level;
        $propertyDataArray['address_id'] = $address_id;
        $propertyDataArray['property_status_id'] = $request->property_status_id != '' ? $request->property_status_id : 0;
        Property::where('id', $request->id)->update($propertyDataArray);
        //Creating Records for Multi Languages
        for ($i = 1; $i < count($languages_id); $i++) {
            $propertyDataArray = $request->except('title_english', 'images', 'titles', 'languages_names', 'build_up_area', 'availablity', 'descriptions', '_token', 'id');
            $propertyDataArray['company_id'] = Auth::user()->id;
            $propertyDataArray['title'] = $titles[$i];
            $propertyDataArray['description'] =  $request->descriptions[$i];
            $propertyDataArray['lang_id'] = $languages_id[$i];
            $propertyDataArray['off_plan_expire_date'] = $request->expire_date;
            $propertyDataArray['create_by'] = Auth::user()->id;

            //location ID And Leavel Work
            $locationsArray = explode(',', $request->address_id);
            $address_level = $locationsArray[0];
            $address_id = $locationsArray[1];
            if ($address_level == 0) {
                $propertyDataArray['location_state_id'] = $address_id;
                $propertyDataArray['location_area_id'] = null;
                $propertyDataArray['location_id'] = null;
                $propertyDataArray['location_building_id'] = null;
            } else if ($address_level == 1) {
                $location_area = LocationArea::firstWhere('id', $address_id);
                $propertyDataArray['location_state_id'] = $location_area->location_state_id;
                $propertyDataArray['location_area_id'] = $address_id;
                $propertyDataArray['location_id'] = null;
                $propertyDataArray['location_building_id'] = null;
            } else if ($address_level == 2) {
                $location_area = Location::firstWhere('id', $address_id);
                $propertyDataArray['location_state_id'] = $location_area->location_state_id;
                $propertyDataArray['location_area_id'] = $location_area->location_area_id;
                $propertyDataArray['location_id'] = $address_id;
                $propertyDataArray['location_building_id'] = null;
            } else if ($address_level == 3) {
                $location_area = LocationBuilding::firstWhere('id', $address_id);
                $propertyDataArray['location_state_id'] = $location_area->location_state_id;
                $propertyDataArray['location_area_id'] = $location_area->location_area_id;
                $propertyDataArray['location_id'] = $location_area->location_id;
                $propertyDataArray['location_building_id'] = $address_id;
            }
            $propertyDataArray['address_level'] = $address_level;
            $propertyDataArray['address_id'] = $address_id;
            $propertyDataArray['property_status_id'] = $request->property_status_id != '' ? $request->property_status_id : 0;

            Property::where(['lang_id' => $languages_id[$i], 'parent_id' => $request->id])->update($propertyDataArray);
        }
        //Uploading images here
        if ($request->hasFile('images')) {
            $logoimg = WaterMarkImages::find(1);
            for ($i = 0; $i < count($request->images); $i++) {
                $watermark = Image::make($logoimg->file_name)->opacity($logoimg->opacity);
                $image = $request->file('images')[$i];

                $imgFile = Image::make($image->getRealPath());
                $imgFile->insert($watermark, $logoimg->position, 10, 10,); //'bottom-right',
                $imagefilename = time();
                $imgFile->save(storage_path('app/' . $imagefilename . '.jpg'));
                $url = storage_path('app/' . $imagefilename . '.jpg');
                $contents = file_get_contents($url);
                $name  = 'PropertyImages/' . substr($url, strrpos($url, '/') + 1);

                Storage::disk('s3')->put($name, $contents);
                $finalurl = Storage::disk('s3')->url($name);
                unlink(storage_path('app/' . $imagefilename . '.jpg'));

                $propertyImages = new PropertyImage;
                $propertyImages->property_id = $request->id;
                $propertyImages->image = $finalurl; // $request->file('images')[$i]->store('PropertyImages', 'public');
                $propertyImages->type = 1;
                $propertyImages->save();
            }
        }
        // Upload Image on s3 old code delete after varification
        //     if($request->hasFile('images')){
        //       $logoimg = WaterMarkImages::find(1);
        //       for($i = 0; $i < count($request->images); $i++){
        //           $watermark = Image::make($logoimg->file_name)->opacity($logoimg->opacity);
        //           $image = $request->file('images')[$i];

        //           $file_imgs =  $request->file('images')[$i]->store('PropertyImages', 's3');

        //           $imgFile = Image::make($image->getRealPath());

        //           $img  = $imgFile->insert($watermark, $logoimg->position, 10, 10, );//'bottom-right',

        //            $url = Storage::disk('s3')->url($file_imgs);
        //            $propertyImages = new PropertyImage;
        //            $propertyImages->property_id = $request->id;
        //            $propertyImages->image = $url; // $request->file('images')[$i]->store('PropertyImages', 'public');
        //            $propertyImages->type = 1;
        //            $propertyImages->save();

        //       }
        //   }


        return 'true';
    }

    //Getting Category Data
    public function get_category_data(Request $request)
    {
        $data = PropertyCategory::where('id', $request->id)->pluck('property_includes')->first();
        return explode(',', $data);
    }

    //Getting Categories Data
    public function get_categories_data(Request $request)
    {
        $categories = PropertyCategory::with(['sub_categories' => function ($query) {
            $query->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'level' => 1, 'status' => 1, 'property_type_id' => $request->id])->get();

        $option = '<option value="">---property category---</option>';

        if ($categories->count()) {
            foreach ($categories as $item) {
                $option .= '<option value="' . $item->id . '" ' . ($item->sub_categories->count() ? "disabled" : "") . '>' . $item->name . '</option>';
                if ($item->sub_categories->count()) {
                    foreach ($item->sub_categories as $sub_item) {
                        $option .= '<option value="' . $sub_item->id . '">-- ' . $sub_item->name . '</option>';
                    }
                }
            }
        }
        return $option;
    }

    public function delete(Request $request)
    {
        Property::where('id', $request->id)->delete();
        PropertyImage::where('property_id', $request->id)->delete();
    }

    // public function get_location_text($level, $id)
    // {
    //    // return $level;
    //     // $level = $request->level;
    //     // $id = $request->id;
    //     if($level == 1){
    //         $location = LocationArea::with('location_states')->where(['id' => $id, 'lang_id' => 1])->first();
    //         return $location->name .', '. $location->location_states->name;
    //     }else if($level == 2)
    //     {
    //         $location = Location::with(['location_areas' => function($query){
    //             $query->with('location_states');
    //         }])->where(['id' => $id, 'lang_id' => 1])->first();
    //         return $location->name .', '. $location->location_areas->name .', '. $location->location_areas->location_states->name;
    //     }
    //     else if($level == 3)
    //     {
    //         $location = LocationBuilding::with(['locations' => function($query){
    //             $query->with(['location_areas' => function($query){
    //                 $query->with('location_states');
    //             }]);
    //         }])->where(['id' => $id, 'lang_id' => 1])->first();
    //         return $location->name .', '. $location->locations->name .', '. $location->locations->location_areas->name .', '. $location->locations->location_areas->location_states->name;
    //     }


    // }

    public function get_location_text($level, $id)
    {
        // return $id;
        if ($level == 0) {
            $state = LocationState::where(['id' => $id, 'lang_id' => 1])->first();
            return $state->name;
        } else if ($level == 1) {
            $area = LocationArea::where(['id' => $id, 'lang_id' => 1])->first();
            // return $area;
            $state = LocationState::where(['id' => $area->location_state_id, 'lang_id' => 1])->first();
            return $area->name . ', ' . $state->name;
        } else if ($level == 2) {
            $location = Location::where(['id' => $id, 'lang_id' => 1])->first();
            $state = LocationState::where(['id' => $location->location_state_id, 'lang_id' => 1])->first();
            $area = LocationArea::where(['id' => $location->location_area_id, 'lang_id' => 1])->first();
            return $location->name . ', ' . $area->name . ', ' . $state->name;
        } else if ($level == 3) {
            $building = LocationBuilding::where(['id' => $id, 'lang_id' => 1])->first();
            $location = Location::where(['id' => $building->location_id, 'lang_id' => 1])->first();
            $state = LocationState::where(['id' => $building->location_state_id, 'lang_id' => 1])->first();
            $area = LocationArea::where(['id' => $building->location_area_id, 'lang_id' => 1])->first();
            return $building->name . ', ' . $location->name . ', ' . $area->name . ', ' . $state->name;
        }
    }


    //**DELETE PROPERTY IMAGES */
    public function delete_property_image(Request $request)
    {
        PropertyImage::where('id', $request->id)->delete();
        return $request->id;
    }
    //**CHNAGE LAT LNG START HERE */
    public function change_lat_lng(Request $request)
    {
        // return $request->all();
        // $locationsArray = explode(',', $request->address_id);
        $level = $request->level_id;
        $id = $request->area_id;
        $lat = $request->lat;
        $lng = $request->lng;


        if ($level == 0) {
            LocationState::where('id', $id)->update(['latitude' => $lat, 'longitude' => $lng]);
            return 'true';
        } else if ($level == 1) {
            LocationArea::where('id', $id)->update(['latitude' => $lat, 'longitude' => $lng]);
            return 'true';
        } else if ($level == 2) {
            Location::where('id', $id)->update(['latitude' => $lat, 'longitude' => $lng]);
        } else if ($level == 3) {
            LocationBuilding::where('id', $id)->update(['latitude' => $lat, 'longitude' => $lng]);
            return 'true';
        } else {
            return 'false';
        }
    }

    //========================PROPERTY DEBUGING START HERE=================================//
    public function debug_poprties()
    {

        $properties = Property::with('state', 'type', 'category')->orderBy('id', 'DESC')->where(['lang_id' => 1])->get();

        $array = [];
        foreach ($properties as $property) {
            array_push($array, $property->state);
            array_push($array, $property->type);
            array_push($array, $property->category);
            array_push($array, $property->price);
            array_push($array, $property->expire_date);
            array_push($array, $property->title);
            array_push($array, $property->category->name);
            array_push($array, $property->type->name);
            try {
                array_push($array, $property->agent->name);
            } catch (\Exception $e) {
                return $property;
            }
        }
        return $array;
    }
    //***PROPERTY SORT ORDER***//
    public function property_sort_order(Request $request)
    {
        Property::where('id', $request->id)->update(['sort_order' => $request->sort_order]);
        return 'true';
    }
}
