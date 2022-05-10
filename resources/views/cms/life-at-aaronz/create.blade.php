@extends('layouts.master')
@section('title', 'Life At Aaronz')
@section('title', 'Life At Aaronz')
@section('first', 'Life At Aaronz')
@section('second', 'CMS')
@section('third', 'Life At Aaronz')
@section('fourth','Create')

@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                {{-- <div class="card-body"> --}}
                    <div class="card-header">
                        <div>
                        </div>
                        <div class="card-toolbar">
                           <div class="example-tools justify-content-center">
                               <a href="{{ route('cms.life-at-aaronz.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Add Video URL:</legend>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                  <label for="video_url">Video URL</label>
                                  <input type="text" name="video_url" id="video_url" placeholder="" class="form-control">
                                  <small id="video_url_error" class="text-danger"></small>
                                </div>
                           </div>
                        </fieldset>
                        <button type="button" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" id="add_video_url">
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
@include('cms.life-at-aaronz.js.create');
@endsection
