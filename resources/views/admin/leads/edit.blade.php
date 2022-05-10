@extends('layouts.master', ['linke' => route('admin.administrator.manage-users.index')])
@section('title', 'Edit Lead')
@section('first', 'Edit Lead')
@section('second', 'Administrator')
@section('third', 'Edit Lead')
@section('fourth', 'Edit')

@section('content')
<style>
    #agent-company > b:first-child{
     display: block;
     margin-bottom: 10px;
    }
    #lead_for + span.select2.select2-container.select2-container--default.select2-container--above {
    width: 30% !important;
}
#company_id + span.select2.select2-container.select2-container--default.select2-container--above.select2-container--focus {
    width: 69% !important;
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
                  Edit Lead
                 </h3>
                 <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <a href="{{ route('manage-leads.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> @lang('translation.back')</a>
                    </div>
                   </div>
                </div>
                <!--begin::Form-->
                 <div class="card-body">
                  <fieldset>
                      <legend>Lead Info & Progress</legend>
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
                                    <button class="btn btn-cherwell btn-block" id="save">Submit</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 for=""><b>Lead Type: </b> {{ $lead->type == 1 ? 'Property' : '' }}</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 for=""><b>Lead Status: </b>
                                        @if ($lead->status == 0)
                                            New
                                        @elseif ($lead->status == 1)
                                            In Progress
                                        @elseif ($lead->status == 5)
                                            Tenancy Contract
                                        @elseif ($lead->status == 6)
                                            Sale Contract
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
                                                @if ($property->property_type_id == 3)
                                                <option value="5" {{ $lead->status == 5 ? 'selected' : '' }}>Tenancy Contract</option>
                                                @endif
                                                <option value="6" {{ $lead->status == 6 ? 'selected' : '' }}>Sale Contract</option>
                                                <option value="2" {{ $lead->status == 2 ? 'selected' : '' }}>Complete</option>
                                                <option value="3" {{ $lead->status == 3 ? 'selected' : '' }}>On Hold</option>
                                                <option value="4" {{ $lead->status == 4 ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </h4>
                                    </div>
                                    @if (auth()->user()->role_id == 1)
                                    <div class="col-md-12">
                                        <h4 for="" id="agent-company"><b>Agent/Company: </b>
                                            @if (isset($lead->assigned_to))
                                            <p class="p-0 m-0 d-inline">{{ $lead->assigned_to->user->role->name }} | </p>
                                            @if ($lead->assigned_to->user->role->id == 3)
                                            {{ $lead->assigned_to->user->name }} | {{ $lead->assigned_to->user->companies->company_name }}
                                            @else
                                            {{ $lead->assigned_to->user->name }}
                                            @endif
                                            <i class="fa fa-edit text-primary" id="show_hide" style="cursor: pointer"></i>
                                           <div class="d-block d-none" data-id="0" id="hide_div">
                                            <select id="lead_for" name="lead_for" class="mb-1">
                                                <option value="">---select Lead For---</option>
                                                <option value="3" {{ $lead->assigned_to->user->role_id == 3 ? 'selected' : '' }}>Agent</option>
                                                {{--  <option value="4" {{ $lead->assigned_to->user->role_id == 4 ? 'selected' : '' }}>Bank</option>  --}}
                                                {{-- <option value="5" {{ $lead->assigned_to->user->role_id == 5 ? 'selected' : '' }}>Service Provider</option> --}}
                                                {{--  <option value="6" {{ $lead->assigned_to->user->role_id == 6 ? 'selected' : '' }}>Insurance</option>  --}}
                                            </select>
                                            @php $companies = \App\Models\User::with('companies')->where(['role_id' => $lead->assigned_to->user->role_id, 'is_active' => 1, 'is_verified' => 1])->get(); @endphp
                                            <select id="company_id" name="company_id" class="">
                                            <option value="">---select Company---</option>
                                            @if ($companies->count())
                                                @foreach ($companies as $comp)
                                                    <option value="{{ $comp->id }}" {{ $lead->assigned_to->assigned_to == $comp->id ? 'selected' : '' }}>{{ $comp->name }}</option>
                                                @endforeach
                                            @endif
                                            </select>
                                           </div>
                                            @else
                                            <select id="lead_for" name="lead_for" class="mb-1">
                                                <option value="">---select Lead For---</option>
                                                <option value="3">Agent</option>
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
                                    <span class="text-muted mt-3 font-weight-bold font-size-sm"> Total {{ $lead->logs->count() }}</span>
                                </h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-4">
                                <div class="timeline timeline-3">
                                    @if (count($lead->logs) > 0)
                                        @foreach ($lead->logs as $item)
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
                    {{-- <div class="col-md-12 col-lg-12 mb-6">
                        <button class="btn btn-danger btn-block" style="font-size:16px;" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.save')</button>
                    </div> --}}
                    <div class="col-lg-7 col-xxl-7">
                        <!--begin::List Widget 9-->
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="Mortgage.html">
                                       <div class="feat_property list">
                                          <div class="thumb">
                                             <img loading="lazy" class="img-whp" src="{{ $property->images[0] ? $property->images[0]->image : '' }}" alt="fp1.jpg">
                                          </div>
                                          <div class="details">
                                             <div class="tc_content">
                                    <a class="fp_price" href="#">AED <span>{{ number_format($property->price) }}</span> </a>
                                    <a class="fp_tag" href="#">Signature</a>
                                    <h4>{{ $property->title }}</h4>
                                    <div class="text-thm">
                                    <div class=" thmb_cntnt">
                                    <ul class="tag mb0">
                                    <li class="list-inline-item"><a href="#">For {{ $property->type->name }}</a></li>
                                    <li class="list-inline-item"><a href="#">{{ $property->category->name }}</a></li>
                                    </ul>
                                    </div>
                                    </div>
                                    <p class="property_desc">Exclusive! Furnished 2BR | High Floor | Canal View...</p>
                                    <ul class="prop_details mb0">
                                    <li class="list-inline-item"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="31.409" height="22.29" viewBox="0 0 31.409 22.29">
                                    <path id="bed" d="M38.9,96.718H38.4V92.665a2.029,2.029,0,0,0-2.026-2.026V82.026A2.029,2.029,0,0,0,34.343,80H13.066a2.029,2.029,0,0,0-2.026,2.026v8.612a2.029,2.029,0,0,0-2.026,2.026v4.053H8.507A.507.507,0,0,0,8,97.224v2.026a.507.507,0,0,0,.507.507h.507v2.026a.507.507,0,0,0,.507.507h1.52a.506.506,0,0,0,.5-.407l.426-2.126H35.447l.426,2.126a.506.506,0,0,0,.5.407h1.52a.507.507,0,0,0,.507-.507V99.757H38.9a.507.507,0,0,0,.507-.507V97.224A.507.507,0,0,0,38.9,96.718ZM12.053,82.026a1.015,1.015,0,0,1,1.013-1.013H34.343a1.015,1.015,0,0,1,1.013,1.013v8.612H34.343V88.612a2.029,2.029,0,0,0-2.026-2.026H26.237a2.029,2.029,0,0,0-2.026,2.026v2.026H23.2V88.612a2.029,2.029,0,0,0-2.026-2.026H15.092a2.029,2.029,0,0,0-2.026,2.026v2.026H12.053ZM33.33,88.612v2.026H25.224V88.612A1.015,1.015,0,0,1,26.237,87.6h6.079A1.015,1.015,0,0,1,33.33,88.612Zm-11.145,0v2.026H14.079V88.612A1.015,1.015,0,0,1,15.092,87.6h6.079A1.015,1.015,0,0,1,22.185,88.612ZM10.026,92.665a1.015,1.015,0,0,1,1.013-1.013h25.33a1.015,1.015,0,0,1,1.013,1.013v4.053H10.026Zm.6,8.612h-.6v-1.52h.9Zm26.758,0h-.6l-.3-1.52h.9ZM38.4,98.744H9.013V97.731H38.4Z" transform="translate(-8 -80)" fill="#30ccd3"></path>
                                    </svg> Beds: {{ $property->bed_no }}</a></li>
                                    <li class="list-inline-item"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="31.509" height="27.963" viewBox="0 0 31.509 27.963">
                                    <g id="bathing" transform="translate(-7.95 -39.95)">
                                    <path id="Path_1787" data-name="Path 1787" d="M38.9,55.2H34.343v-1.52a.507.507,0,0,0-.507-.507H27.757a.507.507,0,0,0-.507.507V55.2H13.066V43.546a2.533,2.533,0,1,1,5.066,0V44.6a3.044,3.044,0,0,0-2.533,3v.507a.507.507,0,0,0,.507.507h5.066a.507.507,0,0,0,.507-.507V47.6a3.044,3.044,0,0,0-2.533-3V43.546a3.546,3.546,0,0,0-7.092,0V55.2H8.507A.507.507,0,0,0,8,55.7v1.52a.507.507,0,0,0,.507.507h1.52v3.546a5.582,5.582,0,0,0,4.053,5.362v.717a.507.507,0,0,0,1.013,0v-.53c.167.015.336.023.507.023H31.81c.171,0,.339-.008.507-.023v.53a.507.507,0,0,0,1.013,0v-.717a5.582,5.582,0,0,0,4.053-5.362V57.731H38.9a.507.507,0,0,0,.507-.507V55.7A.507.507,0,0,0,38.9,55.2ZM20.665,47.6H16.612a2.026,2.026,0,0,1,4.053,0Zm7.6,6.586H33.33V62.8H28.264ZM9.013,56.718v-.507H27.251v.507Zm27.356,4.559a4.565,4.565,0,0,1-4.559,4.559H15.6a4.565,4.565,0,0,1-4.559-4.559V57.731H27.251V63.3a.507.507,0,0,0,.507.507h6.079a.507.507,0,0,0,.507-.507V57.731h2.026ZM38.4,56.718H34.343v-.507H38.4Z" transform="translate(0 0)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                                    <path id="Path_1788" data-name="Path 1788" d="M78.079,336H72.507a.507.507,0,0,0,0,1.013h5.573a.507.507,0,0,0,0-1.013Z" transform="translate(-59.947 -277.256)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                                    <path id="Path_1789" data-name="Path 1789" d="M185.52,336h-1.013a.507.507,0,0,0,0,1.013h1.013a.507.507,0,0,0,0-1.013Z" transform="translate(-164.855 -277.256)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                                    <path id="Path_1790" data-name="Path 1790" d="M257.52,171.04a1.52,1.52,0,1,0-1.52-1.52A1.52,1.52,0,0,0,257.52,171.04Zm0-2.026a.507.507,0,1,1-.507.507A.507.507,0,0,1,257.52,169.013Z" transform="translate(-232.296 -119.894)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                                    <path id="Path_1791" data-name="Path 1791" d="M298.533,93.066A2.533,2.533,0,1,0,296,90.533,2.533,2.533,0,0,0,298.533,93.066Zm0-4.053a1.52,1.52,0,1,1-1.52,1.52A1.52,1.52,0,0,1,298.533,89.013Z" transform="translate(-269.763 -44.96)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                                    <path id="Path_1792" data-name="Path 1792" d="M360,162.026A2.026,2.026,0,1,0,362.026,160,2.026,2.026,0,0,0,360,162.026Zm2.026-1.013a1.013,1.013,0,1,1-1.013,1.013A1.013,1.013,0,0,1,362.026,161.013Z" transform="translate(-329.71 -112.401)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                                    </g>
                                    </svg> Baths: {{ $property->bath_no }}</a></li>
                                    <li class="list-inline-item"><a href="#"><svg id="selection" xmlns="http://www.w3.org/2000/svg" width="31.409" height="31.409" viewBox="0 0 31.409 31.409">
                                    <g id="Group_990" data-name="Group 990">
                                    <path id="Path_1802" data-name="Path 1802" d="M30.6,6.443a.805.805,0,0,0,.805-.805V.805A.805.805,0,0,0,30.6,0H25.771a.805.805,0,0,0-.805.805V2.416H6.443V.805A.805.805,0,0,0,5.637,0H.805A.805.805,0,0,0,0,.805V5.637a.805.805,0,0,0,.805.805H2.416V24.966H.805A.805.805,0,0,0,0,25.771V30.6a.805.805,0,0,0,.805.805H5.637a.805.805,0,0,0,.805-.805V28.993H24.966V30.6a.805.805,0,0,0,.805.805H30.6a.805.805,0,0,0,.805-.805V25.771a.805.805,0,0,0-.805-.805H28.993V6.443ZM27.382,24.966H25.771a.805.805,0,0,0-.805.805v1.611H6.443V25.771a.805.805,0,0,0-.805-.805H4.027V6.443H5.637a.805.805,0,0,0,.805-.805V4.027H24.966V5.637a.805.805,0,0,0,.805.805h1.611V24.966Z" fill="#30ccd3"></path>
                                    </g>
                                    </svg>
                                    Sq Ft: {{ number_format($property->size_sqft) }}</a></li>
                                    </ul>
                                    </div>
                                    <div class="fp_footer">
                                    <div class="btn-group d-none">
                                    <a class="call-btn-1 raise" href="#call">Call <i class="fa fa-phone"></i></a> <a class="call-btn-2 raise" href="#mail">Email <i class="fa fa-envelope-o"></i></a>
                                    </div>
                                    <img loading="lazy" class="developer-logo" src="images/property/vanguard.jfif">
                                    </div>
                                    </div>
                                    </div>
                                    </a>
                                 </div>
                            </div>
                        </div>
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

@include('admin.leads.js.edit')
@endsection
