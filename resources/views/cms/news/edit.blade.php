@extends('layouts.master')
@section('title', 'News')
@section('first', 'News')
@section('second', 'CMS')
@section('third', 'News')
@section('fourth', 'Edit')

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
                               <a href="{{ route('cms.news.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Add News:</legend>
                            <div class="row">
                                <!-- grid column -->
                           @if(count($languages) > 0)
                                <div class="col-md-6 mb-3">
                                    <label for="">News Categories</label>
                                    <select name="news_category_id" id="news_category_id" class="form-control">
                                        <option value=""></option>
                                        @if ($news_categories->count())
                                            @foreach ($news_categories as $item)
                                                <option value="{{ $item->id }}" {{ $storedData[0]->news_category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger" id="news_category_id_error"></span>
                                </div>
                                @foreach ($languages as $key => $item)
                                <div class="col-md-6 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_{{ $item->id }}">
                                  <label for="title_english">Title {{ $item->name }}</label>
                                  <input type="text" name="title_english[]" @if($item->direction == 'Right') dir="rtl" @endif id="title_english_{{ $item->id }}" value="{{ $storedData[$key]->title }}" class="form-control" autofocus>
                                  <span id="title_english_error" class="text-danger"></span>
                                </div><!-- /grid column -->
                                <input type="hidden" name="languages[]" value="{{ $item->id }}" id="languages">
                                @endforeach
                                <div class="col-md-6 mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" placeholder="" value="{{ $storedData[0]->slug }}" class="form-control">
                                    <span id="slug_error" class="text-danger"></span>
                                </div>
                               <div class="col-md-12 col-lg-12 mb-4 ">
                                <label class="mr-2">Upload Image</label>
                                <div class="group-contain" style="display: flex;">
                                   <div class="btn btn-secondary fileinput-button" style="line-height: 2;height: 50px;">
                                      <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                      <input id="fileupload-btn-one" type="file" name="file-one" accept="image/*">
                                   </div>
                                   <div class="form-group" style="
                                      display: block;
                                      margin: 0 auto;
                                      ">
                                      <div id="uploadList" class="list-group list-group-flush list-group-divider" style="margin: auto;">
                                         <img loading="lazy" src="{{ $storedData[0]->image }}" alt="Preview Image" id="blah-one" class="">
                                      </div>
                                   </div>
                                </div>
                                <!-- /.form-group -->
                                <span id="image_one_error" class="text-danger"></span>
                             </div>
                            @endif
                           </div>
                           <div class="row">
                            @foreach ($languages as  $key => $item)
                            <div class="col-md-12 col-lg-12 mb-6 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_description_{{ $item->id }}">
                                <label class="mr-2">Descriptions {{ $item->name }}</label>
                                  <textarea class="form-control" @if($item->direction == 'Right') dir="rtl" @endif name="descriptions_{{ $item->id }}" id="descriptions_{{ $item->id }}">{{ $storedData[$key]->description }}</textarea>
                                <small id="review_error" class="text-danger"></small>
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
                        </fieldset>
                        <fieldset>
                            <legend>SEO SECTION</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" name="meta_title" value="{{ $storedData[0]->meta_title }}" id="meta_title" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="meta_description">Meta Descriptions</label>
                                    <input type="text" name="meta_description" value="{{ $storedData[0]->meta_description }}" id="meta_description" class="form-control" />
                                </div>
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
@include('cms.news.js.edit');
@endsection
