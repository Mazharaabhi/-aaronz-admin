@extends('layouts.master')
@section('title', 'Aaronz Pages')
@section('first', 'Pages')
@section('second', 'CMS')
@section('third', ' Edit')
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
                               <a href="{{ route('cms.pages.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Edit Page:</legend>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label for="type_id">Property Type</label>
                                    <select name="type_id" id="type_id" class="form-control">
                                        @if (count($property_types) > 0)
                                            <option value="">select property type</option>
                                            @foreach ($property_types as $item)
                                                <option value="{{ $item->id }}" @if($item->id == $page_data->menu_id) {{ 'selected' }} @endif>{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small id="type_id_error" class="text-danger"></small>
                                </div>
                                @foreach ($languages  as $key => $item)
                                <div class="col-md-4 col-lg-4 mb-4 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_title_{{ $item->id }}">
                                    <label class="mr-2">Title {{ $item->name }}</label>
                                     <input type="text" name="title[]" @if($item->direction == 'Right') dir="rtl" @endif value="{{ $storedData[$key]->title }}" class="form-control" id="title_{{ $item->id }}">
                                    <small id="title_error" class="text-danger"></small>
                                </div>
                                <input type="hidden" name="languages[]" id="languages" value="{{ $item->id }}" />
                                @endforeach
                                <div class="col-md-4 col-lg-4 mb-4">
                                    <label for="slug">Slug</label>
                                        <input type="text" name="slug" value="{{ $page_data->slug }}" id="slug" placeholder="" class="form-control">
                                    <span id="slug_error" class="text-danger"></span>
                                </div>
                            </div>
                        <div class="row">
                            @foreach ($languages as  $key => $item)
                            <div class="col-md-12 col-lg-12 mb-6 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_review_{{ $item->id }}">
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
                        @if ( $page_data->slug == '/sell-and-lease-with-us')
                        <div class="row">
                            @foreach ($languages as  $key => $item)
                            <div class="col-md-12 col-lg-12 mb-6 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_review_two_{{ $item->id }}">
                                <label class="mr-2">Sell With Us Descriptions Two {{ $item->name }}</label>
                                  <textarea class="form-control" @if($item->direction == 'Right') dir="rtl" @endif name="descriptions_two_{{ $item->id }}" id="descriptions_two_{{ $item->id }}">{{ $storedData[$key]->sell_with_us_desc_two }}</textarea>
                                <small id="review_error" class="text-danger"></small>
                            </div>
                            @php
                            ($item->direction == 'Right') ?   $dir = 'rtl' : $dir = 'ltr';
                        @endphp
                        <script>
                            setTimeout(function(){
                                CKEDITOR.replace('descriptions_two_{{ $item->id }}', {
                                    contentsLangDirection: "{{ $dir }}",
                                    scayt_customerId: '1:Eebp63-lWHbt2-ASpHy4-AYUpy2-fo3mk4-sKrza1-NsuXy4-I1XZC2-0u2F54-aqYWd1-l3Qf14-umd',
                                    scayt_sLang: 'auto',
                                    removeButtons: 'PasteFromWord'
                                    });

                            }, 1000);
                        </script>
                            @endforeach
                        </div>
                        <div class="row">
                            @foreach ($languages as  $key => $item)
                            <div class="col-md-12 col-lg-12 mb-6 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_review_three_{{ $item->id }}">
                                <label class="mr-2">Sell With Us Descriptions Three {{ $item->name }}</label>
                                  <textarea class="form-control" @if($item->direction == 'Right') dir="rtl" @endif name="descriptions_three_{{ $item->id }}" id="descriptions_three_{{ $item->id }}">{{ $storedData[$key]->sell_with_us_desc_three }}</textarea>
                                <small id="review_error" class="text-danger"></small>
                            </div>
                            @php
                            ($item->direction == 'Right') ?   $dir = 'rtl' : $dir = 'ltr';
                        @endphp
                        <script>
                            setTimeout(function(){
                                CKEDITOR.replace('descriptions_three_{{ $item->id }}', {
                                    contentsLangDirection: "{{ $dir }}",
                                    scayt_customerId: '1:Eebp63-lWHbt2-ASpHy4-AYUpy2-fo3mk4-sKrza1-NsuXy4-I1XZC2-0u2F54-aqYWd1-l3Qf14-umd',
                                    scayt_sLang: 'auto',
                                    removeButtons: 'PasteFromWord'
                                    });

                            }, 1000);
                        </script>
                            @endforeach
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6 col-lg-6 mb-4 ">
                              <label class="mr-2">Upload Logo Image</label>
                              <div class="group-contain" style="
                                  display: flex;
                                  ">
                                  <div class="btn btn-secondary fileinput-button" style="line-height: 2;height: 50px;">
                                  <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                  <input id="fileupload-btn-one" type="file" name="file-one" accept="image/*">
                                  </div>
                                  <div class="form-group" style="
                                  display: block;
                                  margin: 0 auto;
                                  ">
                                  <div id="uploadList" class="list-group list-group-flush list-group-divider" style="margin: auto;">
                                      <img loading="lazy" src="{{ $page_data->image }}" alt="Preview Image" id="blah-one" class="d-block" width="50%">
                                  </div>
                                  </div>
                              </div>
                              <!-- /.form-group -->
                              <small id="image_error" class="text-danger"></small>
                            </div>
                           <div class="col-md-6 col-lg-6 mb-4 ">
                              <label class="mr-2">Upload Backgound Image</label>
                              <div class="group-contain" style="
                                  display: flex;
                                  ">
                                  <div class="btn btn-secondary fileinput-button" style="line-height: 2;height: 50px;">
                                  <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                  <input id="bg-image-fileupload" type="file" name="file-two" accept="image/*">
                                  </div>
                                  <div class="form-group" style="
                                  display: block;
                                  margin: 0 auto;
                                  ">
                                  <div id="uploadListTwo" class="list-group list-group-flush list-group-divider" style="margin: auto;">
                                      <img loading="lazy" src="{{ $page_data->bg_image }}" alt="Preview Image" id="blah-two" class="d-block" width="50%">
                                  </div>
                                  </div>
                              </div>
                              <!-- /.form-group -->
                              <small id="bg_image_error" class="text-danger"></small>
                          </div>
                        </div>
                        <fieldset>
                            <legend>Social Icons (Optional)</legend>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" class="form-control" value="{{ $page_data->facebook }}" id="facebook" />
                                </div>
                                <div class="col-md-3">
                                    <label for="Instagram">Instagram</label>
                                    <input type="text" class="form-control" value="{{ $page_data->instagram }}" id="Instagram" />
                                </div>
                                <div class="col-md-3">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" class="form-control" value="{{ $page_data->twitter }}" id="twitter" />
                                </div>
                                <div class="col-md-3">
                                    <label for="whatsapp">Whatsapp</label>
                                    <input type="text" class="form-control" value="{{ $page_data->whatsapp }}" id="whatsapp" />
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" name="meta_title" value="{{ $page_data->meta_title }}" id="meta_title" class="form-control" />
                            </div>
                            <div class="col-md-6">
                                <label for="meta_description">Meta Descriptions</label>
                                <input type="text" name="meta_description" value="{{ $page_data->meta_description }}" id="meta_description" class="form-control" />
                            </div>
                            {{--  <div class="col-md-4">
                                <label for="meta_keywords">Meta Keywords</label>
                                <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" />
                            </div>  --}}
                        </div>
                      </div>
                    </fieldset>
                        <button type="button" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" id="edit_aronz_page">
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
@include('cms.aronz-pages.js.edit');
@endsection
