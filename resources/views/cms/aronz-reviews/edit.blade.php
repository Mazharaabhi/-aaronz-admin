@extends('layouts.master')
@section('title', 'Aaronz Reviews')
@section('first', 'Reviews')
@section('second', 'CMS')
@section('third', 'Aaronz Reviews')
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
                               <a href="{{ route('cms.aronz-reviews.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Add Aaronz Reviews:</legend>
                            <div class="row">
                                @for($i=0 ; $i < count($languages) ; $i++)
                                <div class="col-md-4 col-lg-4 mb-4 {{ $languages[$i]->id != 1 ? 'd-none' : '' }}" id="div_title_{{ $languages[$i]->id }}">
                                    <label class="mr-2"> Title {{ $languages[$i]->name }}</label>
                                     <input type="text" name="title[]" @if($languages[$i]->direction == 'Right') dir="rtl" @endif value="{{ $storedData[$i]->title }}" class="form-control" id="title_{{ $languages[$i]->id }}">
                                    <small id="title_error" class="text-danger"></small>
                                </div>
                                <div class="col-md-4 col-lg-4 mb-4 {{ $languages[$i]->id != 1 ? 'd-none' : '' }}" id="div_{{ $languages[$i]->id }}">
                                    <label class="mr-2">Company Name {{ $languages[$i]->name }}</label>
                                     <input type="text" name="company_name[]" @if($languages[$i]->direction == 'Right') dir="rtl" @endif value="{{ $storedData[$i]->company_name }}" class="form-control" id="company_name_{{ $languages[$i]->id }}">
                                    <small id="company_name_error" class="text-danger"></small>
                                </div>
                                <div class="col-md-4 col-lg-4 mb-4 {{ $languages[$i]->id != 1 ? 'd-none' : '' }}" id="div_designation_{{ $languages[$i]->id }}">
                                    <label class="mr-2">Designation {{ $languages[$i]->name }}</label>
                                      <input type="text" name="designation[]" value="{{ $storedData[$i]->designation }}" @if($languages[$i]->direction == 'Right') dir="rtl" @endif class="form-control" id="designation_{{ $languages[$i]->id }}">
                                    <small id="designation_error" class="text-danger"></small>
                                    <input type="hidden" name="languages[]" value="{{ $languages[$i]->id }}" id="languages">
                                </div>
                                @endfor
                            </div>
                        <div class="row">
                            @for($i=0 ; $i < count($languages) ; $i++)
                            <div class="col-md-12 col-lg-12 mb-6 {{  $languages[$i]->id != 1 ? 'd-none' : '' }}" id="div_review_{{ $languages[$i]->id }}">
                                <label class="mr-2">Review {{ $languages[$i]->name }}</label>
                                  <textarea class="form-control" @if($languages[$i]->direction == 'Right') dir="rtl" @endif name="descriptions_{{  $languages[$i]->id }}" id="descriptions_{{  $languages[$i]->id }}">{{ $storedData[$i]->review }}</textarea>
                                <small id="descriptions_error" class="text-danger"></small>
                            </div>
                            @php
                                ($languages[$i]->direction == 'Right') ?   $dir = 'rtl' : $dir = 'ltr';
                            @endphp
                            <script>
                                setTimeout(function(){
                                    CKEDITOR.replace('descriptions_{{  $languages[$i]->id }}', {
                                        contentsLangDirection: "{{ $dir }}",
                                        scayt_customerId: '1:Eebp63-lWHbt2-ASpHy4-AYUpy2-fo3mk4-sKrza1-NsuXy4-I1XZC2-0u2F54-aqYWd1-l3Qf14-umd',
                                        scayt_sLang: 'auto',
                                        removeButtons: 'PasteFromWord'
                                        });

                                }, 1000);
                            </script>
                            @endfor
                        </div>
                    </div>
                        </fieldset>
                        <button type="button" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" id="edit_aronz_review">
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
@include('cms.aronz-reviews.js.edit');
@endsection
