@extends('layouts.master')
@section('title', 'Manage Questions')
@section('first', 'Manage Services')
@section('second', 'Sub Services')
@section('third', 'Manage Questions')

@section('content')
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                {{-- <div class="card-body"> --}}
                    <div class="card-header">
                        <div class="mt-5">
                           <h3>{{ $category->name }}</h3>
                        </div>
                        <div class="card-toolbar">
                           <div class="example-tools justify-content-center">
                               <a href="{{ route('manage-services.question.index') }}" class="btn btn-cherwell float-right m-1"><span class="fa fa-mail-reply"></span> Back</a>
                               <button class="btn btn-cherwell float-right m-1">Create</button>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <div class="row" id="questionnaire_div">
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('services.sub-categories.js.view_questionnaire');
@endsection
