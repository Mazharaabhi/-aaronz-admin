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
                               <a href="{{ route('manage-services.question.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
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
                        <!-- grid column -->
                          <!-- grid column -->
                          <div class="col-md-6 mb-3">
                            <label for="slug">Service Sub Category</label>
                            <select name="service_sub_category_id" id="service_sub_category_id" class="form-control">
                            </select>
                            <small id="service_sub_id_error" class="text-danger"></small>
                            </div>
                      </div>
                            <!-- grid column -->
                        <!-- grid column -->
                        <div class="row">
                           @for ($i=0 ; $i < count($languages) ; $i++)
                            <div class="col-md-6 mb-3 {{ $languages[$i]->id != 1 ? 'd-none' : '' }}" id="div_{{ $languages[$i]->id }}">
                                <label for="title_english">Title {{ $languages[$i]->name }}</label>
                                <input type="text" name="title_english[]" @if($languages[$i]->direction == 'Right') dir="rtl" @endif id="title_english_{{ $languages[$i]->id }}" value="@if($languages[$i]->id == $storedData[$i]->lang_id) {{ $storedData[$i]->name }} @endif" class="form-control">
                                <small id="title_english_error" class="text-danger"></small>
                            </div><!-- /grid column -->
                            <input type="hidden" name="languages[]" value="{{ $languages[$i]->id }}" id="languages">
                            @endfor
                            <div style="" class="demo-checkbox col-md-6">
                                <label for=""><b>Question Type:</b></label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="question" value="1" name="question" class="custom-control-input" {{ $storedData[0]->question_type == 1 ? 'checked' : ''  }}>
                                    <label class="custom-control-label" for="question" title="For Input Only" data-toggle="tooltip" data-placement="top">Input(Text)</label>
                                  </div>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sub_type" value="2" name="question" class="custom-control-input" {{ $storedData[0]->question_type == 2 ? 'checked' : ''  }}>
                                    <label class="custom-control-label" for="sub_type">Input(Radio)</label>
                                  </div>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="input_date" value="3" name="question" class="custom-control-input" {{ $storedData[0]->question_type == 3 ? 'checked' : ''  }}>
                                    <label class="custom-control-label" for="input_date">Input(Date)</label>
                                  </div>
                             </div>
                         </div>
                        <div id="radio_options" style="width: 100%; @if($storedData[0]->question_type == 1) display:none  @endif">
                          <div class="row">
                            @for ($i=0 ; $i < count($languages) ; $i++)
                            <div class="col-md-6 mb-3 {{ $languages[$i]->id != 1 ? 'd-none' : '' }}" id="div_options_{{ $languages[$i]->id }}">
                                <label for="option_english">Option {{ $languages[$i]->name }}</label>
                                <input type="text" name="option_english[]" @if($languages[$i]->direction == 'Right') dir="rtl" @endif id="option_english_{{ $languages[$i]->id }}" class="form-control"   autofocus>
                                <small id="option_english_error" class="text-danger"></small>
                            </div>
                            @endfor
                            @endif
                            <div class="col-md-4 mt-8">
                                <button class="btn btn-cherwell" id="add-option" data-id="0">Add</button>
                            </div>
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
                                        @foreach ($storedData[0]->QuestionOptions as $option)
                                        <tr id="option_{{ $option->id }}">
                                            <td class="justify-content-center">{{ $option->id }}</td>
                                             <td class="justify-content-center">
                                                {{ $option->title }}
                                             </td>
                                             <td class="text-center justify-content-center">
                                             <input type="hidden" name="id" value="{{ $option->id }}">
                                             <a href="javascript:;" data-id="{{ $option->id }}" id="row-to-update" class="btn btn-sm btn-icon btn-secondary">
                                                <i class="fa fa-pencil-alt text-primary" style="padding-top: 7px !important"></i>
                                            </a>
                                             <a href="javascript:;" data-id="{{ $option->id }}" id="remove" class="btn btn-sm btn-icon btn-secondary">
                                                <i class="far fa-trash-alt" style="padding-top: 7px !important;color:red"></i> <span class="sr-only">Remove</span>
                                            </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
@include('services.questions.js.edit');
@endsection
