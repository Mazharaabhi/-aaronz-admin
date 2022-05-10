@extends('layouts.master')
@section('title', 'Role Permission')
@section('first', 'Role Permission')
@section('second', 'Administrator')
@section('third', 'Role Permission')

@section('content')
<style>
.table thead th, .table thead td {
    font-weight: 600;
    font-size: 1rem !important;
    border-bottom-width: 1px;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
}
input[type=checkbox] {
            transform : scale(1.2);
        }
</style>
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                            <!--begin: Datatable-->
                            <div>
                                <form method="POST" action="{{ route('admin.administrator.role-permission.update') }}">
                                    @csrf
                                <input type="hidden" name="role_id" value="{{ $role_id }}">
                                <table class="table table-bordered table-sm" >
                                    <thead style="background-color:#f5f5f5 !important; font-weight: bold;">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>Module Name</th>
                                            <th>Function Name</th>
                                            <th>View
                                                <p style="display: inline-block;margin:0px;margin-left:5px;">
                                                <input type="checkbox" name="" id="fn_view" value="1">
                                                </p>
                                            </th>
                                            <th>Add
                                                <p style="display: inline-block;margin:0px;margin-left:5px;">
                                                    <input type="checkbox" name="" id="fn_add" value="1">
                                                </p>
                                            </th>
                                            <th>Edit
                                                <p style="display: inline-block;margin:0px;margin-left:5px;">
                                                    <input type="checkbox" name="" id="fn_edit" value="1">
                                                </p>
                                            </th>
                                            <th>Status
                                                <p style="display: inline-block;margin:0px;margin-left:5px;">
                                                    <input type="checkbox" name="" id="fn_status" value="1">
                                                </p>
                                            </th>
                                            <th>Delete
                                                <p style="display: inline-block;margin:0px;margin-left:5px;">
                                                    <input type="checkbox" name="" id="fn_delete" value="1">
                                                </p>
                                            </th>
                                        </tr>
                                    </thead>
                                    @if ($modules->count())
                                        @php
                                            $count = 0;
                                        @endphp
                                        @for ($i = 0; $i < $modules->count() ; $i++)
                                           <tr>
                                               <td style="background: #ececec; font-weight: bold;">{{ ++$count }}</td>
                                               <td colspan="8" style="background: #ececec; font-weight: bold;">{{  $modules[$i]['name']  }}</td>
                                           </tr>
                                           @php
                                               $sub_count = 1;
                                           @endphp
                                           @for ($j = 0 ; $j < $modules[$i]['operations']->count() ; $j++)
                                           <tr>
                                               <td>{{ $count .'.'. $sub_count++ }}</td>
                                               <td></td>
                                               <td>{{  $modules[$i]['operations'][$j]['name']  }}
                                               @php
                                                    $privileg = App\Models\Administrator\Privileg::where(['operation_id' => $modules[$i]['operations'][$j]['id'], 'role_id' => $role_id])->first();
                                               @endphp
                                               <input type="hidden" name="operation_id[{{ $privileg->id }}]" value="{{ $privileg->id }}">
                                               </td>
                                               <td>
                                                    @if ($modules[$i]['operations'][$j]['is_view'] == 1)
                                                        <input type="checkbox" name="is_view[{{ $privileg->id }}]" class="fn_view" value="1" {{ $modules[$i]['operations'][$j]['is_view'] == $privileg->is_view ? "checked" : '' }}/>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($modules[$i]['operations'][$j]['is_add'] == 1)
                                                        <input type="checkbox" name="is_add[{{ $privileg->id }}]" class="fn_add" value="1" {{ $modules[$i]['operations'][$j]['is_add'] == $privileg->is_add ? "checked" : '' }}/>
                                                    @endif
                                                </td><td>
                                                    @if ($modules[$i]['operations'][$j]['is_edit'] == 1)
                                                        <input type="checkbox" name="is_edit[{{ $privileg->id }}]" class="fn_edit" value="1" {{ $modules[$i]['operations'][$j]['is_edit'] == $privileg->is_edit ? "checked" : '' }}/>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($modules[$i]['operations'][$j]['is_status'] == 1)
                                                    <input type="checkbox" name="is_status[{{ $privileg->id }}]" class="fn_status" value="1" {{ $modules[$i]['operations'][$j]['is_status'] == $privileg->is_status ? "checked" : '' }}/>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($modules[$i]['operations'][$j]['is_delete'])
                                                    <input type="checkbox" name="is_delete[{{ $privileg->id }}]" class="fn_delete" value="1" {{ $modules[$i]['operations'][$j]['is_delete'] == $privileg->is_delete ? "checked" : '' }}/>
                                                    @endif
                                                </td>
                                           </tr>
                                           @endfor
                                        @endfor
                                    @endif
                                </table>
                                <a href="{{ route('admin.administrator.role-permission.index') }}" class="btn btn-dark">Cancel</a>
                                @if ($default == 0)
                                    <button type="submit" class="btn btn-danger">Update Role Permission</button>
                                @else
                                    <button type="button" class="btn btn-danger">Can't Update Default Role</button>
                                @endif
                                </form>
                            </div>
                            <!--end: Datatable-->

                    <!--end::Card-->

                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('admin.administrator.role-permission.js.index');
@endsection
