@extends('layouts.master')
@section('title', 'Profile')
@section('p-profile', 'active')
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
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form class="form" onsubmit="return false">
                            <!--begin::Body-->
                            <div class="card-body">
                                <fieldset>
                                    <legend>Account Info: <label class="badge badge-danger" style="padding: 2px 12px 2px 12px !important">Mandatory</label></legend>
                                    <div class="row mb-4">
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12 mb-4">
                                                    <label for="name">@lang('translation.name')</label>
                                                    <input type="text" class="form-control" name="name" id="name" value="{{ $company->name }}" placeholder="@lang('translation.enter_name')" autofocus/>
                                                    <span class="form-text text-danger" id="name_error"></span>
                                                </div>
                                                <div class="col-md-12 col-lg-12 mb-4">
                                                    <label for="designation">@lang('translation.designation')</label>
                                                    <input type="text" class="form-control" name="designation" id="designation" value="{{ $company->designation }}" placeholder="@lang('translation.enter_designation')"/>
                                                    <span class="form-text text-danger" id="designation_error"></span>
                                                </div>
                                                <div class="col-md-12 col-lg-12 mb-4">
                                                    <label for="name">@lang('translation.company_name')</label>
                                                    <input type="text" class="form-control" name="company_name" id="company_name" value="{{ $company->company_name }}" placeholder="@lang('translation.enter_company_name')" autofocus/>
                                                    <span class="form-text text-danger" id="company_name_error"></span>
                                                </div>
                                        </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="row">
                                                <label class="col-xl-4 col-lg-4 text-left">@lang('translation.avatar')</label>
                                                <div class="col-lg-8 col-xl-8">
                                                    <div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(assets/media/users/blank.png)">
                                                        <div class="image-input-wrapper" style="background-image: url({{ $company->avatar ? url('storage/app') .'/'. $company->avatar : 'assets/media/users/300_21.jpg' }})"></div>
                                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="@lang('translation.change_avatar')">
                                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                                            <input type="file" name="profile_avatar" id="profile_avatar" accept=".png, .jpg, .jpeg">
                                                            <input type="hidden" name="profile_avatar_remove">
                                                        </label>
                                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="@lang('translation.cancel_avatar')">
                                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>
                                                        <span class="remove-avatar btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="" data-original-title="@lang('translation.remove_avatar')">
                                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>
                                                    </div>
                                                    <span class="form-text text-bold text-danger" id="avatar_error"></span>
                                                </div>
                                                <div class="col-md-12 col-lg-12 mt-9">

                                                    <label for="email">@lang('translation.company_email')</label>
                                                    <input type="email" class="form-control" name="new_email" id="new_email" value="{{ $company->email }}" placeholder="@lang('translation.enter_company_email')"/>
                                                    <span class="form-text text-danger" id="new_email_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                      {{-- <div class="col-md-6 col-lg-6 mb-4">
                                          <label for="password">@lang('translation.password') <button class="btn btn-success btn-sm" id="generate_password" style="padding: 2px 12px 2px 12px !important"><span class="fa fa-plus"></span> Generate</button></label>
                                          <input type="text" class="form-control" name="password" id="password" placeholder="@lang('translation.enter_password')" autofocus/>
                                          <span class="form-text text-danger" id="password_error"></span>
                                      </div>
                                      <div class="col-md-6 col-lg-6 mb-4">
                                          <label for="confirm_password">@lang('translation.confirm_password')</label>
                                          <input type="text" class="form-control" name="confirm_password" id="confirm_password" placeholder="@lang('translation.enter_confirm_password')"/>
                                          <span class="form-text text-danger" id="confirm_password_error"></span>
                                      </div> --}}
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend for="">Company Info:</legend>
                                    <div class="row mb-4">
                                      <div class="col-md-6 col-lg-6 mb-4 ">
                                          <label for="phone">@lang('translation.company_phone') @lang('translation.optional')</label>
                                          <input type="text" class="form-control" name="phone"  id="phone" placeholder="@lang('translation.enter_company_phone')" value="{{ $company->phone }}"/>
                                          <span class="form-text text-danger" id="phone_error"></span>
                                      </div>
                                      <div class="col-md-6 col-lg-6 mb-4 ">
                                          <label for="mobile">@lang('translation.company_mobile') @lang('translation.optional')</label>
                                          <input type="number" class="form-control" name="mobile" id="mobile" value="{{ $company->mobile }}" placeholder="@lang('translation.enter_company_mobile')" autofocus/>
                                          <span class="form-text text-danger" id="mobile_error"></span>
                                      </div>
                                      <div class="col-md-6 col-lg-6 mb-4">
                                          <label for="office_address">@lang('translation.office_address') @lang('translation.optional')</label>
                                          <input type="text" class="form-control" name="address " id="address" value="{{ $company->address }}" placeholder="@lang('translation.enter_office_address')"/>
                                          <span class="form-text text-danger" id="office_address_error"></span>
                                      </div>
                                      <div class="col-md-6 col-lg-6 mb-4">
                                          <label for="city">@lang('translation.city') @lang('translation.optional')</label>
                                          <input type="text" class="form-control" name="city " id="city" value="{{ $company->city }}" placeholder="@lang('translation.enter_city')"/>
                                          <span class="form-text text-danger" id="city_error"></span>
                                      </div>
                                      <div class="col-md-6 col-lg-6 mb-4">
                                          <label for="zip">@lang('translation.zip') @lang('translation.optional')</label>
                                          <input type="text" class="form-control" name="zip " id="zip" value="{{ $company->zip }}" min="4" max="4" placeholder="@lang('translation.enter_zip')"/>
                                          <span class="form-text text-danger" id="zip_error"></span>
                                      </div>
                                      <div class="col-md-6 col-lg-6 mb-4">
                                          <label for="country">@lang('translation.country') @lang('translation.optional')</label>
                                          <select class="form-control" name="country" id="country">
                                              <option value="">-- Country  --</option>
                                              @if (count($countries) > 0)
                                              @foreach ($countries as $cont)
                                                  <option value="{{ $cont->val }}" {{ $cont->val == $company->country ? 'selected' : '' }}>{{ $cont->text }}</option>
                                              @endforeach
                                              @endif

                                          </select>
                                          <span class="form-text text-danger" id="country_error"></span>
                                      </div>
                                      <div class="col-md-6 col-lg-6">
                                          <label for="state">@lang('translation.state') @lang('translation.optional')</label>
                                              <select class="form-control" name="state" id="state">
                                                  <option value="">-- State  --</option>
                                          </select>
                                          <span class="form-text text-danger" id="state_error"></span>
                                      </div>
                                    </div>
                                </fieldset>
                                <div class="col-md-12 col-lg-12 mb-6">
                                    <button class="btn btn-info btn-block" style="font-size:16px;" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.edit_company')</button>
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
@include('admin.profile.js.index')
@endsection
