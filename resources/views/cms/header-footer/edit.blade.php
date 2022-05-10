@extends('layouts.master')
@section('title', 'Header & Footer')
@section('first', 'Header & Footer')
@section('second', 'CMS')
@section('third', 'Header & Footer')
@section('fourth', 'Edit')

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
                               <a href="{{ route('cms.header-footer.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Header Section:</legend>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 mb-4 ">
                                    <label class="mr-2">Favicon</label>
                                    <div class="group-contain" style="display: flex;">
                                       <div class="btn btn-secondary fileinput-button" style="line-height: 2;height: 50px;">
                                          <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                          <input id="fileupload-btn-three" type="file" name="file-three" accept="image/*">
                                       </div>
                                       <div class="form-group" style="display: block; margin: 0 auto;">
                                          <div id="uploadList" class="list-group list-group-flush list-group-divider" style="margin: auto;">
                                             <img loading="lazy" src="{{ $storedData[0]->favicon }}" alt="Preview Image" id="blah-three" class="" width="80%">
                                          </div>
                                       </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <span id="image_one_error" class="text-danger"></span>
                                 </div>
                                <div class="col-md-12 col-lg-12 mb-4 ">
                                    <label class="mr-2">Header Logo</label>
                                    <div class="group-contain" style="display: flex;">
                                       <div class="btn btn-secondary fileinput-button" style="line-height: 2;height: 50px;">
                                          <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                          <input id="fileupload-btn-one" type="file" name="file-one" accept="image/*">
                                       </div>
                                       <div class="form-group" style="display: block; margin: 0 auto;">
                                          <div id="uploadList" class="list-group list-group-flush list-group-divider" style="margin: auto;">
                                             <img loading="lazy" src="{{ $storedData[0]->header_logo }}" alt="Preview Image" id="blah-one" class="">
                                          </div>
                                       </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <span id="image_one_error" class="text-danger"></span>
                                 </div>
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
                                    <input type="text" name="meta_description" value="{{ $storedData[0]->meta_descriptions }}" id="meta_description" class="form-control" />
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12 col-lg-12 mb-4">
                                <label class="mr-2">Meta Picture</label>
                                <div class="group-contain" style="display: flex;">
                                   <div class="btn btn-secondary fileinput-button" style="line-height: 2;height: 50px;">
                                      <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                      <input id="meta-file" type="file" name="meta-file" accept="image/*">
                                   </div>
                                   <div class="form-group" style="
                                      display: block;
                                      margin: 0 auto;
                                      ">
                                      <div id="uploadList" class="list-group list-group-flush list-group-divider" style="margin: auto;">
                                         <img loading="lazy" src="{{ $storedData[0]->bg_image }}" alt="Preview Image" id="blah-meta-file" class="">
                                      </div>
                                   </div>
                                </div>
                                <!-- /.form-group -->
                                <span id="image_one_error" class="text-danger"></span>
                             </div>
                        </fieldset>
                        <fieldset>
                            <legend>Footer Section:</legend>
                            <div class="row">
                                <!-- grid column -->
                           @if(count($languages) > 0)
                                @foreach ($languages as $key => $item)
                                <div class="col-md-6 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_{{ $item->id }}">
                                  <label for="title_english">Address {{ $item->name }}</label>
                                  <input type="text" name="title_english[]" value="{{ $storedData[$key]->address }}" @if($item->direction == 'Right') dir="rtl" @endif id="title_english_{{ $item->id }}" class="form-control" autofocus>
                                  <span id="title_english_error" class="text-danger"></span>
                                </div><!-- /grid column -->
                                <input type="hidden" name="languages[]" value="{{ $item->id }}" id="languages">
                                @endforeach
                                <div class="col-md-6 mb-3">
                                    <label for="">Email</label>
                                    <input type="email" name="new_one_email" id="new_one_email" value="{{ $storedData[0]->email }}" placeholder="" class="form-control">
                                    <span class="text-danger" id="email_error"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Phone</label>
                                    <input type="tel" name="phone" id="phone" placeholder="" value="{{ $storedData[0]->phone }}" class="form-control">
                                    <span class="text-danger" id="phone_error"></span>
                                </div>
                               <div class="col-md-12 col-lg-12 mb-4">
                                <label class="mr-2">Footer Logo</label>
                                <div class="group-contain" style="display: flex;">
                                   <div class="btn btn-secondary fileinput-button" style="line-height: 2;height: 50px;">
                                      <i class="fa fa-plus fa-fw"></i> <span>Add File</span>
                                      <input id="fileupload-btn-two" type="file" name="file-two" accept="image/*">
                                   </div>
                                   <div class="form-group" style="
                                      display: block;
                                      margin: 0 auto;
                                      ">
                                      <div id="uploadList" class="list-group list-group-flush list-group-divider" style="margin: auto;">
                                         <img loading="lazy" src="{{ $storedData[0]->footer_logo }}" alt="Preview Image" id="blah-two" class="">
                                      </div>
                                   </div>
                                </div>
                                <!-- /.form-group -->
                                <span id="image_one_error" class="text-danger"></span>
                             </div>
                             @foreach ($languages as $key => $item)
                              <div class="col-md-12 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_follow_up_description_{{ $item->id }}">
                                <div class="form-group">
                                    <label for="follow_up_desc">Follow Up Description {{ $item->name }}</label>
                                  <textarea name="follow_up_desc[]" id="follow_up_desc_{{ $item->id }}" class="form-control @if($item->direction =='Right' ) direction @endif">{{ $storedData[$key]->follow_up_desc }}</textarea>
                                  <span id="follow_up_desc_error" class="text-danger"></span>
                              </div>
                             </div>
                             <div class="col-md-12 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_news_letter_description_{{ $item->id }}">
                                <div class="form-group">
                                    <label for="news_letter_desc">News Letter Description {{ $item->name }}</label>
                                  <textarea name="news_letter_desc[]" id="news_letter_desc_{{ $item->id }}" class="form-control @if($item->direction =='Right' ) direction @endif">{{ $storedData[$key]->news_letter_desc }}</textarea>
                                  <span id="news_letter_desc_error" class="text-danger"></span>
                              </div>
                             </div>
                             <div class="col-md-12 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_description_{{ $item->id }}">
                                <div class="form-group">
                                  <label for="description_english">Description {{ $item->name }}</label>
                                  <textarea name="description_english[]" id="description_english_{{ $item->id }}" class="form-control @if($item->direction =='Right' ) direction @endif">{{ $storedData[$key]->description }}</textarea>
                                  <span id="description_english_error" class="text-danger"></span>
                              </div>
                             </div>
                             @endforeach
                            @endif
                           </div>

                        </fieldset>
                        <fieldset>
                            <legend>Social Links:</legend>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="">FaceBook</label>
                                    <input type="text" name="fb" id="fb" value="{{ $storedData[0]->fb }}" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="">Instagram</label>
                                    <input type="text" name="instagram" id="instagram" value="{{ $storedData[0]->instagram }}" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="">Twitter</label>
                                    <input type="text" name="twitter" id="twitter" value="{{ $storedData[0]->twitter }}" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="">LinkedIn</label>
                                    <input type="text" name="linkedin" id="linkedin" value="{{ $storedData[0]->linkedin }}" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="">Google</label>
                                    <input type="text" name="google" id="google" value="{{ $storedData[0]->google }}" class="form-control">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="">Youtube</label>
                                    <input type="text" name="youtube" id="youtube" value="{{ $storedData[0]->youtube }}" class="form-control">
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
@include('cms.header-footer.js.edit');
@endsection
