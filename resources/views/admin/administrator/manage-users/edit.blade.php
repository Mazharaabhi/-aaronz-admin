@extends('layouts.master', ['linke' => route('admin.administrator.manage-users.index')])
@section('title', 'Edit User')
@section('first', 'Edit User')
@section('second', 'Administrator')
@section('third', 'Edit User')
@section('fourth', 'Edit')

@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                 <h3 class="card-title">
                  Edit User
                 </h3>
                 <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('admin.administrator.manage-users.index') }}" class="btn btn-danger float-right"><span class="fa fa-mail-reply"></span> @lang('translation.back')</a>
                    </div>
                   </div>
                </div>
                <!--begin::Form-->
                 <div class="card-body">
                  <fieldset>
                      <legend>Mandatory Fields</legend>
                      <div class="row mb-2">
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="name">@lang('translation.name')</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $customer->name }}" placeholder="@lang('translation.enter_name')" autofocus/>
                            <span class="form-text text-danger" id="name_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="email">@lang('translation.email')</label>
                            <input type="email" class="form-control" name="customer_email" id="customer_email" value="{{ $customer->email }}" placeholder="@lang('translation.enter_email')"/>
                            <span class="form-text text-danger" id="email_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="confirm_password">User Role</label>
                            <select name="role_id" id="role_id" class="form-control">
                                <option value="">---select user role---</option>
                                @if (count($roles) > 0)
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $customer->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                                @endif
                            </select>
                            <span class="form-text text-danger" id="role_error"></span>
                        </div>
                      </div>
                  </fieldset>
                  <fieldset>
                      <legend>Optional Fields</legend>
                      <div class="row mb-4">

                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="phone">@lang('translation.phone')</label>
                            <input type="number" class="form-control" name="phone" id="phone" value="{{ $customer->phone }}" placeholder="@lang('translation.enter_phone')"/>
                            <span class="form-text text-danger" id="phone_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="street">@lang('translation.street')</label>
                            <input type="text" class="form-control" name="street " id="street" value="{{ $customer->address }}" placeholder="@lang('translation.enter_street')"/>
                            <span class="form-text text-danger" id="street_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="city">@lang('translation.city')</label>
                            <input type="text" class="form-control" name="city " id="city" value="{{ $customer->city }}" placeholder="@lang('translation.enter_city')"/>
                            <span class="form-text text-danger" id="city_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="zip">@lang('translation.zip')</label>
                            <input type="text" class="form-control" name="zip " id="zip" min="4" max="4" placeholder="@lang('translation.enter_zip')"/>
                            <span class="form-text text-danger" id="zip_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="country">@lang('translation.country')</label>
                            <select class="form-control" name="country" id="country">
                                <option value="">--- select country ---</option>
                                @if (count($countries) > 0)
                                    @foreach ($countries as $count)
                                        <option value="{{ $count->val }}" {{ $customer->country == $count->val ? 'selected' : '' }}>{{ $count->text }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="form-text text-danger" id="country_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label for="state">@lang('translation.state')</label>
                            <input type="hidden" name="state_count" id="state_count">
                            <select class="form-control" name="state" id="state">
                                <option value="">-- State  --</option>
                            </select>
                            <span class="form-text text-danger" id="state_error"></span>
                        </div>

                      </div>
                  </fieldset>
                  <div class="row mb-6">
                    <div class="col-md-12 col-lg-12 mb-6">
                        <button class="btn btn-danger btn-block" style="font-size:16px;" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.save')</button>
                    </div>
                  </div>
                 </div>
                <!--end::Form-->
               </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

@include('admin.administrator.manage-users.js.edit')
@endsection
