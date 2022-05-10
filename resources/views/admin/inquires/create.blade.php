@extends('layouts.master')
@section('title', 'Cities')
@section('first', 'Cities')
@section('second', 'Locations')
@section('third', 'Cities')
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
                        <div>
                            @include('languages')
                        </div>
                        <div class="card-toolbar">
                           <div class="example-tools justify-content-center">
                               <a href="{{ route('locations.states.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Add Cities:</legend>
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="country" class="d-block">Countries</label>
                                <select name="country" id="country" class="form-control fa-select select2" style="width:90%;display:inline-block">
                                <option value="">---select Country---</option>
                                    @if (count($location_countries) > 0)
                                        @foreach ($location_countries as $item)
                                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span id="country_id_error" class="text-danger d-block"></span>
                                </div><!-- /grid column -->
                                <!-- grid column -->
                           @if(count($languages) > 0)
                                @foreach ($languages as $item)
                                <div class="col-md-6 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_{{ $item->id }}">
                                  <label for="title_english">Name {{ $item->name }}</label>
                                  <input type="text" name="title_english[]" @if($item->direction == 'Right') dir="rtl" @endif id="title_english_{{ $item->id }}" class="form-control" autofocus>
                                  <span id="title_english_error" class="text-danger"></span>
                                </div><!-- /grid column -->
                                <input type="hidden" name="languages[]" value="{{ $item->id }}" id="languages">
                                @endforeach
                            @endif
                           <div class="col-md-6 mb-3">
                               <label for="slug">Slug</label>
                               <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">
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
                                     <img loading="lazy" src="#" alt="Preview Image" id="blah-one" class="d-none">
                                  </div>
                               </div>
                            </div>
                            <!-- /.form-group -->
                            <span id="image_one_error" class="text-danger"></span>
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
@include('locations.states.js.create');
@endsection
