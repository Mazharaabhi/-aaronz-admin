@extends('layouts.master')
@section('title', 'Aaronz Story Sell With Us')
@section('first', 'Aaronz Story Sell With Us')
@section('second', 'CMS')
@section('third', 'Aaronz Story')
@section('fourth', 'Edit')

@section('content')
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

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
                               <a href="{{ route('cms.aronz-story.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Edit Aaronz Story:</legend>
                              <div class="row">
                                    <div class="col-md-4 col-lg-4 mb-4 ">
                                        <label class="mr-2">Title</label>
                                        <input type="text" class="form-control" value="{{ $aronz_story->title }}" id="story_title">
                                        <small id="story_title_error" class="text-danger"></small>
                                    </div>
                                    <div class="col-md-4 col-lg-4 mb-4 ">
                                        <label class="mr-2">Heading</label>
                                        <input type="text" class="form-control" value="{{ $aronz_story->heading }}" id="story_heading">
                                        <small id="story_heading_error" class="text-danger"></small>
                                    </div>
                                    <div class="col-md-4 col-lg-4 mb-4 ">
                                        <label class="mr-2">Link</label>
                                          <input type="text" class="form-control" value="{{ $aronz_story->button_link }}" id="button_link">
                                        <small id="button_link_error" class="text-danger"></small>
                                    </div>
                              </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 mb-6">
                                    <label class="mr-2">Descriptions</label>
                                      <textarea class="form-control"  name="descriptions" id="descriptions">{{ $aronz_story->description }}</textarea>
                                    <small id="descriptions_error" class="text-danger"></small>
                                </div>
                                <script>
                                    setTimeout(function(){
                                        CKEDITOR.replace('descriptions', {
                                            contentsLangDirection: "ltr",
                                            scayt_customerId: '1:Eebp63-lWHbt2-ASpHy4-AYUpy2-fo3mk4-sKrza1-NsuXy4-I1XZC2-0u2F54-aqYWd1-l3Qf14-umd',
                                            scayt_sLang: 'auto',
                                            removeButtons: 'PasteFromWord'
                                            });

                                    }, 1000);
                                </script>
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
                                         <img loading="lazy" src="{{ $aronz_story->image }}" alt="Preview Image" id="blah-one" class="">
                                      </div>
                                   </div>
                                </div>
                                <!-- /.form-group -->
                                <small id="image_one_error" class="text-danger"></small>
                             </div>
                           </div>

                        </fieldset>
                        <button type="button" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" id="edit_aronz_story">
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
@include('cms.aaronz-stories.js.edit');
@endsection
