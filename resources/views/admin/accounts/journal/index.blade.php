@extends('layouts.master')
@section('title', 'Journal Entries')
@section('first', 'Journal Entries')
@section('second', 'Accounts')
@section('third', 'Journal Entries')

@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-bordered" style="border: 1px solid #ed3232">
                            <thead class="text-white" style="background-color: #ed3232">
                                <tr>
                                    <th width="10%">Date</th>
                                    <th width="20%">Type</th>
                                    <th width="35%"></th>
                                    <th width="10%">Credit</th>
                                    <th width="10%">Debit</th>
                                    <th width="5%" class="text-center">Balance</th>
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
@include('admin.accounts.journal.js.index')
@endsection
