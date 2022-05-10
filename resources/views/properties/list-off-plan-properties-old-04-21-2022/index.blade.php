@extends('layouts.master')
@section('title', 'List Off Plan Property')
@section('first', 'List Off Plan Property')
@section('second', 'Manage Properties')
@section('third', 'List Off Plan Property')

@section('content')
    <style>
        .label-w-100 {
            display: block;
        }

        .select2-container {
            width: 100% !important;
        }

        #map {
            height: 100%;
        }

        label .btn.btn-sm.float-right {
            text-align: center;
            padding: 4px;
            margin-top: -2px !important;
            margin: 5px;
            box-shadow: 0px 0.5px 4px -0.5px #00000069;
            border-radius: 4px;
        }

        label .btn.btn-sm.float-right i {
            margin: auto;
            padding: 0;
        }

        #subsale {
            display: none;
        }

    </style>
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
                                    <a href="{{ route('offplan.property.create') }}"
                                        class="btn btn-cherwell font-weight-bolder mr-1" id="OpenAddModel">
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

                            <!--end::Search Form-->

                            <!--begin: Datatable-->
                            <div>
                                {{-- <table id="users-table" class="table users-table">
                                    <thead>
                                        <tr>
                                            <th width="5%">Id</th>
                                            <th>Purpose</th>
                                            <th>Type</th>
                                            <th>Beds</th>
                                            <th>Location</th>
                                            <th>Area</th>
                                            <th>Assigned</th>
                                            <th>Price</th>
                                            <th>Expiry Data</th>
                                            <th>Developers</th>
                                            <th>Status</th>
                                            <th class="text-center" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                </table> --}}

                                <table id="users-table" class="table">
                                    <thead>
                                        <tr>
                                            <th width="5%">Id</th>
                                            <th>Ref.No</th>
                                            <th>Title</th>
                                            <th>Expiry Data</th>
                                            <th>Cities</th>
                                            <th>Sort Order</th>
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
            @include('properties.list-off-plan-properties.js.index');
        @endsection
