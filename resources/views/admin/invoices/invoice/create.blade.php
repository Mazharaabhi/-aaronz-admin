@extends('layouts.master', ['link' => route('admin.invoices.invoice.index')])
@section('title', 'Create Invoice')
@section('first', 'Invoice')
@section('second', 'Invoices')
@section('third', 'Invoice')
@section('fourth', 'Create')
@section('content')

@section('content')
<style>
    hr{
        margin:10px !important;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }
</style>
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                    @if (is_null($paytab))
                  <h3 class="card-title text-danger">Warning: To continue please create MyridePay account got to -> Configurations -> MyridePay Account <a href="{{ route('admin.configurations.paytabs-config.index') }}" class="btn btn-success btn-sm">Set Myridepay Account</a></h3>
                  @elseif(!is_null($paytab))
                    @if ($paytab->server_key == "" || $paytab->profile_id == "" || $paytab->cart_id == "")
                    <h3 class="card-title text-danger">Warning: To Continue pelase complete your paytab configurations got to -> Configurations -> MyridePay Account <a href="{{ route('admin.configurations.paytabs-config.index') }}" class="btn btn-success btn-sm">Set Myridepay Account</a></h3>
                    @elseif($paytab->type == 1)
                    <h3 class="card-title text-success">Your Live account is currently active</h3>
                    @elseif($paytab->type == 2)
                    <h3 class="card-title text-success">Your Sandbox account is currently active</h3>
                    @endif
                  @endif
                 <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('admin.invoices.invoice.index') }}" class="btn btn-danger float-right"><span class="fa fa-mail-reply"></span> @lang('translation.back')</a>
                    </div>
                   </div>
                </div>
                <!--begin::Form-->
                 <div class="card-body">
                  <fieldset>
                    <legend>Customer Details:</legend>
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
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="currency">Currency</label>
                            <select name="my_currency" id="my_currency" class="form-control">
                                @foreach ($currencies as $item)
                                    <option value="{{ $item->from_currency }}" {{ $item->from_currency == 'AED' ? 'selected' : '' }}>{{ $item->from_currency }}</option>
                                @endforeach
                            </select>
                            <span class="form-text text-danger" id="currency_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="transaction_type">@lang('translation.transaction_type')</label>
                            <select name="tran_type" id="tran_type" class="form-control">
                                <option value="sale">Sales</option>
                                <option value="auth">Pre-Auth</option>
                            </select>
                            <span class="form-text text-danger" id="tran_type_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="customer_ref">@lang('translation.customer_ref') @lang('translation.optional')</label>
                            <input type="text" class="form-control" name="customer_ref" id="customer_ref" placeholder="@lang('translation.enter_customer_ref')" autofocus/>
                            <span class="form-text text-danger" id="customer_ref_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="invoice_ref">@lang('translation.invoice_ref') @lang('translation.optional')</label>
                            <input type="text" class="form-control" name="invoice_ref" id="invoice_ref" placeholder="@lang('translation.enter_invoice_ref')" autofocus/>
                            <span class="form-text text-danger" id="invoice_ref_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="phone">@lang('translation.phone') @lang('translation.optional')</label>
                            <input type="number" class="form-control" name="phone" id="phone" placeholder="@lang('translation.enter_phone')" autofocus/>
                            <span class="form-text text-danger" id="phone_error"></span>
                        </div>

                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="street">@lang('translation.street') @lang('translation.optional')</label>
                            <input type="text" class="form-control" name="address " id="address" placeholder="@lang('translation.enter_street')"/>
                            <span class="form-text text-danger" id="street_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="city">@lang('translation.city') @lang('translation.optional')</label>
                            <input type="text" class="form-control" name="city " id="city" placeholder="@lang('translation.enter_city')"/>
                            <span class="form-text text-danger" id="city_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="country">@lang('translation.country') @lang('translation.optional')</label>
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
                            <label for="state">@lang('translation.state') @lang('translation.optional')</label>
                            <input type="hidden" name="state_count" id="state_count">
                            <select class="form-control" name="state" id="state">
                                <option value="">-- State  --</option>
                                </select>
                            <span class="form-text text-danger" id="state_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label for="state">zip</label>
                            <input type="text" name="zip" id="zip" value="" class="form-control" disabled>
                            <span class="form-text text-danger" id="state_error"></span>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="description">@lang('translation.description') @lang('translation.optional')</label>
                            <input type="text" name="d_description" id="d_description" value="" class="form-control">
                            <span class="form-text text-danger" id="description_error"></span>
                          </div>
                      </div>
                  </fieldset>
                  <fieldset>
                      <legend>Invoice Items:</legend>
                      <div class="row">
                          <div class="col-md-12 col-lg-12 col-sm-12">
                              <table class="table table-bordered table-sm">
                                  <thead>
                                      <tr>
                                            <th width="15%">SKU</th>
                                            <th width="25%">Description</th>
                                            <th width="10%">Unit Price</th>
                                            <th width="10%">Quantity</th>
                                            <th width="10%">Discount</th>
                                            <th width="10%">Tax</th>
                                            <th width="15%">Total</th>
                                            <th width="5%">Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody id="tbody">
                                  </tbody>
                              </table>
                          </div>
                          <div class="col-md-12 col-lg-12 col-sm-12">
                              <button class="btn btn-danger float-right mr-1" id="add-row"><i class="fa fa-plus"></i> Add </button>
                          </div>
                          <div class="col-md-12 col-lg-12 col-sm-12">
                          <div class="row">
                              <div class="col-md-5 col-lg-5 col-sm-12"></div>
                              <div class="col-md-7 col-lg-7 col-sm-12">
                                <hr>
                                <label for="" class="mt-2 ml-5"><b>Sub Total</b></label> <input type="number" onkeypress="return isNumberKey(event)"  name="sub_total" id="sub_total" disabled class="form-control ml-1 float-right" style="display: inline-block;width:80%">
                                <hr>
                                <label for="" class="mt-2 ml-5"><b>Discount</b></label> <input type="number" onkeypress="return isNumberKey(event)"  name="extra_discount" id="extra_discount" value="0" class="form-control ml-1 float-right" style="display: inline-block;width:80%">
                                <hr>
                                <label for="" class="mt-2 ml-5"><b>Extra Charge</b></label> <input type="number" onkeypress="return isNumberKey(event)"  name="extra_charge" id="extra_charge" value="0" class="form-control ml-1 float-right" style="display: inline-block;width:80%">
                                <hr>
                                <label for="" class="mt-2 ml-5"><b>Shipping Charge</b></label> <input type="number" onkeypress="return isNumberKey(event)"  name="shipping_charges" id="shipping_charges" value="0" class="form-control ml-1 float-right" style="display: inline-block;width:80%">
                                <hr>
                                <label for="" class="mt-2 ml-5"><b>Grand Total</b></label> <input type="number" onkeypress="return isNumberKey(event)"  name="total_amount" id="total_amount" disabled class="form-control ml-1 float-right" style="display: inline-block;width:80%">

                            </div>
                          </div>
                        </div>
                      </div>
                  </fieldset>
                  <div class="row mb-6">
                    <div class="col-md-12 col-lg-12 mb-6">
                        @if (is_null($paytab))
                        <button class="btn btn-danger btn-block" style="font-size:16px;" disabled><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.create_invoice')</button>
                        @elseif(!is_null($paytab))
                          @if ($paytab->server_key == "" || $paytab->profile_id == "" || $paytab->cart_id == "")
                          <button class="btn btn-danger btn-block" style="font-size:16px;" disabled><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.create_invoice')</button>
                          @else
                          <button class="btn btn-danger btn-block" style="font-size:16px;" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.create_invoice')</button>
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
@include('admin.invoices.invoice.modals')
@include('admin.invoices.invoice.js.create')
@endsection
