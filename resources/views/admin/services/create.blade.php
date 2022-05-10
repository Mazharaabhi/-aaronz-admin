@extends('layouts.master')
@section('title', 'Create Service')

@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">@lang('translation.create_service')</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a  class="text-muted">@lang('translation.services')</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.services.create') }}" class="text-muted">@lang('translation.service')</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">@lang('translation.create_service')</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                 <h3 class="card-title">
                  @lang('translation.create_service')
                 </h3>
                 <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('admin.services.index') }}" class="btn btn-danger float-right"><span class="fa fa-mail-reply"></span> @lang('translation.back')</a>
                    </div>
                   </div>
                </div>
                <!--begin::Form-->
                 <div class="card-body">
                  <div class="row mb-8">
                    <div class="col-md-6 col-lg-6">
                        <label for="title_english">@lang('translation.title_english')</label>
                        <input type="text" class="form-control" name="title_english" id="title_english" placeholder="@lang('translation.enter_title_english')" autofocus/>
                        <span class="form-text text-danger" id="title_english_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <label id="short_title_english">@lang('translation.short_title_english')</label>
                        <input type="text" class="form-control" name="short_title_english" id="short_title_english"  placeholder="@lang('translation.enter_short_title_english')"/>
                        <span class="form-text text-danger" id="short_english_error"></span>
                    </div>
                  </div>
                  <div class="row mb-6">
                    <div class="col-md-6 col-lg-6 mb-6">
                        <label for="slug">@lang('translation.slug')</label>
                        <input type="text" class="form-control" name="slug" id="slug" placeholder="@lang('translation.slug')" autofocus/>
                        <span class="form-text text-danger" id="slug_error"></span>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-6">
                        <label for="image">@lang('translation.image')</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="@lang('translation.slug')" autofocus/>
                        <span class="form-text text-danger" id="image_error"></span>
                    </div>
                    <div class="col-md-12 col-lg-12 mb-6">
                        <button class="btn btn-info btn-block" style="font-size:16px;" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> Save</button>
                    </div>
                  </div>
                 </div>
                <!--end::Form-->
               </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('admin.services.js.create')
@endsection
