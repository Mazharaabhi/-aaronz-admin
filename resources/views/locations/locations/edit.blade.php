@extends('layouts.master')
@section('title', 'Location')
@section('first', 'Location')
@section('second', 'Locations')
@section('third', 'Location')
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
                        <div>
                            @include('languages')
                        </div>
                        <div class="card-toolbar">
                           <div class="example-tools justify-content-center">
                               <a href="{{ route('locations.locations.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Edit Location:</legend>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="country" class="d-block">Countries</label>
                                    <select name="country" id="country" class="form-control fa-select select2">
                                    <option value="">---select country---</option>
                                      @if (count($location_countries) > 0)
                                          @foreach ($location_countries as $item)
                                              <option value="{{ $item->id }}" {{ $item->id == $storedData[0]->location_country_id ? "selected" : "" }}>{{ $item->name }}</option>
                                          @endforeach
                                      @endif
                                    </select>
                                    <span id="icon_error" class="text-danger d-block"></span>
                                  </div><!-- /grid column -->
                                  <div class="col-md-6 mb-3">
                                    <label for="state" class="d-block">Cities</label>
                                    <select name="state" id="state" class="form-control fa-select select2">
                                    <option value="">---select city---</option>
                                    </select>
                                    <span id="state_error" class="text-danger d-block"></span>
                                    </div><!-- /grid column -->
                                    <div class="col-md-6 mb-3">
                                        <label for="area_id" class="d-block">Areas</label>
                                        <select name="area_id" id="area_id" class="form-control fa-select select2">
                                        <option value="">---select city---</option>
                                        </select>
                                        <span id="area_id_error" class="text-danger d-block"></span>
                                        </div><!-- /grid column -->
                                <!-- grid column -->
                                <!-- grid column -->
                           @if(count($languages) > 0)
                               @for ($i=0 ; $i < count($languages) ; $i++)
                                <div class="col-md-6 mb-3 {{ $languages[$i]->id != 1 ? 'd-none' : '' }}" id="div_{{ $languages[$i]->id }}">
                                    <label for="title_english">Name {{ $languages[$i]->name }}</label>
                                    <input type="text" name="title_english[]" @if($languages[$i]->direction == 'Right') dir="rtl" @endif id="title_english_{{ $languages[$i]->id }}" value="@if($languages[$i]->id == $storedData[$i]->lang_id) {{ $storedData[$i]->name }} @endif" class="form-control">
                                    <span id="title_english_error" class="text-danger"></span>
                                </div><!-- /grid column -->
                                <input type="hidden" name="languages[]" value="{{ $languages[$i]->id }}" id="languages">
                                @endfor
                                <div class="col-md-6 col-mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" placeholder="Slug" value="{{ $storedData[0]->slug }}" class="form-control">
                                    <span class="text-danger" id="slug_error"></span>
                                </div>
                                <div class="col-md-12 col-lg-12 mb-4 ">
                                    <label class="mr-2">Image</label>
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
                                             <img loading="lazy" src="{{ $storedData[0]->image }}" alt="Preview Image" id="blah-one" class="">
                                          </div>
                                       </div>
                                    </div>
                               </div>
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
@include('locations.locations.js.edit');
@endsection
