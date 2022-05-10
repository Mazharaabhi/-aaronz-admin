@extends('layouts.master')
@section('title', 'Property Status')
@section('first', 'Property Status')
@section('second', 'Manage Properties')
@section('third', 'Property Settings')
@section('fourth', 'Property Status')
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
                               <a href="{{ route('manage-properties.property-settings.property-status.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Edit Property Sub Type:</legend>
                            <div class="row">
                           @if(count($languages) > 0)
                           <div class="col-md-6 mb-3">
                            <label for="slug">Navbar Menu</label>
                            <select name="service_id" id="service_id" class="form-control">
                                <option value="">---select property type---</option>
                                @if (count($types) > 0)
                                    @foreach ($types as $item)
                                        <option value="{{ $item->id }}" {{ $storedData[0]->type_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <small id="service_id_error" class="text-danger"></small>
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
@include('properties.sub-types.js.edit');
@endsection
