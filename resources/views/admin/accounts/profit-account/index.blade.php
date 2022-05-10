@extends('layouts.master')
@section('title', 'Profit Account')
@section('first', 'Profit Account')
@section('second', 'Accounts')
@section('third', 'Profit Account')

@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="row mb-3">
                        <div class="col-md-6">
                            <select name="company_id" id="company_id" class="form-control">
                               <option value="">--select company--</option>
                                @if (count($companies) > 0)
                                    @foreach ($companies as $item)
                                        <option value="{{ $item->id }}">{{ $item->company_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        </div>
                        <table class="table table-bordered table-bordered" style="border: 1px solid #ed3232">
                            <thead class="text-white" style="background-color: #ed3232">
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="20%">Company</th>
                                    <th width="10%">Fixed Cost</th>
                                    <th width="10%">Service Fee</th>
                                    <th width="10%">Withdrawal Fee</th>
                                    <th width="10%">Government Tax</th>
                                    <th width="10%">Gross Profit</th>
                                    <th width="10%">Net Profit</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('admin.accounts.profit-account.js.index')
@endsection
