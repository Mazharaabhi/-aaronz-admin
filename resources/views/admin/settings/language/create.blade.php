@extends('layouts.master')
@section('title', 'Languages')
@section('first', 'Languages')
@section('second', 'Settings')
@section('third', 'Languages')
@section('fourth', 'Create')

@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                {{-- <div class="card-body"> --}}
                    <div class="card-header">
                        <h3 class="card-title">
                         Add Language
                        </h3>
                        <div class="card-toolbar">
                           <div class="example-tools justify-content-center">
                               <a href="{{ route('admin.settings.languages.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Language Details:</legend>
                            <div class="row">
                            <div class="col-md-12 col-lg-6 mb-4 ">
                                  <label for="description_english" class="d-block">@lang('translation.title_english')</label>
                                  <input type="text" name="title_english" id="title_english" class="form-control" placeholder="Language Name">
                                  <span id="title_english_error" class="text-danger"></span>
                              </div>
                              <div class="col-md-6 col-lg-6 mb-4 ">
                                <label for="description_english">Language Direction</label>
                                <select name="language_direction" id="language_direction" class="form-control">
                                    <option value="Left">Left</option>
                                    <option value="Right">Right</option>
                                </select>
                                <span id="language_direction_error" class="text-danger"></span>
                        </div>

                        <div class="col-md-12 col-lg-12 mb-4 ">
                            <label class="mr-2">Upload Flag</label>
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
                            <!-- /.form-group -->
                            <small id="image_one_error" class="text-danger"></small>
                         </div>
                        </fieldset>
                        <button type="button" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" id="add_language">
                            <span class="svg-icon svg-icon-md fa fa-floppy-o"></span>
                                @lang('translation.save')
                        </button>
                    </div>

                {{-- </div> --}}
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('admin.settings.language.js.create');
@endsection
