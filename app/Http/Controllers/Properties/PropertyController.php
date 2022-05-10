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
use Image;
use Mpdf\Mpdf;
use Spatie\ArrayToXml\ArrayToXml;
use function GuzzleHttp\Promise\all;;

class PropertyController extends Controller
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
                $query->with(['locations' => function ($query) {
                    $query->with(['buildings' => function ($query) {
                        $query->where(['lang_id' => 1, 'status' => 1]);
                    }])->where(['lang_id' => 1, 'status' => 1]);
                }])->where(['lang_id' => 1, 'status' => 1]);
            }])->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'is_default' => 1])->first();
        $property_category = PropertyCategory::all();
        $amenities = Amenity::where(['lang_id' => 1, 'status' => 1])->get();
        $agentusers = User::where('role_id', 3)->orderBy('id', 'DESC')->get();
        $property_types = PropertyType::where(['lang_id' => 1, 'type_id' => 0, 'status' => 1])->get();
        $categories = PropertyCategory::with(['sub_categories' => function ($query) {
            $query->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'level' => 1, 'status' => 1, 'property_type_id' => $property_types[0]->id])->get();

        //=========================================================//

        $properties = Property::with('state', 'type', 'category')->orderBy('id', 'DESC')->where(['lang_id' => 1,'property_status_id' => 19])->get();
        // $properties;
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
                    $html = '<a href="' . route('manage-properties.property.edit', ['id' => $properties->id]) . '">' . $properties->title . '</a>';
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
                ->addColumn('is_featured', function ($properties) {
                    if ($properties->is_featured == 1) {
                        return '
                    <input type="hidden" name="id" value="' . $properties->id . '"/>
                    <input type="checkbox" id="is_featured" data-id="' . $properties->is_featured . '" style="cursor:pointer" checked="checked" name="is_featured"/>
                    ';
                    } else {
                        return '
                    <input type="hidden" name="id" value="' . $properties->id . '"/>
                    <input type="checkbox" id="is_featured" data-id="' . $properties->is_featured . '" style="cursor:pointer" name="is_featured"/>
                    ';
                    }
                })
                ->addColumn('is_signature', function ($properties) {
                    if ($properties->is_signature == 1) {
                        //  return 'Signature';
                        return '
                    <input type="hidden" name="id" value="' . $properties->id . '"/>
                    <input type="checkbox" id="is_signature" data-id="' . $properties->is_signature . '" style="cursor:pointer" checked="checked" name="is_signature"/>
                    ';
                    } else {
                        return '
                    <input type="hidden" name="id" value="' . $properties->id . '"/>
                    <input type="checkbox" id="is_signature" data-id="' . $properties->is_signature . '" style="cursor:pointer" name="is_signature"/>
                    ';
                    }
                })
                ->addColumn('is_verified', function ($properties) {

                    if ($properties->is_verified == 1) {
                        return '
                    <input type="hidden" name="id" value="' . $properties->id . '"/>
                    <input type="checkbox" id="is_verified" data-id="' . $properties->is_verified . '" style="cursor:pointer" checked="checked" name="is_verified"/>
                    ';
                    } else {
                        return '
                    <input type="hidden" name="id" value="' . $properties->id . '"/>
                    <input type="checkbox" id="is_verified" data-id="' . $properties->is_verified . '" style="cursor:pointer" name="is_verified"/>
                    ';
                    }
                })
                ->addColumn('is_boost', function ($properties) {

                    if ($properties->is_signature == 1) {
                        return '
                    <input type="hidden" name="id" value="' . $properties->id . '"/>
                    <input type="checkbox" id="is_signature" data-id="' . $properties->is_signature . '" style="cursor:pointer" checked="checked" name="is_signature"/>
                    ';
                    } else {
                        return '
                    <input type="hidden" name="id" value="' . $properties->id . '"/>
                    <input type="checkbox" id="is_signature" data-id="' . $properties->is_signature . '" style="cursor:pointer" name="is_signature"/>
                    ';
                    }
                })
                ->addColumn('action', function ($properties) {
                    return '
                     <a href="' . route('manage-properties.property.edit', ['id' => $properties->id]) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
        return view('properties.list-properties.index')
            ->with('property_category', $property_category)
            ->with('agentusers', $agentusers)
            ->with('location_country', $location_country)
            ->with('categories', $categories)
            ->with('amenities', $amenities);
    }
    //=========================================================
    //CREATE XML FILE FOR DOBIZEL//
    //=========================================================
    public function property_xml_file()
    {
        $portals = Portal::where('status', 1)->get();

        $amenities = Amenity::where(['lang_id' => 1, 'status' => 1])->get();

        if (Auth::user() && Auth::user()->role_id != 1) {

            $properties = Property::with('developer', 'images', 'state', 'type', 'category', 'agent')
                ->with(['state' => function ($query) {
                    $query->with('location_areas');
                }])->where(['lang_id' => 1, 'create_by' => Auth::user()->id])->where('portals', 'LIKE', '%' . '3' . '%')->get();
        } else {
            $properties = Property::with('developer', 'images', 'type', 'category', 'agent')
                ->with(['state' => function ($query) {
                    $query->with('location_areas');
                }])
                ->orderBy('id', 'DESC')->where(['lang_id' => 1])->where('portals', 'LIKE', '%' . '3' . '%')->get();
            // return count($properties);
        }

        foreach ($properties as $property) {
            foreach ($property->state->location_areas as $pro) {
                if ($property->location_area_id == $pro->id) {
                    $property->area = $pro->name;
                }
            }
        }
        $result = [];
        foreach ($properties as $pro) {
            $amenities_html = '';
            $amenities_arr = explode(",", $pro->amenities);
            $images = '';
            foreach ($pro->images as $image) {
                // $images .= asset('storage/').'/'.$image->image  .  '|' ;
                $images .= $image->image  .  '|';
            }
            for ($i = 0; $i < count($amenities_arr); $i++) {

                foreach ($amenities as $amnty) {

                    if ($amnty->id == $amenities_arr[$i]) {

                        $amenities_html .= $amnty->name . '|';
                    }
                }
            }
            $result[] = [
                'status' => $pro->status == 2 ? 'vacant' : 'deleted',
                'type' => $pro->type->name == 'Sale' ? 'SP' : 'RP',
                'subtype' => ($pro->category->name == 'Villas' ? 'VH' : ($pro->category->name == 'Apartments' ? 'AP' : ($pro->category->name == 'Townhouses' ? 'TH' : ($pro->category->name == 'Penthouses' ? 'PH' : ($pro->category->name == 'Plot' ?: 'PH'))))),
                'commercialtype' => $pro->category->is_commercial == 1 ? 'OC' : '',
                'refno' => $pro->prop_ref_no,
                'title' => $pro->title,
                'description' => $pro->description,
                'size_sqft' => $pro->size_sqft,
                'sizeunits' => 'SqFt',
                'price' => $pro->price,
                'pricecurrency' => 'AED',
                'totalclosingfee' => $pro->service_charges,
                'annualcommunityfee' => '',
                'bedrooms' => $pro->bed_no,
                'bathrooms' => $pro->bath_no,
                'developer' => $pro->developer != '' ? $pro->developer->name : '',
                'readyby' => '',
                'lastupdated' => $pro->updated_at,
                'contactemail' => $pro->agent != ''  ? $pro->agent->email : '',
                'contactnumber' => $pro->agent != ''  ?  $pro->agent->phone : '',
                'building' => $pro->street_name,
                'city' => $pro->area,
                'locationtext' => $pro->state->name,
                'permit_number' => $pro->permit_no,
                'privateamenities' => $amenities_html,
                'commercialamenities' => '',
                'photos' => $images,
                'view360' => $pro->video_link,
                'video_url' => $pro->youtube_link,
                'geopoint' => $pro->lat . ',' . $pro->lng,

            ];
        }

        // $result = ArrayToXml::convert($properties);
        return response()->xml(['property' => $result]);
    }
    //=========================================================
    //CREATE XML FILE FOR Offerpal//
    //=========================================================
    public function property_Offerpal_xml_file()
    {
        $amenities = Amenity::where(['lang_id' => 1, 'status' => 1])->get();

        if (Auth::user() && Auth::user()->role_id != 1) {
            $properties = Property::with('developer', 'images', 'state', 'type', 'category', 'agent')
                ->with(['state' => function ($query) {
                    $query->with('location_areas');
                }])->where(['lang_id' => 1, 'create_by' => Auth::user()->id])->where('portals', 'LIKE', '%' . '5' . '%')->get();
        } else {
            $properties = Property::with('developer', 'images', 'type', 'category', 'agent')
                ->with(['state' => function ($query) {
                    $query->with('location_areas');
                }])
                ->orderBy('id', 'DESC')->where(['lang_id' => 1])->where('portals', 'LIKE', '%' . '5' . '%')->get();
        }

        foreach ($properties as $property) {
            foreach ($property->state->location_areas as $pro) {
                if ($property->location_area_id == $pro->id) {
                    $property->area = $pro->name;
                }
            }
        }
        $result = [];
        foreach ($properties as $pro) {
            $amenities_html = '';
            $amenities_arr = explode(",", $pro->amenities);
            $images = '';
            foreach ($pro->images as $image) {
                // $images .= asset('storage/').'/'.$image->image  .  '|' ;
                $images .= $image->image  .  '|';
            }
            for ($i = 0; $i < count($amenities_arr); $i++) {

                foreach ($amenities as $amnty) {

                    if ($amnty->id == $amenities_arr[$i]) {

                        $amenities_html .= $amnty->name . '|';
                    }
                }
            }
            $result[] = [
                'status' => $pro->status == 2 ? 'vacant' : 'deleted',
                'type' => $pro->type->name == 'Sale' ? 'SP' : 'RP',
                'subtype' => ($pro->category->name == 'Villas' ? 'VH' : ($pro->category->name == 'Apartments' ? 'AP' : ($pro->category->name == 'Townhouses' ? 'TH' : ($pro->category->name == 'Penthouses' ? 'PH' : ($pro->category->name == 'Plot' ?: 'PH'))))),
                'commercialtype' => $pro->category->is_commercial == 1 ? 'OC' : '',
                'refno' => $pro->prop_ref_no,
                'title' => $pro->title,
                'description' => $pro->description,
                'size_sqft' => $pro->size_sqft,
                'sizeunits' => 'SqFt',
                'price' => $pro->price,
                'pricecurrency' => 'AED',
                'totalclosingfee' => $pro->service_charges,
                'annualcommunityfee' => '',
                'bedrooms' => $pro->bed_no,
                'bathrooms' => $pro->bath_no,
                'developer' => $pro->developer != '' ? $pro->developer->name : '',
                'readyby' => '',
                'lastupdated' => $pro->updated_at,
                'contactemail' => $pro->agent != ''  ? $pro->agent->email : '',
                'contactnumber' => $pro->agent != ''  ?  $pro->agent->phone : '',
                'building' => $pro->street_name,
                'city' => $pro->area,
                'locationtext' => $pro->state->name,
                'permit_number' => $pro->permit_no,
                'privateamenities' => $amenities_html,
                'commercialamenities' => '',
                'photos' => $images,
                'view360' => $pro->video_link,
                'video_url' => $pro->youtube_link,
                'geopoint' => $pro->lat . ',' . $pro->lng,

            ];
        }

        // $result = ArrayToXml::convert($properties);
        return response()->xml(['property' => $result]);
    }
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
                        <a href="' . route('manage-properties.property.edit', ['id' => $property->id]) . '" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
        //  return $locations;

        //   ,'location_state_id' => 1
        // return $location_country->location_states;
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
        return view('properties.list-properties.create', compact('languages', 'portals', 'location_country', 'document_types', 'prices', 'property_status', 'agents', 'developers', 'property_types', 'categories', 'cities', 'sizes', 'views', 'gallaries'));
    }

    //Getting Amenities Records
    public function fetch_amenities()
    {
        $amenities = Amenity::where(['lang_id' => 1, 'status' => 1])->get();
        $html = '';
        foreach ($amenities as $item)
            $html .= '
        <div class="col-md-4"><input type="checkbox" name="amenities" value="' . $item->id . '" style="cursor: pointer;"  id="' . $item->name . '_' . $item->id . '" class="chk-green">
        <label for="' . $item->name . '_' . $item->id . '" style="min-width:227px;cursor: pointer;">' . $item->name . '</label></div>
        ';
        return $html;
    }

    //Getting Features Records
    public function fetch_features()
    {
        $features = Feature::where(['lang_id' => 1, 'status' => 1])->get();
        $html = '';
        foreach ($features as $item)
            $html .= '
        <span class="col-md-4"><input type="checkbox" name="features" value="' . $item->id . '" style="cursor: pointer;"  id="' . $item->name . '_' . $item->id . '" class="chk-green">
        <label for="' . $item->name . '_' . $item->id . '" style="min-width:227px;cursor: pointer;">' . $item->name . '</label></span>
        ';
        return $html;
    }

    //IMPORTING PropSpace PROPERTY FROM XML FILE//
    public function create_process_xml_file()
    {
        // xml file path
        $path = "http://xml.propspace.com/feed/xml.php?cl=3410&pid=9922&acc=1154";

        // Read entire file into string
        $xmlfile = file_get_contents($path);

        // Convert xml string into an object
        $new = simplexml_load_string($xmlfile, NULL, LIBXML_NOCDATA);

        // Convert into json
        $con = json_encode($new);

        // Convert into associative array
        $newArr = json_decode($con, true);
         //  return $newArr['Listing'];
        //Saving Property Here
        for ($i = 0; $i < count($newArr['Listing']); $i++) {
            //**CHECKING DUPLICATE PROPERTIES HERE */
            $check_property = Property::where(['prop_ref_no' => $newArr['Listing'][$i]['Property_Ref_No'] , 'is_propspace' => 1])->first();
             //$check_property_title = Property::where('title',$newArr['Listing'][$i]['Property_Title'])->first();
            if (!$check_property) {
                //**TO FIND NUMBERS OF BEDS//
                $beds = 0;
                if (is_array($newArr['Listing'][$i]['Bedrooms'])) {
                    !empty($newArr['Listing'][$i]['Bedrooms'])  ? $beds = $newArr['Listing'][$i]['Bedrooms'][0] : $beds = 0;
                } else {
                    $beds = $newArr['Listing'][$i]['Bedrooms'];
                }
                //**END HERE TO DIF No. OF BEDS */

                //**TO FIND NUMBERS OF latitude//
                $latitude = '';
                if (is_array($newArr['Listing'][$i]['Latitude'])) {
                    !empty($newArr['Listing'][$i]['Latitude'])  ? $latitude = $newArr['Listing'][$i]['Latitude'][0] : $latitude = '';
                } else {
                    $latitude = $newArr['Listing'][$i]['Latitude'];
                }
                //**END HERE TO DIF No. OF latitude */

                //**TO FIND NUMBERS OF BEDS//
                $bath = 0;
                if (is_array($newArr['Listing'][$i]['No_of_Bathroom'])) {
                    !empty($newArr['Listing'][$i]['No_of_Bathroom'])  ? $bath = $newArr['Listing'][$i]['No_of_Bathroom'][0] : $bath = 0;
                } else {
                    $bath = $newArr['Listing'][$i]['No_of_Bathroom'];
                }
                //**END HERE TO DIF No. OF BEDS */

                //**TO FIND PARKING START HERE */
                $parking = 0;
                if (is_array($newArr['Listing'][$i]['Parking'])) {
                    !empty($newArr['Listing'][$i]['Parking'])  ? $parking = $newArr['Listing'][$i]['Parking'][0] : $parking = 0;
                } else {
                    $newArr['Listing'][$i]['Parking']  != '' ? $parking = $newArr['Listing'][$i]['Parking'] : '';
                }
                //**To FIND PARKING END HERE */
                $property = new Property;
                //**PROPERTY LOCATION */
                $pro_state = LocationState::where(['name' => $newArr['Listing'][$i]['Emirate'], 'lang_id' => 1])->first();
                $state_id = 0;
                if ($pro_state) {
                    $property->location_state_id = $pro_state->id;
                    $state_id = $pro_state->id;
                } else {
                    $location_state = new LocationState;
                    $location_state->location_country_id = 1;
                    $location_state->name = $newArr['Listing'][$i]['Emirate'];
                    $location_state->slug = strtolower($newArr['Listing'][$i]['Emirate']);
                    $location_state->lang_id = 1;
                    $location_state->save();
                    $property->location_state_id = $location_state->id;
                    $state_id = $location_state->id;
                    LocationState::where('id', $location_state->id)->update(['parent_id' => $location_state->id]);
                }
                //**PROPERTY AREA */
                $pro_area = LocationArea::where(['name' => $newArr['Listing'][1]['Community'], 'lang_id' => 1])->first();
                if ($pro_area) {
                    $property->location_area_id = $pro_area->id;
                } else {
                    $location_area = new LocationArea;
                    $location_area->location_country_id = 1;
                    $location_area->location_state_id = $state_id;
                    $location_area->name = $newArr['Listing'][$i]['Community'];
                    $location_area->slug = strtolower($newArr['Listing'][$i]['Community']);
                    $location_area->lang_id = 1;
                    $location_area->save();
                    $property->location_area_id = $location_area->id;
                    LocationArea::where('id', $location_area->id)->update(['parent_id' => $location_area->id]);
                }

                //**GET PROPERTY TYPE (SALE OR RENT) */
                $pro_type = PropertyType::where(['name' => $newArr['Listing'][$i]['Ad_Type'], 'lang_id' => 1])->first();
                $property_category = PropertyCategory::where('name', 'LIKE', '%' . $newArr['Listing'][$i]['Unit_Type'] . '%')->where('property_type_id', $pro_type->id)->first();
                if ($property_category) {
                    //**SET CATEGORY ID AND CATEGORY TPYE ID IF CATEGORY EXISTS */
                    $property->property_category_id = $property_category->id;
                    $property->property_type_id = $pro_type->id;
                } else {
                    //**CREATE NEW CATEGORY IF NOT EXISTS */
                    $PropertyCategory = new PropertyCategory;
                    $PropertyCategory->property_type_id = $pro_type->id;
                    $PropertyCategory->name = $newArr['Listing'][$i]['Unit_Type'];
                    $PropertyCategory->slug = strtolower($newArr['Listing'][$i]['Unit_Type']) . '-for-' . strtolower($newArr['Listing'][$i]['Ad_Type']);
                    $PropertyCategory->property_category_id = 0;
                    $PropertyCategory->is_commercial = 0;
                    $PropertyCategory->level = 1;
                    $PropertyCategory->lang_id = 1;
                    $PropertyCategory->parent_id = 0;
                    $PropertyCategory->status = 0;
                    $PropertyCategory->save();
                    PropertyCategory::where('id', $PropertyCategory->id)->update(['parent_id' => $PropertyCategory->id]);
                    $property->property_category_id = $PropertyCategory->id;
                    $property->property_type_id = $pro_type->id;
                }
                //**CHECK AGENT IF EXIST*/
                $agent = User::where(['email' => $newArr['Listing'][$i]['Listing_Agent_Email'], 'role_id' => 3])->first();
                if ($agent) {
                    $property->agent_id = $agent->id;
                } else {
                    //**CREATING NEW AGENT */
                    $create_agent = new User;
                    $create_agent->name = $newArr['Listing'][$i]['Listing_Agent'];
                    $create_agent->email = $newArr['Listing'][$i]['Listing_Agent_Email'];
                    $create_agent->phone = $newArr['Listing'][$i]['Listing_Agent_Phone'];
                    $create_agent->avatar = $newArr['Listing'][$i]['Listing_Agent_Photo'] ? $newArr['Listing'][$i]['Listing_Agent_Photo'][0] : '';
                    $create_agent->password = 112233;
                    $create_agent->real_password = 112233;
                    $create_agent->company_id = Auth::user()->id;
                    $create_agent->role_id = 3;
                    $create_agent->save();
                    $property->agent_id = $create_agent->id;
                }
                //**CHECKING VIEW IF EXISTS */
                if ($newArr['Listing'][$i]['Primary_View']) {
                    $view = View::where('title', 'LIKE', '%' . $newArr['Listing'][$i]['Primary_View'] . '%')->where('lang_id', 1)->first();
                    if ($view) {
                        $property->views = $view->id;
                    } else {
                        $create_view = new View;
                        $create_view->title = $newArr['Listing'][$i]['Primary_View'][0];
                        $create_view->lang_id = 1;
                        $create_view->parent_id = 0;
                        $create_view->status = 1;
                        $create_view->save();
                        View::where('id', $create_view->id)->update(['parent_id' => $create_view->id]);
                        $property->views = $create_view->id;
                    }
                }
                //**CHECKING AMINITIES START HERE**//
                $p_amenities = [];
                if (!empty($newArr['Listing'][$i]['Facilities']['facility'])) {
                    for ($k = 0; $k < count($newArr['Listing'][$i]['Facilities']['facility']); $k++) {
                        //**CRAETING AMINIRY IF NOT EXISTS */
                        $amanity = Amenity::where('name', 'LIKE', '%' . $newArr['Listing'][$i]['Facilities']['facility'][$k] . '%')->where('lang_id', 1)->first();
                        if ($amanity) {
                            array_push($p_amenities, $amanity->id);
                        } else {
                            $craete_amenity = new Amenity;
                            $craete_amenity->name = $newArr['Listing'][$i]['Facilities']['facility'][$k];
                            $craete_amenity->lang_id = 1;
                            $craete_amenity->parent_id = 0;
                            $craete_amenity->save();
                            Amenity::where('id', $craete_amenity->id)->update(['parent_id' => $craete_amenity->id]);
                            array_push($p_amenities, $craete_amenity->id);
                        }
                    }
                    $amenities = implode(', ', $p_amenities);
                    $property->amenities = $amenities;
                }
                $property->company_id           = 1;
                $property->title                = $newArr['Listing'][$i]['Property_Title'];
                // $property->garage_size          = $newArr['Listing'][$i]['Unit_Builtup_Area'];   // NEED TO CHANGE COLUMN NAME ()
                $property->garage_size          = 0;  // NEED TO CHANGE COLUMN NAME ()
                $property->bath_no              = $bath;
                $property->bed_no               = $beds;
                $property->is_propspace         = 1;
                $property->price                = $newArr['Listing'][$i]['Price'];
                $property->description          = $newArr['Listing'][$i]['Web_Remarks'];
                $property->furnished_type       = $newArr['Listing'][$i]['Furnished'];
                $property->size_sqft            = $newArr['Listing'][$i]['Unit_Builtup_Area'];     //   $newArr['Listing'][$i]['Plot_Size'];
                $property->plot_no              = $newArr['Listing'][$i]['Plot_Size'];
                $property->prop_ref_no          = $newArr['Listing'][$i]['Property_Ref_No'];
                $property->permit_no            = $newArr['Listing'][$i]['permit_number'];
                $property->project_name         = $newArr['Listing'][$i]['Property_Name'];
                $property->price_on_application = $newArr['Listing'][$i]['price_on_application'] == 'NO' ? 1 : 0;
                $property->parking_no           = $parking;
                // $property->rent_frequency                 = $newArr['Listing'][$i]['Frequency'];
                $property->lat                  = $latitude;
                $property->lng                  = $newArr['Listing'][$i]['Longitude'];
                $property->is_featured          = $newArr['Listing'][$i]['Featured'] == 0 ? 0 : 1;
                $property->status = 2;
                $property->property_status_id = $newArr['Listing'][$i]['off_plan'] == 1 ? 13  : 19;
                $property->address_level = 2;
                $property->lang_id = 1;
                $property->save();
                $slug = 'details-' . $property->id . '.html';
                Property::where('id', $property->id)->update([
                    'slug' => $slug,
                    'parent_id' => $property->id,
                    'modify_by' => Auth::user()->id
                ]);
                //Uploading images here
                if (count($newArr['Listing'][$i]['Images']['image']) > 0) {
                    for ($m = 0; $m < count($newArr['Listing'][$i]['Images']['image']); $m++) {
                        $propertyImages = new PropertyImage;
                        $propertyImages->property_id = $property->id;
                        $propertyImages->image = $newArr['Listing'][$i]['Images']['image'][$m];
                        $propertyImages->type = 1;
                        $propertyImages->save();
                    }
                }
            } else {
                //**UPDATING TITLE AND DESC START HERE */
                $bath = 0;
                if (is_array($newArr['Listing'][$i]['No_of_Bathroom'])) {
                    !empty($newArr['Listing'][$i]['No_of_Bathroom'])  ? $bath = $newArr['Listing'][$i]['No_of_Bathroom'][0] : $bath = 0;
                } else {
                    $bath = $newArr['Listing'][$i]['No_of_Bathroom'];
                }
                $beds = 0;
                if (is_array($newArr['Listing'][$i]['Bedrooms'])) {
                    !empty($newArr['Listing'][$i]['Bedrooms'])  ? $beds = $newArr['Listing'][$i]['Bedrooms'][0] : $beds = 0;
                } else {
                    $beds = $newArr['Listing'][$i]['Bedrooms'];
                }
                $check_property->title        =  !empty($newArr['Listing'][$i]['Property_Title']) ? $newArr['Listing'][$i]['Property_Title'] : 'N/A';
                $check_property->description  = $newArr['Listing'][$i]['Web_Remarks'];
                $check_property->size_sqft    = $newArr['Listing'][$i]['Unit_Builtup_Area'];     //   $newArr['Listing'][$i]['Plot_Size'];
                $check_property->bath_no      = $bath;
                $check_property->bed_no       = $beds;
                $check_property->update();
                //**UPDATING TITLE AND DESC END HERE */
            }
            //FOR ADDRESS ID//
            $props = Property::all();
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
                //FOR ADDRESS ID//
            }
        }
        return redirect()->route('manage-properties.portals.index')->with('success', 'PropSpace Properties has been added!');
        //return 'true';
    }
    //Creating Property
    public function create_process(Request $request)
    {
        // return $request->all();
        //Getting Property Titles and Converting to array for stroing data in multi language format
        $titles = explode(",", $request->titles);
        //Saving Property Here
        $propertyDataArray = $request->all();
        $propertyDataArray['company_id'] = Auth::user()->id;
        $propertyDataArray['description'] =  $request->descriptions[0];
        $propertyDataArray['title'] = $request->title_english;
        $propertyDataArray['availability'] = $request->availablity;
        $propertyDataArray['built_up_area'] = $request->build_up_area ? $request->build_up_area : 0;
        $propertyDataArray['price_on_application'] = $request->price_on_application == 'on' ? 1 : 0;
        $propertyDataArray['lang_id'] = 1;
        $propertyDataArray['status'] = 0;
        $propertyDataArray['expire_date'] = Carbon::now()->addDays(($request->expire_after * 30));
        if ($request->two_d != 'undefined') {
            if ($request->hasFile('two_d')) {
                $two_d = $request->file('two_d')->store('PropertyFloorPlans', 's3');
                $url1 = Storage::disk('s3')->url($two_d);
                $propertyDataArray['two_d'] = $url1;
            }
        } else {
            $propertyDataArray['two_d'] = null;
        }
        if ($request->three_d != 'undefined') {
            if ($request->hasFile('three_d')) {
                $three_d = $request->file('three_d')->store('PropertyFloorPlans', 's3');
                $url2 = Storage::disk('s3')->url($three_d);
                $propertyDataArray['three_d'] = $url2;
            }
        } else {
            $propertyDataArray['three_d'] = null;
        }
        //** STORE BROUCHER FILE START HERE */
        if ($request->broucher != 'undefined') {
            if ($request->hasFile('broucher')) {
                $broucher = $request->file('broucher')->store('PropertyBroucher', 's3');
                $urlBroucher = Storage::disk('s3')->url($broucher);
                $propertyDataArray['broucher'] = $urlBroucher;
            }
        } else {
            $propertyDataArray['broucher'] = null;
        }
        //** STORE BROUCHER FILE END HERE */

        //SIGNATURE IMAGE SECTION ONE//
        if ($request->signature_image != 'undefined') {
            if ($request->hasFile('signature_image')) {
                $signature_image = $request->file('signature_image')->store('SignatureImages', 's3');
                $url1 = Storage::disk('s3')->url($signature_image);
                $propertyDataArray['signature_image'] = $url1;
            }
        } else {
            $propertyDataArray['signature_image'] = null;
        }

        //SIGNATURE IMAGE SECTION TWO//
        if ($request->signature_section_two_image != 'undefined') {
            if ($request->hasFile('signature_section_two_image')) {
                $signature_section_two_image = $request->file('signature_section_two_image')->store('SignatureImages', 's3');
                $url = Storage::disk('s3')->url($signature_section_two_image);
                $propertyDataArray['signature_section_two_image'] = $url;
            }
        } else {
            $propertyDataArray['signature_section_two_image'] = null;
        }

        //SIGNATURE IMAGE SECTION THREE//
        if ($request->signature_section_three_image != 'undefined') {
            if ($request->hasFile('signature_section_three_image')) {
                $signature_section_three_image = $request->file('signature_section_three_image')->store('SignatureImages', 's3');
                $url = Storage::disk('s3')->url($signature_section_three_image);
                $propertyDataArray['signature_section_three_image'] = $url;
            }
        } else {
            $propertyDataArray['signature_section_three_image'] = null;
        }

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
            $propertyDataArray['status'] = 0;
        }

        $propertyDataArray['size_sqmtr'] = $request->size_sqft / 10.764;

        $popp = Property::create($propertyDataArray);

        if (($request->file_names)) {
            for ($i = 0; $i < count($request->file_names); $i++) {
                $document_files = $request->file('document_files')[$i]->store('DocumentFile', 's3');
                $url3 = Storage::disk('s3')->url($document_files);
                $document = new Document;
                $document->name = $request->file_names[$i];
                $document->file = $url3;
                $document->document_type_id = $request->document_type_ids[$i];
                $document->property_id = $popp->id;
                $document->save();
            }
        }
        //Updating Property Latest Inserted Record
        $last_inserted_record = Property::orderBy('id', 'DESC')->limit(1)->first();

        $property_type = $last_inserted_record->property_type_id == 1 ? 'S' : 'R';

        $slug = 'details-' . $last_inserted_record->id . '.html';

        $prop_ref_no = 'ARZ-' . $property_type . '-' . $last_inserted_record->id;

        Property::where('id', $last_inserted_record->id)->update([
            'slug'        => $slug,
            'description'  =>  $request->descriptions[0],
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
                $propertyDataArray['built_up_area'] = $request->build_up_area ? $request->build_up_area : 0;
                $propertyDataArray['price_on_application'] = $request->price_on_application == 'on' ? 1 : 0;
                $propertyDataArray['lang_id'] = $languages_id[$i];
                $propertyDataArray['availability'] = $request->availablity;
                $propertyDataArray['expire_date'] = Carbon::now()->addDays(($request->expire_after * 30));
                $propertyDataArray['create_by'] = Auth::user()->id;
                if ($request->two_d != 'undefined') {
                    if ($request->hasFile('two_d')) {
                        $two_d = $request->file('two_d')->store('PropertyFloorPlans', 's3');
                        $url4 = Storage::disk('s3')->url($two_d);
                        $propertyDataArray['two_d'] = $url4;
                    }
                } else {
                    $propertyDataArray['two_d'] = null;
                }
                if ($request->three_d != 'undefined') {
                    if ($request->hasFile('three_d')) {
                        $input['file'] = $request->file('three_d')->store('PropertyFloorPlans', 's3');
                        $url = Storage::disk('s3')->url($input['file']);
                        $propertyDataArray['three_d'] = $url;
                    }
                } else {
                    $propertyDataArray['three_d'] = null;
                }

                //** STORE BROUCHER FILE START HERE */
                if ($request->broucher != 'undefined') {
                    if ($request->hasFile('broucher')) {
                        $broucher = $request->file('broucher')->store('PropertyBroucher', 's3');
                        $urlBroucher = Storage::disk('s3')->url($broucher);
                        $propertyDataArray['broucher'] = $urlBroucher;
                    }
                } else {
                    $propertyDataArray['broucher'] = null;
                }
                //** STORE BROUCHER FILE END HERE */

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
                    $propertyDataArray['status'] = 0;
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

        //  if($request->hasFile('images')){
        //      $logoimg = WaterMarkImages::find(1);
        //      for($i = 0; $i < count($request->images); $i++){
        //          $watermark = Image::make($logoimg->file_name)->opacity($logoimg->opacity);
        //          $image = $request->file('images')[$i];

        //          $file_imgs =  $request->file('images')[$i]->store('PropertyImages', 's3');

        //          $imgFile = Image::make($image->getRealPath());
        //          $imgFile->insert($watermark, $logoimg->position, 10, 10, );//'bottom-right',

        //          $url = Storage::disk('s3')->url($file_imgs);

        //           $propertyImages = new PropertyImage;
        //           $propertyImages->property_id = $last_inserted_record->id;
        //           $propertyImages->image = $url; // $request->file('images')[$i]->store('PropertyImages', 'public');
        //           $propertyImages->type = 1;
        //           $propertyImages->save();
        //      }
        //  }
        return 'true';
    }

    //Loading Property View Index Page
    public function edit(Request $request)
    {
        Property::where('location_id', 0)->update(['address_level' => 1]);
        Property::where(['location_area_id' => 0, 'address_level' => 1])->update(['location_area_id' => 1]);
        $property = Property::where('id', $request->id)->first();
        $lat = '';
        $lng = '';
        $level_id = $property->address_level;
        $arid = '';
        // return $property;
        if ($property->address_level == 0) {
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
                $prop->permit_no = $property->permit_no;
                $prop->is_commercial = $property->is_commercial;
                $prop->built_up_area = $property->build_up_area;
                $prop->build_year = $property->build_year;
                $prop->building_floor = $property->building_floor;
                $prop->dewa_no = $property->dewa_no;
                $prop->bed_no = $property->bed_no;
                $prop->bath_no = $property->bath_no;
                $prop->financial_status = $property->financial_status;
                $prop->floor_no = $property->floor_no;
                $prop->furnished_type = $property->furnished_type;
                $prop->layout_type = $property->layout_type;
                $prop->occupacy_id = $property->occupacy_id;
                $prop->parking_no = $property->parking_no;
                $prop->permit_no = $property->permit_no;
                $prop->plot_no = $property->plot_no;
                $prop->price = $property->price;
                $prop->year_price = $property->year_price;
                $prop->month_price = $property->month_price;
                $prop->week_price = $property->week_price;
                $prop->day_price = $property->day_price;
                $prop->slug = $property->slug;
                $prop->prop_ref_no = $property->prop_ref_no;
                $prop->project_name = $property->project_name;
                $prop->street_name = $property->street_name;
                $prop->street_no = $property->street_no;
                $prop->unit_no = $property->unit_no;
                $prop->is_featured = $property->is_featured;
                $prop->is_verified = $property->is_verified;
                $prop->is_boost = $property->is_boost;
                $prop->garage = $property->garage;
                $prop->garage_size = $property->garage_size;
                $prop->price_on_application = $property->price_on_application;
                $prop->property_tenure = $property->property_tenure;
                $prop->renovation_type = $property->renovation_type;
                $prop->service_charges = $property->service_charges;
                $prop->property_type_id = $property->property_type_id;
                $prop->availability = $property->availability;
                $prop->property_category_id = $property->property_category_id;
                $prop->property_status_id = $property->property_status_id;
                $prop->rent_frequency = $property->rent_frequency;
                $prop->size_sqft = $property->size_sqft;
                $prop->size_sqmtr = $property->size_sqmtr;
                $prop->prop_ref_no = $property->prop_ref_no;
                $prop->bed_no = $property->bed_no;
                $prop->bath_no = $property->bath_no;
                $prop->location_state_id = $property->location_state_id;
                $prop->location_area_id = $property->location_area_id;
                $prop->location_id = $property->location_id;
                $prop->location_building_id = $property->location_building_id;
                $prop->views = $property->views;
                $prop->portals = $property->portals;
                $prop->developer_id = $property->developer_id;
                $prop->status = $property->status;
                // $prop->agent_id = $property->agent_id;
                $prop->amenities = $property->amenities;
                $prop->features = $property->features;
                $prop->description = $property->description;
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

                $prop->one_bed_floor_plan = $property->one_bed_floor_plan;
                $prop->two_bed_floor_plan = $property->two_bed_floor_plan;
                $prop->three_bed_floor_plan = $property->three_bed_floor_plan;
                $prop->four_bed_floor_plan = $property->four_bed_floor_plan;
                $prop->studio_floor_plan = $property->studio_floor_plan;
                $prop->off_plan_down_payment = $property->off_plan_down_payment;
                $prop->off_plan_during_consurtion = $property->off_plan_during_consurtion;
                $prop->off_plan_post_handover = $property->off_plan_post_handover;
                $prop->off_plan_overview = $property->off_plan_overview;
                $prop->off_plan_request_more_heading = $property->off_plan_request_more_heading;
                $prop->off_plan_request_more_desc = $property->off_plan_request_more_desc;

                $prop->create_by = $property->create_by;
                $prop->save();
            }
        }
        $property_types = PropertyType::where(['lang_id' => 1, 'type_id' => 0, 'status' => 1])->get();
        $categories = PropertyCategory::with(['sub_categories' => function ($query) {
            $query->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'level' => 1, 'status' => 1, 'property_type_id' => $property->property_type_id])->get();

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
       // return $propertyData;
        $rent_frequency = $propertyData[0]->rent_frequency != "" ? explode(',', $propertyData[0]->rent_frequency) : [];
        $property_views = $propertyData[0]->views != "" ? explode(',', $propertyData[0]->views) : [];
        $property_portals = $propertyData[0]->portals != "" ? explode(',', $propertyData[0]->portals) : [];
        $property_amenities = $propertyData[0]->amenities != "" ? explode(',', $propertyData[0]->amenities) : [];
        $property_features = $propertyData[0]->features != "" ? explode(',', $propertyData[0]->features) : [];
        $property_financial_status = $propertyData[0]->financial_status != "" ? explode(',', $propertyData[0]->financial_status) : [];

        //  $location_country = LocationCountry::with(['location_states' => function($query){
        //      $query->with(['location_areas' => function($query){
        //          $query->with(['locations' => function($query){
        //              $query->with(['buildings' => function($query){
        //                  $query->where(['lang_id' => 1, 'status' => 1]);
        //              }])->where(['lang_id' => 1, 'status' => 1]);
        //          }])->where(['lang_id' => 1, 'status' => 1]);
        //      }])->where(['lang_id' => 1, 'status' => 1]);
        //  }])->where(['lang_id' => 1, 'is_default' => 1])->first();

        $location_country = LocationCountry::with(['location_states' => function ($query) {
            $query->with(['location_areas' => function ($query) {
                $query->where(['lang_id' => 1, 'status' => 1, 'location_state_id' => 1]);
            }])->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'is_default' => 1])->first();



        $document_types = DocumentType::where(['status' => 1])->get();
        $property_images = PropertyImage::where('property_id', $request->id)->get(['id', 'property_id', 'image']);

        return view('properties.list-properties.edit', compact('propertyData', 'arid', 'level_id', 'lat', 'lng', 'property', 'document_types', 'location_country', 'rent_frequency', 'property_portals', 'property_views', 'property_amenities', 'property_features', 'property_financial_status',  'languages', 'prices', 'property_status', 'agents', 'developers', 'portals', 'property_types', 'categories', 'cities', 'sizes', 'views', 'gallaries', 'property_images'));
    }
    //Edit Property Here
    public function edit_process(Request $request)
    {
         // return $request->all();
        //Getting Languages and Converting to array for stroing data in multi language format
        $languages_id = explode(",", $request->languages_names);
        //Getting Descriptions Locations and Converting to array for stroing data in multi language format
        //  $descriptions = explode (",",$request->descriptions);
        //Getting Property Titles and Converting to array for stroing data in multi language format
        $titles = explode(",", $request->titles);

        //Saving Property Here
        $property = Property::find($request->id);
        //return $property;
        $propertyDataArray = $request->except('title_english', 'images', 'titles', 'languages_names', 'build_up_area', 'availablity', 'descriptions', '_token', 'id');

        $propertyDataArray['company_id'] = Auth::user()->id;
        $propertyDataArray['title'] = $request->title_english;
        $propertyDataArray['description'] =  $request->descriptions[0];
        $propertyDataArray['availability'] = $request->availablity;
        $propertyDataArray['built_up_area'] = $request->build_up_area ? $request->build_up_area : 0;
        $propertyDataArray['price_on_application'] = $request->price_on_application == 'on' ? 1 : 0;
        $propertyDataArray['expire_date'] = Carbon::now()->addDays(($request->expire_after * 30));
        $propertyDataArray['modify_by'] = Auth::user()->id;

        $propertyDataArray['off_plan_heading'] = $request->off_plan_heading;
        $propertyDataArray['off_plan_desc'] = $request->off_plan_desc;
        $propertyDataArray['off_plan_overview'] = $request->off_plan_overview;
        $propertyDataArray['off_plan_title_one'] = $request->off_plan_title_one;
        $propertyDataArray['off_plan_title_two'] = $request->off_plan_title_two;
        $propertyDataArray['off_plan_request_more_heading'] = $request->off_plan_request_more_heading;
        $propertyDataArray['off_plan_request_more_desc'] = $request->off_plan_request_more_desc;
        $propertyDataArray['one_bed_floor_plan'] = $request->one_bed_floor_plan;
        $propertyDataArray['two_bed_floor_plan'] = $request->two_bed_floor_plan;
        $propertyDataArray['three_bed_floor_plan'] = $request->three_bed_floor_plan;
        $propertyDataArray['four_bed_floor_plan'] = $request->four_bed_floor_plan;
        $propertyDataArray['studio_floor_plan'] = $request->studio_floor_plan;
        $propertyDataArray['off_plan_down_payment'] = $request->off_plan_down_payment;
        $propertyDataArray['off_plan_during_consurtion'] = $request->off_plan_during_consurtion;
        $propertyDataArray['off_plan_post_handover'] = $request->off_plan_post_handover;



        if ($request->two_d != 'undefined') {
            if ($request->hasFile('two_d')) {
                $input['file'] = $request->file('two_d')->store('PropertyFloorPlans', 's3');
                $url = Storage::disk('s3')->url($input['file']);
                $propertyDataArray['two_d'] =  $url;
            }
        } else {
            $propertyDataArray['two_d'] = $property->two_d;
        }
        if ($request->three_d != 'undefined') {
            if ($request->hasFile('three_d')) {
                $input['file'] = $request->file('three_d')->store('PropertyFloorPlans', 's3');
                $url = Storage::disk('s3')->url($input['file']);
                $propertyDataArray['three_d'] = $url;
            }
        } else {
            $propertyDataArray['three_d'] = $property->three_d;
        }

        //** STORE BROUCHER FILE START HERE */
        if ($request->broucher != 'undefined') {
            if ($request->hasFile('broucher')) {
                $broucher = $request->file('broucher')->store('PropertyBroucher', 's3');
                $urlBroucher = Storage::disk('s3')->url($broucher);
                $propertyDataArray['broucher'] = $urlBroucher;
            }
        } else {
            $propertyDataArray['broucher'] = null;
        }
        //** STORE BROUCHER FILE END HERE */

        //SIGNATURE IMAGE//
        if ($request->signature_image != 'undefined') {
            if ($request->hasFile('signature_image')) {
                $signature_image = $request->file('signature_image')->store('SignatureImages', 's3');
                $url1 = Storage::disk('s3')->url($signature_image);
                $propertyDataArray['signature_image'] = $url1;
            }
        } else {
            $propertyDataArray['signature_image'] = $property->signature_image;
        }

        //SIGNATURE IMAGE SECTION TWO//
        if ($request->signature_section_two_image != 'undefined') {
            if ($request->hasFile('signature_section_two_image')) {
                $signature_section_two_image = $request->file('signature_section_two_image')->store('SignatureImages', 's3');
                $url = Storage::disk('s3')->url($signature_section_two_image);
                $propertyDataArray['signature_section_two_image'] = $url;
            }
        } else {
            $propertyDataArray['signature_section_two_image'] = $property->signature_section_two_image;
        }

        //SIGNATURE IMAGE SECTION THREE//
        if ($request->signature_section_three_image != 'undefined') {
            if ($request->hasFile('signature_section_three_image')) {
                $signature_section_three_image = $request->file('signature_section_three_image')->store('SignatureImages', 's3');
                $url = Storage::disk('s3')->url($signature_section_three_image);
                $propertyDataArray['signature_section_three_image'] = $url;
            }
        } else {
            $propertyDataArray['signature_section_three_image'] = $property->signature_section_three_image;
        }

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
        $propertyDataArray['size_sqmtr'] = $request->size_sqft / 10.764;
        Property::where('id', $request->id)->update($propertyDataArray);
        //Creating Records for Multi Languages
        for ($i = 1; $i < count($languages_id); $i++) {
            $propertyDataArray = $request->except('title_english', 'images', 'titles', 'languages_names', 'build_up_area', 'availablity', 'descriptions', '_token', 'id');
            $propertyDataArray['company_id'] = Auth::user()->id;
            $propertyDataArray['title'] = $titles[$i];
            $propertyDataArray['description'] =  $request->descriptions[$i];
            $propertyDataArray['built_up_area'] = $request->build_up_area ? $request->build_up_area : 0;
            $propertyDataArray['price_on_application'] = $request->price_on_application == 'on' ? 1 : 0;
            $propertyDataArray['lang_id'] = $languages_id[$i];
            $propertyDataArray['availability'] = $request->availablity;
            $propertyDataArray['expire_date'] = Carbon::now()->addDays(($request->expire_after * 30));
            $propertyDataArray['create_by'] = Auth::user()->id;

            $propertyDataArray['off_plan_heading'] = $request->off_plan_heading;
            $propertyDataArray['off_plan_desc'] = $request->off_plan_desc;
            $propertyDataArray['off_plan_overview'] = $request->off_plan_overview;
            $propertyDataArray['off_plan_request_more_heading'] = $request->off_plan_request_more_heading;
            $propertyDataArray['off_plan_title_one'] = $request->off_plan_title_one;
            $propertyDataArray['off_plan_title_two'] = $request->off_plan_title_two;
            $propertyDataArray['off_plan_request_more_desc'] = $request->off_plan_request_more_desc;
            $propertyDataArray['one_bed_floor_plan'] = $request->one_bed_floor_plan;
            $propertyDataArray['two_bed_floor_plan'] = $request->two_bed_floor_plan;
            $propertyDataArray['three_bed_floor_plan'] = $request->three_bed_floor_plan;
            $propertyDataArray['four_bed_floor_plan'] = $request->four_bed_floor_plan;
            $propertyDataArray['studio_floor_plan'] = $request->studio_floor_plan;
            $propertyDataArray['off_plan_down_payment'] = $request->off_plan_down_payment;
            $propertyDataArray['off_plan_during_consurtion'] = $request->off_plan_during_consurtion;
            $propertyDataArray['off_plan_post_handover'] = $request->off_plan_post_handover;

            if ($request->two_d != 'undefined') {
                if ($request->hasFile('two_d')) {
                    $input['file'] = $request->file('two_d')->store('PropertyFloorPlans', 's3');
                    $url = Storage::disk('s3')->url($input['file']);
                    $propertyDataArray['two_d'] = $url;
                }
            } else {
                $propertyDataArray['two_d'] = null;
            }
            if ($request->three_d != 'undefined') {
                if ($request->hasFile('three_d')) {
                    $input['file'] = $request->file('three_d')->store('PropertyFloorPlans', 's3');
                    $url = Storage::disk('s3')->url($input['file']);
                    $propertyDataArray['three_d'] = $url;
                }
            } else {
                $propertyDataArray['three_d'] = null;
            }

            //** STORE BROUCHER FILE START HERE */
            if ($request->broucher != 'undefined') {
                if ($request->hasFile('broucher')) {
                    $broucher = $request->file('broucher')->store('PropertyBroucher', 's3');
                    $urlBroucher = Storage::disk('s3')->url($broucher);
                    $propertyDataArray['broucher'] = $urlBroucher;
                }
            } else {
                $propertyDataArray['broucher'] = null;
            }
            //** STORE BROUCHER FILE END HERE */

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
    //=========================================================
    //CREATE XML FILE FOR BAYUT//
    //=========================================================
    public function property_bayut_xml_file()
    {
        $amenities = Amenity::where(['lang_id' => 1, 'status' => 1])->get();

        if (Auth::user() && Auth::user()->role_id != 1) {
            $properties = Property::with('developer', 'images', 'state', 'type', 'category', 'agent')
                ->with(['state' => function ($query) {
                    $query->with('location_areas');
                }])->where(['lang_id' => 1, 'create_by' => Auth::user()->id])->where('portals', 'LIKE', '%' . '4' . '%')->get();
        } else {
            $properties = Property::with('developer', 'images', 'type', 'category', 'agent')
                ->with(['state' => function ($query) {
                    $query->with('location_areas');
                }])
                ->orderBy('id', 'DESC')->where(['lang_id' => 1])->where('portals', 'LIKE', '%' . '4' . '%')->get();
        }

        foreach ($properties as $property) {
            foreach ($property->state->location_areas as $pro) {
                if ($property->location_area_id == $pro->id) {
                    $property->area = $pro->name;
                }
            }
        }
        // return $properties;

        $result = [];
        foreach ($properties as $pro) {
            $amenities_html = [];
            $amenities_arr = explode(",", $pro->amenities);
            $images = '';
            foreach ($pro->images as $image) {
                // $images .= asset('storage/').'/'.$image->image  .  '|' ;
                $images .= $image->image  .  '|';
            }
            for ($i = 0; $i < count($amenities_arr); $i++) {

                foreach ($amenities as $amnty) {

                    if ($amnty->id == $amenities_arr[$i]) {
                        // $amenity['Feature'] = "<![CDATA[".$amnty->name."]]>";
                        array_push($amenities_html, "<![CDATA[" . $amnty->name . "]]>");
                        /// $amenities_html .= $amnty->name .'|' ;
                    }
                }
            }
            //$amenities_html=['Feature'=>"Bed",'Feature'=>"bath"];
            $result[] = [
                'Property_Status' => $pro->status == 2 ? "<![CDATA[live]]>" : "<![CDATA[archive]]>",
                'Property_purpose' => $pro->type->name == 'Sale' ? "<![CDATA[Buy]]>" : "<![CDATA[Rent]]>",
                'Property_Type' => "<![CDATA[" . $pro->category->name . "]]>",
                'Property_Size' => "<![CDATA[" . $pro->size_sqft . "]]>",
                'Property_Size_Unit' => "<![CDATA[SqFt]]>",
                'Bedrooms' => "<![CDATA[" . $pro->bed_no . "]]>",
                'Bathroom' => "<![CDATA[" . $pro->bath_no . "]]>",
                'Features' => $amenities_html,
                'Images' => "<![CDATA[" . $images . "]]>",
                'Videos' => "<![CDATA[" . $pro->youtube_link . "]]>",
                'Floor_Plans' => '',
                'Off_plan'   => '',
                'city' => "<![CDATA[" . $pro->area . "]]>",
                'Locality' => "<![CDATA[" . $pro->state->name . "]]>",
                'Sub_Locality' => "<![CDATA[" . $pro->street_name . "]]>",
                'Tower_Name' => '',
                'Last_Updated' => "<![CDATA[" . $pro->updated_at . "]]>",
                'Price' => "<![CDATA[" . $pro->price . "]]>",
                'Rent_Frequency' => '',
                'Property_Title' => "<![CDATA[" . $pro->title . "]]>",
                'Property_Description' => "<![CDATA[" . $pro->description . "]]>",
                'Property_Title_AR' => '',
                'Property_Description_AR' => '',
                'Listing_Agent' => $pro->agent != '' ? "<![CDATA[" . $pro->agent->name . "]]>" : '',
                'Listing_Agent_Email' => $pro->agent != '' ? "<![CDATA[" . $pro->agent->email . "]]>" : '',
                'Listing_Agent_Phone' => $pro->agent != '' ? "<![CDATA[" . $pro->agent->phone . "]]>" : '',
                'Permit_Number' => "<![CDATA[" . $pro->permit_no . "]]>",
                'Property_Ref_No' => "<![CDATA[" . $pro->prop_ref_no . "]]>"
            ];
        }
        return response()->xml(['property' => $result]);
    }


    //=========================================================
    //CREATE XML FILE FOR jamesedition//
    //=========================================================
    public function property_jamesedition_xml_file()
    {
        $amenities = Amenity::where(['lang_id' => 1, 'status' => 1])->get();

        if (Auth::user() && Auth::user()->role_id != 1) {
            $properties = Property::with('developer', 'images', 'state', 'type', 'category', 'agent')
                ->with(['state' => function ($query) {
                    $query->with('location_areas');
                }])->where(['lang_id' => 1, 'create_by' => Auth::user()->id])->where('portals', 'LIKE', '%' . '6' . '%')->get();
        } else {
            $properties = Property::with('developer', 'images', 'type', 'category', 'agent')
                ->with(['state' => function ($query) {
                    $query->with('location_areas');
                }])
                ->orderBy('id', 'DESC')->where(['lang_id' => 1])->where('portals', 'LIKE', '%' . '6' . '%')->get();
        }

        foreach ($properties as $property) {
            foreach ($property->state->location_areas as $pro) {
                if ($property->location_area_id == $pro->id) {
                    $property->area = $pro->name;
                }
            }
        }
        // return $properties;

        $result = [];
        foreach ($properties as $pro) {
            $amenities_html = [];
            $amenities_arr = explode(",", $pro->amenities);
            $images = '';
            foreach ($pro->images as $image) {
                // $images .= asset('storage/').'/'.$image->image  .  '|' ;
                $images .= $image->image  .  '|';
            }
            for ($i = 0; $i < count($amenities_arr); $i++) {

                foreach ($amenities as $amnty) {

                    if ($amnty->id == $amenities_arr[$i]) {
                        // $amenity['Feature'] = "<![CDATA[".$amnty->name."]]>";
                        array_push($amenities_html, "<![CDATA[" . $amnty->name . "]]>");
                        /// $amenities_html .= $amnty->name .'|' ;
                    }
                }
            }
            //$amenities_html=['Feature'=>"Bed",'Feature'=>"bath"];
            $result[] = [
                'Property_Status' => $pro->status == 2 ? "<![CDATA[live]]>" : "<![CDATA[archive]]>",
                'Property_purpose' => $pro->type->name == 'Sale' ? "<![CDATA[Buy]]>" : "<![CDATA[Rent]]>",
                'Property_Type' => "<![CDATA[" . $pro->category->name . "]]>",
                'Property_Size' => "<![CDATA[" . $pro->size_sqft . "]]>",
                'Property_Size_Unit' => "<![CDATA[SqFt]]>",
                'Bedrooms' => "<![CDATA[" . $pro->bed_no . "]]>",
                'Bathroom' => "<![CDATA[" . $pro->bath_no . "]]>",
                'Features' => $amenities_html,
                'Images' => "<![CDATA[" . $images . "]]>",
                'Videos' => "<![CDATA[" . $pro->youtube_link . "]]>",
                'Floor_Plans' => '',
                'Off_plan'   => '',
                'city' => "<![CDATA[" . $pro->area . "]]>",
                'Locality' => "<![CDATA[" . $pro->state->name . "]]>",
                'Sub_Locality' => "<![CDATA[" . $pro->street_name . "]]>",
                'Tower_Name' => '',
                'Last_Updated' => "<![CDATA[" . $pro->updated_at . "]]>",
                'Price' => "<![CDATA[" . $pro->price . "]]>",
                'Rent_Frequency' => '',
                'Property_Title' => "<![CDATA[" . $pro->title . "]]>",
                'Property_Description' => "<![CDATA[" . $pro->description . "]]>",
                'Property_Title_AR' => '',
                'Property_Description_AR' => '',
                'Listing_Agent' => $pro->agent != '' ? "<![CDATA[" . $pro->agent->name . "]]>" : '',
                'Listing_Agent_Email' => $pro->agent != '' ? "<![CDATA[" . $pro->agent->email . "]]>" : '',
                'Listing_Agent_Phone' => $pro->agent != '' ? "<![CDATA[" . $pro->agent->phone . "]]>" : '',
                'Permit_Number' => "<![CDATA[" . $pro->permit_no . "]]>",
                'Property_Ref_No' => "<![CDATA[" . $pro->prop_ref_no . "]]>"
            ];
        }
        return response()->xml(['property' => $result]);
    }

    //Advance Search Start here//
    public function advance_search(Request $request)
    {
        // return $request->all();
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
        $amenities = Amenity::where(['lang_id' => 1, 'status' => 1])->get();
        $agentusers = User::where('role_id', 3)->orderBy('id', 'DESC')->get();
        $property_types = PropertyType::where(['lang_id' => 1, 'type_id' => 0, 'status' => 1])->get();
        $categories = PropertyCategory::with(['sub_categories' => function ($query) {
            $query->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'level' => 1, 'status' => 1, 'property_type_id' => $property_types[0]->id])->get();
        $properties = Property::with('category', 'type', 'state')->filter($request)->get();
        return view('properties.list-properties.advance_search_index')
            ->with('properties', $properties)
            ->with('property_category', $property_category)
            ->with('agentusers', $agentusers)
            ->with('location_country', $location_country)
            ->with('categories', $categories)
            ->with('amenities', $amenities);
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
