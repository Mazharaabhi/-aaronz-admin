<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
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
			.btn.btn-danger {
			color: #ffffff;
			background-color: #eb0d23;
			border-color: #eb0d23;
			cursor:pointer !important;
			padding:10px 20px;
			border-radius:5px
			}
		</style>
	</head>
	<body>
		<div style="width: 600px; margin:0px auto">
            <p id="header_background" style="padding: 15px;border:1px solid #ddd;background-color: {{ $settings['bg_color'] }}!important; text-color:{{ $settings['text_color'] }} !important;font-size: 14px;margin: 0;padding: 22px;">
				@if ($settings['header_logo'] != "")
				<img loading="lazy" src="{{ asset('storage') }}/{{ $settings['header_logo'] }}" style="width:{{ $settings['header_logo_width'] }}px;height:{{ $settings['header_logo_height'] }}px;" alt="Header Logo" id="header_logo_image"/>
				@else
				<img loading="lazy" src="{{ asset('common/images/no.png') }}" style="width:80px" alt="Header Logo" id="header_logo_image"/>
				@endif
				<span style="float:right;font-weight:bolder;display:block;font-size:20px;" id="company_name_header">{{ $settings['company_name'] }}</span>
			</p>
			<p style="margin:0; border:none;">
				@if ($settings['banner'] != "")
				<img loading="lazy" src="{{ asset('storage') }}/{{ $settings['banner'] }}" style="width:598PX!important;height:auto!important;"  alt="Banner Image" id="banner_image_div"/>
				@else
				<img loading="lazy" src="{{ asset('common/images/no-banner.jpg') }}" style="width:598PX!important;height:auto!important;" alt="Banner Image" id="banner_image_div"/>
				@endif
			</p>
			<div style="font-size:14px; line-height:30px; padding:5px 5px; border-top:1px solid transparent;border:1px solid #ddd;">
				<p style="margin: 0px auto;font-size:16px;font-style:italic;color:#ec2d2f;font-weight:bold;">
					{!! $content !!}
				</p>
			</div>
			<p id="footer_background" style="border: 1px solid #4c4c4c;margin: 0;font-size: 12px;color: #fff;padding: 34px 20px 70px 34px;position:relative;background-color:{{ isset($settings->footer_color) ? $settings->footer_color : ''  }}!important; color:{{ isset($settings->footer_text_color) ? $settings->footer_text_color : ''  }}!important">
				@if (!is_null($settings) > 0)
					<!-- logo img section start -->
					@if ($settings->footer_logo != "")
					<img loading="lazy" src="{{ asset('storage') }}/{{ $settings->footer_logo }}" style="width:{{ $settings->footer_logo_width }}px;height:{{ $settings->footer_logo_height }}px;" alt="Footer Logo" id="footer_logo_image"/>
					@else
					<img loading="lazy" src="{{ asset('common/images/no.png') }}" style="width:80px" alt="Footer Logo" id="footer_logo_image"/>
					@endif
					@else
					<img loading="lazy" src="{{ asset('common/images/no.png') }}" style="width:80px" alt="Footer Logo" id="footer_logo_image"/>
					@endif
					<!-- logo img section end -->
					<!-- logo social section -->
							<a style="color: #fff; float:right;margin-right: 10px;" href="{{ isset($settings->instagram) ? $settings->instagram : '' }}" target="_blank" id="instagram_image" class="">
								<!-- insta -->
								<img loading="lazy" src='https://imgur.com/9xgeHuU.png'>
								<!-- insta -->
							</a>
							<a style="color: #fff; float:right;margin-right: 10px;" href="{{ isset($settings->linked_in) ? $settings->linked_in : '' }}" target="_blank" id="linkedin_image" class="">
								<!-- linkedin -->
								<img loading="lazy" src='https://imgur.com/EwDwfmZ.png'>
								<!-- linkedin -->
							</a>
							<a style="color: #fff; float:right;margin-right: 10px;" href="{{ isset($settings->youtube) ? $settings->youtube : '' }}" target="_blank" id="youtube_image" class="">
								<!-- youtube -->
								<img loading="lazy" src='https://imgur.com/YxQziYb.png'>
								<!-- youtube -->
							</a>
							<a style="color: #fff; float:right;margin-right: 10px; " href="{{ isset($settings->twitter) ? $settings->twitter : '' }}" target="_blank" id="twitter_image" class="">
								<!-- twitter -->
								<img loading="lazy" src='https://imgur.com/y4ySuwH.png'>
								<!-- twitter -->
							</a>
							<a style="color: #fff; float:right;margin-right: 10px;" href="{{ isset($settings->facebook) ? $settings->facebook : '' }}" target="_blank" id="facebook_image" class="">
								<!-- facebook -->
								<img loading="lazy" src='https://imgur.com/BvLdT4n.png'>
								<!-- facebook -->
							</a>
							<span style="float:right;text-align:right;width: 100%;margin-top: 5px;">
							<span id="email_span" style="border-right: 1px solid #fff;padding-right: 8px;color:#fff;" class="">{{ isset($settings->email) ? $settings->email : '' }}</span>
							<span id="phone_span">{{ isset($settings->mobile) ? $settings->mobile : '' }}</span>
							<span id="address_span" style="display: block">{{ isset($settings->address) ? $settings->address : '' }}</span>
							</span>
				 <p class='footermenu' style="margin:0;font-size: 12px;color: #fff;padding:20px!important;position:relative;background-color:{{ isset($settings->footer_color) ? $settings->footer_color : ''  }}!important; color:{{ isset($settings->footer_text_color) ? $settings->footer_text_color : ''  }}!important">
					<span style="display:block;text-align: center;"><span style="display: inline-block;text-align: center;margin: 0 auto;"><a style="color:{{ isset($settings->footer_link_color) ? $settings->footer_link_color : ''  }}!important; border-right: 1px solid #fff; padding-right: 8px;" href="{{ isset($settings->term_link) ? $settings->term_link : '' }}" target="_blank" class="" id="terms_anchor">Terms & Conditions </a>
					<a style="color:{{ isset($settings->footer_link_color) ? $settings->footer_link_color : ''  }}!important; border-right: 1px solid #fff; padding-right: 8px; padding-left: 8px;" href="{{ isset($settings->policy_link) ? $settings->policy_link : '' }}" target="_blank" class="" id="privacy_anchor">Privacy Policy</a>
					<a style="color:{{ isset($settings->footer_link_color) ? $settings->footer_link_color : ''  }}!important;margin-left: 10px;display:inline-block" href="{{ isset($settings->google_my_business) ? $settings->google_my_business : '' }}" target="_blank" id="google_biz">Google My Business</a></span></span>
				</p></p>
		</div>
	</body>
</html>
