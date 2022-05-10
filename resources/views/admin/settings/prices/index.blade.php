@extends('layouts.master')
@section('title', 'Prices')
@section('first', 'Prices')
@section('second', 'Settings')
@section('third', 'Prices')

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
                                            <a href="{{ route('admin.settings.prices.create') }}" class="btn btn-cherwell font-weight-bolder mr-1" id="OpenAddModel">
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
                                            <th>Price Type</th>
                                            <th>Integer Price</th>
                                            <th>Decimal Price</th>
                                            <th>Compact Price</th>
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
@include('admin.settings.prices.js.index');
@endsection
