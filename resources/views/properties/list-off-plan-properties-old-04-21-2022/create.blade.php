@extends('layouts.master')
@section('title', 'List Property')
@section('first', 'List Property')
@section('second', 'Manage Properties')
@section('third', 'List Property')
@section('fourth', 'Create')
@section('content')
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
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
    #advance_features .is_featured, #advance_features label{
        cursor: pointer;
    }
    .kv-file-upload {
        display: none;
    }
    .fileinput-remove-button{
        display: none;
    }
    .fileinput-upload-button{
        display: none;
    }
</style>
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                {{-- <div class="card-body"> --}}
                    <div class="card-header">
                        <div class="card-toolbar">
                           <div class="example-tools justify-content-right" style="justify-content: right">
                               <a href="{{ route('manage-properties.property.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span>Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Property Types:</legend>
                            <div class="row">
                                 <!-- Property Type grid column -->
                                 <div class="col-md-12">
                                    <label for="" class='label-w-100'>Property Type</label>
                                 </div>
                                 <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                                    <select name="type_id" id="type_id" disabled class="form-control">
                                        @if ($property_types->count())
                                        @foreach ($property_types as $item)
                                            <option value="{{ $item->id }}" @if($item->id == 1) {{ 'selected' }} @endif >{{ $item->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger" id="type_id_error"></span>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                                    <select name="is_commercial" id="is_commercial" class="form-control">
                                        <option value="0">Commercial</option>
                                        <option value="1">Residential</option>
                                    </select>
                                    <span class="text-danger" id="is_commercial_error"></span>
                                </div>
                                <!--/ End Property Type grid column -->
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Specifications:</legend>
                            <div class="row">
                                 <!-- Property Categories grid column -->
                                 <div class="col-md-4 col-lg-4 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'>Property Category * <button class="btn btn-sm float-right" type="button" data-toggle="modal" data-target="#propertyCategoryModel"><i class="fa fa-plus text-success"></i></button></label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">---property category---</option>
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
                                    <span class="text-danger" id="category_id_error"></span>
                                </div>
                                <!--/ End Property Categories grid column -->

                                <!-- Property Property Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="property_status_div">
                                    <label for="" class='label-w-100'>Property Status <button class="btn btn-sm float-right" type="button" data-toggle="modal" data-target="#propertyStatusModel"><i class="fa fa-plus text-success"></i></button></label>
                                    <select name="property_status_id" disabled id="property_status_id" class="form-control">
                                        @if ($property_status->count())
                                        @foreach ($property_status as $item)
                                            <option value="{{ $item->id }}" @if($item->id == 13) {{ 'selected' }} @endif>{{ $item->name }}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                    <span class="text-danger" id="property_status_id_error"></span>
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'>Developer<button class="btn btn-sm float-right" type="button" data-toggle="modal" data-target="#propertyDeveloperModel"><i class="fa fa-plus text-success"></i></button></label>
                                    <select name="developer_id" id="developer_id" class="form-control">
                                        <option value="">---select developer---</option>
                                        @if ($developers->count())
                                            @foreach ($developers as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger" id="developer_id_error"></span>
                                </div>
                                <!--/ End Developers Frequecy grid column -->

                                <!-- Property Agents grid column -->

                                 <div class="col-md-4 col-lg-4 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'>Agent *<button class="btn btn-sm float-right" type="button" data-toggle="modal" data-target="#propertyAgentModel"><i class="fa fa-plus text-success"></i></button></label>
                                    <select name="agent_id" id="agent_id" class="form-control">
                                        <option value="">---select agent---</option>
                                        @if ($agents->count())
                                            @foreach ($agents as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger" id="agent_id_error"></span>
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3">
                                    <label for="">Link.</label>
                                    <input type="text" name="off_plan_url" id="off_plan_url" placeholder="offplan link" class="form-control">
                                    <span class="text-danger" id="off_plan_url_error"></span>
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3">
                                    <label for="">Year of Completion.</label>
                                    <input type="date" name="expiry_date" id="expiry_date" placeholder="expiry_date" class="form-control">
                                    <span class="text-danger" id="expiry_date_error"></span>
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3">
                                    <label for="">Release Time.</label>
                                    <select class="form-control" id="off_plan_release_time" name="off_plan_release_time">
                                        <option value="">select release time</option>
                                        <option value="1">0-3 months</option>
                                        <option value="2">3-6 months</option>
                                        <option value="3">6-9 months</option>
                                        <option value="4">9-12 months</option>
                                        <option value="5">1 year and more</option>
                                    </select>
                                    {{-- <input type="date" name="release_time" id="release_time" placeholder="release_time" class="form-control"> --}}
                                    <span class="text-danger" id="off_plan_release_time_error"></span>
                                </div>
                                </div>
                        </fieldset>
                        <fieldset>
                            <legend>Description</legend>
                            <div class="row">
                                    <!-- Property Title grid column -->
                                    @foreach ($languages as $item)
                                    <div class="col-md-8 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_{{ $item->id }}">
                                    <label for="title_english">Title {{ $item->name }} *</label>
                                    <input type="text" name="title_english[]" @if($item->direction == 'Right') dir="rtl" @endif id="title_english_{{ $item->id }}" class="form-control">
                                    <span id="title_english_error" class="text-danger"></span>
                                    </div>
                                    <input type="hidden" name="languages[]" value="{{ $item->id }}" id="languages">
                                    @endforeach
                                    <!-- /End Property Title grid column -->
                                    <div class="col-md-4 mb-3 text-right">
                                            @include('languages')
                                    </div>
                            </div>
                                   <!-- Property Description grid column -->
                                   {{-- @foreach ($languages as $sub)
                                   <div class="col-md-12 mb-3 {{ $sub->id != 1 ? 'd-none' : '' }}" id="description_div_{{ $sub->id }}">
                                     <label for="description">Description {{ $sub->name }}</label>
                                     <textarea name="descriptions[]" id="description_{{ $sub->id }}" @if($sub->direction == 'Right') dir="rtl" @endif cols="30" rows="10" class="form-control"></textarea>
                                     <span id="description_error" class="text-danger"></span>
                                   </div>
                                   @endforeach --}}
                                   <div class="row">
                                    @foreach ($languages as $item)
                                    <div class="col-md-12 col-lg-12 mb-6 {{ $item->id != 1 ? 'd-none' : '' }}" id="description_div_{{ $item->id }}">
                                        <label class="mr-2">Descriptions {{ $item->name }}</label>
                                          <textarea class="form-control" @if($item->direction == 'Right') dir="rtl" @endif name="descriptions_{{ $item->id }}" id="descriptions_{{ $item->id }}"></textarea>
                                        <small id="descriptions_error" class="text-danger"></small>
                                    </div>
                                    @php
                                        ($item->direction == 'Right') ?   $dir = 'rtl' : $dir = 'ltr';
                                    @endphp
                                    <script>
                                        setTimeout(function(){
                                            CKEDITOR.replace('descriptions_{{ $item->id }}', {
                                                contentsLangDirection: "{{ $dir }}",
                                                scayt_customerId: '1:Eebp63-lWHbt2-ASpHy4-AYUpy2-fo3mk4-sKrza1-NsuXy4-I1XZC2-0u2F54-aqYWd1-l3Qf14-umd',
                                                scayt_sLang: 'auto',
                                                removeButtons: 'PasteFromWord'
                                                });

                                        }, 1000);
                                    </script>
                                    @endforeach
                                </div>
                        </fieldset>

                        <fieldset>
                            <legend>Property Locations:</legend>
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-sm-12 mb-10">
                                            <label for="location_id">Property Location*</label>
                                            <select name="location_id" id="location_id" class="form-control" onchange="SetMap(this)">
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
                                                                {{-- @forelse ($area->locations as $location) --}}
                                                                    {{-- <option value="{{ '2,'.$location->id.','.$location->latitude.','.$location->longitude }}">{{ $location->name }} {{ $area->name }}, {{ $state->name }}</option> --}}
                                                                    {{-- For Locations --}}
                                                                    {{--  @forelse ($location->buildings as $building)  --}}
                                                                    {{--  <option value="{{ '3,'.$building->id.','.$building->latitude.','.$building->longitude }}">{{ $building->name }}, {{ $location->name }}, {{ $area->name }}, {{ $state->name }}</option>  --}}
                                                                    {{-- @empty --}}

                                                                    {{-- @endforelse --}}
                                                                @empty

                                                                {{--  @endforelse
                                                            @empty  --}}

                                                            @endforelse
                                                        @empty
                                                        @endforelse
                                            </select>
                                            <span class="text-danger" id="location_id_error"></span>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-sm-12 mb-10">
                                            <label for="">Project Name</label>
                                            <input type="text" name="project_name" id="project_name" placeholder="Project Name" class="form-control">
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-sm-12 mb-10">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                    <label for="">Street Name</label>
                                                    <input type="text" name="street_name" id="street_name" class="form-control">
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-sm-12">
                                                    <label for="">Street No.</label>
                                                    <input type="text" name="stree_no" id="street_no" class="form-control">
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-sm-12">
                                                    <label for="">Unit No.</label>
                                                    <input type="text" name="unit_no" id="unit_no" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div id="map"></div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Property Images</legend>
                            <div class="row">
                                <!-- Property Base Images grid column -->
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                                    <label for="">Base Images *</label>
                                    <form enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="file-loading">
                                                <input id="file-1" type="file" multiple class="file" data-overwrite-initial="false"  data-theme="fas">
                                            </div>
                                        </div>
                                    </form>
                                    <span class="text-danger" id="base_images_error"></span>
                                </div>
                            </div>

                        </fieldset>
                        <fieldset>
                            <legend>SEO SECTION</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" name="meta_title" id="meta_title" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="meta_description">Meta Descriptions</label>
                                    <input type="text" name="meta_description" id="meta_description" class="form-control" />
                                </div>
                            </div>
                        </fieldset>
                        <button type="button" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" id="create_property">
                            <span class="svg-icon svg-icon-md fa fa-floppy-o"></span>
                                List New Property
                        </button>
                    </div>

                {{-- </div> --}}
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('properties.list-properties.modals')
@include('properties.list-off-plan-properties.js.create')
@endsection

