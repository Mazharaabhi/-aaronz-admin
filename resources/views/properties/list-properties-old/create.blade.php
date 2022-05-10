@extends('layouts.master')
@section('title', 'List Property')
@section('first', 'List Property')
@section('second', 'Manage Properties')
@section('third', 'List Property')
@section('fourth', 'Create')

@section('content')
<style>
    .label-w-100{
        display: block;
    }
    .select2-container {
    width: 100% !important;
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
</style>
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
                               <a href="{{ route('manage-properties.property.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Property Details:</legend>
                            <div class="row">
                                <!-- Property Title grid column -->
                                @foreach ($languages as $item)
                                <div class="col-md-8 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_{{ $item->id }}">
                                  <label for="title_english"><b>Title {{ $item->name }}</b></label>
                                  <input type="text" name="title_english[]" @if($item->direction == 'Right') dir="rtl" @endif id="title_english_{{ $item->id }}" class="form-control" autofocus>
                                  <small id="title_english_error" class="text-danger"></small>
                                </div>
                                <input type="hidden" name="languages[]" value="{{ $item->id }}" id="languages">
                                @endforeach
                                <!-- /End Property Title grid column -->

                                <!-- Property Permit No. grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3">
                                    <label for=""><b>Permit No.</b></label>
                                    <input type="text" name="permit_no" id="permit_no" placeholder="Permit No." class="form-control">
                                    <span class="text-danger" id="permit_no_error"></span>
                                </div>
                                <!--/ End Property Permit No. grid column -->

                                <!-- Property Type grid column -->
                                <div class="col-md-3 col-lg-3 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'><b>Property Type</b></label>
                                    <select name="type_id" id="type_id" class="form-control">
                                        @if ($property_types->count())
                                        @foreach ($property_types as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger" id="type_id_error"></span>
                                </div>
                                <!--/ End Property Type grid column -->

                                <!-- Property Categories grid column -->
                                <div class="col-md-3 col-lg-3 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'><b>Property Category</b> <button class="btn btn-sm float-right" type="button" data-toggle="modal" data-target="#propertyCategoryModel"><i class="fa fa-plus text-success"></i></button></label>
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
                                <div class="col-md-3 col-lg-3 col-sm-12 mb-3" id="property_status_div">
                                    <label for="" class='label-w-100'><b>Property Status</b> <button class="btn btn-sm float-right" type="button" data-toggle="modal" data-target="#propertyStatusModel"><i class="fa fa-plus text-success"></i></button></label>
                                    <select name="property_status_id" id="property_status_id" class="form-control">
                                        @if ($property_status->count())
                                        @foreach ($property_status as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                    <span class="text-danger" id="property_status_id_error"></span>
                                </div>
                                <!--/ End Property Status  grid column -->

                                <!-- Property Prices grid column -->
                                <div class="col-md-3 col-lg-3 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'><b>Price </b>(In AED)</label>
                                    <input type="text" name="price" id="price" placeholder="Enter Price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control">
                                    <span class="text-danger" id="price_id_error"></span>
                                </div>
                                <!--/ End Property Prices grid column -->

                                <!-- Property Size grid column -->
                                <div class="col-md-3 col-lg-3 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'><b>Size </b>(In Sqft)</label>
                                    <select name="size_sqft" id="size_sqft" class="form-control">
                                        <option value="">--select size---</option>
                                        @if ($sizes->count())
                                            @foreach ($sizes as $item)
                                                <option value="{{ $item->id }}">{{ $item->compact_size }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger" id="size_sqft_error"></span>
                                </div>
                                <!--/ End Property Size grid column -->

                                 <!-- Property Size grid column -->
                                 <div class="col-md-3 col-lg-3 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'><b>Size </b>(In Sqmt)</label>
                                    <select name="size_sqmt" id="size_sqmt" class="form-control">
                                        <option value="">--select size---</option>
                                        @if ($sizes->count())
                                            @foreach ($sizes as $item)
                                                <option value="{{ $item->id }}">{{ $item->compact_size }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger" id="size_sqmt_error"></span>
                                </div>
                                <!--/ End Property Size grid column -->

                                 <!-- Property Rent Frequecy grid column -->
                                <div class="col-md-6 col-lg-6 col-sm-12 mb-3 d-none w-100" id="frequent">
                                    <label for="" class='label-w-100'><b>Rent Frequency</b></label>
                                    <select name="rent_frequency" id="rent_frequency" class="form-control" multiple>
                                        <option value="">---select rent frequency---</option>
                                        <option value="">All</option>
                                        <option value="Yearly">Yearly</option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Weekly">Weekly</option>
                                        <option value="Daily">Daily</option>
                                    </select>
                                    <span class="text-danger" id="rent_frequency_error"></span>
                                </div>
                                <!--/ End Property Rent Frequecy grid column -->

                                 <!-- Property Bath Rooms grid column -->
                                <div class="col-md-3 col-lg-3 col-sm-12 mb-3" id="bed_div">
                                    <label for="" class='label-w-100'><b>Bedroom</b></label>
                                    <select name="bed_no" id="bed_no" class="form-control">
                                        <option value="">---select bedroom---</option>
                                        <option value="0">Studio</option>
                                        @for ($i = 1; $i < 8; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <span class="text-danger" id="bed_no_error"></span>
                                </div>
                                <!--/ End Property Bath Rooms grid column -->

                                <!-- Property Bed Rooms grid column -->
                                <div class="col-md-3 col-lg-3 col-sm-12 mb-3" id="bath_div">
                                    <label for="" class='label-w-100'><b>Bath</b></label>
                                    <select name="bath_no" id="bath_no" class="form-control">
                                        <option value="">---select bathroom---</option>
                                        @for ($i = 1; $i < 8; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <span class="text-danger" id="bath_no_error"></span>
                                </div>
                                <!--/ End Bed Rooms Frequecy grid column -->


                                <!-- Property Views grid column -->
                                <div class="col-md-3 col-lg-3 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'><b>View</b> <button class="btn btn-sm float-right" type="button" data-toggle="modal" data-target="#propertyViewModel"><i class="fa fa-plus text-success"></i></button></label>
                                    <select name="view_id" id="view_id" class="form-control" multiple>
                                        <option value="">---select View---</option>
                                        @if ($views->count())
                                            @foreach ($views as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger" id="view_id_error"></span>
                                </div>
                                <!--/ End Views Frequecy grid column -->

                                <!-- Property Developers grid column -->
                                <div class="col-md-3 col-lg-3 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'><b>Developer</b> <button class="btn btn-sm float-right" type="button" data-toggle="modal" data-target="#propertyDeveloperModel"><i class="fa fa-plus text-success"></i></button></label>
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
                                <div class="col-md-3 col-lg-3 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'><b>Agent</b> <button class="btn btn-sm float-right" type="button" data-toggle="modal" data-target="#propertyAgentModel"><i class="fa fa-plus text-success"></i></button></label>
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
                                <!--/ End Agents Frequecy grid column -->

                                <!-- Property Agents grid column -->
                                <div class="col-md-3 col-lg-3 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'><b>Expire After</b></label>
                                    <select name="expire_after" id="expire_after" class="form-control">
                                        <option value="1">1 Month</option>
                                        <option value="3">3 Month</option>
                                        <option value="6">6 Month</option>
                                    </select>
                                    <span class="text-danger" id="agent_id_error"></span>
                                </div>
                                <!--/ End Agents Frequecy grid column -->

                                <!-- Property Amenity And Features grid column -->
                                <div class="col-md-12 col-sm-12 col-lg-12 mt-3 mb-3">
                                    <label for=""><b>Amenities / Feature</b></label><br>
                                    {{-- For Amenities --}}
                                    <a class="btn btn-primary btn-sm collapsed" role="button" data-toggle="collapse" href="#amenitesData" aria-expanded="false" aria-controls="collapseExample">
                                        Select Amenities
                                    </a>
                                    <div class="collapse mt-3" id="amenitesData" aria-expanded="false" style="height: 0px;">
                                        <div style="display: block;width: 95%;" class="demo-checkbox col-md-12" id="amenitesDataDiv">
                                        </div>
                                    </div>
                                    {{-- For Features --}}
                                    <a class="btn btn-cherwell btn-sm collapsed" role="button" data-toggle="collapse" href="#featuresData" aria-expanded="false" aria-controls="collapseExample">
                                        Select Features
                                    </a>
                                    <div class="collapse mt-3" id="featuresData" aria-expanded="false" style="height: 0px;">
                                        <div style="display: block;width: 95%;" class="demo-checkbox col-md-12" id="featuresDataDiv">
                                        </div>
                                    </div>
                                </div>
                                <!-- /End Property Amenity And Features grid column -->

                                <!-- Property Description grid column -->
                                @foreach ($languages as $item)
                                <div class="col-md-12 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="description_div_{{ $item->id }}">
                                  <label for="description"><b>Description {{ $item->name }}</b></label>
                                  <textarea name="descriptions[]" id="description_{{ $item->id }}" @if($item->direction == 'Right') dir="rtl" @endif cols="30" rows="10" class="form-control"></textarea>
                                  <small id="description_error" class="text-danger"></small>
                                </div>
                                @endforeach
                                <!-- /End Property Description grid column -->

                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Property Locations:</legend>
                            <div class="row">
                                <!-- Property Cities grid column -->
                                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                                    <label for="" class="label-w-100"><b>Cities</b> <button class="btn btn-sm float-right" type="button" data-toggle="modal" data-target="#propertyStateModel"><i class="fa fa-plus text-success"></i></button></label>
                                    <select name="state_id" id="state_id" class="form-control">
                                        <option value="">---select country---</option>
                                        @if ($cities->count())
                                            @foreach ($cities as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger" id="state_id_error"></span>
                                </div>
                                <!-- /End Property Cities grid column -->

                                <!-- Property Location grid column -->
                                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                                    <label for="" class="label-w-100"><b>Area</b> <button class="btn btn-sm float-right" type="button" data-toggle="modal" data-target="#propertyAreaModel"><i class="fa fa-plus text-success"></i></button></label>
                                    <select name="area_id" id="area_id" class="form-control">
                                        <option value="">---select area---</option>
                                    </select>
                                    <span class="text-danger" id="area_id_error"></span>
                                </div>
                                <!-- /End Property Location grid column -->

                                <!-- Property Location grid column -->
                                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                                    <label for="" class="label-w-100"><b>Location</b> <button class="btn btn-sm float-right" type="button" data-toggle="modal" data-target="#propertyLocationModel"><i class="fa fa-plus text-success"></i></button></label>
                                    <select name="location_id" id="location_id" class="form-control">
                                        <option value="">---select location---</option>
                                    </select>
                                    <span class="text-danger" id="location_id_error"></span>
                                </div>
                                <!-- /End Property Location grid column -->


                                <!-- Property Map Location grid column -->
                                <div class="col-md-8 col-lg-8 col-sm-12 mb-3" id="mapbox_search_div">
                                    <label for=""><b>Property Map Location</b></label>
                                    <div id="geocoder"></div>
                                </div>
                                @foreach ($languages as $item)
                                <div class="col-md-8 col-lg-8 col-sm-12 mb-3 d-none" id="address_div_{{ $item->id }}">
                                    <label for=""><b>Property Map Location</b></label>
                                    <div id="geocoder"></div>
                                    <input type="text" name="addresses[]" id="address_{{ $item->id }}"  @if($item->direction == 'Right') dir="rtl" @endif class="form-control">
                                </div>
                                @endforeach
                                <div class="col-md-8 col-lg-8 col-sm-12 mb-3 ">
                                    <span class="text-danger" id="address_error"></span>
                                </div>
                                <!-- /End Property Map Location grid column -->

                                <!-- Property Map Box grid column -->
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                    <div id='map' style='width: 100%; height: 500px;'></div>
                                </div>
                                <!-- /End Property Map Box grid column -->


                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Porperty Images</legend>
                            <div class="row">
                                <!-- Property Base Images grid column -->
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                                    <label for=""><b>Base Images</b></label>
                                    <form enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="file-loading">
                                                <input id="file-1" type="file" multiple class="file" data-overwrite-initial="false"  data-theme="fas">
                                            </div>
                                        </div>
                                    </form>
                                    <span class="text-danger" id="base_images_error"></span>
                                </div>
                                <!-- /End Property Base Images grid column -->
                                {{-- <div class="col-md-12 col-lg-12 col-sm-12">
                                    <label for=""><b>Gallarey Images</b></label>
                                    @if ($gallaries->count())
                                        @foreach ($gallaries as $item)
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#div_{{ $item->id }}" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fas fa-folder-open"></i> Add {{ $item->title }} Images
                                        </a>
                                        <div class="collapse mt-3" id="div_{{ $item->id }}" aria-expanded="false" style="height: 0px;">
                                            <form enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="file-loading">
                                                        <input id="file-1" type="file" multiple class="file" data-overwrite-initial="false"  data-theme="fas">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        @endforeach
                                    @endif
                                </div> --}}
                            </div>

                        </fieldset>
                        <fieldset>
                            <legend>Property Videos External Links:</legend>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                                    <label for="">Youtube Link</label>
                                    <input type="text" name="youtube_link" id="youtube_link" class="form-control" placeholder="https://youtube.com">
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                                    <label for="">360 degree Video Link</label>
                                    <input type="text" name="video_link" id="video_link" class="form-control" placeholder="https://example.com">
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
<script>
    function pushBtnClick(obj,name,value)
    {
        old_purpose = $("#purpose").val();
        old_ptype = $("#ptype").val();
        old_type = $("#type").val();
        if( typeof obj == "string" )//COMMENT: when called programically with field name
        {
            obj = I(obj);
            onchange_method = window[obj.name+"_onchange"];
            if( typeof onchange_method == "function" ) onchange_method.call( 0,obj,obj.value );
            return;
        }
        pushBtnDiv = $(obj).parent();
        pushBtnDiv.find(".pushBtnLabel").removeClass("checked").filter(obj).addClass("checked");
        input = pushBtnDiv.find("input").val( value ).get(0);
        onchange_method = window[name+"_onchange"];
        if( typeof onchange_method == "function" ) onchange_method.call( 0,input,value );

        if(name == 'purpose'){

            if(old_purpose != value ) {
                $("#ptype_push_buttons .checked").removeClass("checked");
                $("#type_push_buttons .checked").removeClass("checked");
                $("#ptype").val("");
                $("#type").val("");
                $('.div_type').css("display","none");
            }
        }
        else if( name == 'ptype'){

            if(old_ptype != value ) {
                purpose = $('#purpose').val();
                console.log(value);
                $("#type_push_buttons .checked").removeClass("checked");
                $("#type").val("");
            }
        }
        else if(name == 'type'){

            if(old_type != value ) {
                purpose = $('#purpose').val();
                ptype = $('#ptype').val();
            }
        }
    }
    </script>
@include('properties.list-properties.modals');
@include('properties.list-properties.js.create');
@endsection
