@extends('layouts.master', ['linke' => route('admin.customers.manage-customer.index')])
@section('title', 'Edit Customer')
@section('first', 'Manage Customers')
@section('second', 'Customers')
@section('third', 'Manage Customers')
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
                  @lang('translation.edit_customer')
                 </h3>
                 <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('admin.customers.manage-customer.index') }}" class="btn btn-danger float-right"><span class="fa fa-mail-reply"></span> @lang('translation.back')</a>
                    </div>
                   </div>
                </div>
                <!--begin::Form-->
                 <div class="card-body">
                  <div class="row mb-4">
                    <div class="col-md-6 col-lg-6">
                        <label for="name">@lang('translation.name')</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="@lang('translation.enter_name')" autofocus value="{{ $customer->name }}"/>
                        <span class="form-text text-danger" id="name_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <label for="email">@lang('translation.email')</label>
                        <input type="email" class="form-control" name="customer_email" id="customer_email" placeholder="@lang('translation.enter_email')" value="{{ $customer->email }}"/>
                        <span class="form-text text-danger" id="email_error"></span>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="phone">@lang('translation.phone')</label>
                        <input type="number" class="form-control" name="phone" id="phone" placeholder="@lang('translation.enter_phone')" value="{{ $customer->phone }}"/>
                        <span class="form-text text-danger" id="phone_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <label for="street">@lang('translation.street')</label>
                        <input type="text" class="form-control" name="street " id="street" placeholder="@lang('translation.enter_street')" value="{{ $customer->address }}"/>
                        <span class="form-text text-danger" id="street_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <label for="city">@lang('translation.city')</label>
                        <input type="text" class="form-control" name="city " id="city" placeholder="@lang('translation.enter_city')" value="{{ $customer->city }}"/>
                        <span class="form-text text-danger" id="city_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <label for="zip">@lang('translation.zip')</label>
                        <input type="text" class="form-control" name="zip " id="zip" min="4" max="4" placeholder="@lang('translation.enter_zip')" value="{{ $customer->zip }}"/>
                        <span class="form-text text-danger" id="zip_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <label for="country">@lang('translation.country')</label>
                        <select class="form-control" name="country" id="country">
                            <option value="">--- select country ---</option>
                            @if (count($countries) > 0)
                                @foreach ($countries as $count)
                                    <option value="{{ $count->val }}" {{ $count->val == $customer->country ? "selected" : '' }}>{{ $count->text }}</option>
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
