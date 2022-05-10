@extends('layouts.master')
@section('title', 'Profile Settigs')
@section('sms-api', 'active')
@section('first', 'Profile Settigs')
@section('second', 'Settings')
@section('third', 'Profile Settigs')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Profile Personal Information-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
                    <!--begin::Profile Card-->
                    @include('admin.profile.side-menu')
                    <!--end::Profile Card-->
                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-12">
                    <div class="content d-flex flex-column flex-column-fluid">
                        <!--begin::Entry-->
                        <div class="d-flex flex-column-fluid">
                            <!--begin::Container-->
                            <div class="container-fluid">
                                <div class="card card-custom gutter-b">
                                    <div class="card-body">
                                        <fieldset>
                                            <legend>SMS Api Info: </legend>
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 mb-4 ">
                                                    <label for="sender_id_by_number" class="d-block">@lang('translation.sender_id_by_number') </label>
                                                    <input type="text" name="sender_id_by_number" value="{{ $sms->sender_id_by_number }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="sender_id_by_number" placeholder="@lang('translation.enter_sender_id_by_number')" class="form-control">
                                                    <span class="form-text text-danger" id="sender_id_by_number_error"></span>
                                                </div>
                                                <div class="col-md-6 col-lg-6 mb-4 ">
                                                  <label for="sender_id_by_name" class="d-block">@lang('translation.sender_id_by_name') </label>
                                                  <input type="text" name="sender_id_by_name" value="{{ $sms->sender_id_by_name }}" id="sender_id_by_name" placeholder="@lang('translation.enter_sender_id_by_name')" class="form-control">
                                                  <span class="form-text text-danger" id="sender_id_by_name_error"></span>
                                                </div>
                                                <div class="col-md-6 col-lg-6 mb-4 d-none">
                                                    <label for="secrate_key" class="d-block">@lang('translation.secrate_key') </label>
                                                    <input type="text" name="secrate_key" value="{{ $sms->secrate_key }}" id="secrate_key" placeholder="@lang('translation.enter_secrate_key')" class="form-control">
                                                    <span class="form-text text-danger" id="secrate_key_error"></span>
                                                </div>
                                                <div class="col-md-6 col-lg-6 mb-4 ">
                                                    <label for="api_key" class="d-block">@lang('translation.api_key') </label>
                                                    <input type="text" name="api_key" id="api_key" value="{{ $sms->api_key }}" placeholder="@lang('translation.enter_api_key')" class="form-control">
                                                    <span class="form-text text-danger" id="api_key_error"></span>
                                                </div>
                                                <div class="col-md-6 col-lg-6 mb-4 d-none">
                                                  <label for="sms_limit" class="d-block">@lang('translation.sms_limit') </label>
                                                  <input type="text" name="sms_limit" value="{{ $sms->sms_limit }}"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="sms_limit" placeholder="@lang('translation.enter_sms_limit')" class="form-control">
                                                  <span class="form-text text-danger" id="sms_limit_error"></span>
                                                </div>
                                                <div class="col-md-6 col-lg-6 mb-4 ">
                                                    <label for="active_sms_id">SMS Send From</label>
                                                    <div class="radio-inline">
                                                        <label class="radio radio-danger">
                                                            <input type="radio" name="active_sms_id" value="0" {{ $sms->active_sms_id  == 0 ? 'checked' : ''}}>
                                                            <span></span>Sender Id By Number</label>
                                                        <label class="radio radio-danger">
                                                        <input type="radio" name="active_sms_id" value="1" {{ $sms->active_sms_id  == 1 ? 'checked' : ''}}>
                                                        <span></span>Sender Id By Name</label>
                                                    </div>
                                                    <span class="form-text text-danger" id="currency_error"></span>
                                                </div>
                                                <div class="col-md-12 col-lg-12 mb-4">
                                                    <button class="btn btn-block btn-danger" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> Save</button>
                                                </div>
                                            </div>
                                        </fieldset>  
                                    </div>
                                            <!--end: Datatable-->

                                        <!--end::Card-->

                                    </div>
                                </div>
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Entry-->

                </div>
                <!--end::Content-->
            </div>
            <!--end::Profile Personal Information-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
@include('admin.profile.sms-api.js.index')
@endsection
