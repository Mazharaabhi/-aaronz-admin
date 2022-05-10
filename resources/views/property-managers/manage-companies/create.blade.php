@extends('layouts.master', ['link' => route('property-manager.index')])
@section('title', 'Create Property Manager')
@section('content')
@section('first', 'Manage  Property Managers')
@section('second', 'Property Managers')
@section('third', 'Create')
<style>


.switch {
    display: block;
  margin: 12px auto;
	position: relative;
	display: inline-block;
	vertical-align: top;
	width: 70px;
	height: 30px;
	padding: 3px;
	background-color: white;
	-moz-border-radius: 18px;
	-webkit-border-radius: 18px;
	border-radius: 18px;
	cursor: pointer;
}

.switch-input {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}

.switch-label {
	position: relative;
	display: block;
	height: inherit;
	font-size: 10px;
	text-transform: uppercase;
	background:#bdc3c7;
	-moz-border-radius: inherit;
	-webkit-border-radius: inherit;
	border-radius: inherit;
	-webkit-transition: 0.15s ease-out;
	-moz-transition: 0.15s ease-out;
	-o-transition: 0.15s ease-out;
	transition: 0.15s ease-out;
	-webkit-transition-property: opacity background border;
	-moz-transition-property: opacity background border;
	-o-transition-property: opacity background border;
	transition-property: opacity background border;
}
.switch-label:before, .switch-label:after {
  position: absolute;
  top: 50%;
  margin-top: -.5em;
  line-height: 1;
  -webkit-transition: inherit;
  -moz-transition: inherit;
  -o-transition: inherit;
  transition: inherit;
  font-size:14px;
}
.switch-label:before {
  content: attr(data-off);
  right: 11px;
  color: #000;
}
.switch-label:after {
  content: attr(data-on);
  left: 11px;
  color: white;
  opacity: 0;
}
.switch-input:checked ~ .switch-label {
	background: #34495E;
}
.switch-input:checked ~ .switch-label:before {
  opacity: 0;
}
.switch-input:checked ~ .switch-label:after {
  opacity: 1;
}

.switch-handle {
	position: absolute;
	top: 9px;
	left: 10px;
	width: 18px;
	height: 18px;
	background: white;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-webkit-transition: left 0.15s ease-out;
	-moz-transition: left 0.15s ease-out;
	-o-transition: left 0.15s ease-out;
	transition: left 0.15s ease-out;
}
	.switch-handle:before {
		content: '';
		position: absolute;
		top: 50%;
		left: 50%;
		margin: -6px 0 0 -6px;
		width: 12px;
		height: 12px;
		background: #f9f9f9;
		-moz-border-radius: 6px;
		-webkit-border-radius: 6px;
		border-radius: 6px;
		-moz-box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
		-webkit-box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
		box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
		background-image: -webkit-linear-gradient(top, #eeeeee, white);
		background-image: -moz-linear-gradient(top, #eeeeee, white);
		background-image: -o-linear-gradient(top, #eeeeee, white);
		background-image: linear-gradient(to bottom, #eeeeee, white);
	}


.switch-input:checked ~ .switch-handle {
	background:#1abc9c;
	left: 45px;
	-moz-box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
	-webkit-box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
	box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}

.switch-input:checked ~	.switch-handle:before{
	background:#1abc9c;
}
.switch-green > .switch-input:checked ~ .switch-label {
  background: #4fb845;
}
</style>
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                 <h3 class="card-title">
                  Add Property Manager
                 </h3>
                 <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('property-manager.index') }}" class="btn btn-danger float-right"><span class="fa fa-mail-reply"></span> @lang('translation.back')</a>
                    </div>
                   </div>
                </div>
                <!--begin::Form-->
                 <div class="card-body">
                  <fieldset>
                      <legend>Account Info: <label class="badge badge-danger" style="padding: 2px 12px 2px 12px !important">Mandatory</label></legend>
                      <div class="row mb-4">
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="name">@lang('translation.name')</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="@lang('translation.enter_name')" autofocus/>
                            <span class="form-text text-danger" id="name_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="designation">@lang('translation.designation')</label>
                            <input type="text" class="form-control" name="designation" id="designation" placeholder="@lang('translation.enter_designation')"/>
                            <span class="form-text text-danger" id="designation_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="name">@lang('translation.company_name')</label>
                            <input type="text" class="form-control" name="company_name" id="company_name" placeholder="@lang('translation.enter_company_name')" autofocus/>
                            <span class="form-text text-danger" id="company_name_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="email">@lang('translation.company_email')</label>
                            <input type="email" class="form-control" name="new_email" id="new_email" placeholder="@lang('translation.enter_company_email')"/>
                            <span class="form-text text-danger" id="new_email_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="password">@lang('translation.password') <button class="btn btn-success btn-sm" id="generate_password" style="padding: 2px 12px 2px 12px !important"><span class="fa fa-plus"></span> Generate</button></label>
                            <input type="text" class="form-control" name="password" id="password" placeholder="@lang('translation.enter_password')" autofocus/>
                            <span class="form-text text-danger" id="password_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="confirm_password">@lang('translation.confirm_password')</label>
                            <input type="text" class="form-control" name="confirm_password" id="confirm_password" placeholder="@lang('translation.enter_confirm_password')"/>
                            <span class="form-text text-danger" id="confirm_password_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="user_type_id">Account Type</label>
                            <select name="user_type_id" id="user_type_id" class="form-control">
                                <option value="">---select account type---</option>
                                <option value="2">Property Manager/ Owner</option>
                                <option value="4">Bank</option>
                                <option value="5">Service Provider</option>
                                <option value="6">Insurance</option>
                            </select>
                            <span class="form-text text-danger" id="user_type_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="mobile">Mobile No.</label>
                            <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="@lang('translation.enter_company_mobile')" autofocus/>
                            <span class="form-text text-danger" id="mobile_error"></span>
                        </div>
                      </div>
                  </fieldset>
                  <fieldset>
                      <legend for="">Others Info: (Optional)</legend>
                      <div class="row mb-4">
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="@lang('translation.enter_company_phone')" autofocus/>
                            <span class="form-text text-danger" id="phone_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="state_id">Cities</label>
                            <select name="state_id" id="state_id" class="form-control">
                                <option value="">---select state---</option>
                                @if ($states->count())
                                    @foreach ($states as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="form-text text-danger" id="state_id_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="area_id">Area</label>
                            <select name="area_id" id="area_id" class="form-control" multiple>
                                <option value="">---select area---</option>
                            </select>
                            <span class="form-text text-danger" id="area_id_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="office_address">@lang('translation.office_address')</label>
                            <input type="text" class="form-control" name="address " id="address" placeholder="@lang('translation.enter_office_address')"/>
                            <span class="form-text text-danger" id="office_address_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="image">Profile Image</label>
                            <input type="file" class="form-control" name="avatar " id="avatar" class="forn-control" accept="image/*" />
                            <span class="form-text text-danger" id="zip_error"></span>
                        </div>
                      </div>
                  </fieldset>
                  <fieldset>
                    <legend>Email Package: (Optional)</legend>
                    <div class="row">
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="branded_pay_page" class="d-block">@lang('translation.branded_pay_page')</label>
                          <label class="switch" style="margin:0px;">
                            <input type="checkbox" class="switch-input" name="branded_pay_page" id="branded_pay_page" value="0">
                                <span class="switch-label" data-on="On" data-off="Off"></span>
                                <span class="switch-handle"></span>
                        </label>
                          <span class="form-text text-danger" id="currency_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="branded_email" class="d-block">@lang('translation.branded_email')</label>
                        <label class="switch" style="margin:0px;">
                          <input type="checkbox" class="switch-input" name="branded_email" id="branded_email" value="0">
                              <span class="switch-label" data-on="On" data-off="Off"></span>
                              <span class="switch-handle"></span>
                      </label>
                        <span class="form-text text-danger" id="currency_error"></span>
                    </div>
                </div>
                </fieldset>
                <fieldset>
                    <legend>SMS Package: (Optional)</legend>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 mb-4 d-none">
                            <label for="sender_id_by_number" class="d-block">@lang('translation.sender_id_by_number') </label>
                            <input type="text" name="sender_id_by_number" value="5389" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="sender_id_by_number" placeholder="@lang('translation.enter_sender_id_by_number')" class="form-control">
                            <span class="form-text text-danger" id="sender_id_by_number_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="sender_id_by_name" class="d-block">@lang('translation.sender_id_by_name') </label>
                          <input type="text" name="sender_id_by_name" id="sender_id_by_name" value="MyRide" placeholder="@lang('translation.enter_sender_id_by_name')" class="form-control">
                          <span class="form-text text-danger" id="sender_id_by_name_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 d-none">
                            <label for="secrate_key" class="d-block">@lang('translation.secrate_key') </label>
                            <input type="text" name="secrate_key" id="secrate_key" placeholder="@lang('translation.enter_secrate_key')" class="form-control">
                            <span class="form-text text-danger" id="secrate_key_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="api_key" class="d-block">@lang('translation.api_key') </label>
                            <input type="text" name="api_key" id="api_key" value="C20028525e987cee08a299.44558809" placeholder="@lang('translation.enter_api_key')" class="form-control">
                            <span class="form-text text-danger" id="api_key_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="sms_limit" class="d-block">@lang('translation.sms_limit') </label>
                          <input type="text" name="sms_limit" value="100"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="sms_limit" placeholder="@lang('translation.enter_sms_limit')" class="form-control">
                          <span class="form-text text-danger" id="sms_limit_error"></span>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Bank Details: (Optional)</legend>
                    <div class="row">
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="bank_name" class="d-block">@lang('translation.bank_name') </label>
                          <input type="text" name="bank_name" id="bank_name" placeholder="@lang('translation.enter_bank_name')" class="form-control">
                          <span class="form-text text-danger" id="bank_name_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="bic" class="d-block">@lang('translation.bic') </label>
                        <input type="text" name="bic" id="bic" placeholder="@lang('translation.enter_bic')" class="form-control">
                        <span class="form-text text-danger" id="bic_error"></span>
                    </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="account_name" class="d-block">@lang('translation.account_name') </label>
                        <input type="text" name="account_name" id="account_name" placeholder="@lang('translation.enter_account_name')" class="form-control">
                        <span class="form-text text-danger" id="account_name_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="iban" class="d-block">@lang('translation.iban') @lang('translation.unique')</label>
                        <input type="text" name="iban" maxlength="32" id="iban" placeholder="@lang('translation.enter_iban')" class="form-control">
                        <span class="form-text text-danger" id="iban_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4 ">
                      <label for="account_no" class="d-block">@lang('translation.account_no') @lang('translation.unique')</label>
                      <input type="text" name="account_no" id="account_no" placeholder="@lang('translation.enter_account_no')" class="form-control">
                      <span class="form-text text-danger" id="account_no_error"></span>
                  </div>
                <div class="col-md-6 col-lg-6 mb-4 ">
                    <label for="status">@lang('translation.status') </label>
                    <select name="b_status" id="b_status" class="form-control">
                        <option value="0">Under Review</option>
                        <option value="1">Accepted</option>
                        <option value="2" class="d-none">Rejected</option>
                    </select>
                    <span class="form-text text-danger" id="status_error"></span>
                </div>
                <div class="col-md-6 col-lg-6 mb-4">
                    <button class="btn btn-warning btn-sm mt-7" style="font-size:15px;" id="add"><span class="fa fa-plus"></span> Add Bank</button>
                    <button class="btn btn-warning btn-sm mt-7 d-none" style="font-size:15px;" id="edit_btn"><span class="fa fa-plus"></span> Edit Bank</button>
                </div>
                <div class="col-md-12 col-lg-12 mb-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">Id</th>
                                <th>Bank Name</th>
                                <th>BIC/SWIFT</th>
                                <th>Account Name</th>
                                <th>Account no.</th>
                                <th>IBAN</th>
                                <th>Currency</th>
                                <th>Status</th>
                                <th class="text-center" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                    </table>
                </div>
                    </div>
                </fieldset>
                  <div class="row mb-6">
                    <div class="col-md-12 col-lg-12 mb-6">
                        <button class="btn btn-danger btn-block" style="font-size:16px;" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.add_company')</button>
                    </div>
                  </div>
                 </div>
                <!--end::Form-->
               </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('property-managers.manage-companies.js.create')
@endsection
