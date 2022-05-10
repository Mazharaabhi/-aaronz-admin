@extends('layouts.master', ['linke' => route('admin.administrator.manage-users.index')])
@section('title', 'Edit Service Lead')
@section('first', 'Edit Service Lead')
@section('second', 'Administrator')
@section('third', 'Edit Service Lead')
@section('fourth', 'Edit')

@section('content')
<style>
#accordion .card-header{
    padding: 4px !important;
}
#accordion .card-header button[data-toggle="collapse"]{
    background: #1ec8d6;
    color: #fff;
    text-align: left;
    font-weight: 600;
    font-size: 12px;
    display: block;
    width: 100%;
}
#accordion .card-body {
    padding: 1rem !important;
}
select#lead_status {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    border: 1px solid #E4E6EF;
    outline: none !important;
    border-radius: 0.42rem;
    height: auto;
    padding: 8px;
}
</style>
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header">
                 <h3 class="card-title">
                  Edit Service Lead
                 </h3>
                 <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('manage-leads.index') }}" class="btn btn-danger float-right"><span class="fa fa-mail-reply"></span> @lang('translation.back')</a>
                    </div>
                   </div>
                </div>
                <!--begin::Form-->
                 <div class="card-body">
                  <fieldset>
                      <legend>Service Lead Info & Progress</legend>
                      <div class="row mb-2">
                            <div class="col-md-6" style="border-right: 1px solid #ccc">
                                <div class="col-md-12 col-lg-12 mb-4">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" name="name" id="name" {{ auth()->user()->role_id == 1 ? '' : 'disabled' }} value="{{ $lead->name }}" placeholder="Enter full name" autofocus/>
                                    <span class="form-text text-danger" id="name_error"></span>
                                </div>
                                <div class="col-md-12 col-lg-12 mb-4">
                                    <label for="email">@lang('translation.email')</label>
                                    <input type="email" class="form-control" name="customer_email" {{ auth()->user()->role_id == 1 ? '' : 'disabled' }} value="{{ $lead->email }}" id="customer_email" placeholder="@lang('translation.enter_email')"/>
                                    <span class="form-text text-danger" id="email_error"></span>
                                </div>
                                <div class="col-md-12 col-lg-12 mb-4 ">
                                    <label for="phone">@lang('translation.phone')</label>
                                    <input type="number" class="form-control" name="phone" {{ auth()->user()->role_id == 1 ? '' : 'disabled' }} value="{{ $lead->phone }}"  id="phone" placeholder="@lang('translation.enter_phone')"/>
                                    <span class="form-text text-danger" id="phone_error"></span>
                                </div>
                                <div class="col-md-12 col-lg-12 mb-4">
                                    <label for="email">Message</label>
                                    <textarea name="" id="" cols="30" disabled rows="2" class="form-control">{{ $lead->description }}</textarea>
                                    <span class="form-text text-danger" id="email_error"></span>
                                </div>
                                <div class="col-md-12 col-lg-12 mb-4">
                                    @if (auth()->user()->role_id == 1)
                                    <button class="btn btn-danger btn-block" id="save">Submit</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 for=""><b>Lead Type: </b>Service</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 for=""><b>Lead Status: </b>
                                        @if ($lead->status == 0)
                                            New
                                        @elseif ($lead->status == 1)
                                            In Progress
                                        @elseif ($lead->status == 2)
                                            Complete
                                        @elseif ($lead->status == 3)
                                            On Hold
                                        @elseif ($lead->status == 4)
                                            Cancelled
                                        @endif
                                        </h4>

                                    </div>
                                    <div class="col-md-6">
                                        <h4 for=""><b>Change Status: </b>
                                            <select name="lead_status" id="lead_status">
                                                @if (auth()->user()->role_id == 1)
                                                <option value="0" {{ $lead->status == 0 ? 'selected' : '' }}>New</option>
                                                @endif
                                                <option value="1" {{ $lead->status == 1 ? 'selected' : '' }}>In Progress</option>
                                                <option value="2" {{ $lead->status == 2 ? 'selected' : '' }}>Complete</option>
                                                <option value="3" {{ $lead->status == 3 ? 'selected' : '' }}>On Hold</option>
                                                <option value="4" {{ $lead->status == 4 ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </h4>
                                    </div>
                                    @if (auth()->user()->role_id == 1)
                                    <div class="col-md-12">
                                        <h4 for=""><b>Agent/Company: </b>
                                            @if (isset($lead->service_assigned_to))
                                            <p class="p-0 m-0 d-inline">{{ $lead->service_assigned_to->user->role->name }} | </p>
                                            @if ($lead->service_assigned_to->user->role->id == 3)
                                            {{ $lead->service_assigned_to->user->name }} | {{ $lead->service_assigned_to->user->companies->company_name }}
                                            @else
                                            {{ $lead->service_assigned_to->user->name }}
                                            @endif
                                            <i class="fa fa-edit text-primary" id="show_hide" style="cursor: pointer"></i>
                                           <div class="d-block d-none" data-id="0" id="hide_div">
                                            <select id="lead_for" name="lead_for" class="mb-1">
                                                <option value="">---select Lead For---</option>
                                                <option value="2" {{ $lead->service_assigned_to->user->role_id == 2 ? 'selected' : '' }}>Property Manager/Owner</option>
                                                <option value="3" {{ $lead->service_assigned_to->user->role_id == 3 ? 'selected' : '' }}>Agent</option>
                                                <option value="4" {{ $lead->service_assigned_to->user->role_id == 4 ? 'selected' : '' }}>Bank</option>
                                                <option value="5" {{ $lead->service_assigned_to->user->role_id == 5 ? 'selected' : '' }}>Service Provider</option>
                                                <option value="6" {{ $lead->service_assigned_to->user->role_id == 6 ? 'selected' : '' }}>Insurance</option>
                                            </select>
                                            @php $companies = \App\Models\User::with('companies')->where(['role_id' => $lead->service_assigned_to->user->role_id, 'is_active' => 1, 'is_verified' => 1])->get(); @endphp
                                            <select id="company_id" name="company_id" class="">
                                            <option value="">---select Company---</option>
                                            @if ($companies->count())
                                                @foreach ($companies as $comp)
                                                    <option value="{{ $comp->id }}" {{ $lead->service_assigned_to->assigned_to == $comp->id ? 'selected' : '' }}>{{ $comp->company_name }}</option>
                                                @endforeach
                                            @endif
                                            </select>
                                           </div>
                                            @else
                                            <select id="lead_for" name="lead_for" class="mb-1">
                                                <option value="">---select Lead For---</option>
                                                <option value="2">Property Manager/Owner</option>
                                                <option value="3">Agent</option>
                                                <option value="4">Bank</option>
                                                <option value="5">Service Provider</option>
                                                <option value="6">Insurance</option>
                                            </select>
                                            <select id="company_id" name="company_id" class="">
                                            <option value="">---select Company---</option>
                                            </select>
                                            @endif

                                            </h4>
                                    </div>
                                    @endif
                                    <div class="col-md-12">
                                        <hr width="">
                                        <label for=""><b>Add Comment</b></label>
                                        <textarea name="comment" id="comment" cols="30" rows="5" class="form-control mb-2"></textarea>
                                        <span class="text-danger" id="comment_error"></span>
                                        <button class="btn btn-cherwell float-right" id="add_comment">Add</button>
                                    </div>
                                </div>
                            </div>
                      </div>
                  </fieldset>
                  <div class="row mb-6">
                    <div class="col-lg-5 col-xxl-5">
                        <!--begin::List Widget 9-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header align-items-center border-0 mt-4">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="font-weight-bolder text-dark">Logs</span>
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm"> Total {{ $lead->service_logs->count() }}</span>
                                </h3>
                                {{-- <div class="card-toolbar">
                                    <div class="dropdown dropdown-inline">
                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ki ki-bold-more-hor"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                            <!--begin::Navigation-->
                                            <ul class="navi navi-hover">
                                                <li class="navi-header font-weight-bold py-4">
                                                    <span class="font-size-lg">Choose Label:</span>
                                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                                                </li>
                                                <li class="navi-separator mb-3 opacity-70"></li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-text">
                                                            <span class="label label-xl label-inline label-light-success">Customer</span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-text">
                                                            <span class="label label-xl label-inline label-light-danger">Partner</span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-text">
                                                            <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-text">
                                                            <span class="label label-xl label-inline label-light-primary">Member</span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-text">
                                                            <span class="label label-xl label-inline label-light-dark">Staff</span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="navi-separator mt-3 opacity-70"></li>
                                                <li class="navi-footer py-4">
                                                    <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                                    <i class="ki ki-plus icon-sm"></i>Add new</a>
                                                </li>
                                            </ul>
                                            <!--end::Navigation-->
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-4">
                                <div class="timeline timeline-3">
                                    @if ($lead->service_logs->count())
                                        @foreach ($lead->service_logs as $item)
                                        <div class="timeline-items">
                                            <div class="timeline-item">
                                                <div class="timeline-media">
                                                    <img loading="lazy" alt="Pic" src="{{ asset('storage/'.$item->user->avatar) }}">
                                                </div>
                                                <div class="timeline-content mb-1">
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <div class="mr-2" style="width: 100%">
                                                            <a href="#" class="text-primary-75 text-hover-dark font-weight-bold">{{ auth()->user()->id == $item->user->id ? 'You' : $item->user->name }}</a>
                                                            <span class="label label-light-success font-weight-bolder label-inline  float-right p-0">{{ $item->created_at->diffForHumans() }} | {{ date("d-M-y, H:i", strtotime($item->created_at)) }}</span>
                                                        </div>
                                                    </div>
                                                    <p class="p-0 m-0">{{ $item->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                                <!--end: Items-->
                            </div>
                            <!--end: Card Body-->
                        </div>
                        <!--end: Card-->
                        <!--end: List Widget 9-->
                    </div>

                    <div class="col-lg-7 col-xxl-5">
                        <!--begin::List Widget 9-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header align-items-center border-0 mt-4">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="font-weight-bolder text-dark">Questions / Answers</span>
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm"> Total 2</span>
                                </h3>

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-4">
                                <div id="accordion">
                                @if (count($lead->service_lead_deatils) > 0)
                                @foreach ($lead->service_lead_deatils as $detail)
                                <div class="card">
                                    <div class="card-header" id="heading_{{ $detail->id }}">
                                      <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_{{ $detail->id }}" aria-expanded="true" aria-controls="collapseOne">
                                            {{ $detail->question }}
                                        </button>
                                      </h5>
                                    </div>

                                    <div id="collapse_{{ $detail->id }}" class="collapse @if($loop->first) show @endif" aria-labelledby="heading_{{ $detail->id }}" data-parent="#accordion">
                                      <div class="card-body">
                                        {{ $detail->answer }}
                                      </div>
                                    </div>
                                  </div>
                                @endforeach
                                @endif
                              </div>
                            </div>
                            <!--end: Card Body-->
                        </div>
                        <!--end: Card-->
                        <!--end: List Widget 9-->
                    </div>

                    </div>
                 </div>
                <!--end::Form-->
               </div>

        </div>
    </div>
</div>

        <!--end::Container-->
    </div>
    <!--end::Entry-->

@include('admin.services-leads.js.edit')
@endsection
