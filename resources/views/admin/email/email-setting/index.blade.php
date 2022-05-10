@extends('layouts.master')
@section('title', 'Email Setting')
@section('first', 'Email Setting')
@section('second', 'Email')
@section('third', 'Email Setting')
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
                     <div class="col-md-4 col-lg-4 col-sm-12">
                        <div class="form-group">
                            <fieldset>
                                <legend>Template Colors</legend>
                                <fieldset class="mt-1">
                                    <legend>Header</legend>
                                    <label for="" class="mr-1">Background Color</label>
                                <input type="color" id="head_color" name="head_color" value="{{ isset($settings->bg_color) ? $settings->bg_color : '#ec2d2f' }}">
                                <label for="" class="mr-1">Text Color</label>
                                <input type="color" id="head_text_color" name="head_text_color" value="{{ isset($settings->text_color) ? $settings->text_color : '#fcfcfc' }}">
                                </fieldset>
                                <fieldset>
                                    <legend>Footer</legend>
                                    <label for="" class="mr-1">Background Color</label>
                                <input type="color" id="footer_color" name="footer_color" value="{{ isset($settings->footer_color) ? $settings->footer_color : '#ec2d2f' }}">
                                <p>
                                    <label for="" class="mr-1">Text Color</label>
                                <input type="color" id="footer_text_color" name="footer_text_color" value="{{ isset($settings->footer_text_color) ? $settings->footer_text_color : '#fcfcfc' }}">

                                    <label for="" class="mr-1">Link Color</label>
                                    <input type="color" id="footer_link_color" name="footer_link_color" value="{{ isset($settings->footer_link_color) ? $settings->footer_link_color : '#fcfcfc' }}">
                                </p>
                            </fieldset>
                            </fieldset>
                        </div>
                        <fieldset>
                            <legend>
                                Logos & Banner
                            </legend>
                            <div class="form-group">
                                <label for="header_logo" style="width: 100%">Header Logo
                                   <span class="float-right">
                                       Size:
                                       <input type="number" name="header_logo_width_style" id="header_logo_width_style" style="width: 80px;" placeholder="Width" value="{{ isset($settings->header_logo_width) ? $settings->header_logo_width : '' }}">
                                       <input type="number" name="header_logo_height_style" id="header_logo_height_style" style="width: 80px;" placeholder="Height" value="{{ isset($settings->header_logo_height) ? $settings->header_logo_height : '' }}">
                                       <input type="text" style="width: 30px;" placeholder="px" disabled>
                                   </span></label>
                                <input type="file" name="header_logo" id="header_logo" class="form-control">
                           </div>
                           <div class="form-group">
                               <label for="banner_image" style="width: 100%">Banner Image
                                   <span class="float-right">
                                       Size:
                                       <input type="number" name="banner_image_width_style" id="banner_image_width_style" style="width: 80px;" placeholder="Width" value="{{ isset($settings->banner_width) ? $settings->banner_width : '' }}">
                                       <input type="number" name="banner_image_height_style" id="banner_image_height_style" style="width: 80px;" placeholder="Height" value="{{ isset($settings->banner_height) ? $settings->banner_height : '' }}">
                                       <input type="text" style="width: 30px;" placeholder="%" disabled>
                                   </span></label>
                               <input type="file" name="banner_image" id="banner_image" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="footer_logo" style="width: 100%">Footer Logo
                                <span class="float-right">
                                    Size:
                                    <input type="number" name="footer_logo_width_style" id="footer_logo_width_style" style="width: 80px;" placeholder="Width" value="{{ isset($settings->footer_logo_width) ? $settings->footer_logo_width : '' }}">
                                    <input type="number" name="footer_logo_height_style" id="footer_logo_height_style" style="width: 80px;" placeholder="Height" value="{{ isset($settings->footer_logo_height) ? $settings->footer_logo_height : '' }}">
                                    <input type="text" style="width: 30px;" placeholder="px" disabled>
                                </span></label>
                            <input type="file" name="footer_logo" id="footer_logo" class="form-control">
                       </div>
                        </fieldset>
                        <fieldset>
                            <legend>Company Info</legend>
                            <div class="form-group">
                                <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter company name" value="{{ isset($settings->company_name) ? $settings->company_name : '' }}">
                                <input type="text" name="company_email" id="company_email" class="form-control" placeholder="Company Email" value="{{ isset($settings->email) ? $settings->email : '' }}">
                                <input type="text" name="company_mobile" id="company_mobile" class="form-control" placeholder="Company Mobile" value="{{ isset($settings->mobile) ? $settings->mobile : '' }}">
                                <input type="text" name="address" id="address" class="form-control" placeholder="Company Address" value="{{ isset($settings->address) ? $settings->address : '' }}">
                            </div>
                        </fieldset>
                       <fieldset>
                           <legend>
                               Terms & Policies
                           </legend>
                           <div class="form-group">
                            <input type="text" name="term_link" id="term_link" class="form-control" placeholder="Terms & Conditions Link" value="{{ isset($settings->term_link) ? $settings->term_link : '' }}">
                            <input type="text" name="privacy_link" id="privacy_link" class="form-control" placeholder="Privacy Policy Link" value="{{ isset($settings->policy_link) ? $settings->policy_link : '' }}">
                            </div>
                       </fieldset>
                       <fieldset>
                           <legend>
                               Social Links
                           </legend>
                           <div class="form-group">
                            <input type="text" name="fb" id="fb" class="form-control" placeholder="Facebook link" value="{{ isset($settings->fb) ? $settings->fb : '' }}">
                            <input type="text" name="twitter" id="twitter" class="form-control" placeholder="Twitter link" value="{{ isset($settings->twitter) ? $settings->twitter : '' }}">
                            <input type="text" name="youtube" id="youtube" class="form-control" placeholder="Youtube link" value="{{ isset($settings->youtube) ? $settings->youtube : '' }}">
                            <input type="text" name="linked_in" id="linked_in" class="form-control" placeholder="Linked In link" value="{{ isset($settings->linked_in) ? $settings->linked_in : '' }}">
                            <input type="text" name="instagram" id="instagram" class="form-control" placeholder="Instagram link" value="{{ isset($settings->instagram) ? $settings->instagram : '' }}">
                        </div>
                        </fieldset>
                        <fieldset>
                            <legend>Google My Business</legend>
                            <input type="text" name="google" id="google" class="form-control" placeholder="Google My Business" value="{{ isset($settings->google_my_business) ? $settings->google_my_business : '' }}">
                        </fieldset>
                        {{-- <div class="form-group">
                            <textarea name="short_desc" id="sort_desc" cols="30" rows="2" class="form-control" placeholder="Other Short Description">
                                {{ $settings->address }}
                            </textarea>
                        </div> --}}
                        <div class="form-group">
                            @if ($edit_permission == 1)
                            <button class="btn btn-danger btn-block" id="save"><span class="svg-icon svg-icon-md fa fa-floppy-o"></span> @lang('translation.save_settings')</button>
                            @endif
                        </div>
                     </div>
                     <div class="col-md-8 col-lg-8 col-sm-12">
                        <p id="header_background" style="background-color:{{ isset($settings->bg_color) ? $settings->bg_color : ''  }}!important; color:{{ isset($settings->text_color) ? $settings->text_color : ''  }}!important">
                            @if (!is_null($settings) > 0)
                            @if ($settings->header_logo != "")
                            <img loading="lazy" src="{{ asset('storage') }}/{{ $settings->header_logo }}" style="width:{{ $settings->header_logo_width }}px;height:{{ $settings->header_logo_height }}px;" alt="Header Logo" id="header_logo_image"/>
                            @else
                            <img loading="lazy" src="{{ asset('common/images/no.png') }}" style="width:80px" alt="Header Logo" id="header_logo_image"/>
                            @endif
                            @else
                            <img loading="lazy" src="{{ asset('common/images/no.png') }}" style="width:80px" alt="Header Logo" id="header_logo_image"/>
                            @endif
                            <span style="float:right;font-weight:bolder;display:block;font-size:20px" id="company_name_header">{{ isset($settings->company_name) ? $settings->company_name : '' }}</span>
                        </p>
                        <p style="margin:0;border:1px solid #4c4c4c; border-bottom:1px solid transparent; height:275px;">
                            @if (!is_null($settings) > 0)
                            @if ($settings->banner != "")
                            <img loading="lazy" src="{{ asset('storage') }}/{{ $settings->banner }}" style="width:{{ $settings->banner_width }}%;height:{{ $settings->banner_height }}% !important;"  alt="Banner Image" id="banner_image_div"/>
                            @else
                            <img loading="lazy" src="{{ asset('common/images/no-banner.jpg') }}" style="width: 100%;" alt="Banner Image" id="banner_image_div"/>
                            @endif
                            @else
                            <img loading="lazy" src="{{ asset('common/images/no-banner.jpg') }}" style="width: 100%;" alt="Banner Image" id="banner_image_div"/>
                            @endif
                            <div style="font-size:14px; line-height:30px; padding:15px 25px; border-top:1px solid transparent;border:1px solid #4c4c4c;">
                        <p style="margin: 0;font-size:16px;font-style:italic;color:#ec2d2f;font-weight:bold;height:600px">Dynamic Email Content Will Display Here....</p>
                    </div>
                    <p id="footer_background" style="background-color:{{ isset($settings->footer_color) ? $settings->footer_color : ''  }}!important; color:{{ isset($settings->footer_text_color) ? $settings->footer_text_color : ''  }}!important">
                        @if (!is_null($settings) > 0)
                        @if ($settings->footer_logo != "")
                        <img loading="lazy" src="{{ asset('storage') }}/{{ $settings->footer_logo }}" style="width:{{ $settings->footer_logo_width }}px;height:{{ $settings->footer_logo_height }}px;" alt="Footer Logo" id="footer_logo_image"/>
                        @else
                        <img loading="lazy" src="{{ asset('common/images/no.png') }}" style="width:80px" alt="Footer Logo" id="footer_logo_image"/>
                        @endif
                        @else
                        <img loading="lazy" src="{{ asset('common/images/no.png') }}" style="width:80px" alt="Footer Logo" id="footer_logo_image"/>
                        @endif
                        <a style="color: #fff; float:right;margin-right: 10px;" href="{{ isset($settings->instagram) ? $settings->instagram : '' }}" target="_blank" id="instagram_image" class=""><i class="fa fa-instagram" style="font-size: 20px"></i></a>
                        <a style="color: #fff; float:right;margin-right: 10px;" href="{{ isset($settings->linked_in) ? $settings->linked_in : '' }}" target="_blank" id="linkedin_image" class=""><i class="fa fa-linkedin" style="font-size: 20px"></i></a>
                        <a style="color: #fff; float:right;margin-right: 10px;" href="{{ isset($settings->youtube) ? $settings->youtube : '' }}" target="_blank" id="youtube_image" class=""><i class="fa fa-youtube" style="font-size: 20px"></i></a>
                        <a style="color: #fff; float:right;margin-right: 10px; " href="{{ isset($settings->twitter) ? $settings->twitter : '' }}" target="_blank" id="twitter_image" class=""><i class="fa fa-twitter" style="font-size: 20px"></i></a>
                        <a style="color: #fff; float:right;margin-right: 10px;" href="{{ isset($settings->facebook) ? $settings->facebook : '' }}" target="_blank" id="facebook_image" class=""><i class="fa fa-facebook-square" style="font-size: 20px"></i></a>
                        <br><br>
                        <span style="float: right; text-align: right; width: 331px; margin-top: -25px;">
                        <span id="email_span" style="border-right: 1px solid #fff;padding-right: 8px;" class="">{{ isset($settings->email) ? $settings->email : '' }}</span>
                        <span id="phone_span">{{ isset($settings->mobile) ? $settings->mobile : '' }}</span>
                        <span id="address_span" style="display: block">{{ isset($settings->address) ? $settings->address : '' }}</span>
                        </span>
                        <span style="display:block;text-align: center;position: relative;top: 50px;"><span style="display: inline-block;margin: 0 30px;"><a style="color:{{ isset($settings->footer_link_color) ? $settings->footer_link_color : ''  }}!important; border-right: 1px solid #fff !important; padding-right: 8px;" href="{{ isset($settings->term_link) ? $settings->term_link : '' }}" target="_blank" class="" id="terms_anchor">Terms & Conditions </a>
                        <a style="color:{{ isset($settings->footer_link_color) ? $settings->footer_link_color : ''  }}!important; border-right: 1px solid #fff !important; padding-right: 8px; padding-left: 8px;" href="{{ isset($settings->policy_link) ? $settings->policy_link : '' }}" target="_blank" class="" id="privacy_anchor">Privacy Policy</a>
                        <a style="color:{{ isset($settings->footer_link_color) ? $settings->footer_link_color : ''  }}!important;margin-left: 10px;display:inline-block" href="{{ isset($settings->google_my_business) ? $settings->google_my_business : '' }}" target="_blank" id="google_biz">Google My Business</a></span></span>
                    </p>

                     </div>
                 </div>


                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('admin.email.email-setting.js.index')
@endsection
