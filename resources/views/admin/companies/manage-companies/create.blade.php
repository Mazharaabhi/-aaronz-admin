@extends('layouts.master', ['link' => route('admin.companies.manage-companies.index')])
@section('title', 'Create Company')
@section('content')
@section('first', 'Manage Companies')
@section('second', 'Companies')
@section('third', 'Manage Companies')
@section('fourth', 'Create')
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
                  @lang('translation.add_company')
                 </h3>
                 <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('admin.companies.manage-companies.index') }}" class="btn btn-danger float-right"><span class="fa fa-mail-reply"></span> @lang('translation.back')</a>
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
                            <label for="phone">@lang('translation.company_phone')</label>
                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="@lang('translation.enter_company_phone')" autofocus/>
                            <span class="form-text text-danger" id="phone_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="account_type">Account Type</label>
                            <select name="account_type" id="account_type" class="form-control">
                                <option value="">---select account type---</option>
                                <option value="2">Property Manager/ Owner</option>
                                {{--  <option value="4">Bank</option>  --}}
                                <option value="5">Service Provider</option>
                                {{--  <option value="6">Insurance</option>  --}}
                            </select>
                            <span class="form-text text-danger" id="account_type_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 d-none" id="services_div">
                            <p><label for=""><b>Services</b></label></p>
                            @if ($services->count())
                                @foreach ($services as $item)
                                <span class="col-md-4"><input type="checkbox" name="services" value="{{ $item->id }}" style="cursor: pointer;"  id="{{ $item->name.'_'.$item->id }}" class="chk-green">
                                <label for="{{ $item->name.'_'.$item->id }}" style="min-width:227px;cursor: pointer;">{{ $item->name }}</label></span>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-md-12 col-lg-12 mb-4 ">
                            <label class="mr-2">Company Profile Image</label>
                            <div class="group-contain" style="
                               display: flex;
                               ">
                               <div class="btn btn-secondary fileinput-button" style="line-height: 2;height: 50px;">
                                  <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                  <input id="fileupload-btn-one" type="file" name="avatar" accept="image/*">
                               </div>
                               <div class="form-group" style="
                                  display: block;
                                  margin: 0 auto;
                                  ">
                                  <div id="uploadList" class="list-group list-group-flush list-group-divider" style="margin: auto;">
                                     <img loading="lazy" src="#" alt="Preview Image" id="blah-one" class="d-none">
                                  </div>
                               </div>
                            </div>
                            <!-- /.form-group -->
                            <span id="image_one_error" class="text-danger"></span>
                         </div>
                      </div>
                  </fieldset>
                  <fieldset>
                      <legend for="">Company Info: (Optional)</legend>
                      <div class="row mb-4">

                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="mobile">Whatsapp Number</label>
                            <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="Enter whatsapp number" autofocus/>
                            <span class="form-text text-danger" id="mobile_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="country">@lang('translation.country')</label>
                            <select class="form-control" name="country" id="country">
                                <option value="">-- Country  --</option>
                                @if (count($countries) > 0)
                                    @foreach ($countries as $cont)
                                        <option value="{{ $cont->id }}" {{ $cont->is_default == 1 ? 'selected' : '' }}>{{ $cont->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="form-text text-danger" id="country_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label for="state">@lang('translation.state')</label>
                            <select class="form-control" name="state" id="state">
                                <option value="">-- State  --</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address " id="address" placeholder="@lang('translation.enter_address')"/>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="po_box">P.O Box</label>
                            <input type="text" class="form-control" name="po_box " id="po_box" placeholder="Enter P.O Box"/>
                        </div>
                        <div class="col-md-12 col-lg-12 mb-4">
                            <label for="image">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                      </div>
                  </fieldset>
                  <fieldset>
                      <legend>Corporate Licenses</legend>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 mb-4 ">
                                <label for="rera_no" class="d-block">RERA nO. (ORN)</label>
                                <input type="text" name="rera_no" id="rera_no" placeholder="Enter RERA No." class="form-control">
                            </div>
                            <div class="col-md-6 col-lg-6 mb-4 ">
                                <label for="rera_exp_date" class="d-block">Expiry Date</label>
                                <input type="date" name="rera_exp_date" id="rera_exp_date" placeholder="Enter RERA no." class="form-control">
                            </div>
                            <div class="col-md-6 col-lg-6 mb-4 ">
                                <label for="dtcm_no" class="d-block">DTCM no.</label>
                                <input type="text" name="dtcm_no" id="dtcm_no" placeholder="Enter DTCM no." class="form-control">
                            </div>
                            <div class="col-md-6 col-lg-6 mb-4 ">
                                <label for="dtcm_exp_date" class="d-block">Expiry Date</label>
                                <input type="date" name="dtcm_exp_date" id="dtcm_exp_date" placeholder="Enter RERA No." class="form-control">
                            </div>
                            <div class="col-md-6 col-lg-6 mb-4 ">
                                <label for="license_authority" class="d-block">Licenses Authority</label>
                                <input type="text" name="license_authority" id="license_authority" placeholder="Enter License Authority." class="form-control">
                            </div>
                        </div>
                  </fieldset>
                <fieldset>
                    <legend>Document Section:</legend>
                    <div class="form-group" id="wiget-desc">
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="name">Document File:</label>
                            <input type="file" class="form-control" accept="image/*"  id="header_image_1">
                             <span id="image_1_error" class="text-danger"></span>
                             <div class="d-none" id="widget-one-div">
                                 <hr>
                                 <p id="ImageToUpdate" style="margin: 0px"></p>
                             </div>
                            </div>
                            <div class="col-md-6 mb-3"><label for="name">Document Type</label>
                              <select name="document_type_id" id="document_type_id" class="form-control">
                                  <option value=""></option>
                                  @if ($document_types->count())
                                      @foreach ($document_types as $item)
                                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                                      @endforeach
                                  @endif
                              </select>
                              <span id="document_type_id_1_error" class="text-danger"></span>
                            </div>
                          <div class="col-md-12 mb-3">
                            <button class="btn btn-primary btn-lg btn-block" id="add-button-english">Add Document</button>
                          </div>
                        </div>
                    </div><!-- /.form-group -->
                    <div class="row ">
                        <div class="col-md-12">
                          <span id="widget_1_error" class="text-danger"></span>
                          <table class="table table-bordered table-sm" id="wiget_data">
                            <thead class="bg-success text-white">
                              <tr>
                                 <th width="7%">ID</th>
                                 <th width="23%">Document File</th>
                                  <th width="50%">Document Type</th>
                                  <th width="20%" class="text-center">Action</th>
                              </tr>
                          </thead>
                          </table>
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
                    <label for="currency">@lang('translation.currency') </label>
                    <select name="b_currency" id="b_currency" class="form-control">
                        @foreach ($currencies as $item)
                            <option value="{{ $item->from_currency }}">{{ $item->from_currency }}</option>
                        @endforeach
                    </select>
                    <span class="form-text text-danger" id="b_currency_error"></span>
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
@include('admin.companies.manage-companies.js.create')
@endsection
