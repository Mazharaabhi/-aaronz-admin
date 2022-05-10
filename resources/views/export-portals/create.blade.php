@extends('layouts.master')
@section('title', 'Export Portal')
@section('first', 'Export Portal')
@section('second', 'Manage Portals')
@section('third', 'Export Portal')
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
                        <div class="card-toolbar">
                           <div class="example-tools justify-content-center">
                               <a href="{{ route('manage-properties.export.portals.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Add Export Portal:</legend>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                  <label for="title">Name</label>
                                  <input type="text" name="title" id="title" class="form-control" autofocus>
                                  <small id="title_error" class="text-danger"></small>
                                </div><!-- /grid column -->
                                <div class="col-md-6 mb-3">
                                    <label for="title">XML Link</label>
                                    <input type="text" name="xml_link" id="xml_link" class="form-control" autofocus>
                                    <small id="title_error" class="text-danger"></small>
                                 </div><!-- /grid column -->
                                {{-- <div class="col-md-4 mb-3">
                                    <label for="time_duration">Auto Sync. (Hours)</label>
                                    <select class="form-control" id="time_duration">
                                        @for ($i = 1 ; $i <= 24 ; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <small id="time_duration_error" class="text-danger"></small>
                                </div> --}}
                           </div>
                           <div class="row">
                               <div class="col-md-12">
                                <label for="title">Description</label>
                                   <textarea class="form-control" id="description" cols="12" rows="5"></textarea>
                               </div>
                           </div>
                           <div class="col-md-12 col-lg-12 mb-4 ">
                            <label class="mr-2">Upload Logo</label>
                            <div class="group-contain" style="
                               display: flex;
                               ">
                               <div class="btn btn-secondary fileinput-button" style="line-height: 2;height: 50px;">
                                  <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                  <input id="fileupload-btn-one" type="file" name="file-one" accept="image/*" width="60%">
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
                        <button type="button" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" id="add_portal">
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
@include('export-portals.js.create');
@endsection
