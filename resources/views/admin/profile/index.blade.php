@extends('layouts.master')
@section('title', 'Profile')
@section('p-info', 'active')
@section('first', 'Profile Settings')
@section('second', 'Configurations')
@section('third', 'Profile Settings')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Profile Personal Information-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
                    <!--begin::Profile Card-->
                    @include('admin.profile.side-menu')
                    <!--end::Profile Card-->
                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Header-->
                        <div class="card-header py-3">
                            <div class="card-title align-items-start flex-column">
                                <h3 class="card-label font-weight-bolder text-dark">@lang('translation.personal_information')</h3>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form class="form">
                            <!--begin::Body-->
                            <div class="card-body m-0 py-3 px-5">
                                    <!--begin::Toolbar-->

                                    <!--end::Toolbar-->
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                            <div class="symbol-label"
                                            @if ($user->avatar != "")
                                            style="background-image:url('{{ URL::to("storage/app") }}/{{ $user->avatar }}')"
                                            @else
                                            style="background-image:url('assets/media/users/300_13.jpg')"
                                            @endif
                                            ></div>
                                            <i class="symbol-badge bg-success"></i>
                                        </div>
                                        <div>
                                            <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ $user->name }}</a>
                                            <div class="text-muted">{{ $user->designation }}</div>
                                            <div class="mt-2">
                                                <a href="#" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1"></a>
                                                <a href="#" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Contact-->
                                    <div class="row pt-8">
                                        <div class="col-md-6">
                                            <span class="font-weight-bold mr-2">Company Name:</span>
                                            <span class="text-muted">{{ $user->company_name }}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="font-weight-bold mr-2">Email:</span>
                                            <span class="text-muted">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                    <div class="row pt-4">
                                       <div class="col-md-6">
                                            <span class="font-weight-bold mr-2">Company Phone:</span>
                                            <span class="text-muted">{{ $user->phone }}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="font-weight-bold mr-2">Company Mobile:</span>
                                            <span class="text-muted">{{ $user->mobile }}</span>
                                        </div>
                                    </div>
                                    <div class="row pt-4">
                                       <div class="col-md-6">
                                            <span class="font-weight-bold mr-2">Address:</span>
                                            <span class="text-muted">{{ $user->address }}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="font-weight-bold mr-2">City:</span>
                                            <span class="text-muted">{{ $user->city }}</span>
                                        </div>
                                    </div>
                                    <div class="row pt-4">
                                        <div class="col-md-6">
                                             <span class="font-weight-bold mr-2">Country:</span>
                                             <span class="text-muted">{{ $user->country }}</span>
                                         </div>
                                         <div class="col-md-6">
                                             <span class="font-weight-bold mr-2">State:</span>
                                             <span class="text-muted">{{ $user->state }}</span>
                                         </div>
                                     </div>
                                     <div class="row pt-4">
                                        <div class="col-md-6">
                                             <span class="font-weight-bold mr-2">Zip:</span>
                                             <span class="text-muted">{{ $user->zip }}</span>
                                         </div>
                                     </div>
                                     {{-- <div class="row pt-4 mb-6">
                                        <div class="col-md-12">
                                             <span class="font-weight-bold mr-2">Api Callback:</span>
                                             <span class="">{{ url('/api/payment-callback') .'/'. base64_encode(Auth::user()->id) }}</span>
                                         </div>
                                     </div> --}}
                                    <!--end::Contact-->

                                </div>
                            </div>
                            <!--end::Body-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Profile Personal Information-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
@include('admin.profile.js.change-password')
@endsection
