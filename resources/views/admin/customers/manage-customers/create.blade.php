@extends('layouts.master', ['linke' => route('admin.administrator.manage-users.index')])
@section('title', 'Create Customer')
@section('first', 'Create Customer')
@section('second', 'Administrator')
@section('third', 'Create Customer')
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
                  Create Customer
                 </h3>
                 <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('admin.customers.manage-customer.index') }}" class="btn btn-danger float-right"><span class="fa fa-mail-reply"></span> @lang('translation.back')</a>
                    </div>
                   </div>
                </div>
                <!--begin::Form-->
                 <div class="card-body">
                  <fieldset>
                      <legend>Mandatory Fields</legend>
                      <div class="row mb-2">
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter full name" autofocus/>
                            <span class="form-text text-danger" id="name_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="email">@lang('translation.email')</label>
                            <input type="email" class="form-control" name="customer_email" id="customer_email" placeholder="@lang('translation.enter_email')"/>
                            <span class="form-text text-danger" id="email_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="phone">@lang('translation.phone')</label>
                            <input type="number" class="form-control" name="phone" id="phone" placeholder="@lang('translation.enter_phone')"/>
                            <span class="form-text text-danger" id="phone_error"></span>
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

@include('admin.customers.manage-customers.js.create')
@endsection
