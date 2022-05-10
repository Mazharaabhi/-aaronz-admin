@extends('layouts.master')
@section('title', 'Amenities')
@section('first', 'Amenities')
@section('second', 'Manage Properties')
@section('third', 'Property Settings')
@section('fourth', 'Amenities')
@section('fifth', 'Edit')

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
                            @include('languages')
                        </div>
                        <div class="card-toolbar">
                           <div class="example-tools justify-content-center">
                               <a href="{{ route('manage-properties.property-settings.amenities.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Edit Amenity:</legend>
                            <div class="row">
                                <!-- grid column -->
                           @if(count($languages) > 0)
                               @for ($i=0 ; $i < count($languages) ; $i++)
                                <div class="col-md-6 mb-3 {{ $languages[$i]->id != 1 ? 'd-none' : '' }}" id="div_{{ $languages[$i]->id }}">
                                    <label for="title_english">Title {{ $languages[$i]->name }}</label>
                                    <input type="text" name="title_english[]" @if($languages[$i]->direction == 'Right') dir="rtl" @endif id="title_english_{{ $languages[$i]->id }}" value="@if($languages[$i]->id == $storedData[$i]->lang_id) {{ $storedData[$i]->name }} @endif" class="form-control">
                                    <small id="title_english_error" class="text-danger"></small>
                                </div><!-- /grid column -->
                                <input type="hidden" name="languages[]" value="{{ $languages[$i]->id }}" id="languages">
                                @endfor
                                <div class="col-md-6 mb-3">
                                 <label for="icon" class="d-block">Icon</label>
                                 <select name="icon" id="icon" class="form-control fa-select select2" style="width:90%;display:inline-block">
                                 <option value="">---select icon---</option>
                                   @if (count($icons) > 0)
                                       @foreach ($icons as $item)
                                           <option value="{{ $item->name }}" {{ $item->name == $storedData[0]->icon ? "selected" : "" }}>{{ $item->name }}</option>
                                       @endforeach
                                   @endif
                                 </select>
                                 <span id="show_icon" style="font-size: 25px" class="{{ $storedData[0]->icon }} float-right text-primary"></span>
                                 <small id="icon_error" class="text-danger d-block"></small>
                               </div><!-- /grid column -->
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
                                         <img loading="lazy" src="{{ URL::to('storage/app') }}/{{ $storedData[0]->image }}" alt="Preview Image" id="blah-one" class="">
                                      </div>
                                   </div>
                                </div>
                                <!-- /.form-group -->
                                <small id="image_one_error" class="text-danger"></small>
                             </div>
                            @endif
                           </div>

                        </fieldset>
                        <button type="button" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" id="add_language">
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
@include('properties.amenities.js.edit');
@endsection
