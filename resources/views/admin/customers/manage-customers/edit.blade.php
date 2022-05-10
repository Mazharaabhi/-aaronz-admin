@extends('layouts.master', ['linke' => route('admin.administrator.manage-users.index')])
@section('title', 'Edit Customer')
@section('first', 'Edit Customer')
@section('second', 'Administrator')
@section('third', 'Edit Customer')
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
                  Edit Customer
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
                            <input type="text" class="form-control" name="name" id="name" value="{{ $customer->name }}" placeholder="Enter full name" autofocus/>
                            <span class="form-text text-danger" id="name_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="email">@lang('translation.email')</label>
                            <input type="email" class="form-control" name="customer_email" value="{{ $customer->email }}" id="customer_email" placeholder="@lang('translation.enter_email')"/>
                            <span class="form-text text-danger" id="email_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="phone">@lang('translation.phone')</label>
                            <input type="number" class="form-control" name="phone" value="{{ $customer->phone }}"  id="phone" placeholder="@lang('translation.enter_phone')"/>
                            <span class="form-text text-danger" id="phone_error"></span>
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

@include('admin.customers.manage-customers.js.edit')
@endsection
