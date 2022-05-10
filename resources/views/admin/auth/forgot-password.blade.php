@extends('layouts.master_header')
@section('title', 'Forgot Password')
@section('content')

	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
                <div class="login-aside d-flex flex-column flex-row-auto" style="background-image: url('{{ asset("/common/images/B1.png") }}')">
					<!--begin::Aside Top-->
					<div class="d-flex flex-column-auto flex-column pt-lg-10">
						<!--begin::Aside header-->
						<a href="https://myridepay.com/en/" target="_blank" class="login-logo text-center pt-lg-10 pb-10">
							<img loading="lazy" src="{{ URL::to('/public') }}/common/images/logo.png" class="logoimg" alt="" />
						</a>
						<!--end::Aside header-->
						<!--begin::Aside Title-->
						{{-- <h3 class="font-weight-bolder text-center font-size-h4 text-dark-50 line-height-xl">Smartest Payment
                            Gateway for Car Rentals</h3> --}}
						<!--end::Aside Title-->
					</div>
					<!--end::Aside Top-->
					<!--begin::Aside Bottom-->
					{{-- <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center" style="background-position-y: calc(50% + 0rem); background-image: url({{ URL::to('/public') }}/common/images/banner1.png)"></div> --}}
					<!--end::Aside Bottom-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="login-content flex-row-fluid d-flex flex-column p-10">
					<!--begin::Wrapper-->
					<div class="d-flex flex-row-fluid flex-center">
						<!--begin::Signin-->
						<div class="login-form">
							<!--begin::Form-->
							<form class="form" >
								<!--begin::Title-->
								<div class="pb-5 pb-lg-15">
									<h3 class="font-weight-bolder text-cherwell font-size-h2 font-size-h1-lg">@lang('translation.forgottten_password')</h3>
									<p class="text-muted font-weight-bold font-size-h4">@lang('translation.enter_your_email_to_reset_your_password')</p>
								</div>
								<!--begin::Title-->
								<!--begin::Form group-->
								<div class="form-group">
									<label class="font-size-h6 font-weight-bolder text-dark">@lang('translation.your_email')</label>
									<input class="form-control h-auto py-5 px-4 rounded-lg border-0" type="text" placeholder="@lang('translation.email')" id="email" autocomplete="off" autofocus/>
                                    <span class="text-danger font-weight-bolder text-hover-danger pt-5" id="email_error"></span>
                                </div>

								<!--end::Form group-->
								<!--begin::Action-->
								<div class="pb-lg-0 pb-5">
									<button type="button" id="submit" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">@lang('translation.submit')</button>
                                    <a href="{{ route('admin.auth.index') }}" id="kt_login_forgot_cancel" class="btn btn-light-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3">@lang('translation.cancel')</a>
                                </div>
								<!--end::Action-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Signin-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Login-->
		</div>
        <!--end::Main-->
        @include('admin.auth.js.forgot-password')

@endsection

