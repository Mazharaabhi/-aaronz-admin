@extends('layouts.master')
@section('title', 'Portals')
@section('first', 'Portals')
@section('second', 'Manage Portals')
@section('third', 'Portals')

@section('content')
<style>
    .table:not(.table-bordered) td:nth-of-type(4), .table:not(.table-bordered) td:nth-of-type(3) {
    width: 20%;
    white-space: initial;
   }
    /* styling text input field */
    #inputText {
    padding: 6px 7px;
    font-size: 15px;
    }

    /* styling button */
    #copyText {
    padding: 6px 11px;
    font-size: 15px;
    font-weight: bold;
    background-color: #00c2cb;
    color: #efefef;
    }
</style>
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                            <!--begin::Search Form-->
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="row align-items-center">
                                            <div class="col-md-6 my-2 my-md-0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 d-flex justify-content-end">
                                            <!--begin::Button-->
                                            <a href="{{ route('manage-properties.export.portals.create') }}" class="btn btn-cherwell font-weight-bolder mr-1" id="OpenAddModel">
                                                <span class="svg-icon svg-icon-md fa fa-plus">
                                                </span>@lang('translation.create')
                                            </a>
                                            <!--end::Button-->
                                            <!--begin::Button-->
                                             <a href="#" class="btn btn-cherwell font-weight-bolder" id="reload">
                                                <span class="svg-icon svg-icon-md fa fa-refresh">
                                                </span>@lang('translation.reload')
                                            </a>
                                    </div>
                                </div>
                            </div>
                            <!--end::Search Form-->
                            <!--begin: Datatable-->
                            <div>
                                <table id="users-table-12" class="table fixed">
                                    <thead>
                                        <tr style="background-color:#00c2cb">
                                            <th>Logo</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>XML Link</th>
                                            <th>Copy</th>
                                            <th class="text-center" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    @if (count($portals) > 0)
                                        @foreach ($portals as $portal)
                                        <tr>
                                            <td>
                                                <img loading="lazy" src="{{ asset('storage') }}/{{ $portal->image }}" height="50px" width="50px"/>
                                            </td>
                                            <td>
                                                {{ $portal->name }}
                                            </td>
                                            <td width="5%">
                                                {{ $portal->description }}
                                            </td>
                                            <td width="5%">
                                                <input id="inputText" name="xml" readonly type="text" value="{{ $portal->xml_link }}">

                                            </td>
                                            <td>
                                                <a href="#" id="copyText" class="btn btn-icon btn-light btn-hover-primary" data-toggle="tooltip" data-theme="dark" title="Copy">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                        <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="copy" class="svg-inline--fa fa-copy fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M433.941 65.941l-51.882-51.882A48 48 0 0 0 348.118 0H176c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h224c26.51 0 48-21.49 48-48v-48h80c26.51 0 48-21.49 48-48V99.882a48 48 0 0 0-14.059-33.941zM266 464H54a6 6 0 0 1-6-6V150a6 6 0 0 1 6-6h74v224c0 26.51 21.49 48 48 48h96v42a6 6 0 0 1-6 6zm128-96H182a6 6 0 0 1-6-6V54a6 6 0 0 1 6-6h106v88c0 13.255 10.745 24 24 24h88v202a6 6 0 0 1-6 6zm6-256h-64V48h9.632c1.591 0 3.117.632 4.243 1.757l48.368 48.368a6 6 0 0 1 1.757 4.243V112z"></path></svg>
                                                    </span>
                                                </a>
                                            </td>
                                             <td>
                                                <a href="{{ route('manage-properties.export.portals.edit', ['id' => $portal->id]) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
                                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                       <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                           <rect x="0" y="0" width="24" height="24"></rect>
                                                           <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                                                           <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                       </g>
                                                       </svg>
                                                   </span>
                                                   </a>
                                                   <input type="hidden" name="id" value="{{  $portal->id}}">
                                                  <a id="delete_portal" data-id="{{ $portal->id }}" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                                                  <span class="svg-icon svg-icon-md svg-icon-danger">
                                                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                          <rect x="0" y="0" width="24" height="24"></rect>
                                                          <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                                          <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                                      </g>
                                                  </svg>
                                                  </span>
                                                  </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                </tr>
                                <td colspan="6">
                                   <center>No Record Found</center>
                                <hr>
                                </td>
                                </tr>
                                    @endif
                                </table>
                            </div>
                            <!--end: Datatable-->

                    <!--end::Card-->

                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('export-portals.js.index');
@endsection
