@extends('layouts.master')
@section('title', 'Service Questions')
@section('first', 'Manage Services')
@section('second', 'Service Questions')

@section('content')
<style>
    .question-categories .select2-container--default .select2-selection--single .select2-selection__rendered{
        padding: 0.1rem 3rem 0.1rem 1rem ;
    }
    .question-categories .select2-container--default .select2-search--dropdown .select2-search__field{
        padding: 0.1rem 1rem !important;
    }
    .question-categories .select2-container--default .select2-results__option {
    padding: 0.1rem 1rem !important;
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
                                            <a href="{{ route('manage-services.question.create') }}" class="btn btn-cherwell font-weight-bolder mr-1" id="OpenAddModel">
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
                           <div class="row question-categories">
                            <div class="offset-md-4 col-md-3 mb-3">
                               <select name="category" id="category" class="form-control">
                                    <option value="">---Select Category---</option>
                                    @if (count($categories) > 0)
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                                </select>
                                <small id="category_id_error" class="text-danger"></small>
                            </div>
                             <!-- grid column -->
                           <div class="col-md-3 mb-3">
                                  <select name="sub_category_id" placeholder="Select Sub Category" id="sub_category_id" class="form-control">
                                    <option value="">---Select Sub Category---</option>
                                </select>
                                <small id="sub_category_id_error" class="text-danger"></small>
                            </div>
                            <div class="col-md-2">
                                <a href="#" class="btn btn-cherwell font-weight-bolder" id="search">
                                    <span class="svg-icon svg-icon-md fa fa-search">
                                    </span>Search</a>
                            </div>
                           </div>
                            <div>
                                <table id="users-table" class="table">
                                    <thead>
                                        <tr>
                                            <th width="5%">Id</th>
                                            <th>Title</th>
                                            <th>Service Sub Category</th>
                                            <th>Service Category</th>
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
@include('services.questions.js.index');
@endsection
