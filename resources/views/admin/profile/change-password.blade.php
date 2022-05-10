@extends('layouts.master')
@section('title', 'Change Password')
@section('u-password', 'active')
@section('first', 'Profile Settings')
@section('second', 'Configurations')
@section('third', 'Profile Settings')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
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
                <div class="flex-row-fluid ml-lg-8">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Header-->
                        <div class="card-header py-3">
                            <div class="card-title align-items-start flex-column">
                                <h3 class="card-label font-weight-bolder text-dark">@lang('translation.change_password')</h3>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form class="form">
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-xl-3"></label>
                                    <div class="col-lg-9 col-xl-6">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">@lang('translation.current_password')</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="input-group input-group-lg input-group-solid">
                                            <input type="password" class="form-control form-control-lg form-control-solid" id="current_password" placeholder="@lang('translation.current_password')">
                                        </div>
                                        <span class="form-text text-bold text-danger" id="current_password_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">@lang('translation.new_password')</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="input-group input-group-lg input-group-solid">
                                            <input type="password" class="form-control form-control-lg form-control-solid" id="new_password" placeholder="@lang('translation.new_password')">
                                        </div>
                                        <span class="form-text text-bold text-danger" id="new_password_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label text-right">@lang('translation.confirm_password')</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="input-group input-group-lg input-group-solid">
                                            <input type="password" class="form-control form-control-lg form-control-solid" id="confirm_password" placeholder="@lang('translation.confirm_password')">
                                        </div>
                                        <span class="form-text text-bold text-danger" id="confirm_password_error"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-3 col-xl-3">
                                    </div>
                                    <div class="col-lg-9 col-xl-9">
                                        <button type="button" class="btn btn-success mr-2" id="submit">@lang('translation.save_changes')</button>
                                    </div>
                                </div>

                            </div>
                            <!--end::Body-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Profile Personal Information-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
@include('admin.profile.js.change-password')
@endsection
