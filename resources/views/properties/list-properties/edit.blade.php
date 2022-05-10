@extends('layouts.master')
@section('title', 'List Property')
@section('first', 'List Property')
@section('second', 'Manage Properties')
@section('third', 'List Property')
@section('fourth', 'Edit')
@section('content')
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
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

        #advance_features .is_featured,
        #advance_features label {
            cursor: pointer;
        }

        .kv-file-upload {
            display: none;
        }

        .fileinput-remove-button {
            display: none;
        }

        .fileinput-upload-button {
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
                                <a href="{{ route('manage-properties.property.index') }}"
                                    class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span>Back</a>
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
                                    <select name="type_id" id="type_id" class="form-control">
                                        @if ($property_types->count())
                                            @foreach ($property_types as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $propertyData[0]->property_type_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger" id="type_id_error"></span>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                                    <select name="is_commercial" id="is_commercial" class="form-control">
                                        <option value="0" {{ $propertyData[0]->is_commercial == 0 ? 'selected' : '' }}>
                                            Commercial</option>
                                        <option value="1" {{ $propertyData[0]->is_commercial == 1 ? 'selected' : '' }}>
                                            Residential</option>
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
                                    <label for="" class='label-w-100'>Property Category * <button
                                            class="btn btn-sm float-right" type="button" data-toggle="modal"
                                            data-target="#propertyCategoryModel"><i
                                                class="fa fa-plus text-success"></i></button></label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">---property category---</option>
                                        @if ($categories->count())
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $propertyData[0]->property_category_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger" id="category_id_error"></span>
                                </div>
                                <!--/ End Property Categories grid column -->

                                <!-- Property Property Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="property_status_div">
                                    <label for="" class='label-w-100'>Property Status <button class="btn btn-sm float-right"
                                            type="button" data-toggle="modal" data-target="#propertyStatusModel"><i
                                                class="fa fa-plus text-success"></i></button></label>
                                    <select name="property_status_id" id="property_status_id" disabled="disabled" class="form-control">
                                                <option value="19" selected="selected">Ready Properties</option>
                                    </select>
                                    <span class="text-danger" id="property_status_id_error"></span>
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Bath Rooms grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'>Size (Sqft) *</label>
                                    <input type="text" name="size" id="size" placeholder="Enter size"
                                        value="{{ $propertyData[0]->size_sqft }}"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        class="form-control">
                                    <span class="text-danger" id="size_sqft_error"></span>
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Bath Rooms grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="include_1">
                                    <label for="" class='label-w-100'>Bedroom</label>
                                    <select name="bed_no" id="bed_no" class="form-control">
                                        <option value="">---select bedroom---</option>
                                        <option value="0" {{ $propertyData[0]->bed_no == 0 ? 'selected' : '' }}>Studio
                                        </option>
                                        @for ($i = 1; $i < 8; $i++)
                                            <option value="{{ $i }}"
                                                {{ $propertyData[0]->bed_no == $i ? 'selected' : '' }}>
                                                {{ $i }}</option>
                                        @endfor
                                    </select>
                                    <span class="text-danger" id="bed_no_error"></span>
                                </div>
                                <!--/ End Property Bath Rooms grid column -->

                                <!-- Property Bed Rooms grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="include_2">
                                    <label for="" class='label-w-100'>Bathrooms</label>
                                    <select name="bath_no" id="bath_no" class="form-control">
                                        <option value="">---select bathroom---</option>
                                        @for ($i = 1; $i < 8; $i++)
                                            <option value="{{ $i }}"
                                                {{ $propertyData[0]->bath_no == $i ? 'selected' : '' }}>
                                                {{ $i }}</option>
                                        @endfor
                                    </select>
                                    <span class="text-danger" id="bath_no_error"></span>
                                </div>
                                <!--/ End Bed Rooms Frequecy grid column -->

                                <!-- Property Size grid column -->

                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3 d-none w-100" id="frequent">
                                    <label for="" class='label-w-100'>Rent Frequency</label>
                                    <select name="rent_frequency" id="rent_frequency" class="form-control" multiple>
                                        <option value="">---select rent frequency---</option>
                                        <option value="Yearly"
                                            @if (count($rent_frequency) > 0) @foreach ($rent_frequency as $rf) {{ $rf == 'Yearly' ? 'selected' : '' }} @endforeach
                                            @endif>Yearly</option>
                                        <option value="Monthly"
                                            @if (count($rent_frequency) > 0) @foreach ($rent_frequency as $rf) {{ $rf == 'Monthly' ? 'selected' : '' }} @endforeach
                                            @endif>Monthly</option>
                                        <option value="Weekly"
                                            @if (count($rent_frequency) > 0) @foreach ($rent_frequency as $rf) {{ $rf == 'Weekly' ? 'selected' : '' }} @endforeach
                                            @endif>Weekly</option>
                                        <option value="Daily"
                                            @if (count($rent_frequency) > 0) @foreach ($rent_frequency as $rf) {{ $rf == 'Daily' ? 'selected' : '' }} @endforeach
                                            @endif>Daily</option>
                                    </select>
                                    <span class="text-danger" id="rent_frequency_error"></span>
                                </div>
                                <!--/ End Property Rent Frequecy grid column -->

                                <!-- Property Furnished Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="include_3">
                                    <label for="" class='label-w-100'>Furnished Type </label>
                                    <select name="furnished_type" id="furnished_type" class="form-control">
                                        <option value="1" {{ $propertyData[0]->furnished_type == 1 ? 'selected' : '' }}>
                                            Furnished</option>
                                        <option value="2" {{ $propertyData[0]->furnished_type == 2 ? 'selected' : '' }}>
                                            Un Furnished</option>
                                        <option value="3" {{ $propertyData[0]->furnished_type == 3 ? 'selected' : '' }}>
                                            Partial Furnished</option>
                                    </select>
                                    <span class="text-danger" id="furnished_type_error"></span>
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Furnished Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="include_4">
                                    <label for="" class='label-w-100'>Renovation Type </label>
                                    <select name="renovation_type" id="renovation_type" class="form-control">
                                        <option value="0" {{ $propertyData[0]->renovation_type == 1 ? 'selected' : '' }}>
                                            Luxury</option>
                                        <option value="1" {{ $propertyData[0]->renovation_type == 1 ? 'selected' : '' }}>
                                            Simple</option>
                                    </select>
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Furnished Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="include_6">
                                    <label for="" class='label-w-100'>Build Year </label>
                                    <input type="text" name="build_year" id="build_year"
                                        value="{{ $propertyData[0]->build_year }}" class="form-control"
                                        placeholder="YYYY">
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Furnished Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="include_7">
                                    <label for="" class='label-w-100'>No. of Parking Spaces</label>
                                    <input type="text" name="parking_no" id="parking_no"
                                        value="{{ $propertyData[0]->parking_no }}" class="form-control" placeholder="">
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Furnished Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="include_8">
                                    <label for="" class='label-w-100'>Plot No.</label>
                                    <input type="text" name="plot_no" id="plot_no"
                                        value="{{ $propertyData[0]->plot_no }}" class="form-control" placeholder="">
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Furnished Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="include_9">
                                    <label for="" class='label-w-100'>Built Up Area (In SQFT)</label>
                                    <input type="text" name="build_up_area" id="build_up_area"
                                        value="{{ $propertyData[0]->built_up_area }}" class="form-control"
                                        placeholder="">
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Furnished Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="include_11">
                                    <label for="" class='label-w-100'>Bilding's Floors</label>
                                    <input type="text" name="building_floor" id="building_floor"
                                        value="{{ $propertyData[0]->building_floor }}" class="form-control"
                                        placeholder="0">
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Furnished Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="include_12">
                                    <label for="" class='label-w-100'>Floor No.</label>
                                    <input type="text" name="floor_no" id="floor_no"
                                        value="{{ $propertyData[0]->floor_no }}" class="form-control" placeholder="0">
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Furnished Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="include_15">
                                    <label for="" class='label-w-100'>Garage</label>
                                    <input type="text" name="garage" id="garage" value="{{ $propertyData[0]->garage }}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        class="form-control" placeholder="0">
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Furnished Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="include_16">
                                    <label for="" class='label-w-100'>Garage Size (In SQFT)</label>
                                    <input type="text" name="garage_size" id="garage_size"
                                        value="{{ $propertyData[0]->garage_size }}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        class="form-control" placeholder="0">
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Furnished Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="include_10">
                                    <label for="" class='label-w-100'>Property Tenure * </label>
                                    <select name="property_tenure" id="property_tenure" class="form-control">
                                        <option value="">--select tenure--</option>
                                        <option value="0" {{ $propertyData[0]->property_tenure == 0 ? 'selected' : '' }}>
                                            Freehold</option>
                                        <option value="1" {{ $propertyData[0]->property_tenure == 1 ? 'selected' : '' }}>
                                            Non-freehold</option>
                                        <option value="2" {{ $propertyData[0]->property_tenure == 2 ? 'selected' : '' }}>
                                            Leasehold</option>
                                    </select>
                                    <span class="text-danger" id="property_tenure_error"></span>
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Furnished Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="property_furnished_div">
                                    <label for="" class='label-w-100'>Occupacy * </label>
                                    <select name="occupacy_id" id="occupacy_id" class="form-control">
                                        <option value="">--select occuapacy--</option>
                                        <option value="0" {{ $propertyData[0]->occupacy_id == 0 ? 'selected' : '' }}>
                                            Owner Occupied</option>
                                        <option value="1" {{ $propertyData[0]->occupacy_id == 1 ? 'selected' : '' }}>
                                            Investment</option>
                                        <option value="2" {{ $propertyData[0]->occupacy_id == 2 ? 'selected' : '' }}>
                                            Vacant</option>
                                        <option value="3" {{ $propertyData[0]->occupacy_id == 3 ? 'selected' : '' }}>
                                            Tenanted</option>
                                    </select>
                                    <span class="text-danger" id="occupacy_id_error"></span>
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Furnished Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="property_furnished_div">
                                    <label for="" class='label-w-100'>Availability *</label>
                                    <select name="availablity_id" id="availablity_id" class="form-control">
                                        <option value="">--select availability--</option>
                                        <option value="0" {{ $propertyData[0]->availability == 0 ? 'selected' : '' }}>
                                            Available</option>
                                        <option value="1" {{ $propertyData[0]->availability == 1 ? 'selected' : '' }}>
                                            Under Offer</option>
                                        <option value="2" {{ $propertyData[0]->availability == 2 ? 'selected' : '' }}>
                                            RESERVED</option>
                                        <option value="3" {{ $propertyData[0]->availability == 3 ? 'selected' : '' }}>
                                            Sold</option>
                                    </select>
                                    <span class="text-danger" id="availablity_id_error"></span>
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Furnished Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="include_13">
                                    <label for="" class='label-w-100'>Layout type.</label>
                                    <input type="text" name="layout_type" id="layout_type"
                                        value="{{ $propertyData[0]->layout_type }}" class="form-control"
                                        placeholder="i.e Type E">
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Furnished Status grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3" id="include_14">
                                    <label for="" class='label-w-100'>DEWA Number.</label>
                                    <input type="text" name="dewa_no" id="dewa_no"
                                        value="{{ $propertyData[0]->dewa_no }}" class="form-control" placeholder="">
                                </div>
                                <!--/ End Furnished Status  grid column -->

                                <!-- Property Permit No. grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3">
                                    <label for="">Permit No.</label>
                                    <input type="text" name="permit_no" id="permit_no"
                                        value="{{ $propertyData[0]->permit_no }}" placeholder="Permit No."
                                        class="form-control">
                                    <span class="text-danger" id="permit_no_error"></span>
                                </div>
                                <!--/ End Property Permit No. grid column -->

                                <!-- Property Views grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'>View<button class="btn btn-sm float-right"
                                            type="button" data-toggle="modal" data-target="#propertyViewModel"><i
                                                class="fa fa-plus text-success"></i></button></label>
                                    <select name="view_id" id="view_id" class="form-control" multiple>
                                        <option value="">---select View---</option>
                                        @if ($views->count())
                                            @foreach ($views as $item)
                                                <option value="{{ $item->id }}"
                                                    @if (count($property_views) > 0) @foreach ($property_views as $rf) {{ $rf == $item->id ? 'selected' : '' }} @endforeach
                                                    @endif>{{ $item->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger" id="view_id_error"></span>
                                </div>
                                <!--/ End Views Frequecy grid column -->

                                <!-- Property Developers grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'>Developer<button class="btn btn-sm float-right"
                                            type="button" data-toggle="modal" data-target="#propertyDeveloperModel"><i
                                                class="fa fa-plus text-success"></i></button></label>
                                    <select name="developer_id" id="developer_id" class="form-control">
                                        <option value="">---select developer---</option>
                                        @if ($developers->count())
                                            @foreach ($developers as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $propertyData[0]->developer_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger" id="developer_id_error"></span>
                                </div>
                                <!--/ End Developers Frequecy grid column -->

                                <!-- Property Agents grid column -->

                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'>Agent *<button class="btn btn-sm float-right"
                                            type="button" data-toggle="modal" data-target="#propertyAgentModel"><i
                                                class="fa fa-plus text-success"></i></button></label>
                                    <select name="agent_id" id="agent_id" class="form-control">
                                        <option value="">---select agent---</option>
                                        @if ($agents->count())
                                            @foreach ($agents as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $propertyData[0]->agent_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger" id="agent_id_error"></span>
                                </div>

                                <!--/ End Agents Frequecy grid column -->

                                <!-- Property Agents grid column -->
                                <div class="col-md-4 col-lg-4 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'>Expire After</label>
                                    <select name="expire_after" id="expire_after" class="form-control">
                                        <option value="1" {{ $propertyData[0]->expire_after == 1 ? 'selected' : '' }}>1
                                            Month</option>
                                        <option value="3" {{ $propertyData[0]->expire_after == 3 ? 'selected' : '' }}>3
                                            Month</option>
                                        <option value="6" {{ $propertyData[0]->expire_after == 6 ? 'selected' : '' }}>6
                                            Month</option>
                                    </select>
                                    <span class="text-danger" id="agent_id_error"></span>
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-6 mb-3">
                                    <label for="xml_portal" class='label-w-100'>Portals</label>
                                    <select name="xml_portal" id="xml_portal" class="form-control" multiple>
                                        @if ($portals->count())
                                            @foreach ($portals as $item)
                                                <option value="{{ $item->id }}"
                                                    @if (count($property_portals) > 0) @foreach ($property_portals as $rf) {{ $rf == $item->id ? 'selected' : '' }} @endforeach
                                                    @endif>{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <!--/ End Agents Frequecy grid column -->

                                <!-- Property Amenity And Features grid column -->
                                <div class="col-md-12 col-sm-12 col-lg-12 mt-3 mb-3">
                                    <label for="">Amenities / Feature</label><br>
                                    {{-- For Amenities --}}
                                    <a class="btn btn-primary btn-sm collapsed" role="button" data-toggle="collapse"
                                        href="#amenitesData" aria-expanded="false" aria-controls="collapseExample">
                                        Select Amenities
                                    </a>
                                    <div class="collapse mt-3 show" id="amenitesData" aria-expanded="false">
                                        <div class="demo-checkbox row" id="amenitesDataDiv">
                                        </div>
                                    </div>
                                    {{-- For Features --}}
                                    <a class="btn btn-cherwell btn-sm collapsed" role="button" data-toggle="collapse"
                                        href="#featuresData" aria-expanded="false" aria-controls="collapseExample">
                                        Select Features
                                    </a>
                                    <div class="collapse mt-3 show" id="featuresData" aria-expanded="false">
                                        <div style="display: block;width: 95%;" class="demo-checkbox col-md-12"
                                            id="featuresDataDiv">
                                        </div>
                                    </div>
                                </div>
                                <!-- /End Property Amenity And Features grid column -->
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>PRICING</legend>
                            <div class="row" id="sale_price_div">
                                <div class="col-md-6 col-lg-6 col-sm-6 mb-3">
                                    <label for="" class="label-w-100">Pricing *</label>
                                    <input type="text" name="price" id="price" value="{{ $propertyData[0]->price }}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        class="form-control" placeholder="0.00">
                                    <span class="text-danger" id=""></span>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6 mb-3">
                                    <input type="checkbox" name="price_on_application" id="price_on_application"
                                        {{ $propertyData[0]->price_on_application == 1 ? 'checked' : '' }}
                                        class="mt-10"> <label for="price_on_application">Price on
                                        application</label>
                                </div>
                            </div>
                            <div class="row d-none" id="rent_price_div">
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                    <label for="" class="label-w-100">Rent Prices *</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="" class="label-w-100">Year</label>
                                            <input type="text" name="year_price" id="year_price"
                                                value="{{ $propertyData[0]->year_price }}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                class="form-control" placeholder="0.00">
                                            <span class="text-danger" id="year_price_error"></span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="label-w-100">Month</label>
                                            <input type="text" name="month_price" id="month_price"
                                                value="{{ $propertyData[0]->month_price }}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                class="form-control" placeholder="0.00">
                                            <span class="text-danger" id="month_price_error"></span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="label-w-100">Week</label>
                                            <input type="text" name="week_price" id="week_price"
                                                value="{{ $propertyData[0]->week_price }}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                class="form-control" placeholder="0.00">
                                            <span class="text-danger" id="week_price_error"></span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="label-w-100">Day</label>
                                            <input type="text" name="day_price" id="day_price"
                                                value="{{ $propertyData[0]->day_price }}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                class="form-control" placeholder="0.00">
                                            <span class="text-danger" id="day_price_error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-6 mb-3">
                                    <label for="" class="label-w-100">Service Charges (Monthly)</label>
                                    <input type="text" name="service_charges" id="service_charges"
                                        value="{{ $propertyData[0]->service_charges }}" class="form-control"
                                        placeholder="0.00">
                                </div>
                                <!-- Property Agents grid column -->
                                <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                                    <label for="" class='label-w-100'>Financial Status</label>
                                    <select name="financial_status" id="financial_status" class="form-control" multiple>
                                        <option value="1"
                                            @if (count($property_financial_status) > 0) @foreach ($property_financial_status as $rf) {{ $rf == 1 ? 'selected' : '' }} @endforeach
                                            @endif>Mortgaged</option>
                                        <option value="2"
                                            @if (count($property_financial_status) > 0) @foreach ($property_financial_status as $rf) {{ $rf == 2 ? 'selected' : '' }} @endforeach
                                            @endif>Cash</option>
                                    </select>
                                </div>
                                <!--/ End Agents Frequecy grid column -->
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Description</legend>
                            <div class="row">
                                <!-- Property Title grid column -->
                                @foreach ($languages as $key => $item)
                                    <div class="col-md-8 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}"
                                        id="div_{{ $item->id }}">
                                        <label for="title_english">Title {{ $item->name }} *</label>
                                        <input type="text" name="title_english[]"
                                            @if ($item->direction == 'Right') dir="rtl" @endif
                                            value="@if ($item->id == $propertyData[$key]->lang_id) {{ $propertyData[$key]->title }} @endif"
                                            id="title_english_{{ $item->id }}" class="form-control">
                                        <small id="title_english_error" class="text-danger"></small>
                                    </div>
                                    <input type="hidden" name="languages[]" value="{{ $item->id }}" id="languages">
                                @endforeach
                                <!-- /End Property Title grid column -->
                                <div class="col-md-4 mb-3 text-right">
                                    @include('languages')
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($languages as $kee => $ietms)
                                    <div class="col-md-12 col-lg-12 mb-6 {{ $ietms->id != 1 ? 'd-none' : '' }}"
                                        id="description_div_{{ $ietms->id }}">
                                        <label class="mr-2">Descriptions {{ $ietms->name }}</label>
                                        <textarea class="form-control"
                                            @if ($ietms->direction == 'Right') dir="rtl" @endif
                                            name="descriptions_{{ $ietms->id }}"
                                            id="descriptions_{{ $ietms->id }}">{{ $propertyData[$kee]->description }}</textarea>
                                        <small id="descriptions_error" class="text-danger"></small>
                                    </div>
                                    @php
                                        $dir= '';
                                             ($ietms->direction == 'Right') ? $dir = 'rtl' : $dir = 'ltr';
                                    @endphp
                                    <script>
                                        setTimeout(function() {
                                            CKEDITOR.replace('descriptions_{{ $ietms->id }}', {
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
                                            <select name="location_id" id="location_id" class="form-control"
                                                onchange="SetMap(this)">
                                                {{-- For Country --}}
                                                {{-- <option value="{{ $location_country->id }}">{{ $location_country->short_name }}</option> --}}
                                                {{-- For State --}}
                                                {{-- <option selected value="{{ $property->location_state_id.$property->location_state_id.','.$lat.','.$lng}}"  > {{$property->location_text}} </option> --}}
                                                @forelse ($location_country->location_states as $state)
                                                    <option
                                                        value="{{ '0,' . $state->id . ',' . $state->latitude . ',' . $state->longitude }}"
                                                        {{ $propertyData[0]->address_level == '0' ? ($state->id == $propertyData[0]->address_id ? 'selected' : '') : '' }}>
                                                        {{ $state->name }}</option>
                                                    {{-- For Area --}}
                                                    @forelse ($state->location_areas as $area)
                                                        <option
                                                            value="{{ '1,' . $area->id . ',' . $area->latitude . ',' . $area->longitude }}"
                                                            {{ $propertyData[0]->address_level == '1' ? ($area->id == $propertyData[0]->address_id ? 'selected' : '') : '' }}>
                                                            {{ $area->name }}, {{ $state->name }}</option>
                                                        {{-- For Locations --}}
                                                        {{-- @forelse ($area->locations as $location) --}}
                                                        {{-- <option value="{{ '2,'.$location->id.','.$location->latitude.','.$location->longitude }}" {{  $propertyData[0]->address_level == '2' ? ($location->id == $propertyData[0]->address_id  ? 'selected' : '') :'' }}> {{ $location->name }} {{ $area->name }}, {{ $state->name }}</option> --}}
                                                        {{-- For Locations --}}
                                                        {{-- @forelse ($location->buildings as $building)
                                                            <option value="{{ '3,'.$building->id.','.$building->latitude.','.$building->longitude }}" {{  $propertyData[0]->address_level == '3' ? ($building->id == $propertyData[0]->address_id ? 'selected' : '') : '' }}> {{ $building->name }}, {{ $location->name }}, {{ $area->name }}, {{ $state->name }}</option>
                                                            @empty

                                                            @endforelse --}}
                                                        {{-- @empty --}}

                                                        {{-- @endforelse --}}
                                                    @empty
                                                    @endforelse
                                                @empty
                                                @endforelse
                                            </select>
                                            <span class="text-danger" id="location_id_error"></span>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-sm-12 mb-10">
                                            <label for="">Project Name</label>
                                            <input type="text" name="project_name" id="project_name"
                                                placeholder="Project Name" value="{{ $propertyData[0]->project_name }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-sm-12 mb-10">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                    <label for="">Street Name</label>
                                                    <input type="text" name="street_name" id="street_name"
                                                        value="{{ $propertyData[0]->street_name }}"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-sm-12">
                                                    <label for="">Street No.</label>
                                                    <input type="text" name="stree_no" id="street_no"
                                                        value="{{ $propertyData[0]->street_no }}"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-sm-12">
                                                    <label for="">Unit No.</label>
                                                    <input type="text" name="unit_no" id="unit_no"
                                                        value="{{ $propertyData[0]->unit_no }}" class="form-control">
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
                        @if (auth()->user()->role_id == 1)
                            <fieldset>
                                <legend>Advance Features:</legend>
                                <div class="row" id="advance_features">
                                    <div class="col-md-2">
                                        <input type="checkbox" name="is_verified" id="is_verified"
                                            {{ $propertyData[0]->is_verified == 1 ? 'checked' : '' }}> <label
                                            for="is_verified">Verified</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" name="is_featured" id="is_featured"
                                            {{ $propertyData[0]->is_featured == 1 ? 'checked' : '' }}> <label
                                            for="is_featured">Featured</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" name="is_boost" id="is_boost"
                                            {{ $propertyData[0]->is_boost == 1 ? 'checked' : '' }}> <label
                                            for="is_boost">Boost Sale</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" name="is_hot" id="is_hot"
                                            {{ $propertyData[0]->is_hot == 1 ? 'checked' : '' }}> <label
                                            for="is_hot">Hot</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" name="is_signature" id="is_signature"
                                            {{ $propertyData[0]->is_signature == 1 ? 'checked' : '' }}>
                                        <label for="is_signature" id="signature_type">Signature {{ $propertyData[0]->property_type_id == 1 ? 'Sale' : 'Rent' }} </label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" name="is_basic" id="is_basic"
                                            {{ $propertyData[0]->is_basic == 1 ? 'checked' : '' }}> <label
                                            for="is_basic">Basic</label>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset id="signature-box" @if ($propertyData[0]->is_signature == 0) class="d-none" @endif>
                                <legend>Signature Details</legend>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                                        <label for="">Signature Title</label>
                                        <input type="text" name="signature_title"
                                            value="{{ $propertyData[0]->signature_title }}" id="signature_title"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                                        <label for="">Signature Descriptions</label>
                                        <textarea name="signature_desc" id="signature_desc"
                                            class="form-control">{{ $propertyData[0]->signature_desc }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 mb-4 ">
                                    <label class="mr-2">Signature Image</label>
                                    <div class="group-contain" style="display: flex;">
                                        <div class="btn btn-secondary fileinput-button"
                                            style="line-height: 2;height: 50px;">
                                            <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                            <input id="signature-image" type="file" name="signature-image" accept="image/*">
                                        </div>
                                        <div class="form-group" style="display: block;margin: 0 auto;">
                                            <div id="signature-uploadList"
                                                class="list-group list-group-flush list-group-divider"
                                                style="margin: auto;">
                                                <img loading="lazy" src="{{ $propertyData[0]->signature_image }}"
                                                    alt="Preview Image" id="blah-signature" width="100"
                                                    class="ml-10 d-block">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <small id="signature_image_error" class="text-danger"></small>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                                        <label for="">Signature Section Two Title</label>
                                        <input type="text" name="signature_section_two_title"
                                            value="{{ $propertyData[0]->signature_section_two_title }}"
                                            id="signature_section_two_title" class="form-control">
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                                        <label for="">Signature Section Two Descriptions</label>
                                        <textarea name="signature_section_two_desc" id="signature_section_two_desc"
                                            class="form-control">{{ $propertyData[0]->signature_section_two_desc }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 mb-4 ">
                                    <label class="mr-2">Signature Section Two Image</label>
                                    <div class="group-contain" style="display: flex;">
                                        <div class="btn btn-secondary fileinput-button"
                                            style="line-height: 2;height: 50px;">
                                            <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                            <input id="signature_section_two_image" type="file"
                                                name="signature_section_two_image" accept="image/*">
                                        </div>
                                        <div class="form-group" style="display: block;margin: 0 auto;">
                                            <div id="signature-uploadList"
                                                class="list-group list-group-flush list-group-divider"
                                                style="margin: auto;">
                                                <img loading="lazy"
                                                    src="{{ $propertyData[0]->signature_section_two_image }}"
                                                    alt="Preview Image" id="blah_signature_section_two_image"
                                                    class="d-block">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <small id="signature_section_two_image_error" class="text-danger"></small>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                                        <label for="">Signature Section Three Title</label>
                                        <input type="text" name="signature_section_three_title"
                                            value="{{ $propertyData[0]->signature_section_three_title }}"
                                            id="signature_section_three_title" class="form-control">
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                                        <label for="">Signature Section Three Descriptions</label>
                                        <textarea name="signature_section_three_desc" id="signature_section_three_desc"
                                            class="form-control">{{ $propertyData[0]->signature_section_three_desc }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 mb-4 ">
                                    <label class="mr-2">Signature Section Three Image</label>
                                    <div class="group-contain" style="display: flex;">
                                        <div class="btn btn-secondary fileinput-button"
                                            style="line-height: 2;height: 50px;">
                                            <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                            <input id="signature_section_three_image" type="file"
                                                name="signature_section_three_image" accept="image/*">
                                        </div>
                                        <div class="form-group" style="display: block;margin: 0 auto;">
                                            <div id="signature_section_three_image_uploadList"
                                                class="list-group list-group-flush list-group-divider"
                                                style="margin: auto;">
                                                <img loading="lazy"
                                                    src="{{ $propertyData[0]->signature_section_three_image }}"
                                                    alt="Preview Image" id="blah_signature_section_three_image"
                                                    class="d-block">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <small id="signature_section_three_image_error" class="text-danger"></small>
                                </div>
                            </fieldset>
                        @endif
                        <fieldset>
                            <legend>Property Images</legend>
                            <div class="row">
                                @foreach ($property_images as $thumbnail)
                                    <div class="col-md-2 col-lg-2 col-sm-2 mb-5" id="thmb_<?= $thumbnail->id ?>">
                                        <div class="card">
                                            <img class="card-img-top" src="<?= $thumbnail->image ?>"
                                                alt="Property Image">
                                            <div class="ma-2">
                                                <button type="button" class="btn del" id="del"
                                                    value="<?= $thumbnail->id ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <!-- Property Base Images grid column -->
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                                    <label for="">Base Images *</label>
                                    <form enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="file-loading">
                                                <input id="file-1" type="file" multiple class="file"
                                                    data-overwrite-initial="false" data-theme="fas">
                                            </div>
                                        </div>
                                    </form>
                                    <span class="text-danger" id="base_images_error"></span>
                                </div>
                                <div class="col-md-12 col-lg-12 mb-4 ">
                                    <label class="mr-2">Upload 3D Floor Plan</label>
                                    <div class="group-contain" style="display: flex;">
                                        <div class="btn btn-secondary fileinput-button"
                                            style="line-height: 2;height: 50px;">
                                            <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                            <input id="fileupload-3d" type="file" name="fileupload-3d" accept="image/*">
                                        </div>
                                        <div class="form-group" style="
                                              display: block;
                                              margin: 0 auto;
                                              ">
                                            <div id="uploadList" class="list-group list-group-flush list-group-divider"
                                                style="margin: auto;">
                                                <img loading="lazy"
                                                    src="{{ asset('storage') }}/{{ $propertyData[0]->three_d }}"
                                                    alt="Preview Image" id="blah-3d" class="">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <small id="image_one_error" class="text-danger"></small>
                                </div>
                                <div class="col-md-12 col-lg-12 mb-4 ">
                                    <label class="mr-2">Upload 2D Floor Plan</label>
                                    <div class="group-contain" style="
                                           display: flex;
                                           ">
                                        <div class="btn btn-secondary fileinput-button"
                                            style="line-height: 2;height: 50px;">
                                            <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                            <input id="fileupload-2d" type="file" name="fileupload-2d" accept="image/*">
                                        </div>
                                        <div class="form-group" style="display: block;margin: 0 auto;">
                                            <div id="uploadList" class="list-group list-group-flush list-group-divider"
                                                style="margin: auto;">
                                                <img loading="lazy"
                                                    src="{{ asset('storage') }}/{{ $propertyData[0]->two_d }}"
                                                    alt="Preview Image" id="blah-2d" class="">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <small id="image_one_error" class="text-danger"></small>
                                </div>
                                <div class="col-md-12 col-lg-12 mb-4 ">
                                    <label class="mr-2">Upload Brochure</label>
                                    <div class="group-contain" style="
                                           display: flex;
                                           ">
                                        <div class="btn btn-secondary fileinput-button"
                                             style="line-height: 2;height: 50px;">
                                            <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                            <input id="fileupload-broucher" type="file" name="fileupload-broucher" >
                                        </div>
                                        <div class="form-group" style="
                                              display: block;
                                              margin: 0 auto;
                                              ">
                                            <div id="uploadList" class="list-group list-group-flush list-group-divider"
                                                 style="margin: auto;">
                                                @if($propertyData[0]->broucher)
                                                <a href="{{ $propertyData[0]->broucher }}" target="_blank">View Broucher</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <small id="image_broucher_error" class="text-danger"></small>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset id="offplan_info" class="@if($propertyData[0]->property_status_id == 13) {{'d-block'}} @else {{'d-none'}} @endif">
                            <legend>Off Plan Information:</legend>
                            <div class="col-md-12 col-lg-12 col-sm-12 mb-10">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label for="">Off Plan Heading</label>
                                        <input type="text" name="off_plan_heading" value="{{ $propertyData[0]->off_plan_heading }}" id="off_plan_heading"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label for="">Off Plan Description</label>
                                        <textarea name="off_plan_description" id="off_plan_description"
                                                  class="form-control">{{ $propertyData[0]->off_plan_desc }} </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label for="">Off Plan Title One</label>
                                        <input type="text" name="off_plan_title_one" value="{{ $propertyData[0]->off_plan_title_one }}" id="off_plan_title_one"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label for="">Off Plan Title Two</label>
                                        <input type="text" name="off_plan_title_two" value="{{ $propertyData[0]->off_plan_title_two }}" id="off_plan_title_two"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label for="">Overview</label>
                                        <textarea name="off_plan_overview" id="off_plan_overview"
                                                  class="form-control"> {{ $propertyData[0]->off_plan_overview }}</textarea>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <label for="">Off Plan Request More Heading</label>
                                        <input type="text" name="off_plan_request_more_heading" value="{{ $propertyData[0]->off_plan_request_more_heading }}" id="off_plan_request_more_heading"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <label for="">Off Plan Request More Description</label>
                                        <textarea name="off_plan_omniyat_desc" id="off_plan_omniyat_desc"
                                                  class="form-control"> {{ $propertyData[0]->off_plan_request_more_desc }}</textarea>
                                    </div>
                                </div>
                                <fieldset>
                                    <legend>
                                        Floor Plan
                                    </legend>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <label for="">1 Bed</label>
                                            <input type="text" placeholder="1 Bed file link" value="{{ $propertyData[0]->one_bed_floor_plan }}" name="one_bed" id="one_bed"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <label for="">2 Bed</label>
                                            <input type="text" placeholder="2 Bed file link" value="{{ $propertyData[0]->two_bed_floor_plan }}" name="two_bed" id="two_bed"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <label for="">3 Bed</label>
                                            <input type="text" placeholder="3 Bed file link" value="{{ $propertyData[0]->three_bed_floor_plan }}" name="three_bed"
                                                   id="three_bed"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <label for="">4 Bed</label>
                                            <input type="text" placeholder="4 Bed file link" value="{{ $propertyData[0]->four_bed_floor_plan }}" name="four_bed"
                                                   id="four_bed"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <label for="">Studio</label>
                                            <input type="text" placeholder="Studio file link" value="{{ $propertyData[0]->studio_floor_plan }}"  name="studio" id="studio"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Payment Plan</legend>
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4 col-sm-6">
                                            <label for="">down payment</label>
                                            <input type="number" min="0" maxlength="100" value="{{ $propertyData[0]->off_plan_down_payment }}"  placeholder="down payment in %" name="down_payment" id="down_payment"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-sm-6">
                                            <label for="">During Construction</label>
                                            <input type="number" min="0" maxlength="100" value="{{ $propertyData[0]->off_plan_during_consurtion }}"  placeholder="During Construction payment in %" name="during_construction" id="during_construction"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-sm-6">
                                            <label for="">Post Handover</label>
                                            <input type="number" min="0" maxlength="100"  value="{{ $propertyData[0]->off_plan_post_handover }}"  placeholder="down payment in %" name="post_handover" id="post_handover"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </fieldset>
                        <fieldset>
                        <fieldset>
                            <legend>Document Section:</legend>
                            <div class="form-group" id="wiget-desc">
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name">Document File:</label>
                                        <input type="file" class="form-control" accept="image/*" id="header_image_1">
                                        <span id="image_1_error" class="text-danger"></span>
                                        <div class="d-none" id="widget-one-div">
                                            <hr>
                                            <p id="ImageToUpdate" style="margin: 0px"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3"><label for="name">Document Type</label>
                                        <select name="document_type_id" id="document_type_id" class="form-control">
                                            <option value=""></option>
                                            @if ($document_types->count())
                                                @foreach ($document_types as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="document_type_id_1_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <button class="btn btn-primary btn-lg btn-block" id="add-button-english">Add
                                            Document</button>
                                    </div>
                                </div>
                            </div><!-- /.form-group -->
                            <div class="row ">
                                <div class="col-md-12">
                                    <span id="widget_1_error" class="text-danger"></span>
                                    <table class="table table-bordered table-sm" id="wiget_data">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th width="7%">ID</th>
                                                <th width="23%">Document File</th>
                                                <th width="50%">Document Type</th>
                                                <th width="20%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($propertyData[0]->documents->count())
                                                @foreach ($propertyData[0]->documents as $key => $item)
                                                    <tr id="WidgetRow_{{ $item->id }}">
                                                        <td class="justify-content-center">{{ $item->id }}</td>
                                                        <td class="justify-content-center">{{ $item->name }}</td>
                                                        <td class="justify-content-center">
                                                            {{ $item->document_type->name }}</td>
                                                        <td class="text-center justify-content-center">
                                                            <input type="hidden" name="id" value="{{ $item->id }}" />
                                                            <input type="hidden" name="name"
                                                                value="{{ $item->name }}" />
                                                            <input type="hidden" name="type_name"
                                                                value="{{ $item->document_type->name }}" />
                                                            <input type="hidden" name="type_id"
                                                                value="{{ $item->document_type->id }}" />
                                                            <a href="javascript:;" id="row-to-update"
                                                                class="btn btn-sm btn-icon btn-secondary">
                                                                <i class="fa fa-pencil-alt text-primary"
                                                                    style="padding-top: 7px !important"></i>
                                                            </a>
                                                            <a href="javascript:;" id="remove-w-1"
                                                                class="btn btn-sm btn-icon btn-secondary">
                                                                <i class="far fa-trash-alt"
                                                                    style="padding-top: 7px !important;color:red"></i> <span
                                                                    class="sr-only">Remove</span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Property Videos External Links:</legend>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                                    <label for="">Youtube Link</label>
                                    <input type="text" name="youtube_link" id="youtube_link" class="form-control"
                                        value="{{ $propertyData[0]->youtube_link }}" placeholder="https://youtube.com">
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12 mb-5">
                                    <label for="">360 degree Video Link</label>
                                    <input type="text" name="video_link" id="video_link" class="form-control"
                                        value="{{ $propertyData[0]->video_link }}" placeholder="https://example.com">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>SEO SECTION</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" name="meta_title" value="{{ $propertyData[0]->meta_title }}"
                                        id="meta_title" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="meta_description">Meta Descriptions</label>
                                    <input type="text" name="meta_description"
                                        value="{{ $propertyData[0]->meta_description }}" id="meta_description"
                                        class="form-control" />
                                </div>
                            </div>
                        </fieldset>
                        <button type="button"
                            class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block"
                            id="create_property">
                            <span class="svg-icon svg-icon-md fa fa-floppy-o"></span>
                            Update Property
                        </button>
                    </div>

                    {{-- </div> --}}
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->

        @include('properties.list-properties.modals');
        @include('properties.list-properties.js.edit');

        <script>
            $(".del").click(function() {
                let del = $(this).val();
                // $("#thmb_"+del).hide();
                $.confirm({
                    title: '@lang("translation.confirm")',
                    content: 'Are You Sure you want to delete this Image? ',
                    boxWidth: '20%',
                    buttons: {
                        cancel: function() {},
                        confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function() {
                                $.ajax("{{ route('manage-properties.property.delete-property-image') }}", {
                                    type: 'POST', // http method
                                    data: {
                                        id: del
                                    }, // data to submit
                                    success: function(data, status, xhr) {
                                        $("#thmb_" + del).hide('slow')
                                    },
                                    error: function(jqXhr, textStatus, errorMessage) {
                                        console.log('Error' + errorMessage);
                                    }
                                });
                            }
                        }
                    }
                });
            });
        </script>
    @endsection
