@extends('layouts.master')
@section('title', 'Categories')
@section('first', 'Categories')
@section('second', 'Manage Properties')
@section('third', 'Property Settings')
@section('fourth', 'Categories')
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
                               <a href="{{ route('manage-properties.property-settings.categories.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Edit Category:</legend>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input is_commercial" type="radio" value="0" name="is_commercial" id="flexRadioDefault1" {{ $storedData[0]->is_commercial == '0' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Commercial
                                    </label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input is_commercial" type="radio" value="1" name="is_commercial" id="flexRadioDefault2" {{ $storedData[0]->is_commercial == '1' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                       Residential
                                    </label>
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                           @if(count($languages) > 0)
                           <div class="col-md-6 mb-3">
                            <label for="slug">Property Type</label>
                            <select name="type_id" id="type_id" class="form-control">
                                <option value="">---select property type---</option>
                                @if (count($menus) > 0)
                                    @foreach ($menus as $item)
                                        <option value="{{ $item->id }}" {{ $storedData[0]->property_type_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <small id="type_id_error" class="text-danger"></small>
                        </div>
                        <!-- grid column -->
                           @for ($i=0 ; $i < count($languages) ; $i++)
                            <div class="col-md-6 mb-3 {{ $languages[$i]->id != 1 ? 'd-none' : '' }}" id="div_{{ $languages[$i]->id }}">
                                <label for="title_english">View Title {{ $languages[$i]->name }}</label>
                                <input type="text" name="title_english[]" @if($languages[$i]->direction == 'Right') dir="rtl" @endif id="title_english_{{ $languages[$i]->id }}" value="@if($languages[$i]->id == $storedData[$i]->lang_id) {{ $storedData[$i]->name }} @endif" class="form-control">
                                <small id="title_english_error" class="text-danger"></small>
                            </div><!-- /grid column -->
                            <input type="hidden" name="languages[]" value="{{ $languages[$i]->id }}" id="languages">
                            @endfor
                            <div class="col-md-6 mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" placeholder="" value="{{ $storedData[0]->slug }}" class="form-control">
                              </div>
                              <div class="col-md-12 mb-3">
                                <label for=""><b>Includes:</b></label><br>
                                <div class="mt-3" id="amenitesData">
                                    <div style="display: block;" class="demo-checkbox col-md-12">
                                            <div class="row">
                                                @if (count($property_includes) > 0)
                                                @foreach ($property_includes as $key => $sub_item)
                                                    <div class="col-md-3">
                                                        <input name="property_includes[]" value="{{ $sub_item->id }}" {{ count($includes) > 0 && $includes[$key] == $sub_item->id ? 'checked' : '' }} style="cursor: pointer;" type="checkbox" id="{{ $sub_item->name }}" class="chk-col-green">
                                                    <label for="{{ $sub_item->name }}" style="min-width:227px;cursor: pointer;">{{ $sub_item->name }}</label>
                                                    </div>
                                                @endforeach
                                            @endif
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
@include('properties.categories.js.edit');
@endsection
