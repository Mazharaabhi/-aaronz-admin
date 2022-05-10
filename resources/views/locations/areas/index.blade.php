@extends('layouts.master')
@section('title', 'Areas')
@section('first', 'Areas')
@section('second', 'Locations')
@section('third', 'Areas')

@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                            <!--begin::Search Form-->
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 my-2 my-md-0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 d-flex justify-content-end">
                                            <!--begin::Button-->
                                            <a href="{{ route('location.areas.create') }}" class="btn btn-cherwell font-weight-bolder mr-1" id="OpenAddModel">
                                                <span class="svg-icon svg-icon-md fa fa-plus">
                                                </span>@lang('translation.create')</a>
                                            <!--end::Button-->
                                            <!--begin::Button-->
                                            <a href="#" class="btn btn-cherwell font-weight-bolder" id="reload">
                                                <span class="svg-icon svg-icon-md fa fa-refresh">
                                                </span>@lang('translation.reload')</a>
                                                <!--end::Button-->

                                    </div>
                                </div>
                            </div>
                            <!--end::Search Form-->
                            <!--begin: Datatable-->
                            <div>
                                <table id="users-table" class="table">
                                    <thead>
                                        <tr>
                                            <th width="5%">Id</th>
                                            <th>Area</th>
                                            <th>City</th>
                                            <th>Country</th>
                                            <th>Latitude.</th>
                                            <th>Longitude.</th>
                                            <th>Show to web</th>
                                            <th>Status</th>
                                            <th class="text-center" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!--end: Datatable-->

                    <!--end::Card-->

                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('locations.areas.js.index');
<style>
    .switch {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  font-size: 1rem; }
  .switch label {
    margin: 0; }
  .switch input:empty {
    margin-left: -999px;
    height: 0;
    width: 0;
    overflow: hidden;
    position: absolute;
    opacity: 0; }
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
    user-select: none; }
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
    content: ' ';
    -webkit-transition: all 100ms ease-in;
    transition: all 100ms ease-in; }
  .switch input[disabled] {
    cursor: not-allowed; }
    .switch input[disabled] ~ span:after,
    .switch input[disabled] ~ span:before {
      cursor: not-allowed;
      opacity: 0.5; }
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
    line-height: 0; }

.switch input:empty ~ span {
  margin: 2px 0;
  height: 30px;
  width: 57px;
  border-radius: 15px; }

.switch input:empty ~ span:before,
.switch input:empty ~ span:after {
  width: 54px;
  border-radius: 15px; }

.switch input:empty ~ span:after {
  height: 24px;
  width: 24px;
  top: 3px;
  bottom: 3px;
  margin-left: 3px;
  font-size: 0.65em;
  text-align: center;
  vertical-align: middle; }

.switch input:checked ~ span:after {
  margin-left: 26px; }

.switch.switch-sm input:empty ~ span {
  margin: 2px 0;
  height: 24px;
  width: 40px;
  border-radius: 12px; }

.switch.switch-sm input:empty ~ span:before,
.switch.switch-sm input:empty ~ span:after {
  width: 38px;
  border-radius: 12px; }

.switch.switch-sm input:empty ~ span:after {
  height: 20px;
  width: 20px;
  top: 2px;
  bottom: 2px;
  margin-left: 2px;
  font-size: 0.55em;
  text-align: center;
  vertical-align: middle; }

.switch.switch-sm input:checked ~ span:after {
  margin-left: 16px; }

.switch.switch-lg input:empty ~ span {
  margin: 2px 0;
  height: 40px;
  width: 75px;
  border-radius: 20px; }

.switch.switch-lg input:empty ~ span:before,
.switch.switch-lg input:empty ~ span:after {
  width: 72px;
  border-radius: 20px; }

.switch.switch-lg input:empty ~ span:after {
  height: 34px;
  width: 34px;
  top: 3px;
  bottom: 3px;
  margin-left: 3px;
  font-size: 0.75em;
  text-align: center;
  vertical-align: middle; }

.switch.switch-lg input:checked ~ span:after {
  margin-left: 34px; }

.switch input:empty ~ span:before {
  background-color: #EBEDF3; }

.switch input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7; }

.switch input:checked ~ span:before {
  background-color: #EBEDF3; }

.switch input:checked ~ span:after {
  opacity: 1;
  color: #ffffff;
  background-color: #3699FF; }

.switch.switch-primary:not(.switch-outline) input:empty ~ span:before {
  background-color: #3699FF; }

.switch.switch-primary:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7; }

.switch.switch-primary:not(.switch-outline) input:checked ~ span:before {
  background-color: #3699FF; }

.switch.switch-primary:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #3699FF;
  background-color: #ffffff; }

.switch.switch-outline.switch-primary input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent; }

.switch.switch-outline.switch-primary input:empty ~ span:after {
  background-color: #EBEDF3; }

.switch.switch-outline.switch-primary input:checked ~ span:before {
  border: 2px solid #3699FF;
  background-color: transparent; }

.switch.switch-outline.switch-primary input:checked ~ span:after {
  color: #ffffff;
  background-color: #3699FF; }

.switch.switch-secondary:not(.switch-outline) input:empty ~ span:before {
  background-color: #E4E6EF; }

.switch.switch-secondary:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7; }

.switch.switch-secondary:not(.switch-outline) input:checked ~ span:before {
  background-color: #E4E6EF; }

.switch.switch-secondary:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #E4E6EF;
  background-color: #ffffff; }

.switch.switch-outline.switch-secondary input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent; }

.switch.switch-outline.switch-secondary input:empty ~ span:after {
  background-color: #EBEDF3; }

.switch.switch-outline.switch-secondary input:checked ~ span:before {
  border: 2px solid #E4E6EF;
  background-color: transparent; }

.switch.switch-outline.switch-secondary input:checked ~ span:after {
  color: #ffffff;
  background-color: #E4E6EF; }

.switch.switch-success:not(.switch-outline) input:empty ~ span:before {
  background-color: #F20202; }

.switch.switch-success:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7; }

.switch.switch-success:not(.switch-outline) input:checked ~ span:before {
  background-color: #F20202; }

.switch.switch-success:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #F20202;
  background-color: #ffffff; }

.switch.switch-outline.switch-success input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent; }

.switch.switch-outline.switch-success input:empty ~ span:after {
  background-color: #EBEDF3; }

.switch.switch-outline.switch-success input:checked ~ span:before {
  border: 2px solid #F20202;
  background-color: transparent; }

.switch.switch-outline.switch-success input:checked ~ span:after {
  color: #ffffff;
  background-color: #F20202; }

.switch.switch-info:not(.switch-outline) input:empty ~ span:before {
  background-color: #8950FC; }

.switch.switch-info:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7; }

.switch.switch-info:not(.switch-outline) input:checked ~ span:before {
  background-color: #8950FC; }

.switch.switch-info:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #8950FC;
  background-color: #ffffff; }

.switch.switch-outline.switch-info input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent; }

.switch.switch-outline.switch-info input:empty ~ span:after {
  background-color: #EBEDF3; }

.switch.switch-outline.switch-info input:checked ~ span:before {
  border: 2px solid #8950FC;
  background-color: transparent; }

.switch.switch-outline.switch-info input:checked ~ span:after {
  color: #ffffff;
  background-color: #8950FC; }

.switch.switch-warning:not(.switch-outline) input:empty ~ span:before {
  background-color: #FFA800; }

.switch.switch-warning:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7; }

.switch.switch-warning:not(.switch-outline) input:checked ~ span:before {
  background-color: #FFA800; }

.switch.switch-warning:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #FFA800;
  background-color: #ffffff; }

.switch.switch-outline.switch-warning input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent; }

.switch.switch-outline.switch-warning input:empty ~ span:after {
  background-color: #EBEDF3; }

.switch.switch-outline.switch-warning input:checked ~ span:before {
  border: 2px solid #FFA800;
  background-color: transparent; }

.switch.switch-outline.switch-warning input:checked ~ span:after {
  color: #ffffff;
  background-color: #FFA800; }

.switch.switch-danger:not(.switch-outline) input:empty ~ span:before {
  background-color: #F64E60; }

.switch.switch-danger:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7; }

.switch.switch-danger:not(.switch-outline) input:checked ~ span:before {
  background-color: #F64E60; }

.switch.switch-danger:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #F64E60;
  background-color: #ffffff; }

.switch.switch-outline.switch-danger input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent; }

.switch.switch-outline.switch-danger input:empty ~ span:after {
  background-color: #EBEDF3; }

.switch.switch-outline.switch-danger input:checked ~ span:before {
  border: 2px solid #F64E60;
  background-color: transparent; }

.switch.switch-outline.switch-danger input:checked ~ span:after {
  color: #ffffff;
  background-color: #F64E60; }

.switch.switch-light:not(.switch-outline) input:empty ~ span:before {
  background-color: #F3F6F9; }

.switch.switch-light:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7; }

.switch.switch-light:not(.switch-outline) input:checked ~ span:before {
  background-color: #F3F6F9; }

.switch.switch-light:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #F3F6F9;
  background-color: #ffffff; }

.switch.switch-outline.switch-light input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent; }

.switch.switch-outline.switch-light input:empty ~ span:after {
  background-color: #EBEDF3; }

.switch.switch-outline.switch-light input:checked ~ span:before {
  border: 2px solid #F3F6F9;
  background-color: transparent; }

.switch.switch-outline.switch-light input:checked ~ span:after {
  color: #ffffff;
  background-color: #F3F6F9; }

.switch.switch-dark:not(.switch-outline) input:empty ~ span:before {
  background-color: #181C32; }

.switch.switch-dark:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7; }

.switch.switch-dark:not(.switch-outline) input:checked ~ span:before {
  background-color: #181C32; }

.switch.switch-dark:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #181C32;
  background-color: #ffffff; }

.switch.switch-outline.switch-dark input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent; }

.switch.switch-outline.switch-dark input:empty ~ span:after {
  background-color: #EBEDF3; }

.switch.switch-outline.switch-dark input:checked ~ span:before {
  border: 2px solid #181C32;
  background-color: transparent; }

.switch.switch-outline.switch-dark input:checked ~ span:after {
  color: #ffffff;
  background-color: #181C32; }

.switch.switch-white:not(.switch-outline) input:empty ~ span:before {
  background-color: #ffffff; }

.switch.switch-white:not(.switch-outline) input:empty ~ span:after {
  background-color: #ffffff;
  opacity: 0.7; }

.switch.switch-white:not(.switch-outline) input:checked ~ span:before {
  background-color: #ffffff; }

.switch.switch-white:not(.switch-outline) input:checked ~ span:after {
  opacity: 1;
  color: #ffffff;
  background-color: #ffffff; }

.switch.switch-outline.switch-white input:empty ~ span:before {
  border: 2px solid #EBEDF3;
  background-color: transparent; }

.switch.switch-outline.switch-white input:empty ~ span:after {
  background-color: #EBEDF3; }

.switch.switch-outline.switch-white input:checked ~ span:before {
  border: 2px solid #ffffff;
  background-color: transparent; }

.switch.switch-outline.switch-white input:checked ~ span:after {
  color: #ffffff;
  background-color: #ffffff; } */

</style>
@endsection
