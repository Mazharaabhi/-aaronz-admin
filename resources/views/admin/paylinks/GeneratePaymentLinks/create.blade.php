@extends('layouts.master', ['link' => route('admin.paylinks.generate-payment-link.index')])
@section('title', 'Generate Payment Link')
@section('first', 'Payment Link')
@section('second', 'Pay Link')
@section('third', 'Payment Link')
@section('fourth', 'Create')

@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                  @if (is_null($paytab))
                  <h3 class="card-title text-danger">Warning: To continue please create MyridePay account got to -> Configurations -> MyridePay Account</h3>
                  @elseif(!is_null($paytab))
                    @if ($paytab->server_key == "" || $paytab->profile_id == "" || $paytab->cart_id == "")
                    <h3 class="card-title text-danger">Warning: To Continue pelase complete your paytab configurations got to -> Configurations -> MyridePay Account</h3>
                    @elseif($paytab->type == 1)
                    <h3 class="card-title text-success">Your Live account is currently active</h3>
                    @elseif($paytab->type == 2)
                    <h3 class="card-title text-success">Your Sandbox account is currently active</h3>
                    @endif
                  @endif

                 <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('admin.paylinks.generate-payment-link.index') }}" class="btn btn-danger float-right"><span class="fa fa-mail-reply"></span> @lang('translation.back')</a>
                    </div>
                   </div>
                </div>
                <!--begin::Form-->
                 <div class="card-body">
                  <fieldset>
                    <legend>Amount Description</legend>
                    <div class="row mb-4">
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="amount">@lang('translation.amount')</label>
                            <input type="number" class="form-control" name="amount" id="amount" placeholder="@lang('translation.enter_amount')" autofocus/>
                            <span class="form-text text-danger" id="amount_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label for="description">@lang('translation.description')</label>
                            <input type="text" class="form-control" name="description" id="description" placeholder="@lang('translation.enter_description')">
                            <span class="form-text text-danger" id="description_error"></span>
                        </div>
                  </fieldset>
                  <fieldset>
                    <legend>Payment Details:</legend>
                    <div class="row mb-4">
                        <div class="col-md-6 col-lg-6">
                            <label for="name">@lang('translation.full_name')</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="@lang('translation.eg_john_doe')" autofocus/>
                            <span class="form-text text-danger" id="name_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label for="email">@lang('translation.email')</label>
                            <input type="email" class="form-control" name="link_email" id="link_email" placeholder="@lang('translation.enter_email')"/>
                            <span class="form-text text-danger" id="email_error"></span>
                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="phone">@lang('translation.phone')</label>
                            <input type="number" class="form-control" name="phone" id="phone" placeholder="@lang('translation.enter_phone')" autofocus/>
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
                            <label for="zip">@lang('translation.zip') @lang('translation.optional')</label>
                            <input type="text" class="form-control" name="zip " id="zip" min="4" max="4" placeholder="@lang('translation.enter_zip')"/>
                            <span class="form-text text-danger" id="zip_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="country">@lang('translation.country')</label>
                            <select class="form-control" name="country" id="country">
                                <option value="">--- select country ---</option>
                                @if (count($countries) > 0)
                                    @foreach ($countries as $count)
                                        <option value="{{ $count->val }}">{{ $count->text }}</option>
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
                        @if (is_null($paytab))
                        <button class="btn btn-danger btn-block" style="font-size:16px;" disabled><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.generate_link')</button>
                        @elseif(!is_null($paytab))
                          @if ($paytab->server_key == "" || $paytab->profile_id == "" || $paytab->cart_id == "")
                          <button class="btn btn-danger btn-block" style="font-size:16px;" disabled><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.generate_link')</button>
                          @else
                          <button class="btn btn-danger btn-block" style="font-size:16px;" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.generate_link')</button>
                          @endif
                        @endif
                    </div>
                  </div>
                 </div>
                <!--end::Form-->
               </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('admin.paylinks.GeneratePaymentLinks.modals')
@include('admin.paylinks.GeneratePaymentLinks.js.create')
@endsection
