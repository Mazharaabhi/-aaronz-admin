<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Title -->
<title>Aaronz</title>
@include('layouts.app_header')
</head>
<body>
<div class="wrapper">
    @php
        $header_footer = get_header_footer_content();
    @endphp
    <div class="preloader">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 354.53 357.7"><defs></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="path" fill="white" stroke="#03c2cb" stroke-width="5" d="M.64,176.22c17.42-17,35-33.86,52.23-51.08Q113.7,64.35,174.26,3.26c3.65-3.66,2.63-3.73,6.44.09Q202.93,25.66,225.12,48c.64.63,1.37,1.17,2.67,2.27,0-7.62.21-14.53-.09-21.42-.15-3.52.89-4.34,4.35-4.31q34.19.24,68.38,0c2.89,0,3.62.81,3.61,3.62-.09,31.67,0,63.34-.12,95a9.18,9.18,0,0,0,3,7.19c15.05,15,30,30.07,45,45.11a16,16,0,0,0,1.93,1.42l-.55.83h-3.81q-108.87,0-217.75-.08c-3.17,0-4.65.81-5.53,3.94-9.06,32.2-3.89,61.09,20.36,85.13,12.35,12.24,27.93,17.41,45.22,18.21,25.89,1.19,46.89-9.52,65.57-26.19,3.6-3.21,3.61-3.24,6.87.13,2.41,2.5,4.72,5.11,7.19,7.56,1.27,1.26,1.51,2.08,0,3.41-18.77,16.21-39.69,28.11-64.63,31.53-47.9,6.55-89.68-24.09-99.82-69.73-5.26-23.66-1.76-46.41,7.77-68.46,1.08-2.48,2.62-2.6,4.76-2.6q93.95,0,187.88,0c1.27,0,2.6.33,3.84-.31.22-1.26-.86-1.65-1.47-2.27-7.16-7.27-14.3-14.55-21.55-21.72a6.38,6.38,0,0,1-2-5.05c.06-28.43,0-56.86.11-85.29,0-3.15-.74-4.05-3.95-4-11,.21-22.07.17-33.11,0-2.81,0-3.86.42-3.81,3.65.22,14.87.09,29.74.09,44.62v3c-1.56-1.51-2.56-2.44-3.51-3.39q-31.2-31.41-62.35-62.85c-1.8-1.83-2.67-1.75-4.42,0Q110.45,92.34,45.6,157.52c-.8.8-2,1.39-2.19,3.1H62.08c4.25,0,4.34,0,3,4-5.79,17.85-9,36.12-7,54.86,5.78,54.28,33.94,92,84.89,112,23.63,9.26,48.36,9.91,73.3,7.07,32.28-3.69,58.67-18.76,80.87-41.86,1.94-2,3-2.09,4.92-.08a83.17,83.17,0,0,0,8,7.19c2,1.59,2.36,2.6.3,4.7-23.48,23.82-50.73,40.68-84.28,46-34.8,5.48-68.88,3.6-101.13-11.78-44.27-21.11-71.79-55.88-82.25-103.86-4.19-19.21-3.84-38.59-.12-57.87.54-2.85-.22-3.21-2.71-3.19-11.64.09-23.27,0-34.91,0H1.6Z"/></g></g>
        </svg>
    </div>
	<!-- Main Header Nav -->
	<header class="header-nav menu_style_home_one style2 style3 navbar-scrolltofixed stricky main-menu">
		<div class="container-fluid p0">
		    <!-- Ace Responsive Menu -->
		    <nav>
		        <!-- Menu Toggle btn-->
		        <div class="menu-toggle">
		            <a href="{{ URL::to('/') }}"><img loading="lazy" class="nav_logo_img img-fluid" src="{{asset('/storage/'.$header_footer->header_logo)}}" alt="header-logo.svg"></a>
		            <button type="button" id="menu-btn">
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>
		        </div>
		        <a href="{{ URL::to('/') }}" class="navbar_brand float-left dn-smd">
		            <img loading="lazy" class="logo1 img-fluid" src="{{asset('/storage/'.$header_footer->header_logo)}}" alt="header-logo.svg">
		            <img loading="lazy" class="logo2 img-fluid" src="{{asset('/storage/'.$header_footer->header_logo)}}" alt="header-logo2.png">
		        </a>
		        <ul id="respMenu" class="ace-responsive-menu text-right" data-menu-style="horizontal">
                    @php  $navbars = get_navbars() @endphp
                    @if (count($navbars) > 0)
                        @foreach ($navbars as $item)
                        <li>
                            <a href="{{ $item->slug }}" class="text-uppercase"><span class="title">{{ $item->name }}</span></a>
                              @php $rentCategories = get_Rent_Categories(); @endphp
                            @if ($item->name == 'Rent' || $item->name == 'rent' )
                                <ul>
                                    @if (count($rentCategories))
                                        @foreach ($rentCategories as $sub)
                                            <li><a href="{{ route('list-rent-properties') }}">{{ $sub->name }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            @endif
                            @if ($item->name == 'Buy' || $item->name == 'buy')
                                <ul>
                                    @php $buyCategories = get_Buy_Categories(); @endphp
                                    @if (count($buyCategories))
                                        @foreach ($buyCategories as $sub)
                                            <li><a href="{{ route('list-buy-properties') }}">{{ $sub->name }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            @endif
                            @if ($item->name == 'Services' || $item->name == 'services')
                                <ul>
                                    @php $serviceCategories = get_Service_Categories(); @endphp
                                    @if (count($serviceCategories))
                                        @foreach ($serviceCategories as $sub)
                                            <li><a href="{{ route('services.index', $sub->slug) }}">{{ $sub->name }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            @endif

                        </li>
                        @endforeach
                    @endif
		            {{-- <li>
		                <a href="index.html"><span class="title">HOME</span></a>
		            </li>
		            <li>
		                <a href="#"><span class="title">RENT</span></a>
		            </li>
		            <li>
		                <a href="page-service.html"><span class="title">SERVICES</span></a>
		                <ul>
		                	<li><a href="handyman_provider.html">Handyman</a></li>
							<li><a href="painting_provider.html">painting</a></li>
							<li><a href="landscaping_provider.html">Landscaping</a></li>
							<li><a href="interior_provider.html">Interior Design</a></li>
							<li><a href="custom_furniture_provider.html">Custom Made Furniture</a></li>
							<li><a href="bathroom_renovation_provider.html">Bathroom Renovation</a></li>
							<li><a href="kitchen_renovation_provider.html">Kitchen Renovation</a></li>
							<li><a href="Mortgage_provider.html">Bank Mortgage</a></li>
		                </ul>
		            </li>
		            <li>
		                <a href="#"><span class="title">PROPERTIES</span></a>
		                <ul>
							<li><a href="page-listing-grid.html">Listing 1</a></li>
		                	<li><a href="page-listing-list.html">Listing 2</a></li>
		                </ul>
		            </li>
		            <li>
		                <a href="investment.html"><span class="title">INVESTMENTS</span></a>
		            </li>
		            <li>
		                <a href="calculator.html"><span class="title">CALCULATOR</span></a>
		            </li>
		            <li class="last">
		                <a href="page-contact.html"><span class="title">CONTACT</span></a>
		            </li> --}}
		            <li class="language">
						<select>
							<option>UAE</option>
							{{-- <option>Bahrain</option>
							<option>Egypt</option>
							<option>Qatar</option>
							<option>Saudi</option> --}}
						</select>
		            </li>
		            {{-- <li class="last">
		                <a href="page-listing-list.html"><span class="title"><i class="fa fa-heart-o"></i></span></a>
		            </li> --}}

	                <li class="list-inline-item list_s">
                        @if (auth()->user())

	                	<a href="#" class="btn flaticon-login menu-dash"> <span class="dn-lg">{{ auth()->user()->name }}</span></a>
                        <ul class="sub-menu hide">
                            @if (auth()->user()->role_id == 7)
                                <li class=""><a href="{{ route('profile.index') }}">My Profile</a></li>
							@else
                                <li class=""><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                            @endif
                            <li class=""><a href="{{ route('auth.logout') }}">Logout!</a></li>
                        </ul>
                        @else
	                	<a href="#" class="btn flaticon-login" data-toggle="modal" id="open-modal-btn" data-target=".bd-example-modal-lg"> <span class="dn-lg">LOGIN / REGISTER</span></a>
                        @endif
                    </li>
		        </ul>
		    </nav>
		</div>
	</header>
<div id="page" class="stylehome1 h0">
				<div class="mobile-menu">
					<div class="header stylehome1">
						<div class="main_logo_home2 text-center">
							 <img loading="lazy" class="logo2 img-fluid" src="{{asset('/storage/'.$header_footer->header_logo)}}" alt="header-logo2.png">
						</div>
						<ul class="menu_bar_home2">
							<li class="list-inline-item list_s"><a href="page-register.html"><span class="flaticon-user"></span></a></li>
							<li class="list-inline-item"><a href="#menu"><span></span></a></li>
						</ul>
					</div>
				</div>
				<!-- /.mobile-menu -->

			</div>
    @include('layouts.app_modals')
    @yield('content')

	<!-- Our Partners -->
	<section id="Apps" class="Apps">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-6">
					<h3>Download App</h3>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
					<form>
						<div class="dia-banner-btn d-flex">
							<a href="#"><img loading="lazy" src="{{asset('website')}}/images/btn2.png" alt=""></a>
							<a href="#"><img loading="lazy" src="{{asset('website')}}/images/btn1.png" alt=""></a>
						</div>
					</form>
				</div>
				<div class="col-ms-1 col-md-1"></div>
				<div class="col-sm-5 col-md-5">
					<img loading="lazy" class="img-fluid" src="{{asset('website')}}/images/apps.png" alt="app">
				</div>
			</div>
		</div>
	</section>


<!-- Our Footer -->
<section class="footer_one">
	<div class="container">
		<div class="row">

			<div class="col-sm-3 col-md-3">
				<div class="widget">
					<img loading="lazy" src="{{asset('/storage/'.$header_footer->header_logo)}}" />
					<p>{{ $header_footer->description }}.</p>
				</div>
			</div>

			<div class="col-sm-3 col-md-3">
				<div class="widget">
					<h4>EXTRA LINKS</h4>
					<ul>
						<li><a href="#">Contact Us </a></li>
						<li><a href="#">Featured Agencies</a></li>
						<li><a href="#">Transactions</a></li>
						<li><a href="#">Trending Area</a></li>
						<li><a href="#">Create Property </a></li>
						<li><a href="#">Popular Area</a></li>
						<li><a href="#">My Properties</a></li>
					</ul>
				</div>
			</div>

			<div class="col-sm-3 col-md-3">
				<div class="widget">
					<h4>ADDRESS</h4>
					<p><span><i class="fa fa-map-marker"></i></span>{{ $header_footer->address }}</p>
					<p><span><i class="fa fa-envelope"></i></span>{{ $header_footer->email }}</p>
					<p><span><i class="fa fa-phone"></i></span>{{ $header_footer->phone }}</p>
				</div>
			</div>

			<div class="col-sm-3 col-md-3">
				<div class="widget">
					<h4>SOCIAL NETWORK</h4>
					<div class="social">
						<a href="{{ $header_footer->fb }}" target="_blank"><i class="fa fa-facebook-f"></i></a>
						<a href="{{ $header_footer->twitter }}" target="_blank"><i class="fa fa-twitter"></i></a>
						<a href="{{ $header_footer->google }}" target="_blank"><i class="fa fa-google-plus"></i></a>
						<a href="{{ $header_footer->youtube }}" target="_blank"><i class="fa fa-youtube"></i></a>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<div class="footerBottom">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<p class="text-center">All Right Reserved &copy; Aaronz 2021-22</p>
			</div>
			<div class="col-sm-12 col-md-12">
				<a href="#" class="scrollToHome" title="Back To Top">Back to top <i class="flaticon-arrows"></i></a>
			</div>
		</div>
	</div>
</div>

</div>
@include('layouts.app_footer')
</body>
</html>
