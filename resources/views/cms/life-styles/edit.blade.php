@extends('layouts.master')
@section('title', 'Life Styles')
@section('first', 'Life Style')
@section('second', 'CMS')
@section('third', 'Life Style')
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
                               <a href="{{ route('cms.life-styles.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Edit Lifestyle:</legend>
                            <div class="row">
                                <div class="col-md-6 col-lg-6 mb-6 ">
                                    <label class="mr-2">Title</label>
                                     <input type="text" class="form-control" value="{{ $area->title }}" id="title">
                                    <small id="title_error" class="text-danger"></small>
                                </div>
                                <div class="col-md-6 col-lg-6 mb-6">
                                    <label for="slug">Slug</label>
                                        <input type="text" name="slug" value="{{ $area->slug }}" id="slug" placeholder="" class="form-control">
                                    <span id="slug_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6 mb-6">
                                    <label class="mr-2">Sub Title</label>
                                      <input type="text" class="form-control" value="{{ $area->sub_title }}" id="sub_title">
                                    <small id="sub_title_error" class="text-danger"></small>
                                </div>
                                <div class="col-md-6 col-lg-6 mb-6 ">
                                    <label class="mr-2">Youtube Link</label>
                                      <input type="text" placeholder="https://www.youtube.com/embed/MigrDLUErX4" class="form-control" value="{{ $area->link }}" id="button_link">
                                    <small id="button_link_error" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                        <label for="type_id">Areas</label>
                                        <select name="type_id" id="type_id" name="type_id[]" class="form-control" multiple>
                                            @if (count($areas) > 0)
                                                <option value="">select areas</option>
                                                @foreach ($areas as $item)
                                                    <option value="{{ $item->id }}"
                                                        @foreach ($area->areas as $loc_area)
                                                        @if($item->id == $loc_area) {{ 'selected' }} @endif
                                                        @endforeach
                                                        >{{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                          <small id="type_id_error" class="text-danger"></small>
                                   </div>
                              </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 mb-6 ">
                                <label class="mr-2">Descriptions</label>
                                  <textarea class="form-control" id="lifestyle_desc">{{ $area->description }}</textarea>
                                <small id="lifestyle_desc_error" class="text-danger"></small>
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
                                         <img loading="lazy" src="{{ $area->image }}" alt="Preview Image" id="blah-one" class="d-block">
                                      </div>
                                   </div>
                                </div>
                                <!-- /.form-group -->
                                <small id="image_one_error" class="text-danger"></small>
                             </div>
                           </div>
                        </fieldset>
                        <fieldset>
                            <legend>SEO SECTION:</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" value="{{ $area->meta_title }}" name="meta_title" id="meta_title" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="meta_description">Meta Descriptions</label>
                                    <input type="text" name="meta_description" value="{{ $area->meta_description }}" id="meta_description" class="form-control" />
                                </div>
                            </div>
                        </fieldset>
                        <button type="button" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" id="edit_lifestyle">
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
@include('cms.life-styles.js.edit');
@endsection
