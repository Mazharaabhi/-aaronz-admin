@extends('layouts.master')
@section('title', 'List Property')
@section('first', 'List Property')
@section('second', 'Manage Properties')
@section('third', 'List Property')

@section('content')
<style>
    .label-w-100{
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
   label .btn.btn-sm.float-right i{
        margin: auto;
        padding: 0;
    }
    #subsale{
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
                                        <a href="{{ route('offplan.property.create') }}" class="btn btn-cherwell font-weight-bolder mr-1" id="OpenAddModel">
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
                                <form action="{{ route('manage-properties.property.advance-search') }}" method="POST" name="advance_search">
                                 @csrf
                                <div class="row">
                                    <div class="col col-4">
                                        <div class="row  mb-3">
                                            <div class="col col-4">Purpose:</div>
                                            <div class="col col-8">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input purpose" value="0" type="radio" name="purpose" id="purpose1" checked>
                                                    <label class="form-check-label" for="purpose1">
                                                      Any
                                                    </label>
                                                  </div>
                                                  <div class="form-check form-check-inline">
                                                    <input class="form-check-input purpose" value="1" type="radio" name="purpose" id="purpose2" >
                                                    <label class="form-check-label" for="purpose2">
                                                        Sale
                                                    </label>
                                                  </div>
                                                  <div class="form-check form-check-inline">
                                                    <input class="form-check-input purpose" value="3" type="radio" name="purpose" id="purpose3" >
                                                    <label class="form-check-label" for="purpose3">
                                                      Rent
                                                    </label>
                                                  </div>
                                                  <div id="subsale" >
                                                  <div class="form-check form-check-inline">
                                                    <input class="form-check-input purpose" value="13" type="radio" name="purpose" id="purpose4" >
                                                    <label class="form-check-label" for="purpose4">
                                                        Off Plan
                                                    </label>
                                                  </div>
                                                  <div class="form-check form-check-inline">
                                                    <input class="form-check-input purpose" value="11" type="radio" name="purpose" id="purpose5" >
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
                                                <select name="location_id" id="location_id" class="form-control" >
                                                    <option value=""></option>
                                                            {{-- For Country --}}
                                                            {{-- <option value="{{ $location_country->id }}">{{ $location_country->short_name }}</option> --}}
                                                            {{-- For State --}}
                                                            @forelse ($location_country->location_states as $state)
                                                                <option value="{{ '0,'.$state->id.','.$state->latitude.','.$state->longitude }}">{{ $state->name }}</option>
                                                                {{-- For Area --}}
                                                                @forelse ($state->location_areas as $area)
                                                                    <option value="{{ '1,'.$area->id.','.$area->latitude.','.$area->longitude }}">{{ $area->name }}, {{ $state->name }}</option>
                                                                    {{-- For Locations --}}
                                                                    @forelse ($area->locations as $location)
                                                                        <option value="{{ '2,'.$location->id.','.$location->latitude.','.$location->longitude }}">{{ $location->name }}, {{ $area->name }}, {{ $state->name }}</option>
                                                                        {{-- For Locations --}}
                                                                        @forelse ($location->buildings as $building)
                                                                        <option value="{{ '3,'.$building->id.','.$building->latitude.','.$building->longitude }}">{{ $building->name }}, {{ $location->name }}, {{ $area->name }}, {{ $state->name }}</option>
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
                                                <input class="form-control form-control-sm" name="ref_id" id="ref_id" type="text" placeholder="" aria-label=".form-control-sm example">
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
                                                        <option value="{{ $item->id }}" {{ $item->sub_categories->count() ? 'disabled' : '' }}>{{ $item->name }}</option>
                                                        @if ($item->sub_categories->count())
                                                            @foreach ($item->sub_categories as $sub_item)
                                                                <option value="{{ $sub_item->id }}">-- {{ $sub_item->name }}</option>
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
                                                        <input class="form-control form-control-sm" list="beds_min_options" name="beds_min" id="beds_min" placeholder="Min">
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

                                                    <input class="form-control form-control-sm" list="beds_max_options" name="beds_max" id="beds_max" placeholder="Max">
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
                                                    @if( $item->name != '')
                                                        <option value="{{ $item->id}}">{{ $item->name}}</option>
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
                                                    <input class="form-check-input listing_type" value="1" type="checkbox" name="hot" id="flexRadioDefault2" >
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                      Hot
                                                    </label>
                                                  </div>
                                                  <div class="form-check form-check-inline">
                                                    <input class="form-check-input" value="1" type="checkbox" name="signature" id="flexRadioDefault3" >
                                                    <label class="form-check-label" for="flexRadioDefault3">
                                                        Signature
                                                    </label>
                                                  </div>
                                                  <div class="form-check form-check-inline">
                                                    <input class="form-check-input" value="1" type="checkbox" name="basic" id="flexRadioDefault4" >
                                                    <label class="form-check-label" for="flexRadioDefault4">
                                                        Basic
                                                    </label>
                                                  </div>
                                                  <div class="form-check form-check-inline">
                                                    <input class="form-check-input" value="1" type="checkbox" name="verified" id="flexRadioDefault5" >
                                                    <label class="form-check-label" for="flexRadioDefault5">
                                                        Verified
                                                    </label>
                                                  </div>
                                                  <div class="form-check form-check-inline">
                                                    <input class="form-check-input" value="1" type="checkbox" name="featured" id="flexRadioDefault6" >
                                                    <label class="form-check-label" for="flexRadioDefault6">
                                                        Featured
                                                    </label>
                                                  </div>
                                                  <div class="form-check form-check-inline">
                                                    <input class="form-check-input" value="1" type="checkbox" name="boostsale" id="flexRadioDefault7" >
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
                                            <a href="{{ route('offplan.property.index')}}" role="button"   class="btn btn-outline-primary mx-2">Cancel</a>
                                            <!--end::Button-->
                                            <!--begin::Button-->
                                            <button type="submit" id="quicksearch_123" name="quicksearch" class="btn btn-primary mx-2">Search</button>
                                            {{-- <a href="{{ route('properties.xml.file') }}" name="xml_file" class="btn btn-warning mx-2">Export XML</a> --}}
                                            {{-- <a href="{{ route('properties.import.xml.file') }}" name="xml_file" class="btn btn-success mx-2">Import XML</a> --}}
                                    </div>
                                </div>
                        </div>
                    </form>
                            </div>
                            <!--end::Search Form-->

                            <!--begin: Datatable-->
                            <div>
                                {{-- <table id="users-table" class="table users-table">
                                    <thead>
                                        <tr>
                                            <th width="5%">Id</th>
                                            <th>Purpose</th>
                                            <th>Type</th>
                                            <th>Beds</th>
                                            <th>Location</th>
                                            <th>Area</th>
                                            <th>Assigned</th>
                                            <th>Price</th>
                                            <th>Expiry Data</th>
                                            <th>Developers</th>
                                            <th>Status</th>
                                            <th class="text-center" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                </table> --}}

                                <table id="users-table" class="table">
                                    <thead>
                                        <tr>
                                            <th width="5%">Id</th>
                                            <th>Ref.No</th>
                                            <th>Title</th>
                                            <th>Expiry Data</th>
                                            <th>Cities</th>
                                            <th>Sort Order</th>
                                            <th>Status</th>
                                            <th class="text-center" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                </table>

                            </div>
                            <!--end: Datatable-->

                    <!--end::Card-->

                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('properties.list-off-plan-properties.js.index');
@endsection


