@extends('layouts.master')
@section('title', 'Email Template')
@section('first', 'Email Template')
@section('second', 'Email')
@section('third', 'Email Template')


@section('content')
<style>
    .form-group{
        margin-bottom: 1rem !important;
    }
    #header_background{
        border:1px solid #4c4c4c;
        color:#fff;font-size:14px;background:#ec2d2f;margin:0;padding: 22px;
    }
    #footer_background{
        border:1px solid #4c4c4c;margin: 0; font-size:12px; color:#fff;padding: 34px 20px 70px 34px;background: #ec2d2f;
    }
</style>
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                 <div class="row">
                     <div class="col-md-2 col-lg-2 col-sm-12">
                     </div>
                     <div class="col-md-8 col-lg-8 col-sm-12">
                        <div class="form-group">
                            <fieldset>
                                <legend>Email Template Catgories</legend>
                                <select name="email_category_id" id="email_category_id" class="form-control mb-3">
                                    <option value="">--select email category---</option>
                                    @if (count($email_categories) > 0)
                                        @foreach ($email_categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="form-group" id="tags_list">
                                </div>
                            </fieldset>
                        </div>
                        <fieldset id="field_set" class="d-none">
                            <legend>Email Dynamic Content Write Here </legend>
                            <button class="btn btn-danger btn-sm" id="view_email_content">Click to View Content</button>
                            {{-- <button class="btn btn-danger btn-sm">Send Test Email</button> --}}
                            <div class="summernote" id="content" style="width: 100%"></div>
                            <div style="width:100%">
                            @if ($edit_permission == 1)
                            <button class="btn btn-danger btn-block" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.save_email_content')</button>
                            @endif
                            </div>
                            {{-- <p id="header_background">
                                @if ($settings->header_logo != "")
                                <img loading="lazy" src="{{ URL::to('storage/app') }}/{{ $settings->header_logo }}" style="width:{{ $settings->header_logo_width }}px;height:{{ $settings->header_logo_height }}px;" alt="Header Logo" id="header_logo_image"/>
                                @else
                                <img loading="lazy" src="{{ URL::to('/public/common/images/no.png') }}" style="width:80px" alt="Header Logo" id="header_logo_image"/>
                                @endif
                                <span style="float:right;font-weight:bolder;display:block;font-size:20px" id="company_name_header">{{ $settings->company_name }}</span>
                            </p>
                            <p style="margin:0;border:1px solid #4c4c4c; border-bottom:1px solid transparent; height:275px;">

                                @if ($banner[0]->banner != "")
                                <img loading="lazy" src="{{ URL::to('storage/app') }}/{{ $banner[0]->banner }}" style="width:{{ $banner[0]->banner_width }}%;height:{{ $banner[0]->banner_height }}% !important;"  alt="Banner Image" id="banner_image_div"/>
                                @else
                                <img loading="lazy" src="{{ URL::to('/public/common/images/no-banner.jpg') }}" style="width: 100%;" alt="Banner Image" id="banner_image_div"/>
                                @endif
                                <div style="font-size:14px; line-height:30px; border-top:1px solid transparent;border:1px solid #4c4c4c;height:600px">

                        </div>
                        <p id="footer_background">
                            @if ($settings->footer_logo != "")
                            <img loading="lazy" src="{{ URL::to('storage/app') }}/{{ $settings->footer_logo }}" style="width:{{ $settings->footer_logo_width }}px;height:{{ $settings->footer_logo_height }}px;" alt="Footer Logo" id="footer_logo_image"/>
                            @else
                            <img loading="lazy" src="{{ URL::to('/public/common/images/no.png') }}" style="width:80px" alt="Footer Logo" id="footer_logo_image"/>
                            @endif
                            <a style="color: #fff; float:right;margin-right: 10px;" href="{{ $settings->instagram }}" target="_blank" id="instagram_image" class=""><i class="fa fa-instagram" style="font-size: 20px"></i></a>
                            <a style="color: #fff; float:right;margin-right: 10px;" href="{{ $settings->linked_in }}" target="_blank" id="linkedin_image" class=""><i class="fa fa-linkedin" style="font-size: 20px"></i></a>
                            <a style="color: #fff; float:right;margin-right: 10px;" href="{{ $settings->youtube }}" target="_blank" id="youtube_image" class=""><i class="fa fa-youtube" style="font-size: 20px"></i></a>
                            <a style="color: #fff; float:right;margin-right: 10px; " href="{{ $settings->twitter }}" target="_blank" id="twitter_image" class=""><i class="fa fa-twitter" style="font-size: 20px"></i></a>
                            <a style="color: #fff; float:right;margin-right: 10px;" href="{{ $settings->facebook }}" target="_blank" id="facebook_image" class=""><i class="fa fa-facebook-square" style="font-size: 20px"></i></a>


                            <br><br>
                            <a style="color: #fff; border-right: 1px solid #fff; padding-right: 8px;" href="{{ $settings->term_link }}" target="_blank" class="" id="terms_anchor">Terms & Conditions </a>
                            <a style="color: #fff; border-right: 1px solid #fff; padding-right: 8px; padding-left: 8px;" href="{{ $settings->policy_link }}" target="_blank" class="" id="privacy_anchor">Privacy Policy</a>
                            <a href="{{ $settings->google_my_business }}" target="_blank" style="color: #fff;margin-left: 10px;display:inline-block" id="google_biz">Google My Business</a>
                            <span style="float: right; text-align: right; width: 331px; margin-top: -25px;">
                                <span id="email_span" style="border-right: 1px solid #fff;padding-right: 8px;" class="">{{ $settings->email }}</span>
                                <span id="phone_span">{{ $settings->mobile }}</span>
                                <span id="address_span" style="display: block">{{ $settings->address }}</span>
                            </span>
                        </p> --}}
                        </fieldset>

                     </div>
                 </div>


                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('admin.email.email-template.modals')
@include('admin.email.email-template.js.index')
@endsection
