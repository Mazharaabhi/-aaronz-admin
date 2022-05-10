@extends('layouts.master')
@section('title', 'Service Questions')
@section('first', 'Manage Services')
@section('second', 'Service Questions')
@section('third', 'Create')

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
                               <a href="{{ route('manage-services.question-sub-type.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <form onsubmit="return false;" id="QuestionForm">
                        <fieldset>
                            <legend>Add Service Sub Type Question:</legend>
                            <div class="row">
                           @if(count($languages) > 0)
                            <!-- grid column -->
                           <div class="col-md-6 mb-3">
                                <label for="slug">Service Category</label>
                                <select name="service_id" id="service_id" class="form-control">
                                    <option value="">---select a parent category---</option>
                                    @if (count($categories) > 0)
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                                </select>
                                <small id="service_id_error" class="text-danger"></small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="service_subCat">Service Sub Category</label>
                                <select name="service_subCat_id" id="service_subCat_id" class="form-control">
                                </select>
                                <small id="service_subCat_id_error" class="text-danger"></small>
                            </div>
                            <!-- grid column -->
                                @foreach ($languages as $item)
                                <div class="col-md-6 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_{{ $item->id }}">
                                  <label for="title_english">Question Heading {{ $item->name }}</label>
                                  <input type="text" name="title_english[]" @if($item->direction == 'Right') dir="rtl" @endif id="title_english_{{ $item->id }}" class="form-control" autofocus>
                                  <small id="title_english_error" class="text-danger"></small>
                                </div><!-- /grid column -->
                                <input type="hidden" name="languages[]" value="{{ $item->id }}" id="languages">

                                <div class="col-md-6 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_options_{{ $item->id }}">
                                    <label for="option_english">Option {{ $item->name }}</label>
                                    <input type="text" name="option_english[]" @if($item->direction == 'Right') dir="rtl" @endif id="option_english_{{ $item->id }}" class="form-control" autofocus>
                                    <small id="option_english_error" class="text-danger"></small>
                                </div>
                                @endforeach
                            @endif
                           </div>
                        </fieldset>
                        <button type="submit" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" id="add_language">
                            <span class="svg-icon svg-icon-md fa fa-floppy-o"></span>
                                @lang('translation.save')
                        </button>
                    </form>
                </div>
                {{-- </div> --}}
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('services.question-sub-types.js.create');
@endsection
