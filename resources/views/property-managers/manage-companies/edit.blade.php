@extends('layouts.master', ['link' => route('property-manager.index')])
@section('title', 'Create Property Manager')
@section('content')
@section('first', 'Manage Property Managers')
@section('second', 'Property Managers')
@section('third', 'Edit')
@section('content')
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
                     Edit Property Manager
                 </h3>
                 <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('property-manager.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> @lang('translation.back')</a>
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
                            <input type="text" class="form-control" name="name" id="name" value="{{ $company->name }}" placeholder="@lang('translation.enter_name')" autofocus/>
                            <span class="form-text text-danger" id="name_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="designation">@lang('translation.designation')</label>
                            <input type="text" class="form-control" name="designation" id="designation" value="{{ $company->designation }}" placeholder="@lang('translation.enter_designation')"/>
                            <span class="form-text text-danger" id="designation_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="name">@lang('translation.company_name')</label>
                            <input type="text" class="form-control" name="company_name" id="company_name" value="{{ $company->company_name }}" placeholder="@lang('translation.enter_company_name')" autofocus/>
                            <span class="form-text text-danger" id="company_name_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="email">@lang('translation.company_email')</label>
                            <input type="email" class="form-control" name="new_email" id="new_email" value="{{ $company->email }}" placeholder="@lang('translation.enter_company_email')"/>
                            <span class="form-text text-danger" id="new_email_error"></span>
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

                      <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="user_type_id">Account Type</label>
                        <select name="user_type_id" id="user_type_id" class="form-control">
                            <option value="">---select account type---</option>
                            <option value="2" @if($company->user_role == 2) {{ 'selected' }} @endif>Property Manager/ Owner</option>
                            <option value="4" @if($company->user_role == 4) {{ 'selected' }} @endif>Bank</option>
                            <option value="5" @if($company->user_role == 5) {{ 'selected' }} @endif>Service Provider</option>
                            <option value="6" @if($company->user_role == 6) {{ 'selected' }} @endif>Insurance</option>
                        </select>
                        <span class="form-text text-danger" id="user_type_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="mobile">Mobile No.</label>
                        <input type="tel" class="form-control" name="mobile" value="{{ $company->mobile }}" id="mobile" placeholder="@lang('translation.enter_company_mobile')" autofocus/>
                        <span class="form-text text-danger" id="mobile_error"></span>
                    </div>
                </div>
                  </fieldset>
                  <fieldset>
                      <legend for="">Other Info:</legend>
                      <div class="row mb-4">
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="phone">@lang('translation.company_phone') @lang('translation.optional')</label>
                            <input type="text" class="form-control" name="phone"  id="phone" placeholder="@lang('translation.enter_company_phone')" value="{{ $company->phone }}"/>
                            <span class="form-text text-danger" id="phone_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="state_id">Cities</label>
                            <select name="state_id" id="state_id" class="form-control">
                                <option value="">---select state---</option>
                                @if ($states->count())
                                    @foreach ($states as $item)
                                        <option value="{{ $item->id }}" @if ($item->id == $company->state) {{ 'selected' }} @endif>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="form-text text-danger" id="state_id_error"></span>
                        </div>
                        @if ($company->area_id)
                        @php
                        $areas = explode(',', $company->area_id);
                        @endphp
                        @endif
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="area_id">Area</label>
                            <select name="area_id" id="area_id" class="form-control" multiple>
                                <option value="">---select area---</option>
                                @foreach ($locations  as  $location)

                                <option value="{{ $location->id }}"
                                    @if($company->area_id)
                                      @for($i=0; $i< count($areas) ; $i++) @if($location->id == $areas[$i]) {{ 'selected' }} @endif
                                      @endfor
                                     @endif>
                                     {{ $location->name }}
                              </option>

                                @endforeach
                            </select>
                            <span class="form-text text-danger" id="area_id_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="office_address">@lang('translation.office_address') @lang('translation.optional')</label>
                            <input type="text" class="form-control" name="address " id="address" value="{{ $company->address }}" placeholder="@lang('translation.enter_office_address')"/>
                            <span class="form-text text-danger" id="office_address_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="image">Profile Image</label>
                            <input type="file" class="form-control" name="avatar " id="avatar" class="forn-control" accept="image/*" />
                            <span class="form-text text-danger" id="zip_error"></span>
                            <img loading="lazy" src="{{ asset('storage') }}/{{ $company->avatar }}" width="150px" height="150px" alt="Company Image">
                        </div>
                      </div>
                  </fieldset>
                  <fieldset>
                    <legend>Email Package:</legend>
                    <div class="row">
                      <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="branded_pay_page" class="d-block">@lang('translation.branded_pay_page') @lang('translation.optional')</label>
                          <label class="switch" style="margin:0px;">
                            <input type="checkbox" class="switch-input" name="branded_pay_page" id="branded_pay_page" value="{{ $company->branded_pay_page }}" {{ $company->branded_pay_page == 1 ? 'checked' : '' }}>
                                <span class="switch-label" data-on="On" data-off="Off"></span>
                                <span class="switch-handle"></span>
                        </label>
                          <span class="form-text text-danger" id="currency_error"></span>
                      </div>
                      <div class="col-md-6 col-lg-6 mb-4 ">
                        <label for="branded_email" class="d-block">@lang('translation.branded_email') @lang('translation.optional')</label>
                        <label class="switch" style="margin:0px;">
                            <input type="checkbox" class="switch-input" name="branded_email" id="branded_email" value="{{ $company->branded_email }}" {{ $company->branded_email == 1 ? 'checked' : '' }}>
                                <span class="switch-label" data-on="On" data-off="Off"></span>
                                <span class="switch-handle"></span>
                        </label>
                        <span class="form-text text-danger" id="branded_email_error"></span>
                    </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>SMS Package: (Optional)</legend>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 mb-4 d-none">
                            <label for="sender_id_by_number" class="d-block">@lang('translation.sender_id_by_number') <span class="text-success">{{ $company->active_sms_id == 0 ? 'Active' : '' }}</span></label>
                            <input type="text" name="sender_id_by_number" value="{{ $company->sender_id_by_number }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="sender_id_by_number" placeholder="@lang('translation.enter_sender_id_by_number')" class="form-control">
                            <span class="form-text text-danger" id="sender_id_by_number_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="sender_id_by_name" class="d-block">@lang('translation.sender_id_by_name') <span class="text-success">{{ $company->active_sms_id == 1 ? 'Active' : '' }}</span></label>
                          <input type="text" name="sender_id_by_name" id="sender_id_by_name" value="{{ $company->sender_id_by_name }}" placeholder="@lang('translation.enter_sender_id_by_name')" class="form-control">
                          <span class="form-text text-danger" id="sender_id_by_name_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 d-none">
                            <label for="secrate_key" class="d-block">@lang('translation.secrate_key') </label>
                            <input type="text" name="secrate_key" id="secrate_key" value="{{ $company->secrate_key }}" placeholder="@lang('translation.enter_secrate_key')" class="form-control">
                            <span class="form-text text-danger" id="secrate_key_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="api_key" class="d-block">@lang('translation.api_key') </label>
                            <input type="text" name="api_key" id="api_key" value="{{ $company->api_key }}" placeholder="@lang('translation.enter_api_key')" class="form-control">
                            <span class="form-text text-danger" id="api_key_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                          <label for="sms_limit" class="d-block">@lang('translation.sms_limit') </label>
                          <input type="text" name="sms_limit" value="{{ $company->sms_limit }}"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="sms_limit" placeholder="@lang('translation.enter_sms_limit')" class="form-control">
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
                        <option value="2" class="d-none" id="rejected_id">Rejected</option>
                    </select>
                    <span class="form-text text-danger" id="status_error"></span>
                </div>
                <div class="col-md-6 col-lg-6 mb-4 d-none" id="reason_div">
                    <label for="reason">@lang('translation.reason') </label>
                    <input type="text" name="b_reason" id="b_reason" class="form-control">
                    <span class="form-text text-danger" id="b_reason_error"></span>
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
                                {{-- <th>Active</th> --}}
                                <th class="text-center" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @if (count($company->banks) > 0)
                                @foreach ($company->banks as $key => $bank)
                                <tr id="row_{{ $bank->id }}"
                                @if (isset($row_id) && $row_id == $bank->id)
                                    style="background-color:#fac2ac"
                                @endif>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $bank->bank_name }}</td>
                                    <td>{{ $bank->bic }}</td>
                                    <td>{{ $bank->account_name }}</td>
                                    <td>{{ $bank->account_no }}</td>
                                    <td>{{ $bank->iban }}</td>
                                    <td>{{ $bank->currency }}</td>
                                    <td>
                                        @if($bank->status == 0)

                                            <label class="label label-lg label-light-warning label-inline">Under Review</label>

                                        @elseif($bank->status == 1)

                                            <label class="label label-lg label-light-success label-inline">Approved</label>

                                        @else

                                            <label class="label label-lg label-light-danger label-inline">Rejected</label>
                                        @endif

                                    </td>
                                    {{-- <td>
                                        @if($bank->is_active == 1)

                                            <label class="label label-lg label-light-success label-inline">Active</label>

                                        @elseif($bank->is_active == 0)

                                            <label class="label label-lg label-light-danger label-inline">Not Active</label>
                                        @endif

                                    </td> --}}
                                    <td>
                                                <input type="hidden" name="e_id" value="{{ $bank->id }}"/>
                                                <input type="hidden" name="e_bank_name" value="{{ $bank->bank_name }}"/>
                                                <input type="hidden" name="e_bic" value="{{ $bank->bic }}"/>
                                                <input type="hidden" name="e_account_no" value="{{ $bank->account_no }}"/>
                                                <input type="hidden" name="e_account_name" value="{{ $bank->account_name }}"/>
                                                <input type="hidden" name="e_iban" value="{{ $bank->iban }}"/>
                                                <input type="hidden" name="e_currency" value="{{ $bank->currency }}"/>
                                                <input type="hidden" name="e_status" value="{{ $bank->status }}"/>
                                                <input type="hidden" name="e_reason" value="{{ $bank->reason }}"/>
                                                <a id="edit" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
                                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                    </g>
                                                    </svg>
                                                </span>
                                                </a>
                                                <a id="delete" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                            <span class="svg-icon svg-icon-md svg-icon-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                    <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                            </span>
                            </a>
                                    </td>

                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                    </div>
                </fieldset>
                  <div class="row mb-6">
                    <div class="col-md-12 col-lg-12 mb-6">
                        <button class="btn btn-cherwell btn-block" style="font-size:16px;" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.edit_company')</button>
                    </div>
                  </div>
                 </div>
                <!--end::Form-->
               </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('property-managers.manage-companies.js.edit')
@endsection
