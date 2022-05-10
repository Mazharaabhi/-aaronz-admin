@extends('layouts.master')
@section('title', 'List Service')
@section('first', 'Manage Services')
@section('second', 'List Service')
@section('third', 'Create')
@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                {{-- <div class="card-body"> --}}
                    <div class="card-header">
                        <div>
                            @include('languages')
                        </div>
                        <div class="card-toolbar">
                           <div class="example-tools justify-content-center">
                               <a href="{{ route('manage-services.list-service.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>List Service:</legend>
                            <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-3">
                                    <label for="">Service Categories</label>
                                    <select name="service_category_id" id="service_category_id" class="form-control">
                                        <option value=""></option>
                                        @if ($service_categories->count())
                                            @foreach ($service_categories as $item)
                                                    <option value="{{ $item->id }}" {{ $storedData[0]->service_category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger" id="service_category_id_error"></span>
                                </div>
                                <!-- grid column -->
                                <div class="col-md-6 mb-3">
                                    <label for="">Service Sub Categories</label>
                                    <select name="service_sub_category_id" id="service_sub_category_id" class="form-control">
                                        <option value=""></option>
                                    </select>
                                    <span class="text-danger" id="service_sub_category_id_error"></span>
                                </div>
                                <!-- grid column -->
                                <!-- Property Title grid column -->
                                @foreach ($languages as $key => $item)
                                <div class="col-md-6 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_{{ $item->id }}">
                                <label for="title_english">Title {{ $item->name }}</label>
                                <input type="text" name="title_english[]" @if($item->direction == 'Right') dir="rtl" @endif id="title_english_{{ $item->id }}" value="{{ $storedData[$key]->title }}" class="form-control">
                                <span id="title_english_error" class="text-danger"></span>
                                </div>
                                <input type="hidden" name="languages[]" value="{{ $item->id }}" id="languages">
                                @endforeach
                                <!-- /End Property Title grid column -->
                                <div class="col-md-6 mb-3">
                                    <label for="">Service Charges (Daily)</label>
                                    <input type="text" name="daily_charges" id="daily_charges" class="form-control" value="{{ $storedData[0]->daily_charges }}" placeholder="0.00" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    <span class="text-danger" id="daily_charges_error"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Service Charges (Hourly)</label>
                                    <input type="text" name="hourly_charges" id="hourly_charges" class="form-control" value="{{ $storedData[0]->hourly_charges }}" placeholder="0.00" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    <span class="text-danger" id="hourly_charges_error"></span>
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-10">
                                    <label for="location_id">Property Location*</label>
                                    <select name="location_id" id="location_id" class="form-control" multiple>
                                        <option value=""></option>
                                                {{-- For Country --}}
                                                {{-- <option value="{{ $location_country->id }}">{{ $location_country->short_name }}</option> --}}
                                                {{-- For State --}}
                                                @if (count($location_country->location_states) > 0)
                                                        @foreach ($location_country->location_states as $key => $state)
                                                        <option value="{{ '0.'.$state->id }}" {{ isset($property_locations[$key]) && $property_locations[$key] == '0.'.$state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                                        {{-- For Area --}}
                                                        @if (count($state->location_areas) > 0)
                                                                @foreach ($state->location_areas as $area_key => $area)
                                                                <option value="{{ '1.'.$area->id }}" {{ isset($property_locations[$area_key]) && $property_locations[$area_key] == '1.'.$area->id ? 'selected' : '' }}>{{ $area->name }}, {{ $state->name }}</option>
                                                                {{-- For Locations --}}
                                                                @if (count($area->locations) > 0)
                                                                    @foreach ($area->locations as $location_key => $location)
                                                                    <option value="{{ '2.'.$location->id}}" {{ isset($property_locations[$location_key]) && $property_locations[$location_key] == '2.'.$location->id ? 'selected' : '' }}>{{ $location->name }}, {{ $area->name }}, {{ $state->name }}</option>
                                                                    {{-- For Locations --}}
                                                                    @if (count($location->buildings) > 0)
                                                                        @foreach ($location->buildings as $building_key => $building)
                                                                        <option value="{{ '3.'.$building->id}}" {{ isset($property_locations[$building_key]) && $property_locations[$building_key] == '3.'.$building->id ? 'selected' : '' }}>{{ $building->name }}, {{ $location->name }}, {{ $area->name }}, {{ $state->name }}</option>


                                                                        @endforeach
                                                                    @endif

                                                                @endforeach
                                                                @endif

                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                    </select>
                                    <span class="text-danger" id="location_id_error"></span>
                                </div>
                                <div class="col-md-12 col-lg-12 mb-4 ">
                                    <label class="mr-2">Upload Image</label>
                                    <div class="group-contain" style="
                                    display: flex;
                                    ">
                                    <div class="btn btn-secondary fileinput-button" style="line-height: 2;height: 50px;">
                                        <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                        <input id="fileupload-btn-one" type="file" name="file-one" accept="image/*">
                                    </div>
                                    <div class="form-group" style="
                                        display: block;
                                        margin: 0 auto;
                                        ">
                                        <div id="uploadList" class="list-group list-group-flush list-group-divider" style="margin: auto;">
                                            <img loading="lazy" src="{{ asset('storage/'.$storedData[0]->image) }}" alt="Preview Image" id="blah-one" class="">
                                        </div>
                                    </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <span id="image_one_error" class="text-danger"></span>
                                </div>
                                <!-- Property Description grid column -->
                                @foreach ($languages as $key => $sub)
                                <div class="col-md-12 mb-3 {{ $sub->id != 1 ? 'd-none' : '' }}" id="description_div_{{ $sub->id }}">
                                  <label for="description">Description {{ $sub->name }}</label>
                                  <textarea name="descriptions[]" id="description_english_{{ $sub->id }}" @if($sub->direction == 'Right') dir="rtl" @endif cols="30" rows="10" class="form-control">
                                        {{ $storedData[$key]->description }}
                                  </textarea>
                                  <span id="description_error" class="text-danger"></span>
                                </div>
                                @endforeach
                                <!-- /End Property Description grid column -->
                            </div>
                        </fieldset>
                        <button type="button" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" id="add_language">
                            <span class="svg-icon svg-icon-md fa fa-floppy-o"></span>
                                @lang('translation.save')
                        </button>
                    </div>

                {{-- </div> --}}
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('services.list-service.js.edit');
@endsection
