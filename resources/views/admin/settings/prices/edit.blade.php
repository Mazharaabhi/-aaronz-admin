@extends('layouts.master')
@section('title', 'Prices')
@section('first', 'Prices')
@section('second', 'Settings')
@section('third', 'Prices')
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
                        <h3 class="card-title">
                         Edit Price
                        </h3>
                        <div class="card-toolbar">
                           <div class="example-tools justify-content-center">
                               <a href="{{ route('admin.settings.prices.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Price Details:</legend>
                            <div class="row">
                            <div class="col-md-12 col-lg-4 mb-4 ">
                                <label for="description_english" class="d-block">Integer Price</label>
                                <input type="text" name="amount" placeholder="0" id="amount" value="{{ $price->amount }}" onkeypress="return isNumberKey(event)" class="form-control" autofocus>
                                <span id="amount_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-12 col-lg-4 mb-4 ">
                                  <label for="description_english" class="d-block">Decimal Price</label>
                                  <input type="text" name="decimal_amount" placeholder="0.00" id="decimal_amount" value="{{ $price->decimal_amount }}" class="form-control" readonly>
                              </div>
                              <div class="col-md-12 col-lg-4 mb-4 ">
                                <label for="description_english" class="d-block">Compact Price</label>
                                <input type="text" name="compact_amount" id="compact_amount" class="form-control" value="{{ $price->compact_amount }}" placeholder="0" readonly>
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
@include('admin.settings.prices.js.edit');
@endsection
