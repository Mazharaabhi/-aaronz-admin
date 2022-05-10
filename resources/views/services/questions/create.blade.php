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
                               <a href="{{ route('manage-services.question.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <form onsubmit="return false;" id="QuestionForm">
                        <fieldset>
                            <legend>Add Service Question:</legend>
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
                             <!-- grid column -->
                           <div class="col-md-6 mb-3">
                            <label for="slug">Service Sub Category</label>
                            <select name="service_sub_category_id" id="service_sub_category_id" class="form-control">
                            </select>
                            <small id="service_sub_id_error" class="text-danger"></small>
                            </div>
                      </div>
                      <div class="row">
                            <!-- grid column -->
                                @foreach ($languages as $item)
                                <div class="col-md-6 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_{{ $item->id }}">
                                  <label for="title_english">Question Heading {{ $item->name }}</label>
                                  <input type="text" name="title_english[]" @if($item->direction == 'Right') dir="rtl" @endif id="title_english_{{ $item->id }}" class="form-control" autofocus>
                                  <small id="title_english_error" class="text-danger"></small>
                                </div><!-- /grid column -->
                                <input type="hidden" name="languages[]" value="{{ $item->id }}" id="languages">
                                @endforeach
                                <div style="" class="demo-checkbox col-md-6">
                                    <label for=""><b>Question Type:</b></label><br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="question" value="1" name="question" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="question" title="For Input Only" data-toggle="tooltip" data-placement="top">Input(Text)</label>
                                      </div>
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="sub_type" value="2" name="question" class="custom-control-input">
                                        <label class="custom-control-label" for="sub_type">Input(Radio)</label>
                                      </div>
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="input_date" value="3" name="question" class="custom-control-input">
                                        <label class="custom-control-label" for="input_date">Input(Date)</label>
                                      </div>
                                 </div>
                               </div>
                            <div id="radio_options" style="width: 100%; display:none">
                              <div class="row">
                                @foreach ($languages as $item)
                                <div class="col-md-6 mb-3 {{ $item->id != 1 ? 'd-none' : '' }}" id="div_options_{{ $item->id }}">
                                    <label for="option_english">Option {{ $item->name }}</label>
                                    <input type="text" name="option_english_{{ $item->id  }}" @if($item->direction == 'Right') dir="rtl" @endif id="option_english_{{ $item->id }}" class="form-control" autofocus>
                                    <small id="option_english_error" class="text-danger"></small>
                                </div>
                                @endforeach
                                <div class="col-md-4 mt-8">
                                    <button class="btn btn-cherwell" id="add-option">Add</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 mb-4">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="5%">Id</th>
                                                <th class="text-center">Question Title</th>
                                                <th class="text-center" width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="options_tbody">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
@include('services.questions.js.create');
@endsection
