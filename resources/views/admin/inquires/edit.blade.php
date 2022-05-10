@extends('layouts.master')
@section('title', 'Manage Sell With Us')
@section('first', 'Manage Sell With Us')
@section('second', 'Sell With Us')
@section('third', 'View')

@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                {{-- <div class="card-body"> --}}
                    <div class="card-header">
                        <div class="card-toolbar">
                           <div class="example-tools justify-content-center">
                               <a href="{{ route('sell-with-us.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span>Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>View Sell With Us:</legend>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="Name" class="d-block">Name</label>
                                     <input type="text" name="name" id="name" value="{{ $inquery->name }}" class="form-control" placeholder="name">
                                  </div><!-- /grid column -->
                                <!-- grid column -->
                            <div class="col-md-6 mb-3">
                                <label for="slug">Email</label>
                                <input type="text" name="email" id="email" value="{{ $inquery->email }}" class="form-control" placeholder="email">
                                <span class="text-danger" id="email_error"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" value="{{ $inquery->phone }}" class="form-control" placeholder="phone">
                                <span class="text-danger" id="phone_error"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="company">Company</label>
                                <input type="text" name="company" id="company" value="{{ $inquery->company }}" class="form-control" placeholder="company">
                                <span class="text-danger" id="company_error"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="community">Community</label>
                                <input type="text" name="community" id="community" value="{{ $inquery->community }}" class="form-control" placeholder="community">
                                <span class="text-danger" id="community_error"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="property_type">Property Type</label>
                                <input type="text" name="property_type" id="property_type" value="{{ $inquery->property_type }}" class="form-control" placeholder="Property Type">
                                <span class="text-danger" id="property_type_error"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="bedrooms">Bed Rooms</label>
                                <input type="text" name="bedrooms" id="bedrooms" value="{{ $inquery->bedrooms }}" class="form-control" placeholder="bedrooms">
                                <span class="text-danger" id="bedrooms_error"></span>
                            </div>
                            <div class="col-md-12 mb-6">
                                <textarea class="form-control">{{ $inquery->message }}</textarea>
                            </div>
                          </div>
                        </fieldset>
                    </div>

                {{-- </div> --}}
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
{{--  @include('locations.states.js.edit');  --}}
@endsection
