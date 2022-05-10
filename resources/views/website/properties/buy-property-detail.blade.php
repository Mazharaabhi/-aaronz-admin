@extends('layouts.app')

@section('content')
<style>
    .calculatorFirst {
    padding: 30px 0 0;
    }
    .calculatorFirst {
    box-shadow: 0 2px 3px #d6d6d6;
    border: 1px solid #e8e8e8;
    border-radius: 6px;
    }
    .calculatorFirst .col-sm-3.col-md-3 {
    padding: 0 10px 0 0;
    }
    .calculatorFirst .row {
    margin: 0;
    padding: 0 20px;
    }
    .calculatorFirst .form-group {
    padding: 0;
    }
    .calculatorFirst{
    color:#777;
    margin: 50px 0;
    }
    .calculatorFirst .form-group {
    position: relative;
    margin-bottom: 0;
    }
    .calculatorFirst .form-group label {
    font-size: 16px;
    display: block;
    font-family: nunito,sans-serif;
    }
    .calculatorFirst .form-group input[type=text] {
    padding-right: 40px;
    }
    .calculatorFirst .form-group input[type=text] {
    width: 100%;
    height: auto;
    padding: 10px 20px;
    border: 1px solid #c1c1c1;
    }
    .calculatorFirst .form-group span {
    position: absolute;
    right: 29px;
    bottom: 10px;
    font-family: nunito,sans-serif;
    font-weight: 700;
    }
    .calculatorFirst .fots {
    text-align: left;
    background: #f9f9f9;
    }
    .calculatorFirst .fots {
    padding: 10px 20px;
    margin-top: 31px;
    }
    .calculatorFirst .fots .row {
    padding: 0;
    }
    .calculatorFirst .fots ul {
    margin: 0;
    }
    .calculatorFirst .fots p,.calculatorFirst .fots ul,.calculatorFirst .fots ol,.calculatorFirst .fots dl,.calculatorFirst .fots dt,.calculatorFirst .fots dd,.calculatorFirst .fots blockquote,.calculatorFirst .fots address {
    margin: 0 0 10px;
    }
    .calculatorFirst .fots ul,.calculatorFirst .fots ol {
    list-style: none;
    margin: 0;
    padding: 0;
    }
    .calculatorFirst .fots li {
    font-size: 16px;
    display: block;
    font-family: nunito,sans-serif;
    font-weight: 700;
    }
    .calculatorFirst .fots li label {
    margin-right: 11px;
    font-weight: 400;
    }
    .calculatorFirst .fots li label {
    display: inline-block;
    margin-bottom: .5rem;
    }
    .calculatorFirst .fots .last-Chld {
    text-align: right;
    }
    .calculatorFirst .fots p {
    border: 1px solid #e8e8e8;
    width: 255px;
    padding: 20px;
    border-radius: 24px;
    text-align: center;
    font-size: 20px;
    display: inline-block;
    margin: 0;
    }
    .calculatorFirst p {
    color: #484848;
    }
    .calculatorFirst .fots p {
    font-family: nunito,sans-serif;
    }
    .calculatorFirst .fots p strong {
    display: block;
    }
    .calculatorFirst .fots a {
    width: 100%;
    text-align: center;
    padding: 13px 0;
    margin-top: 10px;
    }
    .calculatorFirst .fots a {
    background: #00C2CB;
    display: inline-block;
    color: #fff;
    font-family: roboto,sans-serif;
    font-size: 14px;
    font-weight: 600;
    border-radius: 5px;
    }
    .calculatorFirst .fots a {
    text-decoration: none;
    -webkit-font-smoothing: antialiased;
    }
    .calculatorFirst .fots a {
    text-shadow: none;
    }
    .calculator .content ul li label input:checked+span {
    box-shadow: inset 0 0 3px 0 rgb(4 89 150 / 35%);
    background-color: #e5f5fc;
    color: #124171;
    border-color: #759cc3;
    }
    .calculator .content ul li label span i {
    color: #30ccd3;
    font-size: 15px;
    position: absolute;
    left: 14px;
    top: 40%;
    display: none;
    }
    .calculator .content ul li label input:checked+span i {
    display: block;
    }
    div#calculat {
    margin: 50px 0;
    display: none;
    font-family:nunito,sans-serif;
    }
    .calculator .steps.clearfix {
    display: none ;
    }
    .calculator .content {
    margin-bottom: 50px;
    }
    .calculator .content h3 {
    display: none;
    }
    .calculator section {
    padding: 0;
    position: relative;
    display: block;
    }
    .calculator .content h6 {
    color: #484848;
    font-family: roboto!important;
    line-height: 1.2;
    margin-bottom: 43px;
    text-align: center;
    font-weight: 700;
    font-size: 24px;
    }
    .calculator p,.calculator ul,.calculator ol,.calculator dl,.calculator dt,.calculator dd,.calculator blockquote,.calculator address {
    margin: 0 0 10px;
    }
    .calculator ul{
    padding:0 !important;
    list-style: none !important;
    }
    .calculator .actions ul {
    margin: 0;
    padding: 0;
    text-align: center;
    }
    .calculator .actions ul li a {
    border-radius: 0;
    background: #30ccd3;
    margin-left: 10px;
    font-family: roboto,sans-serif;
    box-shadow: none;
    height: 40px;
    line-height: 40px;
    position: relative;
    text-align: center;
    vertical-align: middle;
    width: 180px;
    display: block;
    color: #fff;
    font-weight: 700;
    }
    .calculator .actions ul li {
    display: inline-block;
    }
    .calculator ul .fa,.calculator ul .fas {
    color: #00C2CB;
    }
    .calculator .content ul li {
    margin-bottom: 21px;
    }
    .calculator .content ul li label {
    position: relative;
    margin: 0;
    padding: 0;
    display: inline-block;
    }
    .header, .content, .footer {
    text-align: center;
    }
    .calculator .content ul li label input {
    position: absolute;
    visibility: hidden;
    }
    .calculator .content ul li label input[type=checkbox],.calculator .content ul li label input[type=radio] {
    box-sizing: border-box;
    padding: 0;
    }
    .calculator .content ul li label span {
    border: 1px solid #d6d6d6;
    border-radius: 3px;
    box-shadow: 0 1px 1px 0 rgb(105 111 128 / 10%);
    -webkit-tap-highlight-color: transparent;
    font-size: 1em;
    padding-top: 1.4em;
    padding-bottom: 1.4em;
    display: inline-block;
    padding: 1.3em 1em;
    font-weight: 600;
    transition: 0s;
    position: relative;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    cursor: pointer;
    min-width: 300px;
    }
    .calculator label.error {
        color: red;
        display: block;
        width: 100%;
    }
    .calculator .content .form-group {
    max-width: 400px;
    margin: 0 auto;
    text-align: left;
    margin-bottom: 20px;
    }
</style>
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
{{-- </div>
</div>
</div>
</div>
</div> --}}
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
				{{-- <div class="col-sm-6 col-lg-5 col-xl-4">
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
				</div> --}}
			</div>
		</div>
	</section>
    <section class="prop-detail-page">
        <div class="container">
           <div class="row p-3">
              <div class="col-md-9">
                 <div class="col-md-12 d-flex property_gen">
                    <div class="property-dtl-price">
                       <small>AED</small><span>{{ number_format($property->price) }}</span>
                    </div>
                    {{-- <div class="property-dtl-btn-mr btn-group">
                       <a href="#">
                       <button><i class="fa fa-heart-o"></i>Save</button>
                       </a>
                       <div class="dropdown">
                          <button class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-share"></i>Share</button>
                          <ul class="dropdown-menu">
                             <li><a href="#" class="facebook"><i class="fa fa-facebook"></i> Share on Facebook</a></li>
                             <li><a href="#" class="twitter"><i class="fa fa-twitter"></i>Share on Twitter</a> </li>
                             <li><a href="#" class="google"><i class="fa fa-google"></i>Share on Google </a> </li>
                             <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i> Share on Linked In</a></li>
                          </ul>
                       </div>
                    </div> --}}
                 </div>
                 <div class="col-md-12">
                    <div class="details">
                       <div class="tc_content">
                          <h4 class="text-muted mt-0">{{ $property->title }}</h4>
                          <p class="property_desc">Exclusive! Furnished 2BR | High Floor | Canal View...</p>
                          <ul class="prop_details mb0">
                             <li class="list-inline-item">
                                <a href="#">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="31.409" height="22.29" viewBox="0 0 31.409 22.29">
                                      <path id="bed" d="M38.9,96.718H38.4V92.665a2.029,2.029,0,0,0-2.026-2.026V82.026A2.029,2.029,0,0,0,34.343,80H13.066a2.029,2.029,0,0,0-2.026,2.026v8.612a2.029,2.029,0,0,0-2.026,2.026v4.053H8.507A.507.507,0,0,0,8,97.224v2.026a.507.507,0,0,0,.507.507h.507v2.026a.507.507,0,0,0,.507.507h1.52a.506.506,0,0,0,.5-.407l.426-2.126H35.447l.426,2.126a.506.506,0,0,0,.5.407h1.52a.507.507,0,0,0,.507-.507V99.757H38.9a.507.507,0,0,0,.507-.507V97.224A.507.507,0,0,0,38.9,96.718ZM12.053,82.026a1.015,1.015,0,0,1,1.013-1.013H34.343a1.015,1.015,0,0,1,1.013,1.013v8.612H34.343V88.612a2.029,2.029,0,0,0-2.026-2.026H26.237a2.029,2.029,0,0,0-2.026,2.026v2.026H23.2V88.612a2.029,2.029,0,0,0-2.026-2.026H15.092a2.029,2.029,0,0,0-2.026,2.026v2.026H12.053ZM33.33,88.612v2.026H25.224V88.612A1.015,1.015,0,0,1,26.237,87.6h6.079A1.015,1.015,0,0,1,33.33,88.612Zm-11.145,0v2.026H14.079V88.612A1.015,1.015,0,0,1,15.092,87.6h6.079A1.015,1.015,0,0,1,22.185,88.612ZM10.026,92.665a1.015,1.015,0,0,1,1.013-1.013h25.33a1.015,1.015,0,0,1,1.013,1.013v4.053H10.026Zm.6,8.612h-.6v-1.52h.9Zm26.758,0h-.6l-.3-1.52h.9ZM38.4,98.744H9.013V97.731H38.4Z" transform="translate(-8 -80)" fill="#30ccd3"></path>
                                   </svg>
                                   Beds: {{ $property->bed_no }}
                                </a>
                             </li>
                             <li class="list-inline-item">
                                <a href="#">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="31.509" height="27.963" viewBox="0 0 31.509 27.963">
                                      <g id="bathing" transform="translate(-7.95 -39.95)">
                                         <path id="Path_1787" data-name="Path 1787" d="M38.9,55.2H34.343v-1.52a.507.507,0,0,0-.507-.507H27.757a.507.507,0,0,0-.507.507V55.2H13.066V43.546a2.533,2.533,0,1,1,5.066,0V44.6a3.044,3.044,0,0,0-2.533,3v.507a.507.507,0,0,0,.507.507h5.066a.507.507,0,0,0,.507-.507V47.6a3.044,3.044,0,0,0-2.533-3V43.546a3.546,3.546,0,0,0-7.092,0V55.2H8.507A.507.507,0,0,0,8,55.7v1.52a.507.507,0,0,0,.507.507h1.52v3.546a5.582,5.582,0,0,0,4.053,5.362v.717a.507.507,0,0,0,1.013,0v-.53c.167.015.336.023.507.023H31.81c.171,0,.339-.008.507-.023v.53a.507.507,0,0,0,1.013,0v-.717a5.582,5.582,0,0,0,4.053-5.362V57.731H38.9a.507.507,0,0,0,.507-.507V55.7A.507.507,0,0,0,38.9,55.2ZM20.665,47.6H16.612a2.026,2.026,0,0,1,4.053,0Zm7.6,6.586H33.33V62.8H28.264ZM9.013,56.718v-.507H27.251v.507Zm27.356,4.559a4.565,4.565,0,0,1-4.559,4.559H15.6a4.565,4.565,0,0,1-4.559-4.559V57.731H27.251V63.3a.507.507,0,0,0,.507.507h6.079a.507.507,0,0,0,.507-.507V57.731h2.026ZM38.4,56.718H34.343v-.507H38.4Z" transform="translate(0 0)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                                         <path id="Path_1788" data-name="Path 1788" d="M78.079,336H72.507a.507.507,0,0,0,0,1.013h5.573a.507.507,0,0,0,0-1.013Z" transform="translate(-59.947 -277.256)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                                         <path id="Path_1789" data-name="Path 1789" d="M185.52,336h-1.013a.507.507,0,0,0,0,1.013h1.013a.507.507,0,0,0,0-1.013Z" transform="translate(-164.855 -277.256)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                                         <path id="Path_1790" data-name="Path 1790" d="M257.52,171.04a1.52,1.52,0,1,0-1.52-1.52A1.52,1.52,0,0,0,257.52,171.04Zm0-2.026a.507.507,0,1,1-.507.507A.507.507,0,0,1,257.52,169.013Z" transform="translate(-232.296 -119.894)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                                         <path id="Path_1791" data-name="Path 1791" d="M298.533,93.066A2.533,2.533,0,1,0,296,90.533,2.533,2.533,0,0,0,298.533,93.066Zm0-4.053a1.52,1.52,0,1,1-1.52,1.52A1.52,1.52,0,0,1,298.533,89.013Z" transform="translate(-269.763 -44.96)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                                         <path id="Path_1792" data-name="Path 1792" d="M360,162.026A2.026,2.026,0,1,0,362.026,160,2.026,2.026,0,0,0,360,162.026Zm2.026-1.013a1.013,1.013,0,1,1-1.013,1.013A1.013,1.013,0,0,1,362.026,161.013Z" transform="translate(-329.71 -112.401)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"></path>
                                      </g>
                                   </svg>
                                   Baths: {{ $property->bath_no }}
                                </a>
                             </li>
                             <li class="list-inline-item">
                                <a href="#">
                                   <svg id="selection" xmlns="http://www.w3.org/2000/svg" width="31.409" height="31.409" viewBox="0 0 31.409 31.409">
                                      <g id="Group_990" data-name="Group 990">
                                         <path id="Path_1802" data-name="Path 1802" d="M30.6,6.443a.805.805,0,0,0,.805-.805V.805A.805.805,0,0,0,30.6,0H25.771a.805.805,0,0,0-.805.805V2.416H6.443V.805A.805.805,0,0,0,5.637,0H.805A.805.805,0,0,0,0,.805V5.637a.805.805,0,0,0,.805.805H2.416V24.966H.805A.805.805,0,0,0,0,25.771V30.6a.805.805,0,0,0,.805.805H5.637a.805.805,0,0,0,.805-.805V28.993H24.966V30.6a.805.805,0,0,0,.805.805H30.6a.805.805,0,0,0,.805-.805V25.771a.805.805,0,0,0-.805-.805H28.993V6.443ZM27.382,24.966H25.771a.805.805,0,0,0-.805.805v1.611H6.443V25.771a.805.805,0,0,0-.805-.805H4.027V6.443H5.637a.805.805,0,0,0,.805-.805V4.027H24.966V5.637a.805.805,0,0,0,.805.805h1.611V24.966Z" fill="#30ccd3"></path>
                                      </g>
                                   </svg>
                                   Sq Ft: {{ number_format($property->size_sqft) }}
                                </a>
                             </li>
                          </ul>
                       </div>
                    </div>
                    <div class="col-md-12 mt-2 p-0">
                        <h3 class="prop-detail-overview">Details</h3>
                        <p class="mb0"></p>
                        <p class="gpara second_para  mt10 mb10">{{ $property->description }}</p>

                        {{-- <p class="overlay_close">
                           <a class="text-thm fz14" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                           Show More <span class="flaticon-download-1 fz12"></span>
                           </a> --}}
                        </p>
                     </div>
                    @if ($property->two_d != "" || $property->three_d != "")
                    <div class="col-md-12 pt-3 p-0" >
                        <h3><strong class="titles-type1">Floor Plans</strong></h3>
                        <p>Explore the floor plan in Goldcrest Views 2 that matches this listing</p>
                        <div class="row">
                           @if ($property->two_d != "")
                            <a href="javascript:;" data-toggle="lightbox" data-gallery="gallery" class="col-md-3">
                                <img loading="lazy" src="{{ asset('storage/'.$property->two_d) }}" class="img-fluid rounded">
                            </a>
                           @endif
                           @if ($property->three_d != "")
                            <a href="javascript:;" data-toggle="lightbox" data-gallery="gallery" class="col-md-3">
                                <img loading="lazy" src="{{ asset('storage/'.$property->three_d) }}" class="img-fluid rounded">
                            </a>
                           @endif
                        </div>
                        {{-- <div class="container">
                           <div class="row ">
                              <div class="offset-md-2 col-md-8">
                                 <div class="card-body req-floor">
                                    <h4><strong>Contact the agent to get the relevant floor plan for this listing</strong></h4>
                                    <button style="color:#fff; background:#30ccd3;">Request FloorPlan</button>
                                 </div>
                              </div>
                           </div>
                        </div> --}}
                     </div>
                    @endif
                    <div class="col-md-12 pt-3 p-0">
                       <h3><strong class="titles-type1">Features / Amenities</strong></h3>
                       <div class="amenities-continer">
                          <div class="row row-eq-height">
                            @if (count($maneities_array) > 0)
                            @for ($i = 0; $i < count($maneities_array); $i++)
                                @if ($i < 11)
                                <div class="col-md-2">
                                    <div class="amenities-box">
                                       <div class="amenities-icon">
                                          <svg id="balcony-or-terrace" viewBox="0 0 24 24">
                                             <g id="Group_1214">
                                                <path id="Path_1002" class="cls-1" d="M5.93,1.89H18.18a1,1,0,0,1,.88,1v1h-14v-1A1,1,0,0,1,5.93,1.89Z"></path>
                                                <path id="Union_40" class="cls-1" d="M20.06,15.89v-2h-16v2h-2v-2a2,2,0,0,1,2-2h17a1,1,0,0,1,1,1v3Z"></path>
                                                <rect id="Rectangle_1769" class="cls-1" x="2.06" y="19.89" width="20" height="2"></rect>
                                                <rect id="Rectangle_1770" class="cls-1" x="5.06" y="3.89" width="2" height="7"></rect>
                                                <rect id="Rectangle_1775" class="cls-1" x="17.06" y="3.89" width="2" height="7"></rect>
                                                <rect id="Rectangle_1773" class="cls-1" x="11.06" y="3.89" width="2" height="7"></rect>
                                                <rect id="Rectangle_1774" class="cls-1" x="13.06" y="13.89" width="2" height="6"></rect>
                                                <rect id="Rectangle_1771" class="cls-1" x="9.06" y="13.89" width="2" height="6"></rect>
                                                <rect id="Rectangle_1772" class="cls-1" x="5.06" y="13.89" width="2" height="6"></rect>
                                                <rect id="Rectangle_1776" class="cls-1" x="17.06" y="13.89" width="2" height="6"></rect>
                                             </g>
                                          </svg>
                                       </div>
                                       <div class="amenities-title">{{ $maneities_array[$i] }}</div>
                                    </div>
                                 </div>
                                @endif
                             @endfor
                             @endif
                             @if (count($maneities_array) > 11)
                             @php $remaining_amenities = count($maneities_array) - 11;  @endphp
                             <div class="col-md-2" id="OpenAmenityModal">
                                <div class="amenities-box">
                                   <div class="amenities-icon">
                                      <h2> {{ $remaining_amenities . '+' }}  </h2>
                                   </div>
                                   <div type="button" class="amenities-title">more Amenities</div>
                                </div>
                             </div>

                              <!-- The Modal -->
                              <div class="modal fade" id="AmenityModal">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <h4 class="modal-title">{{ $remaining_amenities  }} Amenities / Features</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="row">
                                                @for ($k = 0; $k < $remaining_amenities; $k++)

                                                <div class="col-md-2">
                                                    <div class="amenities-box">
                                                    <div class="amenities-icon">
                                                        <svg id="balcony-or-terrace" viewBox="0 0 24 24">
                                                            <g id="Group_1214">
                                                                <path id="Path_1002" class="cls-1" d="M5.93,1.89H18.18a1,1,0,0,1,.88,1v1h-14v-1A1,1,0,0,1,5.93,1.89Z"></path>
                                                                <path id="Union_40" class="cls-1" d="M20.06,15.89v-2h-16v2h-2v-2a2,2,0,0,1,2-2h17a1,1,0,0,1,1,1v3Z"></path>
                                                                <rect id="Rectangle_1769" class="cls-1" x="2.06" y="19.89" width="20" height="2"></rect>
                                                                <rect id="Rectangle_1770" class="cls-1" x="5.06" y="3.89" width="2" height="7"></rect>
                                                                <rect id="Rectangle_1775" class="cls-1" x="17.06" y="3.89" width="2" height="7"></rect>
                                                                <rect id="Rectangle_1773" class="cls-1" x="11.06" y="3.89" width="2" height="7"></rect>
                                                                <rect id="Rectangle_1774" class="cls-1" x="13.06" y="13.89" width="2" height="6"></rect>
                                                                <rect id="Rectangle_1771" class="cls-1" x="9.06" y="13.89" width="2" height="6"></rect>
                                                                <rect id="Rectangle_1772" class="cls-1" x="5.06" y="13.89" width="2" height="6"></rect>
                                                                <rect id="Rectangle_1776" class="cls-1" x="17.06" y="13.89" width="2" height="6"></rect>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="amenities-title">{{ $maneities_array[$k+11] }}</div>
                                                    </div>
                                                </div>
                                                @endfor
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>

                                  </div>
                                </div>
                              </div>
                             @endif

                          </div>
                       </div>
                    </div>
                    {{-- <div class="col-md-12 pt-3 p-0">
                       <h3><strong class="titles-type1">Property Attachments</strong></h3>
                       <div class="attachments-continer">
                          <div class="row">
                             <div class="col-md-6">
                                <div class="icon_box_area style2">
                                   <div class="score"><span class="flaticon-document text-thm fz50"></span></div>
                                   <div class="details">
                                      <h5>Demo Word Document</h5>
                                      <span>Property Location Details</span>
                                   </div>
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="icon_box_area style2">
                                   <div class="score"><span class="flaticon-document text-thm fz50"></span></div>
                                   <div class="details">
                                      <h5>Demo Word Document</h5>
                                      <span>Property Location Details</span>
                                   </div>
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="icon_box_area style2">
                                   <div class="score"><span class="flaticon-document text-thm fz50"></span></div>
                                   <div class="details">
                                      <h5>Demo Word Document</h5>
                                      <span>Property Location Details</span>
                                   </div>
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="icon_box_area style2">
                                   <div class="score"><span class="flaticon-document text-thm fz50"></span></div>
                                   <div class="details">
                                      <h5>Demo Word Document</h5>
                                      <span>Property Location Details</span>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div> --}}
                    @if ($property->vido_link != "")
                    <div class="col-md-12 pt-3 p-0">
                        <div class="view-location">
                           <h3><strong class="titles-type1">Locations Views</strong></h3>
                           <iframe src="{{ $property->vido_link }}" width="100%" height="330"></iframe>
                        </div>
                     </div>
                    @endif
                 </div>
              </div>
              <div class="col-md-3">
                 <div class="company-details">
                    <div class="company-logo"><img loading="lazy" src="{{ asset('storage/'.$property->company->avatar) }}"></div>
                    <div class="comapny-title">{{ $property->company->company_name }}</div>
                    <div class="row detialsdes">
                       <div class="col-lg-12">
                          <table>
                             <tbody>
                                <tr>
                                   <td><strong>RERA#</strong></td>
                                   <td>{{ $property->company->rera_no }}</td>
                                </tr>
                                <tr>
                                   <td><strong>DTCM#</strong></td>
                                   <td>{{ $property->company->dtcm_no }}</td>
                                </tr>
                                <tr>
                                   <td><strong>Permit#</strong></td>
                                   <td class="service-area-con">
                                      0517016410
                                   </td>
                                </tr>
                                <tr>
                                   <td><strong>Properties:</strong></td>
                                   <td>{{ $property->company->properties_count }}</td>
                                </tr>
                                {{-- <tr>
                                   <td><strong>Agent:</strong></td>
                                   <td>{{ $property->agent->name }}</td>
                                </tr> --}}
                             </tbody>
                          </table>
                       </div>
                       <hr>
                    </div>
                 </div>
              </div>
           </div>
           {{-- <div id="map-canvas"></div> --}}

           <div class="row pt-3 near-by-places">
              <div class="col-md-12">
                 <h3><strong class="titles-type1">Location</strong></h3>
              </div>
              <div class="col-lg-12">
                  <div id="map-canvas" style="width: 100%; height: 500px;"></div>
              </div>
              <div class="col-lg-12">
                 <div class="sidebar_listing_list">
                    <div class="sidebar_advanced_search_widget" style="display:flex;flex-direction:row">
                       <div class="sl_creator">
                          <h4 class="mb25">Presented by</h4>
                          @if ($property->agent->is_company == 1)
                              <div class="media">
                             <span class="imgWrap"><img loading="lazy" class="mr-3" src="{{ asset('storage/'.$property->company->avatar) }}" alt="lc1.png"></span>
                             <div class="media-body">
                                <h5 class="mt-0 mb0">{{ $property->company->name }}</h5>
                                <p class="mb0">{{$property->company->phone}}</p>
                                <p class="mb0"><a href="#" class="__cf_email__" >Property Advisor</a></p>
                             </div>
                          </div>
                          @else
                             <div class="media">
                            <span class="imgWrap"><img loading="lazy" class="mr-3" src="{{ asset('storage/'.$property->agent->avatar) }}" alt="lc1.png"></span>
                            <div class="media-body">
                               <h5 class="mt-0 mb0">{{ $property->agent->name }}</h5>
                               <p class="mb0">{{$property->agent->phone}}</p>
                               <p class="mb0"><a href="#" class="__cf_email__" >{{$property->agent->designation}}</a></p>
                            </div>
                         </div>
                         @endif




                       </div>
                       <div class="row">
                          <div class="col-sm-12 col-md-12">
                             <form method="POST" onsubmit="return false" @auth id="LeadForm" @endauth>
                             @csrf
                             <input type="hidden" name="property_id"  value="{{ $property->id }}">
                             <ul class="sasw_list mb0">
                                <li class="search_area">
                                   <div class="form-group">
                                      <input type="text" name="lead_name" class="form-control" id="exampleInputName1" placeholder="Your Name" value="@auth {{ auth()->user()->name }} @endauth">
                                   </div>
                                </li>
                                <li class="search_area">
                                   <div class="form-group">
                                      <input type="tel" name="lead_phone" class="form-control" id="exampleInputName2" placeholder="Phone" value="@auth {{ auth()->user()->phone }} @endauth">
                                   </div>
                                </li>
                                <li class="search_area">
                                   <div class="form-group">
                                      <input type="email" name="lead_email" class="form-control" id="exampleInputEmail" placeholder="Email" value="@auth {{ auth()->user()->email }} @endauth">
                                   </div>
                                </li>
                                <li class="search_area">
                                   <div class="form-group">
                                      <textarea id="form_message" name="lead_message" class="form-control required" rows="5" required="required" placeholder="">{{ $message }}</textarea>
                                   </div>
                                </li>
                                <li>
                                   <div class="search_option_button">
                                      <button type="submit" class="btn btn-block btn-thm" id="request_info">Request info</button>
                                   </div>
                                </li>
                             </ul>
                            </form>
                          </div>
                       </div>

                    </div>
                 </div>
              </div>
           </div>
     </section>
     <div class="container">
        <div class="row">
            <div class="col-md-12 m-auto">
                <h3><strong class="titles-type1">Mortgage Calculator</strong></h3>
                <div class="calculatorFirst">
                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                <label>Property price</label>
                                <input type="text" name="loan" disabled id="loan" value="{{ $property->price }}">
                                <span>AED</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                <label>Down payment</label>
                                <input type="text" name="down_payment" id="down_payment" value="{{ $property->price / 100 * 20 }}">
                                <span>AED</span>
                            </div>
                            <span>min <small><b>{{ number_format($property->price / 100 * 20 ) }}</b></small> max <small><b>{{ number_format($property->price / 100 * 80 ) }}</b></small></span>
                            <span id="down_payment_error" class="text-danger"></span>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                <label>Loan duration</label>
                                <input type="text" id="years" name="years" value="5">
                                <span>Years</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                <label>Interest rate</label>
                                <input type="text" id="rate" name="rate" value="2.5">
                                <span>%</span>
                            </div>
                        </div>
                    </div>
                    <div class="fots">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <ul>
                                    <li><label>No. of payments</label><span id="terms"></span></li>
                                    <li><label>Monthly installments </label><span id="installment"></span></li>
                                    <li><label>Property price</label> AED <span id="property_price"></span></li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-md-6 last-Chld">
                                <p>Estimated Mo. Payment <strong>AED <span id="estimated_amount"></span></strong> Based on <span id="no_year">192</span> Year Fixed</p>
                            </div>
                        </div>
                        <a class="calOpen" id="mortgage-request">
                        Apply Now
                        </a>
                    </div>
                </div>
                <div class="calculator" id="calculat">
                  <form onsubmit="return false;" id="apply-for-mortgage">
                    <input type="hidden" name="product_id" id="product_id" value="" />
                    <input type="hidden" name="bank_id" id="bank_id" value="" />
                    <div id="example-basic">
                        <h3>1</h3>
                        <section>
                           <div class="types homeType">
                              <h6>
                                 What type of mortgage are you looking to get?
                              </h6>
                              <ul>
                                 <li> <label><input type="radio" name="types" value="New property purchase" class="required"/> <span><i class="fa fa-check"></i>New property purchase</span></label></li>
                                 <li> <label><input type="radio" name="types" value="Existing home refinance" class="required"/> <span><i class="fa fa-check"></i>Existing home refinance</span></label></li>
                              </ul>
                           </div>
                        </section>
                        <h3>1.1</h3>
                        <section>
                           <div class="types homeType">
                              <h6>
                                 What stage are you in the property buying journey?
                              </h6>
                              <ul>
                                 <li> <label><input type="radio" name="stage" value="I'm still researching" class="required"/> <span><i class="fa fa-check"></i>I'm still researching</span></label></li>
                                 <li> <label><input type="radio" name="stage" value="I'm viewing properties in person" class="required"/> <span><i class="fa fa-check"></i>I'm viewing properties in person</span></label></li>
                                 <li> <label><input type="radio" name="stage" value="I've already made an offer" class="required"/> <span><i class="fa fa-check"></i>I've already made an offer</span></label></li>
                              </ul>
                           </div>
                        </section>
                        <h3>1.2</h3>
                        <section>
                           <div class="types homeType">
                              <h6>
                                 When are you looking to purchase your new property?
                              </h6>
                              <ul>
                                 <li> <label><input type="radio" name="purchase" value="Within 3 months" class="required"/> <span><i class="fa fa-check"></i>Within 3 months</span></label></li>
                                 <li> <label><input type="radio" name="purchase" value="3 to 6 months" class="required"/> <span><i class="fa fa-check"></i>3 to 6 months</span></label></li>
                                 <li> <label><input type="radio" name="purchase" value="6 to 12 months" class="required"/> <span><i class="fa fa-check"></i>6 to 12 months</span></label></li>
                                 <li> <label><input type="radio" name="purchase" value="I haven't decided yet" class="required"/> <span><i class="fa fa-check"></i>I haven't decided yet</span></label></li>
                              </ul>
                           </div>
                        </section>
                        <h3>1.3</h3>
                        <section>
                           <div class="types homeType">
                              <h6>
                                 What type of property are you looking to purchase?
                              </h6>
                              <ul>
                                 <li> <label><input type="radio" name="property" value="Apartment" class="required"/> <span><i class="fa fa-check"></i>Apartment</span></label></li>
                                 <li> <label><input type="radio" name="property" value="Villa" class="required"/> <span><i class="fa fa-check"></i>Villa</span></label></li>
                                 <li> <label><input type="radio" name="property" value="Land" class="required"/> <span><i class="fa fa-check"></i>Land</span></label></li>
                              </ul>
                           </div>
                        </section>
                        <h3>1.4</h3>
                        <section>
                           <div class="types homeType">
                              <h6>
                                 Are you interested in completed properties or still under construction?
                              </h6>
                              <ul>
                                 <li> <label><input type="radio" name="construction"  value="Completed properties" class="required"/> <span><i class="fa fa-check"></i>Completed properties</span></label></li>
                                 <li> <label><input type="radio" name="construction"  value="Under construction" class="required"/> <span><i class="fa fa-check"></i>Under construction</span></label></li>
                                 <li> <label><input type="radio" name="construction"  value="I haven't decided yet" class="required"/> <span><i class="fa fa-check"></i>I haven't decided yet</span></label></li>
                              </ul>
                           </div>
                        </section>
                        <h3>1.5</h3>
                        <section>
                           <div class="types homeType">
                              <h6>
                                 Which property locations are you currently looking into?
                              </h6>
                              <div class="form-group">
                                 <label>Search by location, community, or tower</label>
                                 <input type="text" id="search_txt" class="form-control required" name="property_location">
                              </div>
                           </div>
                        </section>
                        <h3>1.5</h3>
                        <section>
                           <div class="types homeType">
                              <h6>
                                 What is your estimated budget?
                              </h6>
                              <div class="form-group">
                                 <label>Amount</label>
                                 <input type="number" class="form-control required" name="estimated_budget" id="estimated_budget" >
                              </div>
                           </div>
                        </section>
                        <h3>1.5</h3>
                        <section>
                           <div class="types homeType">
                              <h6>
                                 How much do you have for the initial down payment?
                              </h6>
                              <div class="form-group">
                                 <label>Amount</label>
                                 <input type="number" class="form-control required" name="initial_down_payment" id="initial_down_payment">
                              </div>
                           </div>
                        </section>
                        <h3>1.5</h3>
                        <section>
                           <div class="types homeType">
                              <h6>
                                 Are you a UAE national?
                              </h6>
                              <ul>
                                 <li> <label><input type="radio" name="national" value="Yes" class="required"/> <span><i class="fa fa-check"></i>Yes</span></label></li>
                                 <li> <label><input type="radio" name="national" value="No" class="required"/> <span><i class="fa fa-check"></i>No</span></label></li>
                              </ul>
                           </div>
                        </section>
                        <h3>1.5</h3>
                        <section>
                           <div class="types homeType">
                              <h6>
                                 Great! Tell us a bit more about yourself
                              </h6>
                              <div class="form-group">
                                 <label>What year were you born in?</label>
                                 <select class="form-control required" id="yearpicker" name="born_date">
                                     <option>---Select year ---</option>
                                 </select>
                              </div>
                           </div>
                        </section>
                        <h3>1.5</h3>
                        <section>
                           <div class="types homeType">
                              <h6>
                                 What is your employment situation?
                              </h6>
                              <ul>
                                 <li> <label><input type="radio" name="employment" value="I am employed" class="required"/> <span><i class="fa fa-check"></i>I am employed</span></label></li>
                                 <li> <label><input type="radio" name="employment" value="I am self-employed" class="required"/> <span><i class="fa fa-check"></i>I am self-employed</span></label></li>
                                 <li> <label><input type="radio" name="employment" value="I have a different source of income" class="required" /> <span><i class="fa fa-check"></i>I have a different source of income</span></label></li>
                              </ul>
                           </div>
                        </section>
                        <h3>1.5</h3>
                        <section>
                           <div class="types homeType">
                              <h6>
                                 Is this a joint or single application?
                                 <span>A joint mortgage is when you apply to borrow funds with another person (e.g. a spouse or a family member) to purchase a property together.</span>
                              </h6>
                              <ul>
                                 <li> <label><input type="radio" name="application" value="Single application" class="required"/> <span><i class="fa fa-check"></i>Single application</span></label></li>
                                 <li> <label><input type="radio" name="application" value="Joint application" class="required"/> <span><i class="fa fa-check"></i>Joint application</span></label></li>
                              </ul>
                           </div>
                        </section>
                        <h3>1.5</h3>
                        <section>
                           <div class="types homeType">
                              <h6>
                                 Let's get an idea of your financial situation
                                 <span>Understanding your overall financial situation allows us to best assess which mortgage products you are most likely to get successfully pre-approved for</span>
                              </h6>
                              <div class="form-group">
                                 <label>What is your approximate monthly income?</label>
                                 <input type="text" class="form-control required" name="approximate_monthly_income" id="approximate_monthly_income">
                              </div>
                              <div class="form-group">
                                 <label>Do you have any credit cards? If yes, what is your total available credit limit for all cards?</label>
                                 <input type="text" class="form-control required" name="available_credit_limit" id="available_credit_limit">
                              </div>
                              <div class="form-group">
                                 <label>Do you have any other loans? If yes, what are your total monthly repayments?</label>
                                 <input type="text" class="form-control required" name="total_monthly_repayments" id="total_monthly_repayments">
                              </div>
                           </div>
                        </section>
                        <h3>1.5</h3>
                        <section>
                           <div class="types homeType">
                              <h6>
                                 How should we reach you?
                              </h6>
                              <div class="form-group">
                                 <label>Full Name</label>
                                 <input type="text" class="form-control required" name="full_name" id="full_name" >
                              </div>
                              <div class="form-group">
                                 <label>Email Address</label>
                                 <input type="text" class="form-control required email" name="email_address"  id="email_address">
                              </div>
                              <div class="form-group">
                                 <label>Phone Number</label>
                                 <input type="text" class="form-control required" name="phone_number" id="phone_number">
                              </div>
                           </div>
                        </section>
                     </div>
                </form>
                </div>
            </div>
        </div>
    </div>
     <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3><strong class="titles-type1">Property Reviews</strong></h3>
                <div class="seprator"></div>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row" id="reviews_div">

                         </div>
                    </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
     </div>
  </div>
</div>
    @include('website.properties.similar')
    {{-- <section class="our-agent-single bgc-f7 pb30-991">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product_single_content">
                        <div class="mbp_pagination_comments mt30">
                            <div class="mbp_comment_form style2">
                                <h2>Write a Review</h2>
                                <div class="rateit" data-rateit-mode="font"></div>
                                    <span class="list-inline-item review_rating_para">Your Rating & Review</span>
                                    <form class="comments_form" onsubmit="return false">
                                        <div class="form-group">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="12" placeholder="Your Review"></textarea>
                                            <span class="text-danger d-block" id="review_error"></span>
                                        </div>
                                        <button type="button" class="btn btn-thm" id="submit_review">Submit Review <span class="flaticon-right-arrow-1"></span></button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
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
            zoom: 18,
            mapId: 'f750d04825b63838',
            disableDefaultUI: true,
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
    <script>
        jQuery(document).ready(function($){

          /**Opening Amenity Modal*/
          $('#OpenAmenityModal').click(function(){
                $('#AmenityModal').modal('show');
          });

          const property_id = "{{ $property->id }}";
          getPropertyReviews()
          function getPropertyReviews(){
            $.ajax({
                    url:"{{ route('get-property-review') }}",
                    method:"GET",
                    data:{property_id},
                    success:function(res){
                        $('#reviews_div').html(res);
                    },error:function(xhr){
                        console.log(xhr.responseText)
                    }
                });
          }
          const authorized ="{{ isset(Auth::user()->id) ? Auth::user()->id : '' }}";

          $('#request_info').click(function(){
            if(authorized === ""){
                $('#open-modal-btn').trigger('click');
                }
          });


          $('#submit_review').click(function(){
          if(authorized === ""){
                $('#open-modal-btn').trigger('click');
          }else{
            const rate = $('.rateit').rateit('value');
            const review = $('#exampleFormControlTextarea1').val();
            if(!$.trim(review).length){
                $('#review_error').html('The review field is required.');
                return $('#exampleFormControlTextarea1').focus();
            }else if(review.length < 3){
                $('#review_error').html('The review must be atleast 3 characters.');
                return $('#exampleFormControlTextarea1').focus();
            }else{
                $('#review_error').html('');
                $.ajax({
                    url:"{{ route('submit-property-review') }}",
                    method:"POST",
                    data:{rate,review,property_id,_token:"{{ csrf_token() }}"},
                    success:function(res){
                        swal("Success", "Review added successfully!", "success");
                        $('#rateit-reset-2').trigger('click');
                        $('#exampleFormControlTextarea1').val('');
                        getPropertyReviews()
                    },error:function(xhr){
                        console.log(xhr.responseText)
                    }
                });
            }
          }
      });

      //*******MORTGAGE REQUEST START HERE*******//
      $('#mortgage-request').on('click',function(){
          const down_payment =$('#down_payment').val();
          const property_price =$('#loan').val();
          const intrust_rate =$('#rate').val();
          const loan_duration =$('#years').val();
          const installment =$('#installment').text();
          const ml_name =$('#exampleInputName1').val();
          const ml_phone =$('#exampleInputName2').val();
          const ml_email =$('#exampleInputEmail').val();
          const ml_description =$('#form_message').val();
          const authorized ="{{ isset(Auth::user()->id) ? Auth::user()->id : '' }}";
        if(authorized === ""){
               return $('#open-modal-btn').trigger('click');
                }
        $.ajax({
                url:"{{ route('submit-mortgage-request') }}",
                method:"POST",
                data:{ml_description,ml_email,ml_phone,ml_name,installment,down_payment,property_price,intrust_rate,loan_duration,property_id,_token:"{{ csrf_token() }}"},
                success:function(res){
                    console.log(res);
                    swal("Success", "Mortgage Request Sent successfully!", "success");
                    window.location.href= "{{ URL::to('/') }}";
                },error:function(xhr){
                    console.log(xhr.responseText)
                }
            });
        })
      //*****MORTGAGE REQUEST START END HERE*****//
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

         //TODO:: MORTGAGE FORM CALCULATOR//
         showResult();
         function showResult()
      {
        $('#down_payment_error').html("");
        const loan=$('#loan').val()
        const years=$('#years').val()
        const rate=$('#rate').val()
        const down_payment=$('#down_payment').val()
        var months = years * 12;
        var min_down_payment_cal=loan * 20 / 100;
        var max_down_payment_cal=loan * 80 / 100;
       // console.log(`loan: ${loan} , years:${years}, rate: ${rate}, months:${months}`);
       if(years < 5)
       {
        $('#years').val(5)
       }
       if(years > 25)
       {
         $('#years').val(25)
       }
       if(rate < 2.5)
       {
        $('#rate').val(2.5)
       }
       if(rate > 10)
       {
         $('#rate').val(10)
       }
       if(down_payment < min_down_payment_cal)
       {
        $('#down_payment_error').html(`down payment should be equal or greater than ${min_down_payment_cal}`);
        return $('#down_payment').focus();
       }
       if(down_payment > max_down_payment_cal)
       {
        $('#down_payment_error').html(`down payment should be equal or less than ${max_down_payment_cal}`);
        return $('#down_payment').focus();
       }
        if ((loan == null ||
              loan.length == 0) ||
                (months == null ||
            months.length == 0) ||
            (rate== null || rate.length == 0))
        {
            $('#pay').html('Incomplete data')
        }
        else
        {
            var princ = loan - down_payment;
            var term  = months;
            var intr   = rate / 1200;
            var no_years=$('#years').val()
            // document.calc.pay.value = princ * intr / (1 - (Math.pow(1/(1 + intr), term)));
            var monthly_payment = princ * intr / (1 - (Math.pow(1/(1 + intr), term)));
           // console.log(monthly_payment.toFixed(2))
            $('#installment').html(monthly_payment.toFixed(2));
            $('#terms').html(term);
            $('#property_price').html(loan);
            $('#no_year').html(no_years);
            $('#estimated_amount').html(monthly_payment.toFixed(2));

            // $('#estimated_amount').html(princ);
            }
          }
          // payment = principle * monthly interest/(1 - (1/(1+MonthlyInterest)*Months))
           $('#rate').focusout(function(){
           showResult();
        });
        $('#loan').focusout(function(){
        showResult();
        });
         $('#years').focusout(function(){
           showResult();
          });
        $('#down_payment').focusout(function(){
          showResult();
           });
     });
   </script>
    <script>

        $(document).ready(function($){
            $(".typesList .viewall").on("click", function(){
            if($(".typesList ul").height()==30){
            var txt = $('.typesList ul').height()==30 ? 'View Less Locations' : '';
            // alert(txt);
            $('.typesList .viewall').text(txt);
            $('.typesList ul').css('height','auto');
            }else{
                        var txt = $('.typesList .viewall').height()!=30 ? 'View All Locations' : '';
            $('.typesList .viewall').text(txt);
            $('.typesList ul').css('height','30');
            }
            });
            //Select 2 For Search Option
            $(".input-search").select2({
                placeholder: "Location"
            });
        });

    </script>


@endsection
