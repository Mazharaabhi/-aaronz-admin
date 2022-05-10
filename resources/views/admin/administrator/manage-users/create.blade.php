@extends('layouts.master', ['linke' => route('admin.administrator.manage-users.index')])
@section('title', 'Create User')
@section('first', 'Create User')
@section('second', 'Administrator')
@section('third', 'Create User')
@section('fourth', 'Create')

@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                 <h3 class="card-title">
                  Create User
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
                            <input type="text" class="form-control" name="name" id="name" placeholder="@lang('translation.enter_name')" autofocus/>
                            <span class="form-text text-danger" id="name_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="email">@lang('translation.email')</label>
                            <input type="email" class="form-control" name="customer_email" id="customer_email" placeholder="@lang('translation.enter_email')"/>
                            <span class="form-text text-danger" id="email_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="password">Password <button class="btn btn-success btn-sm" id="generate_password" style="padding: 2px 12px 2px 12px !important"><span class="fa fa-plus"></span> Generate</button></label>
                            <input type="text" class="form-control" name="password" id="password" placeholder="Enter password" autofocus="">
                            <span class="form-text text-danger" id="password_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="text" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter confirm password">
                            <span class="form-text text-danger" id="confirm_password_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="confirm_password">User Role</label>
                            <select name="role_id" id="role_id" class="form-control">
                                <option value="">---select user role---</option>
                                @if (count($roles) > 0)
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
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
                            <input type="number" class="form-control" name="phone" id="phone" placeholder="@lang('translation.enter_phone')"/>
                            <span class="form-text text-danger" id="phone_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="street">@lang('translation.street')</label>
                            <input type="text" class="form-control" name="street " id="street" placeholder="@lang('translation.enter_street')"/>
                            <span class="form-text text-danger" id="street_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="city">@lang('translation.city')</label>
                            <input type="text" class="form-control" name="city " id="city" placeholder="@lang('translation.enter_city')"/>
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
                                        <option value="{{ $count->val }}" >{{ $count->text }}</option>
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

@include('admin.administrator.manage-users.js.create')
@endsection
