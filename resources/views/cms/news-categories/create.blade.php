@extends('layouts.master')
@section('title', 'News Categories')
@section('first', 'News Categories')
@section('second', 'CMS')
@section('third', 'News Categories')
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
                               <a href="{{ route('cms.news-categories.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Add Category:</legend>
                            <div class="row">
                                @if(count($languages) > 0)
                                        @foreach ($languages as $item)
                                        <div class="col-md-6 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_{{ $item->id }}">
                                        <label for="title_english">Name {{ $item->name }}</label>
                                        <input type="text" name="title_english[]" @if($item->direction == 'Right') dir="rtl" @endif id="title_english_{{ $item->id }}" class="form-control" autofocus>
                                        <span id="title_english_error" class="text-danger"></span>
                                        </div><!-- /grid column -->
                                        <input type="hidden" name="languages[]" value="{{ $item->id }}" id="languages">
                                        @endforeach
                                        <div class="col-md-6 mb-3">
                                            <label for="slug">Slug</label>
                                                <input type="text" name="slug" id="slug" placeholder="" class="form-control">
                                            <span id="slug_error" class="text-danger"></span>
                                        </div>
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
@include('cms.news-categories.js.create');
@endsection
