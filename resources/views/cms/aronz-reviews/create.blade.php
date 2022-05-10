@extends('layouts.master')
@section('title', 'Aaronz Reviews')
@section('first', 'Reviews')
@section('second', 'CMS')
@section('third', 'Aaronz Reviews')
@section('fourth', 'Create')

@section('content')
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

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
                               <a href="{{ route('cms.aronz-reviews.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Add Aaronz Reviews:</legend>
                            <div class="row">
                                @foreach ($languages as $item)
                                <div class="col-md-4 col-lg-4 mb-4 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_title_{{ $item->id }}">
                                    <label class="mr-2">Title {{ $item->name }}</label>
                                     <input type="text" name="title[]" class="form-control" id="title_{{ $item->id }}">
                                    <small id="title_error" class="text-danger"></small>
                                </div>
                                <div class="col-md-4 col-lg-4 mb-4 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_{{ $item->id }}">
                                    <label class="mr-2">Company Name {{ $item->name }}</label>
                                     <input type="text" name="company_name[]" class="form-control" id="company_name_{{ $item->id }}">
                                    <small id="company_name_error" class="text-danger"></small>
                                </div>
                                <div class="col-md-4 col-lg-4 mb-4 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_designation_{{ $item->id }}">
                                    <label class="mr-2">Designation {{ $item->name }}</label>
                                      <input type="text" name="designation[]" class="form-control" id="designation_{{ $item->id }}">
                                    <small id="designation_error" class="text-danger"></small>
                                    <input type="hidden" name="languages[]" value="{{ $item->id }}" id="languages">
                                </div>
                                @endforeach
                            </div>
                        <div class="row">
                            @foreach ($languages as $item)
                            <div class="col-md-12 col-lg-12 mb-6 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_review_{{ $item->id }}">
                                <label class="mr-2">Review {{ $item->name }}</label>
                                  <textarea class="form-control" @if($item->direction == 'Right') dir="rtl" @endif name="descriptions_{{ $item->id }}" id="descriptions_{{ $item->id }}"></textarea>
                                <small id="descriptions_error" class="text-danger"></small>
                            </div>
                            @php
                                ($item->direction == 'Right') ?   $dir = 'rtl' : $dir = 'ltr';
                            @endphp
                            <script>
                                setTimeout(function(){
                                    CKEDITOR.replace('descriptions_{{ $item->id }}', {
                                        contentsLangDirection: "{{ $dir }}",
                                        scayt_customerId: '1:Eebp63-lWHbt2-ASpHy4-AYUpy2-fo3mk4-sKrza1-NsuXy4-I1XZC2-0u2F54-aqYWd1-l3Qf14-umd',
                                        scayt_sLang: 'auto',
                                        removeButtons: 'PasteFromWord'
                                        });

                                }, 1000);
                            </script>
                            @endforeach
                        </div>
                    </div>
                        </fieldset>
                        <button type="button" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" id="add_aronz_review">
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
@include('cms.aronz-reviews.js.create');
@endsection
