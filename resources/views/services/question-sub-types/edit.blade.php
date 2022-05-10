@extends('layouts.master')
@section('title', 'Service Questions')
@section('first', 'Manage Services')
@section('second', 'Service Questions')
@section('third', 'Edit')

@section('content')
<style>
    th{
        background-color: #8bdfe4;
    }
</style>
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
                        <fieldset>
                            <legend>Edit Service Question:</legend>
                            <div class="row">
                           @if(count($languages) > 0)
                          <!-- grid column -->
                          <div class="col-md-6 mb-3">
                            <label for="slug"> Service Category</label>
                            <select name="service_id" id="service_id" class="form-control">
                                <option value="">---select a category---</option>
                            @if (count($categories) > 0)
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" {{ $storedData[0]->service_category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            @endif
                            </select>
                            <small id="service_id_error" class="text-danger"></small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="service_subCat_id"> Service Sub Category</label>
                                <select name="service_subCat_id" id="service_subCat_id" class="form-control">
                                    <option value="">---select a category---</option>
                                @if (count($all_categories) > 0)
                                    @foreach ($all_categories as $item)
                                        <option value="{{ $item->id }}" {{ $storedData[0]->service_sub_category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                                </select>
                                <small id="service_subCat_id_error" class="text-danger"></small>
                                </div>
                        <!-- grid column -->
                        <!-- grid column -->
                           @for ($i=0 ; $i < count($languages) ; $i++)
                            <div class="col-md-6 mb-3 {{ $languages[$i]->id != 1 ? 'd-none' : '' }}" id="div_{{ $languages[$i]->id }}">
                                <label for="title_english">Title {{ $languages[$i]->name }}</label>
                                <input type="text" name="title_english[]" @if($languages[$i]->direction == 'Right') dir="rtl" @endif id="title_english_{{ $languages[$i]->id }}" value="@if($languages[$i]->id == $storedData[$i]->lang_id) {{ $storedData[$i]->name }} @endif" class="form-control">
                                <small id="title_english_error" class="text-danger"></small>
                            </div><!-- /grid column -->
                            <input type="hidden" name="languages[]" value="{{ $languages[$i]->id }}" id="languages">
                            <div class="col-md-6 mb-3 {{ $languages[$i]->id != 1 ? 'd-none' : '' }}" id="div_options_{{ $languages[$i]->id }}">
                                <label for="option_english">Option {{ $languages[$i]->name }}</label>
                                <input type="text" name="option_english[]" @if($languages[$i]->direction == 'Right') dir="rtl" @endif id="option_english_{{ $languages[$i]->id }}" value="@if($languages[$i]->id == $optionsData[$i]->lang_id) {{ $optionsData[$i]->title }} @endif" class="form-control"   autofocus>
                                <small id="option_english_error" class="text-danger"></small>
                            </div>
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
@include('services.question-sub-types.js.edit');
@endsection
