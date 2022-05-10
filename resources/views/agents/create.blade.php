@extends('layouts.master', ['link' => route('manage-agents.index')])
@section('title', 'Create Agents')
@section('content')
@section('first', 'Agents')
@section('second', 'Manage Agents')
@section('third', 'Agents')
@section('fourth', 'Create')
<style>
.switch {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  font-size: 1rem;
}
.switch label {
  margin: 0;
}
.switch input:empty {
  margin-left: -999px;
  height: 0;
  width: 0;
  overflow: hidden;
  position: absolute;
  opacity: 0;
}
.switch input:empty ~ span {
  display: inline-block;
  position: relative;
  float: left;
  width: 1px;
  text-indent: 0;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.switch input:empty ~ span:before,
.switch input:empty ~ span:after {
  position: absolute;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  top: 0;
  bottom: 0;
  left: 0;
  content: " ";
  -webkit-transition: all 100ms ease-in;
  transition: all 100ms ease-in;
}
.switch input[disabled] {
  cursor: not-allowed;
}
.switch input[disabled] ~ span:after,
.switch input[disabled] ~ span:before {
  cursor: not-allowed;
  opacity: 0.5;
}
.switch.switch-icon input:checked ~ span:after {
  font-family: Ki;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  line-height: 1;
  text-decoration: inherit;
  text-rendering: optimizeLegibility;
  text-transform: none;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  font-smoothing: antialiased;
  content: "";
  line-height: 0;
}

.switch input:empty ~ span {
  margin: 2px 0;
  height: 30px;
  width: 57px;
  border-radius: 15px;
}
.switch input:empty ~ span:before,
.switch input:empty ~ span:after {
  width: 54px;
  border-radius: 15px;
}
.switch input:empty ~ span:after {
  height: 24px;
  width: 24px;
  top: 3px;
  bottom: 3px;
  margin-left: 3px;
  font-size: 0.65em;
  text-align: center;
  vertical-align: middle;
}
.switch input:checked ~ span:after {
  margin-left: 26px;
}
.switch.switch-sm input:empty ~ span {
  margin: 2px 0;
  height: 24px;
  width: 40px;
  border-radius: 12px;
}
.switch.switch-sm input:empty ~ span:before,
.switch.switch-sm input:empty ~ span:after {
  width: 38px;
  border-radius: 12px;
}
.switch.switch-sm input:empty ~ span:after {
  height: 20px;
  width: 20px;
  top: 2px;
  bottom: 2px;
  margin-left: 2px;
  font-size: 0.55em;
  text-align: center;
  vertical-align: middle;
}
.switch.switch-sm input:checked ~ span:after {
  margin-left: 16px;
}
.switch.switch-lg input:empty ~ span {
  margin: 2px 0;
  height: 40px;
  width: 75px;
  border-radius: 20px;
}
.switch.switch-lg input:empty ~ span:before,
.switch.switch-lg input:empty ~ span:after {
  width: 72px;
  border-radius: 20px;
}
.switch.switch-lg input:empty ~ span:after {
  height: 34px;
  width: 34px;
  top: 3px;
  bottom: 3px;
  margin-left: 3px;
  font-size: 0.75em;
  text-align: center;
  vertical-align: middle;
}
.switch.switch-lg input:checked ~ span:after {
  margin-left: 34px;
}

.switch input:empty ~ span:before {
  background-color: #EBEDF3;
}
.switch input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7;
}
.switch input:checked ~ span:before {
  background-color: #EBEDF3;
}
.switch input:checked ~ span:after {
  opacity: 1;
  color: #ffffff;
  background-color: #3699FF;
}
.switch.switch-primary:not(.switch-outline) input:empty ~ span:before {
  background-color: #3699FF;
}
.switch.switch-primary:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7;
}
.switch.switch-primary:not(.switch-outline) input:checked ~ span:before {
  background-color: #3699FF;
}
.switch.switch-primary:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #3699FF;
  background-color: #ffffff;
}
.switch.switch-outline.switch-primary input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent;
}
.switch.switch-outline.switch-primary input:empty ~ span:after {
  background-color: #EBEDF3;
}
.switch.switch-outline.switch-primary input:checked ~ span:before {
  border: 2px solid #3699FF;
  background-color: transparent;
}
.switch.switch-outline.switch-primary input:checked ~ span:after {
  color: #ffffff;
  background-color: #3699FF;
}
.switch.switch-secondary:not(.switch-outline) input:empty ~ span:before {
  background-color: #E4E6EF;
}
.switch.switch-secondary:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7;
}
.switch.switch-secondary:not(.switch-outline) input:checked ~ span:before {
  background-color: #E4E6EF;
}
.switch.switch-secondary:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #E4E6EF;
  background-color: #ffffff;
}
.switch.switch-outline.switch-secondary input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent;
}
.switch.switch-outline.switch-secondary input:empty ~ span:after {
  background-color: #EBEDF3;
}
.switch.switch-outline.switch-secondary input:checked ~ span:before {
  border: 2px solid #E4E6EF;
  background-color: transparent;
}
.switch.switch-outline.switch-secondary input:checked ~ span:after {
  color: #ffffff;
  background-color: #E4E6EF;
}
.switch.switch-success:not(.switch-outline) input:empty ~ span:before {
  background-color: #1BC5BD;
}
.switch.switch-success:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7;
}
.switch.switch-success:not(.switch-outline) input:checked ~ span:before {
  background-color: #1BC5BD;
}
.switch.switch-success:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #1BC5BD;
  background-color: #ffffff;
}
.switch.switch-outline.switch-success input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent;
}
.switch.switch-outline.switch-success input:empty ~ span:after {
  background-color: #EBEDF3;
}
.switch.switch-outline.switch-success input:checked ~ span:before {
  border: 2px solid #1BC5BD;
  background-color: transparent;
}
.switch.switch-outline.switch-success input:checked ~ span:after {
  color: #ffffff;
  background-color: #1BC5BD;
}
.switch.switch-info:not(.switch-outline) input:empty ~ span:before {
  background-color: #8950FC;
}
.switch.switch-info:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7;
}
.switch.switch-info:not(.switch-outline) input:checked ~ span:before {
  background-color: #8950FC;
}
.switch.switch-info:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #8950FC;
  background-color: #ffffff;
}
.switch.switch-outline.switch-info input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent;
}
.switch.switch-outline.switch-info input:empty ~ span:after {
  background-color: #EBEDF3;
}
.switch.switch-outline.switch-info input:checked ~ span:before {
  border: 2px solid #8950FC;
  background-color: transparent;
}
.switch.switch-outline.switch-info input:checked ~ span:after {
  color: #ffffff;
  background-color: #8950FC;
}
.switch.switch-warning:not(.switch-outline) input:empty ~ span:before {
  background-color: #FFA800;
}
.switch.switch-warning:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7;
}
.switch.switch-warning:not(.switch-outline) input:checked ~ span:before {
  background-color: #FFA800;
}
.switch.switch-warning:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #FFA800;
  background-color: #ffffff;
}
.switch.switch-outline.switch-warning input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent;
}
.switch.switch-outline.switch-warning input:empty ~ span:after {
  background-color: #EBEDF3;
}
.switch.switch-outline.switch-warning input:checked ~ span:before {
  border: 2px solid #FFA800;
  background-color: transparent;
}
.switch.switch-outline.switch-warning input:checked ~ span:after {
  color: #ffffff;
  background-color: #FFA800;
}
.switch.switch-danger:not(.switch-outline) input:empty ~ span:before {
  background-color: #F64E60;
}
.switch.switch-danger:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7;
}
.switch.switch-danger:not(.switch-outline) input:checked ~ span:before {
  background-color: #F64E60;
}
.switch.switch-danger:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #F64E60;
  background-color: #ffffff;
}
.switch.switch-outline.switch-danger input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent;
}
.switch.switch-outline.switch-danger input:empty ~ span:after {
  background-color: #EBEDF3;
}
.switch.switch-outline.switch-danger input:checked ~ span:before {
  border: 2px solid #F64E60;
  background-color: transparent;
}
.switch.switch-outline.switch-danger input:checked ~ span:after {
  color: #ffffff;
  background-color: #F64E60;
}
.switch.switch-light:not(.switch-outline) input:empty ~ span:before {
  background-color: #F3F6F9;
}
.switch.switch-light:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7;
}
.switch.switch-light:not(.switch-outline) input:checked ~ span:before {
  background-color: #F3F6F9;
}
.switch.switch-light:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #F3F6F9;
  background-color: #ffffff;
}
.switch.switch-outline.switch-light input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent;
}
.switch.switch-outline.switch-light input:empty ~ span:after {
  background-color: #EBEDF3;
}
.switch.switch-outline.switch-light input:checked ~ span:before {
  border: 2px solid #F3F6F9;
  background-color: transparent;
}
.switch.switch-outline.switch-light input:checked ~ span:after {
  color: #ffffff;
  background-color: #F3F6F9;
}
.switch.switch-dark:not(.switch-outline) input:empty ~ span:before {
  background-color: #181C32;
}
.switch.switch-dark:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7;
}
.switch.switch-dark:not(.switch-outline) input:checked ~ span:before {
  background-color: #181C32;
}
.switch.switch-dark:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #181C32;
  background-color: #ffffff;
}
.switch.switch-outline.switch-dark input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent;
}
.switch.switch-outline.switch-dark input:empty ~ span:after {
  background-color: #EBEDF3;
}
.switch.switch-outline.switch-dark input:checked ~ span:before {
  border: 2px solid #181C32;
  background-color: transparent;
}
.switch.switch-outline.switch-dark input:checked ~ span:after {
  color: #ffffff;
  background-color: #181C32;
}
.switch.switch-white:not(.switch-outline) input:empty ~ span:before {
  background-color: #ffffff;
}
.switch.switch-white:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7;
}
.switch.switch-white:not(.switch-outline) input:checked ~ span:before {
  background-color: #ffffff;
}
.switch.switch-white:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #ffffff;
  background-color: #ffffff;
}
.switch.switch-outline.switch-white input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent;
}
.switch.switch-outline.switch-white input:empty ~ span:after {
  background-color: #EBEDF3;
}
.switch.switch-outline.switch-white input:checked ~ span:before {
  border: 2px solid #ffffff;
  background-color: transparent;
}
.switch.switch-outline.switch-white input:checked ~ span:after {
  color: #ffffff;
  background-color: #ffffff;
}


</style>
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                 <h3 class="card-title">
                  Add Agent
                 </h3>
                 <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('manage-agents.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> @lang('translation.back')</a>
                    </div>
                   </div>
                </div>
                <!--begin::Form-->
                 <div class="card-body">
                  <fieldset>
                      <legend>Agent Info:</legend>

                      <div class="row  mb-4">
                          <div class="col-md-6 col-lg-6 mb-4">
                            <div class="form-group row">
                                <label class="col-4 col-form-label"><strong>Show Company Profile </strong></label>
                                <div class="col-3">
                                    <span class="switch switch-outline switch-icon switch-success">
                                        <label>
                                            <input type="checkbox" name="is_company_contact" id="is_company_contact">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>

                            </div>
                         </div>
                            <div class="col-md-6 col-lg-6 mb-4">
                              <div class="form-group row">
                                  <label class="col-4 col-form-label"><strong>Is Management ?</strong></label>
                                  <div class="col-3">
                                      <span class="switch switch-outline switch-icon switch-success">
                                          <label>
                                              <input type="checkbox" name="is_managment" id="is_managment">
                                              <span></span>
                                          </label>
                                      </span>
                                  </div>

                              </div>
                           </div>
                      </div>

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
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="new_email" id="new_email" placeholder="Enter Email"/>
                            <span class="form-text text-danger" id="new_email_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="brn">BRN #</label>
                            <input type="text" class="form-control" name="brn" id="brn" placeholder="Enter BRN Number"/>
                            <span class="form-text text-danger" id="brn_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="@lang('translation.enter_company_phone')" autofocus/>
                            <span class="form-text text-danger" id="phone_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="state_id">State/City</label>
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
                        <div class="col-md-6 col-lg-6 mb-4 ">
                            <label for="address">Complete Address</label>
                            <input type="text" name="address" id="address" placeholder="Enter Address" class="form-control">
                            <span class="form-text text-danger" id="address_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="nationality">Nationality</label>
                            <select name="nationality" id="nationality" class="form-control" multiple>
                                <option value="">--select nationality---</option>
                                @if ($nationalities->count())
                                    @foreach ($nationalities as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="form-text text-danger" id="nationality_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="specialities">Specialities</label>
                            <select name="specialities" id="specialities" class="form-control" multiple>
                                <option value="">--select specialities---</option>
                                @if ($types->count())
                                    @foreach ($types as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="form-text text-danger" id="specialities_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="languages">Languages</label>
                            <select name="languages" id="langs" class="form-control" multiple>
                                <option value="">--select languages---</option>
                                @if ($languages->count())
                                    @foreach ($languages as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                              </select>
                            </select>
                            <span class="form-text text-danger" id="languages_error"></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="rera_no">RERA No. </label>
                            <input type="text" class="form-control" name="" id="rera_no" placeholder="RERA No." autofocus/>
                            <span class="form-text text-danger" id=""></span>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-4">
                            <label for="key_location">Key Location. </label>
                            <input type="number" class="form-control" name="" id="key_location" placeholder="Key Location." autofocus/>
                            <span class="form-text text-danger" id=""></span>
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
                        <div class="col-md-12 col-lg-12 mb-4">
                            <label class="mr-2">Agent Image</label>
                                <div class="group-contain" style="
                                   display: flex;
                                   ">
                                   <div class="btn btn-secondary fileinput-button" style="line-height: 2;height: 50px;">
                                      <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                      <input id="fileupload-btn-one" type="file" name="file-one" accept="image/*">
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
                            <span class="form-text text-danger" id="image_error"></span>
                        </div>
                         <div class="col-md-12 col-lg-12 mb-4">
                            <label class="mr-2">Profile Documents</label>
                                <div class="group-contain" style="
                                   display: flex;
                                   ">
                                   <div class="btn btn-secondary fileinput-button" style="line-height: 2;height: 50px;">
                                      <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                      <input id="fileupload-btn-oasdne" type="file" name="file-one" accept="image/*">
                                   </div>
                                   <div class="form-group" style="
                                      display: block;
                                      margin: 0 auto;
                                      ">
                                      <div id="uploadList" class="list-group list-group-flush list-group-divider" style="margin: auto;">
                                         <img loading="lazy" src="#" alt="Preview Image" id="blahasd-one" class="d-none">
                                      </div>
                                   </div>
                                </div>
                            <span class="form-text text-danger" id="image_error"></span>
                        </div>
                        <div class="col-md-12 col-lg-12 mb-4">
                            <label class="mr-2">EmirateID</label>
                                <div class="group-contain" style="
                                   display: flex;
                                   ">
                                   <div class="btn btn-secondary fileinput-button" style="line-height: 2;height: 50px;">
                                      <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                      <input id="fileupload-btn-oasdne" type="file" name="file-one" accept="image/*">
                                   </div>
                                   <div class="form-group" style="
                                      display: block;
                                      margin: 0 auto;
                                      ">
                                      <div id="uploadList" class="list-group list-group-flush list-group-divider" style="margin: auto;">
                                         <img loading="lazy" src="#" alt="Preview Image" id="blahasd-one" class="d-none">
                                      </div>
                                   </div>
                                </div>
                            <span class="form-text text-danger" id="image_error"></span>
                        </div>
                        <div class="col-md-12 col-lg-12 mb-4">
                            <label class="mr-2">Passport</label>
                                <div class="group-contain" style="
                                   display: flex;
                                   ">
                                   <div class="btn btn-secondary fileinput-button" style="line-height: 2;height: 50px;">
                                      <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                      <input id="fileupload-btn-oasdne" type="file" name="file-one" accept="image/*">
                                   </div>
                                   <div class="form-group" style="
                                      display: block;
                                      margin: 0 auto;
                                      ">
                                      <div id="uploadList" class="list-group list-group-flush list-group-divider" style="margin: auto;">
                                         <img loading="lazy" src="#" alt="Preview Image" id="blahasd-one" class="d-none">
                                      </div>
                                   </div>
                                </div>
                            <span class="form-text text-danger" id="image_error"></span>
                        </div>
                            <div class="col-md-12 col-lg-12 mb-6">
                                <label class="mr-2">Descriptions</label>
                                  <textarea class="form-control"  name="descriptions" id="descriptions"></textarea>
                                <small id="descriptions_error" class="text-danger"></small>
                            </div>
                            <script>
                                setTimeout(function(){
                                    CKEDITOR.replace('descriptions', {
                                        contentsLangDirection: "ltr",
                                        scayt_customerId: '1:Eebp63-lWHbt2-ASpHy4-AYUpy2-fo3mk4-sKrza1-NsuXy4-I1XZC2-0u2F54-aqYWd1-l3Qf14-umd',
                                        scayt_sLang: 'auto',
                                        removeButtons: 'PasteFromWord'
                                        });

                                }, 1000);
                            </script>
                      </div>
                  </fieldset>
                  <fieldset>
                    <legend>SEO SECTION</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label for="meta_description">Meta Descriptions</label>
                            <input type="text" name="meta_description" id="meta_description" class="form-control" />
                        </div>
                    </div>
                </fieldset>
                  <div class="row mb-6">
                    <div class="col-md-12 col-lg-12 mb-6">
                        <button class="btn btn-cherwell btn-block" style="font-size:16px;" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span>Add</button>
                    </div>
                  </div>
                 </div>
                <!--end::Form-->
               </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('agents.js.create')
@endsection
