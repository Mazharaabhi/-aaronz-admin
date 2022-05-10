@extends('layouts.master')
@section('title', 'Sub Location')
@section('first', 'Sub Location')
@section('second', 'Locatinos')
@section('third', 'Sub Location')
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
                               <a href="{{ route('locations.sub-locations.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Edit Sub Location:</legend>
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
                                    <small id="icon_error" class="text-danger d-block"></small>
                                  </div><!-- /grid column -->
                                  <div class="col-md-6 mb-3">
                                    <label for="state" class="d-block">Cities</label>
                                    <select name="state" id="state" class="form-control fa-select select2">
                                    <option value="">---select city---</option>
                                    </select>
                                    <small id="state_error" class="text-danger d-block"></small>
                                    </div><!-- /grid column -->
                                    <div class="col-md-6 mb-3">
                                        <label for="location_id" class="d-block">Location</label>
                                        <select name="location_id" id="location_id" class="form-control fa-select select2">
                                        <option value="">---select location---</option>
                                        </select>
                                        <small id="location_error" class="text-danger d-block"></small>
                                        </div><!-- /grid column -->
                                <!-- grid column -->
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
@include('locations.sub-locations.js.edit');
@endsection
