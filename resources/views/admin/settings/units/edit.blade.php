@extends('layouts.master')
@section('title', 'Units')
@section('first', 'Units')
@section('second', 'Settings')
@section('third', 'Units')
@section('fourth', 'Edit')

@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <h3 class="card-title">
                     Edit Unit
                    </h3>
                    <div class="card-toolbar">
                       <div class="example-tools justify-content-center">
                           <a href="{{ route('admin.settings.units.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                       </div>
                      </div>
                   </div>
                        <div class="card-body">
                            <fieldset>
                                <legend>Unit Details:</legend>
                                <div class="row">
                                <div class="col-md-12 col-lg-6 mb-4 ">
                                      <label for="description_english" class="d-block">@lang('translation.title_english')</label>
                                      <input type="text" name="title_english" id="title_english" value="{{ $unit->name }}"  class="form-control" placeholder="Language Name">
                                      <span id="title_english_error" class="text-danger"></span>
                                  </div>
                             </div>
                            </fieldset>
                            <button type="button" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block btn-block" id="edit_language">
                                <span class="svg-icon svg-icon-md fa fa-floppy-o"></span>
                                    Update
                                </button>
                        </div>

                    </div>

                {{-- </div> --}}
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('admin.settings.units.js.edit');
@endsection
