@extends('layouts.app')

@section('content')
	<div class="single_page_listing_style singleDasktopSlider">
		<div class="container-fluid p0">
			<div class="row">
				<div class="col-sm-6 col-lg-6 p0">
					<div class="row m0">
						<div class="col-lg-12 p0">
							<div class="spls_style_one pr1 1px">
                                <a class="popup-img" href="{{ asset('storage') }}/{{ $property->images[0]->image }}">
								<img loading="lazy" class="img-fluid w100" src="{{ asset('storage') }}/{{ $property->images[0]->image }}" alt="ls1.jpg">
                                </a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-lg-6 p0">
					<div class="row m0">
						@if (count($property->images) > 0)

                              @for ($i = 1; $i < count($property->images); $i++)
                                @if ($i < 5)
                                    <div class="col-sm-6 col-lg-6 p0">
                                        <div class="spls_style_one">
                                            <a class="popup-img" href="{{ asset('storage') }}/{{ $property->images[$i]->image }}"><img loading="lazy" class="img-fluid w100" src="{{ asset('storage') }}/{{ $property->images[$i]->image }}" alt="ls2.jpg"></a>
                                        </div>
                                    </div>
                                @endif
                              @endfor
                        @endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>
	<div class="home10-mainslider singlemobileSlider">
		<div class="container-fluid p0">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-banner-wrapper home10">
					    <div class="banner-style-one owl-theme owl-carousel">
					        <div class="slide slide-one" style="background-image: url(images/home/1.jpg);height: 600px;"></div>
					        <div class="slide slide-one" style="background-image: url(images/home/2.jpg);height: 600px;"></div>
					        <div class="slide slide-one" style="background-image: url(images/home/1.jpg);height: 600px;"></div>
					    </div>
					    <div class="carousel-btn-block banner-carousel-btn">
					        <span class="carousel-btn left-btn"><i class="flaticon-left-arrow-1 left"></i></span>
					        <span class="carousel-btn right-btn"><i class="flaticon-right-arrow right"></i></span>
					    </div><!-- /.carousel-btn-block banner-carousel-btn -->
					</div><!-- /.main-banner-wrapper -->
				</div>
			</div>
		</div>
	</div>
	<section class="p0">
		<div class="container">
			<div class="row listing_single_row">
				<div class="col-sm-6 col-lg-7 col-xl-8">
					<div class="single_property_title">
						<a href="images/property/ls1.jpg" class="upload_btn popup-img"><span class="flaticon-photo-camera"></span> View Photos</a>
					</div>
				</div>
				<div class="col-sm-6 col-lg-5 col-xl-4">
					<div class="single_property_social_share">
						<div class="spss style2 mt10 text-right tal-400">
							<ul class="mb0">
								<li class="list-inline-item"><a href="#"><span class="flaticon-transfer-1"></span></a></li>
								<li class="list-inline-item"><a href="#"><span class="flaticon-heart"></span></a></li>
								<li class="list-inline-item"><a href="#"><span class="flaticon-share"></span></a></li>
								<li class="list-inline-item"><a href="#"><span class="flaticon-printer"></span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Agent Single Grid View -->
	<section class="our-agent-single bgc-f7 pb30-991">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12 mt50">
					<div class="row">
						<div class="col-lg-12">
							<div class="listing_single_description2 mt30-767 mb30-767">
								<div class="single_property_title">
									<h2>{{ $property->title }}</h2>
									<p>{{ $property->location }}</p>
								</div>
								<div class="single_property_social_share style2">
									<div class="price">
										<h2>AED {{ number_format($property->price) }}<small></small></h2>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="listing_single_description style2">
								<div class="lsd_list">
									<ul class="mb0">
										<li class="list-inline-item"><a href="#">{{ $property->category->name }}</a></li>
										<li class="list-inline-item"><a href="#">Beds: {{ $property->bed_no }}</a></li>
										<li class="list-inline-item"><a href="#">Baths: {{ $property->bath_no }}</a></li>
										<li class="list-inline-item"><a href="#">Sq Ft: {{ number_format($property->size_sqft) }}</a></li>
									</ul>
								</div>
								<h4 class="mb30">Description</h4>
						    	<p class="mb25">Evans Tower very high demand corner junior one bedroom plus a large balcony boasting full open NYC views. You need to see the views to believe them. Mint condition with new hardwood floors. Lots of closets plus washer and dryer.</p>
						    	<p class="gpara second_para white_goverlay mt10 mb10">{{ $property->description }}</p>
								{{-- <div class="collapse" id="collapseExample">
								  	<div class="card card-body">
								    	<p class="mt10 mb10">{{ $property->description }}</p>

								  	</div>
								</div>
								<p class="overlay_close">
									<a class="text-thm fz14" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
								   	 Show More <span class="flaticon-download-1 fz12"></span>
								  	</a>
								</p> --}}
							</div>
						</div>
						<div class="col-lg-12">
							<div class="additional_details">
								<div class="row">
									<div class="col-lg-12">
										<h4 class="mb15">Property Details</h4>
									</div>
									<div class="col-md-6 col-lg-6 col-xl-4">
										<ul class="list-inline-item">
											<li><p>Property ID :</p></li>
											<li><p>Price :</p></li>
											<li><p>Property Size :</p></li>
                                            <li class="{{ $property->build_year ? '' : 'd-none' }}"><p>Year Built :</p></li>
                                            <li class="{{ $property->built_up_area > 0 ? '' : 'd-none' }}"><p>Built Up Area (In SQFT) :</p></li>
											<li><p>Furnished Type:</p></li>
											<li><p>Renovation Type:</p></li>
										</ul>
										<ul class="list-inline-item">
											<li><p><span>{{ $property->prop_ref_no }}</span></p></li>
											<li><p><span>AED {{ number_format($property->price) }}</span></p></li>
											<li><p><span>{{ number_format($property->size_sqft) }} Sq Ft</span></p></li>
                                            <li class="{{ $property->build_year ? '' : 'd-none' }}"><span>{{ $property->built_year }}</span></li>
                                            <li class="{{ $property->built_up_area > 0 ? '' : 'd-none' }}"><span>{{ $property->built_up_area }}</span></li>
											<li><p><span>@if ($property->furnished_type == 1)
                                                Furnished
                                            @elseif($property->furnished_type == 2)
                                                Un Furnished
                                            @elseif($property->furnished_type == 3)
                                                Partial Furnished
                                            @endif</span></p></li>
											<li><p><span>{{ $property->renovation_type == 1 ? 'Luxury' : 'Simple' }}</span></p></li>
										</ul>
									</div>
									<div class="col-md-6 col-lg-6 col-xl-4">
										<ul class="list-inline-item">
                                            <li class="{{ $property->bed_no != "" ? '' : 'd-none' }}"><p>Bedrooms :</p></li>
                                            <li class="{{ $property->bath_no != "" ? '' : 'd-none' }}"><p>Bathrooms :</p></li>
                                            <li class="{{ $property->garage != "" ? '' : 'd-none' }}"><p>Garage :</p></li>
                                            <li class="{{ $property->garage_size != "" ? '' : 'd-none' }}"><p>Garage Size :</p></li>
                                            <li class="{{ $property->parking_no != "" ? '' : 'd-none' }}"><p>No. of Parking Spaces :</p></li>
                                            <li class="{{ $property->building_floor != "" ? '' : 'd-none' }}"><p>Building's Floors :</p></li>
                                            <li class="{{ $property->floor_no != "" ? '' : 'd-none' }}"><p>Floor No. :</p></li>
										</ul>
										<ul class="list-inline-item">
                                            <li class="{{ $property->bed_no != "" ? '' : 'd-none' }}"><p><span>{{ $property->bed_no }}</span></p></li>
                                            <li class="{{ $property->bath_no != "" ? '' : 'd-none' }}"><p><span>{{ $property->bath_no }}</span></p></li>
                                            <li class="{{ $property->garage != "" ? '' : 'd-none' }}"><p><span>{{ $property->garage }}</span></p></li>
                                            <li class="{{ $property->garage_size != "" ? '' : 'd-none' }}"><p><span>{{ $property->garage_size }}</span></p></li>
                                            <li class="{{ $property->parking_no != "" ? '' : 'd-none' }}"><p><span>{{ $property->parking_no }}</span></p></li>
                                            <li class="{{ $property->building_floor != "" ? '' : 'd-none' }}"><p><span>{{ $property->building_floor }}</span></p></li>
                                            <li class="{{ $property->floor_no != "" ? '' : 'd-none' }}"><p><span>{{ $property->floor_no }}</p></span></li>
										</ul>
									</div>
									<div class="col-md-6 col-lg-6 col-xl-4">
										<ul class="list-inline-item">
											<li><p>Property Type :</p></li>
											<li><p>Property Status :</p></li>
                                            <li class="{{ $property->plot_no != "" ? '' : 'd-none' }}"><p>Plot No. :</p></li>
											<li><p>Property Tenure:</p></li>
											<li><p>Occupacy:</p></li>
                                            <li class="{{ $property->dewa_no != "" ? '' : 'd-none' }}"><p>DEWA No. :</p></li>
                                            <li class="{{ $property->permit_no != "" ? '' : 'd-none' }}"><p>Permit No. :</p></li>

										</ul>
										<ul class="list-inline-item">
											<li><p><span>{{ $property->category->name }}</span></p></li>
											<li><p><span>For {{ $property->type->name }}</span></p></li>
                                            <li class="{{ $property->plot_no != "" ? '' : 'd-none' }}"><p><span>{{ $property->plot_no }}</span></p></li>
                                            <li {{ $property->property_tenure == "" ? 'd-none' : '' }}><p><span>@if ($property->property_tenure == 0)
                                                Freehold
                                            @elseif($property->property_tenure == 1)
                                                Non-freehold
                                            @elseif($property->property_tenure == 2)
                                                Leasehold
                                            @endif</span></p></li>
                                            <li {{ $property->occupacy_id == "" ? 'd-none' : '' }}><p><span>@if ($property->occupacy_id == 0)
                                                Owner Occupied
                                            @elseif($property->occupacy_id == 1)
                                                Investment
                                            @elseif($property->occupacy_id == 2)
                                                Vacant
                                            @elseif($property->occupacy_id == 3)
                                                Tenanted
                                            @endif</span></p></li>
                                            <li class="{{ $property->dewa_no != "" ? '' : 'd-none' }}"><p><span>{{ $property->dewa_no }}</span></p></li>
                                            <li class="{{ $property->permit_no != "" ? '' : 'd-none' }}"><p><span>{{ $property->permit_no }}</span></p></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="additional_details">
								<div class="row">
									<div class="col-lg-12">
										<h4 class="mb15">Additional details</h4>
									</div>
									<div class="col-md-6 col-lg-6">
										<ul class="list-inline-item">
											<li><p>Deposit :</p></li>
											<li><p>Pool Size :</p></li>
											<li><p>Additional Rooms :</p></li>
										</ul>
										<ul class="list-inline-item">
											<li><p><span>20%</span></p></li>
											<li><p><span>300 Sqft</span></p></li>
											<li><p><span>Guest Bath</span></p></li>
										</ul>
									</div>
									<div class="col-md-6 col-lg-6">
										<ul class="list-inline-item">
											<li><p>Last remodel year :</p></li>
											<li><p>Amenities :</p></li>
											<li><p>Equipment :</p></li>
										</ul>
										<ul class="list-inline-item">
											<li><p><span>1987</span></p></li>
											<li><p><span>Clubhouse</span></p></li>
											<li><p><span>Grill - Gas</span></p></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="property_attachment_area">
								<h4 class="mb30">Property Attachments</h4>
								<div class="iba_container style2">
									<div class="icon_box_area style2">
										<div class="score"><span class="flaticon-document text-thm fz30"></span></div>
										<div class="details">
											<h5><span class="flaticon-download text-thm pr10"></span> Demo Word Document</h5>
										</div>
									</div>
									<div class="icon_box_area style2">
										<div class="score"><span class="flaticon-pdf text-thm fz30"></span></div>
										<div class="details">
											<h5><span class="flaticon-download text-thm pr10"></span> Demo pdf Document</h5>
										</div>
									</div>
								</div>
							</div>
						</div>
						<style>
						.payments .score{
    border: 2px solid #959595;
						}
						.payments span.t-Icon {
							font-size:30px;
    margin: auto;
}
.payments h4{
	font-size:34px !important;
}
.payments .icon_box_area{
	    padding: 0 32px;
}
.payments .icon_box_area.style2 .details {
    padding: 0px 20px 0;
}
.payments h5{
	font-size:24px !important;
	font-weight:700;
}
						</style>
						<div class="col-lg-12">
							<div class="property_attachment_area payments">
								<h4 class="mb50">We accept all types of payments</h4>
								<div class="iba_container style2 text-center">
								<div class='d-inline-flex m-auto'>
									@if ($payment_methods->count())
										@foreach ($payment_methods as $item)
											<div class="icon_box_area style2 m-auto">
												<div class="">
												<img loading="lazy" src="{{ asset('/storage/'.$item->image) }}"/>
												</div>
												<div class="details">
													<h5> {{$item->name}}</h5>
												</div>
											</div>
											</div>
										@endforeach
									@endif
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="application_statics mt30">
								<div class="row">
									<div class="col-lg-12">
										<h4 class="mb10">Amenities & Features</h4>
									</div>
                                        @if (count($maneities_array))
                                            @foreach ($maneities_array as $item)
                                            <div class="col-sm-4 col-md-4 col-lg-4 amenity_list">
                                                <a href="#"><span class="flaticon-tick"></span>{{ $item }}</a>
                                            </div>
                                            @endforeach
                                        @endif
								</div>
							</div>
						</div>
						@if ($property->youtube_link != "")
							<div class="col-lg-12">
							<div class="application_statics mt30">
								<div class="row">
									<div class="col-lg-12">
										<h4 class="mb10">Virutal Tour</h4>
									</div>
                                    <div class="col-lg-12">
									<iframe width="560" height="315" src="{{$property->youtube_link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
									</div>
								</div>
							</div>
						</div>
						@endif
						@if ($property->video_link != "")
							<div class="col-lg-12">
							<div class="application_statics mt30">
								<div class="row">
									<div class="col-lg-12">
										<h4 class="mb10">Virutal Tour</h4>
									</div>
                                    <div class="col-lg-12">
									<iframe width="560" height="315" src="{{$property->video_link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
									</div>
								</div>
							</div>
						</div>
						@endif
						<div class="col-lg-12">
							<div class="application_statics mt30">
								<h4 class="mb30">Location </h4>
								<div class="property_video p0">
									<div class="thumb">
										<div class="h400" id="map-canvas"></div>
										{{-- <div class="overlay_icon">
											<a href="#"><img loading="lazy" class="map_img_icon" src="/website/images/header-logo.svg" alt="header-logo.svg"></a>
										</div> --}}
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="whats_nearby mt30">
								<h4 class="mb10">What's Nearby</h4>
								<div class="education_distance mb15">
									<h5><span class="flaticon-college-graduation"></span> Education</h5>
									<div class="single_line">
										<p class="para">Eladia's Kids <span>(3.13 miles)</span></p>
										<ul class="review">
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><span class="total_rive_count">8895 reviews</span></li>
										</ul>
									</div>
									<div class="single_line">
										<p class="para">Gear Up With ACLS <span>(4.66 miles)</span></p>
										<ul class="review">
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><span class="total_rive_count">7475 reviews</span></li>
										</ul>
									</div>
									<div class="single_line">
										<p class="para">Brooklyn Brainery <span>(3.31 miles)</span></p>
										<ul class="review">
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><span class="total_rive_count">3579 reviews</span></li>
										</ul>
									</div>
								</div>
								<div class="education_distance mb15 style2">
									<h5><span class="flaticon-heartbeat"></span> Health & Medical</h5>
									<div class="single_line">
										<p class="para">Eladia's Kids <span>(3.13 miles)</span></p>
										<ul class="review">
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><span class="total_rive_count">8895 reviews</span></li>
										</ul>
									</div>
									<div class="single_line">
										<p class="para">Gear Up With ACLS <span>(4.66 miles)</span></p>
										<ul class="review">
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><span class="total_rive_count">7475 reviews</span></li>
										</ul>
									</div>
									<div class="single_line">
										<p class="para">Brooklyn Brainery <span>(3.31 miles)</span></p>
										<ul class="review">
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><span class="total_rive_count">3579 reviews</span></li>
										</ul>
									</div>
								</div>
								<div class="education_distance style3">
									<h5><span class="flaticon-front-of-bus"></span> Transportation</h5>
									<div class="single_line">
										<p class="para">Eladia's Kids <span>(3.13 miles)</span></p>
										<ul class="review">
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><span class="total_rive_count">8895 reviews</span></li>
										</ul>
									</div>
									<div class="single_line">
										<p class="para">Gear Up With ACLS <span>(4.66 miles)</span></p>
										<ul class="review">
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><span class="total_rive_count">7475 reviews</span></li>
										</ul>
									</div>
									<div class="single_line">
										<p class="para">Brooklyn Brainery <span>(3.31 miles)</span></p>
										<ul class="review">
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><span class="total_rive_count">3579 reviews</span></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="sidebar_listing_list">
								<div class="sidebar_advanced_search_widget">
									<div class="sl_creator">
										<h4 class="mb25">Presented by</h4>
										<div class="media">
											<span class="imgWrap"><img loading="lazy" class="mr-3" src="{{ asset('storage') }}/{{ $property->agent->avatar }}" alt="lc1.png"></span>
											<div class="media-body">
										    	<h5 class="mt-0 mb0">{{ $property->agent->name }}</h5>
										    	<p class="mb0">(123)456-7890</p>
										    	<p class="mb0"><a href="#" class="__cf_email__" >{{ $property->agent->designation }}</a></p>
										  	</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-3 col-md-3"></div>
										<div class="col-sm-6 col-md-6">
                                            <div class="text-center">
                                            </div>
                                            <form  method="POST" onsubmit="return false" id="LeadForm">
                                                <input type="hidden" name="id" value="{{ $property->id }}">
                                            @csrf
											<ul class="sasw_list mb0">
												<li class="search_area">
												    <div class="form-group">
												    	<input type="text" class="form-control" name="lead_name" id="lead_name" value="@auth  {{ auth()->user()->name }}  @endauth" placeholder="Your Name">
												    </div>
												</li>
												<li class="search_area">
												    <div class="form-group">
												    	<input type="number" class="form-control" name="lead_phone" id="lead_phone" value="@auth {{ auth()->user()->phone }} @endauth"  placeholder="Phone">
												    </div>
												</li>
												<li class="search_area">
												    <div class="form-group">
												    	<input type="email" class="form-control" name="lead_email" id="lead_email"  value="@auth {{ auth()->user()->email }}  @endauth" placeholder="Email">
												    </div>
												</li>
												<li class="search_area">
						                            <div class="form-group">
						                                <textarea id="form_message" name="lead_message" id="lead_message" class="form-control required" rows="5" placeholder="I'm interest in [ Listing Single ]">{{ $message }}</textarea>
						                            </div>
												</li>
												<li>
													<div class="search_option_button">
													    <button type="submit" class="btn btn-block btn-thm" id="request_info">Request info</button>
													</div>
												</li>
											</ul>
                                            <input type="hidden" name="">
                                            </form>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="col-lg-12">
							<div class="product_single_content">
								<div class="mbp_pagination_comments mt30">
									<ul class="total_reivew_view">
										<li class="list-inline-item sub_titles">896 Reviews</li>
										<li class="list-inline-item">
											<ul class="star_list">
												<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
												<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
												<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
												<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
												<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											</ul>
										</li>
										<li class="list-inline-item avrg_review">( 4.5 out of 5 )</li>
										<li class="list-inline-item write_review">Write a Review</li>
									</ul>
									<div class="mbp_first media">
										<img loading="lazy" src="/website/images/testimonial/1.png" class="mr-3" alt="1.png">
										<div class="media-body">
									    	<h4 class="sub_title mt-0">Diana Cooper
												<div class="sspd_review dif">
													<ul class="ml10">
														<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
														<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
														<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
														<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
														<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
														<li class="list-inline-item"></li>
													</ul>
												</div>
									    	</h4>
									    	<a class="sspd_postdate fz14" href="#">December 28, 2020</a>
									    	<p class="mt10">Beautiful home, very picturesque and close to everything in jtree! A little warm for a hot weekend, but would love to come back during the cooler seasons!</p>
										</div>
									</div>
									<div class="custom_hr"></div>
									<div class="mbp_first media">
										<img loading="lazy" src="/website/images/testimonial/2.png" class="mr-3" alt="2.png">
										<div class="media-body">
									    	<h4 class="sub_title mt-0">Ali Tufan
												<div class="sspd_review dif">
													<ul class="ml10">
														<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
														<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
														<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
														<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
														<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
														<li class="list-inline-item"></li>
													</ul>
												</div>
									    	</h4>
									    	<a class="sspd_postdate fz14" href="#">December 28, 2020</a>
									    	<p class="mt10">Beautiful home, very picturesque and close to everything in jtree! A little warm for a hot weekend, but would love to come back during the cooler seasons!</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						{{-- <div class="col-lg-12">
							<div class="product_single_content">
								<div class="mbp_pagination_comments mt30">
									<div class="mbp_comment_form style2">
										<h4>Write a Review</h4>
										<ul class="sspd_review">
											<li class="list-inline-item">
												<ul class="mb0">
													<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
													<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
													<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
													<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
													<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
												</ul>
											</li>
											<li class="list-inline-item review_rating_para">Your Rating & Review</li>
										</ul>
										<form class="comments_form">
											<div class="form-group">
										    	<input type="text" class="form-control" id="exampleInputName1" aria-describedby="textHelp" placeholder="Review Title">
											</div>
											<div class="form-group">
											    <textarea class="form-control" id="exampleFormControlTextarea1" rows="12" placeholder="Your Review"></textarea>
											</div>
											<button type="submit" class="btn btn-thm">Submit Review <span class="flaticon-right-arrow-1"></span></button>
										</form>
									</div>
								</div>
							</div>
						</div> --}}
					</div>
				</div>

			</div>
		</div>
	</section>
	<section class="our-agent-single SimilarWrapa pb30-991">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="row">

						<div class="col-lg-12">
							<h4 class="mt30 mb30 Similar">Similar Properties</h4>
						</div>
						<div class="col-lg-6">
							<div class="feat_property">
								<div class="thumb">
									<img loading="lazy" class="img-whp" src="/website/images/property/fp1.jpg" alt="fp1.jpg">
									<div class="thmb_cntnt">
										<ul class="tag mb0">
											<li class="list-inline-item"><a href="#">For Rent</a></li>
											<li class="list-inline-item"><a href="#">Featured</a></li>
										</ul>
										<ul class="icon mb0">
											<li class="list-inline-item"><a href="#"><span class="flaticon-transfer-1"></span></a></li>
											<li class="list-inline-item"><a href="#"><span class="flaticon-heart"></span></a></li>
										</ul>
										<a class="fp_price" href="#">$13,000<small></small></a>
									</div>
								</div>
								<div class="details">
									<div class="tc_content">
										<p class="text-thm">Apartment</p>
										<h4>Renovated Apartment</h4>
										<p><span class="flaticon-placeholder"></span> 1421 San Pedro St, Los Angeles, CA 90015</p>
										<ul class="prop_details mb0">
											<li class="list-inline-item"><a href="#">Beds: 4</a></li>
											<li class="list-inline-item"><a href="#">Baths: 2</a></li>
											<li class="list-inline-item"><a href="#">Sq Ft: 5280</a></li>
										</ul>
									</div>
									<div class="fp_footer">
										<ul class="fp_meta float-left mb0">
											<li class="list-inline-item"><a href="#"><img loading="lazy" src="/website/images/property/pposter1.png" alt="pposter1.png"></a></li>
											<li class="list-inline-item"><a href="#">Ali Tufan</a></li>
										</ul>
										<div class="fp_pdate float-right">4 years ago</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="feat_property">
								<div class="thumb">
									<img loading="lazy" class="img-whp" src="/website/images/property/fp2.jpg" alt="fp2.jpg">
									<div class="thmb_cntnt">
										<ul class="tag mb0">
											<li class="list-inline-item"><a href="#">For Rent</a></li>
										</ul>
										<ul class="icon mb0">
											<li class="list-inline-item"><a href="#"><span class="flaticon-transfer-1"></span></a></li>
											<li class="list-inline-item"><a href="#"><span class="flaticon-heart"></span></a></li>
										</ul>
										<a class="fp_price" href="#">$13,000<small></small></a>
									</div>
								</div>
								<div class="details">
									<div class="tc_content">
										<p class="text-thm">Apartment</p>
										<h4>Renovated Apartment</h4>
										<p><span class="flaticon-placeholder"></span> 1421 San Pedro St, Los Angeles, CA 90015</p>
										<ul class="prop_details mb0">
											<li class="list-inline-item"><a href="#">Beds: 4</a></li>
											<li class="list-inline-item"><a href="#">Baths: 2</a></li>
											<li class="list-inline-item"><a href="#">Sq Ft: 5280</a></li>
										</ul>
									</div>
									<div class="fp_footer">
										<ul class="fp_meta float-left mb0">
											<li class="list-inline-item"><a href="#"><img loading="lazy" src="/website/images/property/pposter1.png" alt="pposter1.png"></a></li>
											<li class="list-inline-item"><a href="#">Ali Tufan</a></li>
										</ul>
										<div class="fp_pdate float-right">4 years ago</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="feat_property">
								<div class="thumb">
									<img loading="lazy" class="img-whp" src="/website/images/property/fp3.jpg" alt="fp3.jpg">
									<div class="thmb_cntnt">
										<ul class="tag mb0">
											<li class="list-inline-item"><a href="#">For Sale</a></li>
										</ul>
										<ul class="icon mb0">
											<li class="list-inline-item"><a href="#"><span class="flaticon-transfer-1"></span></a></li>
											<li class="list-inline-item"><a href="#"><span class="flaticon-heart"></span></a></li>
										</ul>
										<a class="fp_price" href="#">$13,000<small></small></a>
									</div>
								</div>
								<div class="details">
									<div class="tc_content">
										<p class="text-thm">Apartment</p>
										<h4>Renovated Apartment</h4>
										<p><span class="flaticon-placeholder"></span> 1421 San Pedro St, Los Angeles, CA 90015</p>
										<ul class="prop_details mb0">
											<li class="list-inline-item"><a href="#">Beds: 4</a></li>
											<li class="list-inline-item"><a href="#">Baths: 2</a></li>
											<li class="list-inline-item"><a href="#">Sq Ft: 5280</a></li>
										</ul>
									</div>
									<div class="fp_footer">
										<ul class="fp_meta float-left mb0">
											<li class="list-inline-item"><a href="#"><img loading="lazy" src="/website/images/property/pposter1.png" alt="pposter1.png"></a></li>
											<li class="list-inline-item"><a href="#">Ali Tufan</a></li>
										</ul>
										<div class="fp_pdate float-right">4 years ago</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="feat_property">
								<div class="thumb">
									<img loading="lazy" class="img-whp" src="/website/images/property/fp1.jpg" alt="fp1.jpg">
									<div class="thmb_cntnt">
										<ul class="tag mb0">
											<li class="list-inline-item"><a href="#">For Rent</a></li>
											<li class="list-inline-item"><a href="#">Featured</a></li>
										</ul>
										<ul class="icon mb0">
											<li class="list-inline-item"><a href="#"><span class="flaticon-transfer-1"></span></a></li>
											<li class="list-inline-item"><a href="#"><span class="flaticon-heart"></span></a></li>
										</ul>
										<a class="fp_price" href="#">$13,000<small></small></a>
									</div>
								</div>
								<div class="details">
									<div class="tc_content">
										<p class="text-thm">Apartment</p>
										<h4>Renovated Apartment</h4>
										<p><span class="flaticon-placeholder"></span> 1421 San Pedro St, Los Angeles, CA 90015</p>
										<ul class="prop_details mb0">
											<li class="list-inline-item"><a href="#">Beds: 4</a></li>
											<li class="list-inline-item"><a href="#">Baths: 2</a></li>
											<li class="list-inline-item"><a href="#">Sq Ft: 5280</a></li>
										</ul>
									</div>
									<div class="fp_footer">
										<ul class="fp_meta float-left mb0">
											<li class="list-inline-item"><a href="#"><img loading="lazy" src="/website/images/property/pposter1.png" alt="pposter1.png"></a></li>
											<li class="list-inline-item"><a href="#">Ali Tufan</a></li>
										</ul>
										<div class="fp_pdate float-right">4 years ago</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	{{-- <section class="our-agent-single SimilarWrapa BottomForm pb30-991">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="row">
						<div class="col-lg-12">
							<div class="listing_single_description style2">
								<div class="lsd_list">
									<ul class="mb0">
										<li class="list-inline-item"><a  data-toggle="modal" data-target=".InsuranceModal" href="#">Insurance</a></li>
										<li class="list-inline-item"><a data-toggle="modal" data-target=".MortgageModal" href="#">Mortgage</a></li>
										<li class="list-inline-item"><a data-toggle="modal" data-target=".MaintenanceModal" href="#">Maintenance</a></li>
									</ul>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section> --}}
    <script>
        $(document).ready(function(){

        $("#LeadForm").validate({
        rules: {
            lead_name : {
                required: true,
                minlength: 3
            },
            lead_phone: {
                required: true,
                minlength: 9
            },
            lead_email: {
                required: true,
                email: true
            },
            lead_message: {
                required: true,
                minlength: 10
            },
        },
        messages:{
            lead_name:{
                required: "The name field is required.",
                minlength: "name length should be atleast 3 characters."
            },
            lead_phone:{
                required: "The phone field is required.",
                minlength: "Phone length must be atleast 9 digits."
            },
            lead_email:{
                required: "The email field is required.",
            },
            password:{
                required: "The password field is required.",
                minlength: "Password length should be atleast 6 characters."
            },
            lead_message:{
                required: "The message field is required.",
                minlength: "Message length should be atleast 10 characters."
            }
        },
            submitHandler: function(form) {
            $.ajax({
                url: "{{ route('leads.store') }}",
                type: "POST",
                data: $('#LeadForm').serialize(),
                beforeSend:function(){
                    $('#LeadForm button[type="submit"]').attr('disabled');
                    $('#LeadForm button[type="submit"]').html('Processing...');
                },
                success: function(res) {
                    $('#LeadForm button[type="submit"]').removeAttr('disabled');
                    $('#LeadForm button[type="submit"]').html('Request Info');
                    if(res == 'true')
                    {
                        $('#LeadForm')[0].reset();
                        $('.confirm-modal').modal('show');
                    }
                },error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
        }
        });

        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUH0-xyOTyiJiGxpCby07Y3CKGYpQRW7E&libraries=places&callback=initMap" async defer>
        google.maps.event.addDomListener(window, 'load', initMap);
        </script>
    <script>
        const lat = "{{ $property->lat }}";
        const lng ="{{ $property->lng }}";
        const position = { lat: parseFloat(lat), lng: parseFloat(lng) };
    function initMap() {
        let mymap = new google.maps.Map(document.getElementById("map-canvas"), {
        center: position,
        zoom: 16,
        mapId: 'f750d04825b63838',
        // disableDefaultUI: true,
        zoomControl: true,
        panControl: false,
        mapTypeControl: false,
        scaleControl: true,
        streetViewControl: false,
        overviewMapControl: false,
        rotateControl: false,
        fullscreenControl:true
      });

        // The marker, positioned at Uluru
        let  marker = new google.maps.Marker({
            position: position,
            map: mymap,
            icon:"{{ asset('common/location.png') }}"
        });



        const detailWindow = new google.maps.InfoWindow({
            content:'<p class="text-center">{{ $property->title }}</p>'
        });

        marker.addListener('mouseover', () => {
            detailWindow.open(mymap, marker);
        })
      }




    </script>

@endsection
