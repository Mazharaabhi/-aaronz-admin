@extends('layouts.master')
@section('title', 'View')
@section('first', 'View')
@section('second', 'Manage Properties')
@section('third', 'Property Settings')
@section('fourth', 'View')
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
                               <a href="{{ route('manage-properties.property-settings.views.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Add View:</legend>
                            <div class="row">
                                <!-- grid column -->
                           @if(count($languages) > 0)
                                @foreach ($languages as $item)
                                <div class="col-md-12 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_{{ $item->id }}">
                                  <label for="title_english">Title {{ $item->name }}</label>
                                  <input type="text" name="title_english[]" @if($item->direction == 'Right') dir="rtl" @endif id="title_english_{{ $item->id }}" class="form-control" autofocus>
                                  <small id="title_english_error" class="text-danger"></small>
                                </div><!-- /grid column -->
                                <input type="hidden" name="languages[]" value="{{ $item->id }}" id="languages">
                                @endforeach

                            @endif
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
@include('properties.views.js.create');
@endsection
