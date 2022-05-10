@extends('layouts.master')
@section('title', 'Sub Categories')
@section('first', 'Sub Categories')
@section('second', 'Manage Properties')
@section('third', 'Property Settings')
@section('fourth', 'Sub Categories')
@section('fifth', 'Create')

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
                               <a href="{{ route('manage-properties.property-settings.sub-categories.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Edit Sub Categories:</legend>
                            <div class="row">
                           @if(count($languages) > 0)
                           <div class="col-md-6 mb-3">
                            <label for="slug">Property Type</label>
                            <select name="type_id" id="type_id" class="form-control">
                                <option value="">---select property type---</option>
                                @if (count($types) > 0)
                                    @foreach ($types as $item)
                                        <option value="{{ $item->id }}" {{ $storedData[0]->categories->types->id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <small id="type_id_error" class="text-danger"></small>
                        </div>
                          <!-- grid column -->
                          <div class="col-md-6 mb-3">
                            <label for="slug">Category</label>
                            <select name="service_id" id="service_id" class="form-control">
                                <option value="">---select a category---</option>
                            </select>
                            <small id="service_id_error" class="text-danger"></small>
                            </div>
                        <!-- grid column -->
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
@include('properties.sub-categories.js.edit');
@endsection
