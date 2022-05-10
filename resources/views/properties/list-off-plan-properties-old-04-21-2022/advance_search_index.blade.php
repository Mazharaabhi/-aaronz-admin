@extends('layouts.master')
@section('title', 'List Property')
@section('first', 'List Property')
@section('second', 'Manage Properties')
@section('third', 'List Property')

@section('content')
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <style>
        .label-w-100 {
            display: block;
        }

        .select2-container {
            width: 100% !important;
        }

        #map {
            height: 100%;
        }

        label .btn.btn-sm.float-right {
            text-align: center;
            padding: 4px;
            margin-top: -2px !important;
            margin: 5px;
            box-shadow: 0px 0.5px 4px -0.5px #00000069;
            border-radius: 4px;
        }

        label .btn.btn-sm.float-right i {
            margin: auto;
            padding: 0;
        }

        #subsale {
            display: none;
        }

    </style>
    <div class="content d-flex flex-column flex-column-fluid">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <!--begin::Search Form-->
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-lg-6 col-xl-6">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 my-2 my-md-0">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 d-flex justify-content-end">
                                    <!--begin::Button-->
                                    <a href="{{ route('manage-properties.property.create') }}"
                                        class="btn btn-cherwell font-weight-bolder mr-1" id="OpenAddModel">
                                        <span class="svg-icon svg-icon-md fa fa-plus">
                                        </span>@lang('translation.create')</a>
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <a href="#" class="btn btn-cherwell font-weight-bolder" id="reload">
                                        <span class="svg-icon svg-icon-md fa fa-refresh">
                                        </span>@lang('translation.reload')</a>
                                    <!--end::Button-->

                                </div>
                            </div>
                            <h3>QUICK SEARCH</h3>
                            <form action="{{ route('manage-properties.property.advance-search') }}" method="POST"
                                name="advance_search">
                                @csrf
                                <div class="row">

                                    <div class="col col-4">
                                        <div class="row  mb-3">
                                            <div class="col col-4">Purpose:</div>
                                            <div class="col col-8">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input purpose" value="0" type="radio"
                                                        name="purpose" id="purpose1" checked>
                                                    <label class="form-check-label" for="purpose1">
                                                        Any
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input purpose" value="1" type="radio"
                                                        name="purpose" id="purpose2">
                                                    <label class="form-check-label" for="purpose2">
                                                        Sale
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input purpose" value="3" type="radio"
                                                        name="purpose" id="purpose3">
                                                    <label class="form-check-label" for="purpose3">
                                                        Rent
                                                    </label>
                                                </div>
                                                <div id="subsale">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input purpose" value="13" type="radio"
                                                            name="purpose" id="purpose4">
                                                        <label class="form-check-label" for="purpose4">
                                                            Off Plan
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input purpose" value="11" type="radio"
                                                            name="purpose" id="purpose5">
                                                        <label class="form-check-label" for="purpose5">
                                                            Ready to Move
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-4">Location:</div>
                                            <div class="col col-8">
                                                <select name="location_id" id="location_id" class="form-control">
                                                    <option value=""></option>
                                                    {{-- For Country --}}
                                                    {{-- <option value="{{ $location_country->id }}">{{ $location_country->short_name }}</option> --}}
                                                    {{-- For State --}}
                                                    @forelse ($location_country->location_states as $state)
                                                        <option
                                                            value="{{ '0,' . $state->id . ',' . $state->latitude . ',' . $state->longitude }}">
                                                            {{ $state->name }}</option>
                                                        {{-- For Area --}}
                                                        @forelse ($state->location_areas as $area)
                                                            <option
                                                                value="{{ '1,' . $area->id . ',' . $area->latitude . ',' . $area->longitude }}">
                                                                {{ $area->name }}, {{ $state->name }}</option>
                                                            {{-- For Locations --}}
                                                            @forelse ($area->locations as $location)
                                                                <option
                                                                    value="{{ '2,' . $location->id . ',' . $location->latitude . ',' . $location->longitude }}">
                                                                    {{ $location->name }}, {{ $area->name }},
                                                                    {{ $state->name }}</option>
                                                                {{-- For Locations --}}
                                                                @forelse ($location->buildings as $building)
                                                                    <option
                                                                        value="{{ '3,' . $building->id . ',' . $building->latitude . ',' . $building->longitude }}">
                                                                        {{ $building->name }}, {{ $location->name }},
                                                                        {{ $area->name }}, {{ $state->name }}</option>
                                                                @empty
                                                                @endforelse
                                                            @empty

                                                            @endforelse
                                                        @empty

                                                        @endforelse
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-4">REF ID:</div>
                                            <div class="col col-8">
                                                <input class="form-control form-control-sm" name="ref_id" id="ref_id"
                                                    type="text" placeholder="" aria-label=".form-control-sm example">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col col-4">

                                        <div class="row mb-3">
                                            <div class="col col-4">Property Type:</div>
                                            <div class="col col-8">
                                                <select name="category_id" id="category_id" class="form-control">
                                                    <option value=""></option>
                                                    @if ($categories->count())
                                                        @foreach ($categories as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->sub_categories->count() ? 'disabled' : '' }}>
                                                                {{ $item->name }}</option>
                                                            @if ($item->sub_categories->count())
                                                                @foreach ($item->sub_categories as $sub_item)
                                                                    <option value="{{ $sub_item->id }}">--
                                                                        {{ $sub_item->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col col-4">
                                                <label for="beds" class="form-label">Beds:</label>
                                            </div>
                                            <div class="col col-8">
                                                <div class="row">
                                                    <div class="col col-6">
                                                        <input class="form-control form-control-sm" list="beds_min_options"
                                                            name="beds_min" id="beds_min" placeholder="Min">
                                                        <datalist id="beds_min_options">
                                                            <option value="Studio">
                                                            <option value="1">
                                                            <option value="2">
                                                            <option value="3">
                                                            <option value="4">
                                                            <option value="5">
                                                            <option value="6">
                                                            <option value="7">
                                                            <option value="8">
                                                            <option value="9">
                                                            <option value="10">
                                                            <option value="1">
                                                            <option value="12">
                                                            <option value="13">
                                                            <option value="14">
                                                            <option value="15">
                                                            <option value="16">
                                                            <option value="17">
                                                            <option value="18">
                                                            <option value="19">
                                                            <option value="20">
                                                            <option value="20+">
                                                        </datalist>
                                                    </div>
                                                    <div class="col col-6">

                                                        <input class="form-control form-control-sm" list="beds_max_options"
                                                            name="beds_max" id="beds_max" placeholder="Max">
                                                        <datalist id="beds_max_options">
                                                            <option value="Studio">
                                                            <option value="1">
                                                            <option value="2">
                                                            <option value="3">
                                                            <option value="4">
                                                            <option value="5">
                                                            <option value="6">
                                                            <option value="7">
                                                            <option value="8">
                                                            <option value="9">
                                                            <option value="10">
                                                            <option value="1">
                                                            <option value="12">
                                                            <option value="13">
                                                            <option value="14">
                                                            <option value="15">
                                                            <option value="16">
                                                            <option value="17">
                                                            <option value="18">
                                                            <option value="19">
                                                            <option value="20">
                                                            <option value="20+">
                                                        </datalist>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col col-4">
                                        {{-- <div class="form-group">
                                            <label>Meta Keywords</label>
                                            <input type="text" class="form-control tagify" placeholder="Enter Meta Keywords..." name="meta_keywords" id="kt_tagify_1" value="" />
                                            <div class="mt-3">
                                                <a href="javascript:;" id="kt_tagify_1_remove" class="btn btn-sm btn-light-primary font-weight-bold">Remove all tags</a>
                                            </div>
                                        </div> --}}
                                        {{-- ========= --}}
                                        {{-- <div class="row mb-3">
                                            <div class="col col-4">Validation Status:</div>
                                            <div class="col col-8" >
                                                <input type="text" class="form-control tagify" placeholder="Enter Meta Keywords..." name="meta_keywords" id="kt_tagify_1" value="" style="height:100px; max-height:200px; overflow:scroll" />
                                                <div class="mt-3">
                                                    <a href="javascript:;" id="kt_tagify_1_remove" class="btn btn-sm btn-light-primary font-weight-bold">Remove all tags</a>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="row">
                                            <div class="col col-4">Assigned:</div>
                                            <div class="col col-8">
                                                <select name="assigned" id="assigned" class="form-control">
                                                    @if ($agentusers->count())
                                                        <option value="0">select agent</option>
                                                        @foreach ($agentusers as $item)
                                                            @if ($item->name != '')
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-4 pr-0">Listing Type:</div>
                                            <div class="col col-8 pr-0">
                                                {{-- <div class="form-check form-check-inline">
                                                    <input class="form-check-input listing_type" type="radio" name="listing_type" id="flexRadioDefault1" checked>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                      All
                                                    </label>
                                                  </div> --}}
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input listing_type" value="1" type="checkbox"
                                                        name="hot" id="flexRadioDefault2">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Hot
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" value="1" type="checkbox"
                                                        name="signature" id="flexRadioDefault3">
                                                    <label class="form-check-label" for="flexRadioDefault3">
                                                        Signature
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" value="1" type="checkbox" name="basic"
                                                        id="flexRadioDefault4">
                                                    <label class="form-check-label" for="flexRadioDefault4">
                                                        Basic
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" value="1" type="checkbox"
                                                        name="verified" id="flexRadioDefault5">
                                                    <label class="form-check-label" for="flexRadioDefault5">
                                                        Verified
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" value="1" type="checkbox"
                                                        name="featured" id="flexRadioDefault6">
                                                    <label class="form-check-label" for="flexRadioDefault6">
                                                        Featured
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" value="1" type="checkbox"
                                                        name="boostsale" id="flexRadioDefault7">
                                                    <label class="form-check-label" for="flexRadioDefault7">
                                                        Boost Sale
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row mb-3">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Amanities</label>
                                            <select class="form-control select2 select2-hidden-accessible" id="kt_select2_3" name="param" multiple="" data-select2-id="kt_select2_3" tabindex="-1" aria-hidden="true">
                                                 @foreach ($amenities as $amenity)
                                                    <option value="{{$amenity->id}}">{{$amenity->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 my-2 my-md-0">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 d-flex justify-content-end">
                                        <!--begin::Button-->
                                        <a href="{{ route('manage-properties.property.index') }}" role="button"
                                            class="btn btn-outline-primary mx-2">Cancel</a>
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        <button type="submit" id="quicksearch_123" name="quicksearch"
                                            class="btn btn-primary mx-2">Search</button>
                                        {{-- <a href="{{ route('properties.xml.file') }}" name="xml_file" class="btn btn-warning mx-2">Export XML</a> --}}
                                        {{-- <a href="{{ route('properties.import.xml.file') }}" name="xml_file" class="btn btn-success mx-2">Import XML</a> --}}
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                    <div>
                        <table id="data-table-id" class="table">
                            <thead>
                                <tr>
                                    <th width="5%">Id</th>
                                    <th>Ref.no</th>
                                    <th>Title</th>
                                    <th>Expiry Data</th>
                                    <th>Cities</th>
                                    <th>Sort Order</th>
                                    <th>Signature</th>
                                    <th>Feature</th>
                                    <th>Verify</th>
                                    <th>Boost</th>
                                     <th>Status</th>
                                    <th class="text-center" width="10%">Action</th>
                                </tr>
                            </thead>
                            @if (count($properties) > 0)
                                @foreach ($properties as $key => $property)
                                    <tr>
                                        <td>
                                            {{ ++$key }}
                                        </td>
                                        <td>
                                            {{ $property->prop_ref_no }}
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('manage-properties.property.edit', ['id' => $property->id]) }}">{{ $property->title }}</a><br>
                                            @if ($property->price == '')

                                                @php
                                                    echo number_format(0);
                                                @endphp

                                            @else
                                                @php
                                                    echo number_format($property->price);
                                                @endphp
                                            @endif
                                            {{ $property->category->name }} | {{ $property->type->name }} |
                                            {{ $property->agent != '' ? $property->agent->name : '' }}
                                        </td>
                                        <td>
                                            {{ $property->expire_date }}
                                        </td>
                                        <td>
                                            {{ $property->state->name }}
                                        </td>
                                        <td>
                                            <input type="number" name="property_sort_order" data-id="{{ $property->id }}"
                                                id="property_sort_order" value="{{ $property->sort_order }}"
                                                class="form-control" />
                                        </td>
                                        <td>
                                            @if ($property->is_signature == 1)
                                                <input type="hidden" name="id" value="{{ $property->id }}" />
                                                <input type="checkbox" id="is_signature"
                                                    data-id="{{ $property->is_signature }}" style="cursor:pointer"
                                                    checked="checked" name="is_signature" />

                                            @else
                                                <input type="hidden" name="id" value="{{ $property->id }}" />
                                                <input type="checkbox" id="is_signature"
                                                    data-id="{{ $property->is_signature }}" style="cursor:pointer"
                                                    name="is_signature" />
                                            @endif
                                        </td>
                                        <td>
                                            @if ($property->is_featured == 1)
                                                <input type="hidden" name="id" value="{{ $property->id }}" />
                                                <input type="checkbox" id="is_featured"
                                                    data-id="{{ $property->is_featured }}" style="cursor:pointer"
                                                    checked="checked" name="is_featured" />

                                            @else
                                                <input type="hidden" name="id" value="{{ $property->id }}" />
                                                <input type="checkbox" id="is_featured"
                                                    data-id="{{ $property->is_featured }}" style="cursor:pointer"
                                                    name="is_featured" />
                                            @endif
                                        </td>
                                        <td>
                                            @if ($property->is_verified == 1)
                                                <input type="hidden" name="id" value="{{ $property->id }}" />
                                                <input type="checkbox" id="is_verified"
                                                    data-id="{{ $property->is_verified }}" style="cursor:pointer"
                                                    checked="checked" name="is_verified" />
                                            @else
                                                <input type="hidden" name="id" value="{{ $property->id }}" />
                                                <input type="checkbox" id="is_verified"
                                                    data-id="{{ $property->is_verified }}" style="cursor:pointer"
                                                    name="is_verified" />
                                            @endif
                                        </td>
                                        <td>
                                            @if ($property->is_boost == 1)
                                                <input type="hidden" name="id" value="{{ $property->id }}" />
                                                <input type="checkbox" id="is_boost" data-id="{{ $property->is_boost }}"
                                                    style="cursor:pointer" checked="checked" name="is_boost" />
                                            @else
                                                <input type="hidden" name="id" value="{{ $property->id }}" />
                                                <input type="checkbox" id="is_boost" data-id="{{ $property->is_boost }}"
                                                    style="cursor:pointer" name="is_boost" />
                                            @endif
                                        </td>
                                        <td>
                                            <input type="hidden" name="id" value="{{ $property->id }}" />
                                            <input type="hidden" name="status" value="{{ $property->status }}" />
                                            <select id="property_status" clas="form-control">
                                                <option value="0" {{ $property->status == 0 ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="2" {{ $property->status == 2 ? 'selected' : '' }}>
                                                    Published</option>
                                                <option value="3" {{ $property->status == 3 ? 'selected' : '' }}>
                                                    Rejected</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{ route('manage-properties.property.edit', ['id' => $property->id]) }}"
                                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1"
                                                data-toggle="tooltip" data-theme="dark" title="Edit">
                                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path
                                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
                                                            </path>
                                                            <path
                                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </a>
                                            <input type="hidden" name="id" value="{{ $property->id }}">
                                            <a id="delete_language" data-id="{{ $property->id }}"
                                                class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip"
                                                data-theme="dark" title="Delete">
                                                <span class="svg-icon svg-icon-md svg-icon-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path
                                                                d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                                fill="#000000" fill-rule="nonzero"></path>
                                                            <path
                                                                d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                fill="#000000" opacity="0.3"></path>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>

                    </div>
                    <!--end: Datatable-->

                    <!--end::Card-->

                </div>
            </div>
        </div>
        {{-- {{ $properties->links() }} --}}
        <!--end::Container-->
    </div>
    <!--end::Entry-->
    @include('properties.list-properties.js.advance_search_index');
@endsection
