@extends('layouts.master')
@section('title', 'Categories')
@section('first', 'Manage Services')
@section('second', 'Service Categories')
@section('third', 'Edit')

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
                               <a href="{{ route('manage-services.categories.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Edit  Service Category:</legend>
                            <div class="row">
                           @if(count($languages) > 0)
                        <!-- grid column -->
                           @for ($i=0 ; $i < count($languages) ; $i++)
                            <div class="col-md-6 mb-3 {{ $languages[$i]->id != 1 ? 'd-none' : '' }}" id="div_{{ $languages[$i]->id }}">
                                <label for="title_english">Category Title {{ $languages[$i]->name }}</label>
                                <input type="text" name="title_english[]" @if($languages[$i]->direction == 'Right') dir="rtl" @endif id="title_english_{{ $languages[$i]->id }}" value="@if($languages[$i]->id == $storedData[$i]->lang_id) {{ $storedData[$i]->name }} @endif" class="form-control">
                                <small id="title_english_error" class="text-danger"></small>
                            </div><!-- /grid column -->
                            <input type="hidden" name="languages[]" value="{{ $languages[$i]->id }}" id="languages">
                            @endfor
                            <div class="col-md-6 mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" placeholder="" value="{{ $storedData[0]->slug }}" class="form-control">
                              </div>
                            @endif
                           </div>
                           <div style="display: none;" class="demo-checkbox col-md-12">
                            <label for=""><b>Include:</b></label><br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="question" value="1" name="question" class="custom-control-input" @if($view->is_question == 1) {{ 'checked' }} @endif>
                                <label class="custom-control-label" for="question">Questions</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="sub_type" value="2" name="question" class="custom-control-input" @if($view->is_sub_type == 1) {{ 'checked' }} @endif>
                                <label class="custom-control-label" for="sub_type">Sub Type Question</label>
                              </div>
                         </div>
                         <br>
                           <div class="col-md-12 col-lg-12 mb-4 ">
                            <label class="mr-2">Upload Image</label>
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
                                     <img loading="lazy" src="{{ asset('storage') }}/{{ $view->image }}" alt="Preview Image" id="blah-one" class="d-block">
                                  </div>
                               </div>
                            </div>
                            <!-- /.form-group -->
                            <small id="image_one_error" class="text-danger"></small>
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
@include('services.categories.js.edit');
@endsection
