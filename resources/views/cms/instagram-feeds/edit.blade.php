@extends('layouts.master')
@section('title', 'Instagram Feeds')
@section('first', 'Instagram Feeds')
@section('second', 'CMS')
@section('third', 'Instagram Feed')
@section('fourth', 'Edit')

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
                               <a href="{{ route('cms.instagram-feed.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Edit Instagram Feed:</legend>
                              <div class="row">
                                    <div class="col-md-6 col-lg-6 mb-6 ">
                                        <label class="mr-2">Title</label>
                                        <input type="text" class="form-control" value="{{ $instagram_feed->title }}" id="instagram_feed_title">
                                        <small id="instagram_feed_title_error" class="text-danger"></small>
                                    </div>
                                    <div class="col-md-6 col-lg-6 mb-6 ">
                                        <label class="mr-2">Link</label>
                                          <input type="text" class="form-control" value="{{ $instagram_feed->link }}" id="button_link">
                                        <small id="button_link_error" class="text-danger"></small>
                                    </div>
                              </div>
                            <div class="row">
                               <div class="col-md-12 col-lg-12 mb-4 ">
                                <label class="mr-2">Upload Image</label>
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
                                         <img loading="lazy" src="{{ $instagram_feed->image }}" alt="Preview Image" id="blah-one" class="">
                                      </div>
                                   </div>
                                </div>
                                <!-- /.form-group -->
                                <small id="image_one_error" class="text-danger"></small>
                             </div>
                           </div>

                        </fieldset>
                        <button type="button" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" id="edit_instagram_feed">
                            <span class="svg-icon svg-icon-md fa fa-floppy-o"></span>
                                @lang('translation.update')
                        </button>
                    </div>

                {{-- </div> --}}
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('cms.instagram-feeds.js.edit');
@endsection
