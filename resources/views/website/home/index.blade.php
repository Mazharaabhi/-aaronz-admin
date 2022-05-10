@extends('layouts.app')

@section('content')

    <!-- 6th Home Design -->
	<section class="home-six home6-overlay banner1">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @if ($sliders->count())
                @foreach ($sliders as $key => $item)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img loading="lazy" src="{{ asset('storage/'.$item->image) }}" class="d-block w-100" alt="...">
               </div>
                @endforeach
            @endif
            </div>
        </div>
		<div class="container">
			<div class="row posr">
				<div class="col-lg-12">
					<div class="home_content home6">
						<div class="home-text home6 text-center">
							<h2 class="fz55">Enjoy The Finest Homes</h2>
							<p class="fz18">From as low as $10 per day with limited time offer discounts.</p>
						</div>
						<div class="home_adv_srch_opt home6">
                                    <form action="{{ route('search') }}">
									<div class="tab-content home1_adsrchfrm" id="pills-tabContent">
										<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
											<div class="home1-advnc-search home6">
												<ul class="h1ads_1st_list mb0">
													<li class="list-inline-item firstBox">
														<div class="form-group">
															{{-- <input type="text" class="form-control" id="l" name="l" placeholder="Location"> --}}
                                                            <select name="l" id="l" class="form-control select2_el" multiple required></select>
															<label for="exampleInputEmail"><span class="flaticon-maps-and-flags"></span></label>
														</div>
													</li>
													<li class="list-inline-item scndBox">
														<div class="innerradio">
															<label><input type="radio" name="t" id="t" value="1" checked> <span>Sale</span></label>
															<label><input type="radio" name="t" id="t" value="3"> <span>Rent</span></label>
														</div>
													</li>
													<li class="list-inline-item scndBox">
														<div class="search_option_two">
															<div class="candidate_revew_select twoFields">
                                                                <select id="mnp" name="mnp" class="">
                                                                </select>
                                                                <select id="mxp" name="mxp" class="">
                                                                </select>
                                                            </div>
														</div>
													</li>

													<li class="list-inline-item fourtBox">
														<div class="search_option_two">
															<div class="candidate_revew_select">
																<select name="c" id="c" class="w100 show-tick">
																</select>
															</div>
														</div>
													</li>
												</ul>
												<ul class="h1ads_1st_list mb0">
													<li class="list-inline-item lastBox">
														<div class="candidate_revew_select twoFields">
															<select name="bd" id="bd" class="selectpicker w100 show-tick">
																<option value="">BEDS</option>
																<option value="0">All</option>
																<option value="">Studio</option>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
																<option value="6">6</option>
																<option value="7">7</option>
																<option value="8">8+</option>
															</select>
															<select name="bh" id="bh" class="selectpicker w100 show-tick">
																<option value="">BATHS</option>
																<option value="0">All</option>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
																<option value="6">6</option>
															</select>
														</div>
													</li>
													<li class="list-inline-item scndBox">
														<div class="candidate_revew_select twoFields">
															<select name="mnz" id="mnz" class="">
															</select>
															<select name="mxz" id="mxz" class="">
															</select>
														</div>
													</li>
                                                    <li class="list-inline-item scndBox">
														<div class="candidate_revew_select twoFields">
															<select name="v" id="v" class="">
                                                                @if ($views->count())
                                                                    @foreach ($views as $vie)
                                                                        <option value="{{ $vie->id }}">{{ $vie->title }}</option>
                                                                    @endforeach
                                                                @endif
															</select>
														</div>
													</li>

													<li class="custome_fields_520 list-inline-item">
														<div class="navbered">
															<div class="mega-dropdown home6">
																{{-- <span id="show_advbtn" class="dropbtn">Advanced <i class="flaticon-more pl10 flr-520"></i></span> --}}
																<div class="dropdown-content">
																	<div class="mega_dropdown_content_closer">
																		<h5 class="text-thm text-right mt15"><span id="hide_advbtn" class="curp">Hide</span></h5>
																	</div>
																	<div class="row p15 pt0-xsd">
																		<div class="col-sm-3">
																			<div class="list-inline-item">
																				<div class="small_dropdown2 home6">
																					<div id="prncgs" class="btn dd_btn">
																						<span>Price</span>
																						<label for="exampleInputEmail2"><span class="fa fa-angle-down"></span></label>
																					</div>
																					<div class="dd_content2">
																						<div class="pricing_acontent">
																							<span id="slider-range-value1"></span>
																							<span id="slider-range-value2"></span>
																							<div id="slider"></div>
																							<!-- <input type="text" class="amount" placeholder="$52,239">
																								<input type="text" class="amount2" placeholder="$985,14">
																								<div class="slider-range"></div> -->
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col-sm-3">
																			<div class="list-inline-item">
																				<div class="candidate_revew_select twoFields">
																					<select class="selectpicker w100 show-tick">
																						<option>Min Size</option>
																						<option>300 Sqft</option>
																						<option>500 Sqft</option>
																						<option>700 Sqft</option>
																						<option>1000 Sqft</option>
																						<option>1300 Sqft</option>
																						<option>2300 Sqft</option>
																						<option>4300 Sqft</option>
																						<option>7000 Sqft</option>
																					</select>
																					<select class="selectpicker w100 show-tick">
																						<option>Max Size</option>
																						<option>300 Sqft</option>
																						<option>500 Sqft</option>
																						<option>700 Sqft</option>
																						<option>1000 Sqft</option>
																						<option>1300 Sqft</option>
																						<option>2300 Sqft</option>
																						<option>4300 Sqft</option>
																						<option>7000 Sqft</option>
																					</select>
																				</div>
																			</div>
																		</div>
																		<div class="col-sm-3">
																			<div class="list-inline-item">
																				<div class="candidate_revew_select">
																					<select class="selectpicker w100 show-tick">
																						<option value="A" selected="selected">Min View</option>
																						<option value="422">Dubai Skyline</option>
																						<option value="446">Dubai Creek</option>
																						<option value="32">Burj Khalifa</option>
																						<option value="463">Dubai Opera</option>
																						<option value="474">Dubai Mall Fountains</option>
																						<option value="469">Ain Dubai</option>
																						<option value="462">10</option>
																						<option value="456">The Creek Tower</option>
																						<option value="28">Sea</option>
																						<option value="185">Palm Jumeirah</option>
																						<option value="477">Atlantis</option>
																						<option value="10">Golf Course</option>
																						<option value="36">Marina</option>
																						<option value="19">Park</option>
																						<option value="31">Pool</option>
																						<option value="447">Shk Zayed Road</option>
																						<option value="34">Community</option>
																						<option value="478">Address Fountain Views &amp; Damac</option>
																					</select>
																				</div>
																			</div>
																		</div>
																		<div class="col-sm-3">
																			<div class="list-inline-item">
																				<div class="candidate_revew_select">
																					<input type="text" placeholder="Ref No." class="form-control" name="">
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="row p15 mainServices">
																		<div class="col-lg-12">
																			<h4 class="text-thm3">Property Services</h4>
																			<ul>
																				<li><label><input type="radio" name="services" /> <span>Handyman</span></label></li>
																				<li><label><input type="radio" name="services" /> <span>painting</span></label></li>
																				<li><label><input type="radio" name="services" /> <span>Landscaping</span></label></li>
																				<li><label><input type="radio" name="services" /> <span>Interior Design</span></label></li>
																				<li><label><input type="radio" name="services" /> <span>Custom Made Furniture</span></label></li>
																				<li><label><input type="radio" name="services" /> <span>Bathroom Renovation</span></label></li>
																				<li><label><input type="radio" name="services" /> <span>Kitchen Renovation</span></label></li>
																				<li><label><input type="radio" name="services" /> <span>Bank Mortgage</span></label></li>
																			</ul>
																		</div>
																	</div>
																	<div class="row p15 mainServices">
																		<div class="col-lg-12">
																			<h4 class="text-thm3">Completion status</h4>
																			<ul>
																				<li><label><input type="radio" name="statuss" /> <span>Off-plan</span></label></li>
																				<li><label><input type="radio" name="statuss" /> <span>Ready</span></label></li>
																			</ul>
																		</div>
																	</div>
																	<div class="row p15 mainServices">
																		<div class="col-lg-12">
																			<h4 class="text-thm3">All Virtual Viewings</h4>
																			<ul>
																				<li><label><input type="radio" name="Virtual" /> <span>360 Tours</span></label></li>
																				<li><label><input type="radio" name="Virtual" /> <span>Video Tours</span></label></li>
																				<li><label><input type="radio" name="Virtual" /> <span>Live Viewings</span></label></li>
																			</ul>
																		</div>
																	</div>
																	<div class="row p15 mainServices">
																		<div class="col-lg-12">
																			<h4 class="text-thm3">What size is your home? </h4>
																			<ul>
																				<li><label><input type="radio" name="size" /> <span>1 bedroom Flat</span></label></li>
																				<li><label><input type="radio" name="size" /> <span>2 bedroom Flat</span></label></li>
																				<li><label><input type="radio" name="size" /> <span>2 bedroom Villa</span></label></li>
																				<li><label><input type="radio" name="size" /> <span>3 bedroom Flat</span></label></li>
																				<li><label><input type="radio" name="size" /> <span>3 bedroom Villa</span></label></li>
																				<li><label><input type="radio" name="size" /> <span>4 bedroom Villa</span></label></li>
																				<li><label><input type="radio" name="size" /> <span>5 bedroom Villa</span></label></li>
																				<li><label><input type="radio" name="size" /> <span>Studio</span></label></li>
																			</ul>
																		</div>
																	</div>
																	<div class="row p15 mainServices">
																		<div class="col-lg-12">
																			<h4 class="text-thm3">Must Have</h4>
																			<ul>
																				<li><label><input type="radio" name="size" /> <span>Air Reduced Price</span></label></li>
																				<li><label><input type="radio" name="size" /> <span>Furnished</span></label></li>
																				<li><label><input type="radio" name="size" /> <span>Waterfront</span></label></li>
																				<li><label><input type="radio" name="size" /> <span>Beachfront</span></label></li>
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</li>
													<li class="list-inline-item">
														<div class="search_option_button">
															<button type="submit" class="btn btn-thm">Search</button>
														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>
                                    </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

    <section id="feature-property" class="feature-property Communities">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<a href="#feature-property">
				    	<div class="mouse_scroll home5">
			        		<div class="icon">
					    		<h4>Scroll Down</h4>
					    		<p>to discover more</p>
			        		</div>
			        		<div class="thumb">
			        			<img loading="lazy" src="images/resource/mouse.png" alt="mouse.png">
			        		</div>
				    	</div>
				    </a>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="main-title text-center">
						<h2>COMMUNITIES</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					</div>
				</div>
			</div>
			<style>
			</style>
			<div class="row">
                @if ($states->count())
                @foreach ($states as $key => $item)
				<div class="col-lg-4 col-xl-4">
					<div class="grid-block-style1">
					   <a href="{{ route('property-by-city-area', ['city' => $item->location_states->slug, 'area' => $item->slug]) }}">

                        @if ($item->image != "")
						<div class="thumbnail" style="background-image: url({{ asset('/storage/'.$item->image) }});padding-top: 100%;background-size: cover;background-repeat: no-repeat;"></div>
                        @else
							<div class="thumbnail" style="background-image: url({{ asset('/common/default.png') }});padding-top: 100%;background-size: cover;background-repeat: no-repeat;"></div>
                        @endif
						<div class="overlay-panel">
							<div class="description">
						        <p class="pricing" style='background:#0000; font-size:24px'>Average Price <b>1,344</b> <sup> AED/Sqft</sup></p>
								<div><h4>{{ $item->name }}</h4></div>
								<p class="property-count">{{ $item->properties_count }}  Properties</p>
							</div>
						</div>
						</a>
					</div>
				</div>
                @endforeach
                @endif
			</div>

		</div>
	</section>


	<section id="our-partners" class="our-partners pt30">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="main-title text-center">
						<h2>Developers</h2>
						<p>We only work with the best companies around the globe</p>
					</div>
				</div>
			</div>
			<div class="row ourdev">
				@if ($developers->count())
                    @foreach ($developers as $item)
                        <div class="col-sm-6 col-md-4 col-lg">
                            <div class="our_partner">
                                @if ($item->image != "")
                                    <img loading="lazy" class="img-fluid" src="{{asset('/storage/'. $item->image)}}" alt="1.png">
                                @else
                                    <img loading="lazy" class="img-fluid" src="{{asset('website')}}/images/partners/1.png" alt="1.png">
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
			</div>
		</div>
	</section>

	{{-- <section id="feature-property" class="feature-property bgc-f7 Communities">
		<div class="container ovh">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="main-title text-center mb40">
						<h2>Featured Properties</h2>
						<p>Handpicked properties by our team.</p>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="feature_property_slider">
						@if ($featuredProperties->count())
                            @foreach ($featuredProperties as $proper)
                            	<div class="item">
                                    <div class="property-blk grid-layout">
                                        <a @if ($proper->property_type_id == 1)
                                            href="{{ route('list-single-buy-properties', $proper->slug) }}"
                                            @else
                                            href="{{ route('list-single-rents-properties', $proper->slug) }}"
                                            @endif>
                                        <div class="thumbnail">
                                            <img loading="lazy" class="img-whp" src="{{asset('storage/'.$proper->images[0]->image)}}" alt="fp1.jpg">
                                            <div class="button-on-thumb">
                                                <ul class="icon mb0">
                                                    <li class="list-inline-item"><button><span class="flaticon-transfer-1"></span></button></li>
                                                    <li class="list-inline-item"><button><span class="flaticon-heart"></span></button></li>
                                                </ul>
                                                </div>
                                        </div>
                                        <div class="detail-sec">
                                            <div class="content">

                                                 <a class="fp_price" href="#">AED <span>
                                                @if ($proper->property_type_id == 1)
                                                {{ number_format($proper->price) }}</a>
                                                @else
                                                    {{ number_format($proper->month_rent) }}</a>
                                                @endif
                                                </span> {{ $proper->property_type_id != 1 ? '/mon' : '' }}
                                                </a>

                                                <h4>{{ $proper->title }}</h4>
                                                <div class="text-thm">
                                                <div class=' tags-type-1'>
                                                <ul class="tag mb0">
                                                    <li class="list-inline-item"><a href="#">{{ $proper->property_type_id == 1 ? 'For Sale' : 'For Rent' }}</a></li>
                                                    <li class="list-inline-item"><a href="#">{{ $proper->category->name }}</a></li>
                                                </ul>
                                                </div>
                                                </div>
                                                <p class="property_desc">Exclusive! Furnished 2BR | High Floor | Canal View...</p>
                                                <ul class="prop_details mb0">
                                                    <li class="list-inline-item"><span><svg xmlns="http://www.w3.org/2000/svg" width="31.409" height="22.29" viewBox="0 0 31.409 22.29">
        <path id="bed" d="M38.9,96.718H38.4V92.665a2.029,2.029,0,0,0-2.026-2.026V82.026A2.029,2.029,0,0,0,34.343,80H13.066a2.029,2.029,0,0,0-2.026,2.026v8.612a2.029,2.029,0,0,0-2.026,2.026v4.053H8.507A.507.507,0,0,0,8,97.224v2.026a.507.507,0,0,0,.507.507h.507v2.026a.507.507,0,0,0,.507.507h1.52a.506.506,0,0,0,.5-.407l.426-2.126H35.447l.426,2.126a.506.506,0,0,0,.5.407h1.52a.507.507,0,0,0,.507-.507V99.757H38.9a.507.507,0,0,0,.507-.507V97.224A.507.507,0,0,0,38.9,96.718ZM12.053,82.026a1.015,1.015,0,0,1,1.013-1.013H34.343a1.015,1.015,0,0,1,1.013,1.013v8.612H34.343V88.612a2.029,2.029,0,0,0-2.026-2.026H26.237a2.029,2.029,0,0,0-2.026,2.026v2.026H23.2V88.612a2.029,2.029,0,0,0-2.026-2.026H15.092a2.029,2.029,0,0,0-2.026,2.026v2.026H12.053ZM33.33,88.612v2.026H25.224V88.612A1.015,1.015,0,0,1,26.237,87.6h6.079A1.015,1.015,0,0,1,33.33,88.612Zm-11.145,0v2.026H14.079V88.612A1.015,1.015,0,0,1,15.092,87.6h6.079A1.015,1.015,0,0,1,22.185,88.612ZM10.026,92.665a1.015,1.015,0,0,1,1.013-1.013h25.33a1.015,1.015,0,0,1,1.013,1.013v4.053H10.026Zm.6,8.612h-.6v-1.52h.9Zm26.758,0h-.6l-.3-1.52h.9ZM38.4,98.744H9.013V97.731H38.4Z" transform="translate(-8 -80)" fill="#30ccd3"/>
        </svg> Beds : {{ $proper->bed_no }}</span></li>
                                                    <li class="list-inline-item"><span><svg xmlns="http://www.w3.org/2000/svg" width="31.509" height="27.963" viewBox="0 0 31.509 27.963">
        <g id="bathing" transform="translate(-7.95 -39.95)">
            <path id="Path_1787" data-name="Path 1787" d="M38.9,55.2H34.343v-1.52a.507.507,0,0,0-.507-.507H27.757a.507.507,0,0,0-.507.507V55.2H13.066V43.546a2.533,2.533,0,1,1,5.066,0V44.6a3.044,3.044,0,0,0-2.533,3v.507a.507.507,0,0,0,.507.507h5.066a.507.507,0,0,0,.507-.507V47.6a3.044,3.044,0,0,0-2.533-3V43.546a3.546,3.546,0,0,0-7.092,0V55.2H8.507A.507.507,0,0,0,8,55.7v1.52a.507.507,0,0,0,.507.507h1.52v3.546a5.582,5.582,0,0,0,4.053,5.362v.717a.507.507,0,0,0,1.013,0v-.53c.167.015.336.023.507.023H31.81c.171,0,.339-.008.507-.023v.53a.507.507,0,0,0,1.013,0v-.717a5.582,5.582,0,0,0,4.053-5.362V57.731H38.9a.507.507,0,0,0,.507-.507V55.7A.507.507,0,0,0,38.9,55.2ZM20.665,47.6H16.612a2.026,2.026,0,0,1,4.053,0Zm7.6,6.586H33.33V62.8H28.264ZM9.013,56.718v-.507H27.251v.507Zm27.356,4.559a4.565,4.565,0,0,1-4.559,4.559H15.6a4.565,4.565,0,0,1-4.559-4.559V57.731H27.251V63.3a.507.507,0,0,0,.507.507h6.079a.507.507,0,0,0,.507-.507V57.731h2.026ZM38.4,56.718H34.343v-.507H38.4Z" transform="translate(0 0)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"/>
            <path id="Path_1788" data-name="Path 1788" d="M78.079,336H72.507a.507.507,0,0,0,0,1.013h5.573a.507.507,0,0,0,0-1.013Z" transform="translate(-59.947 -277.256)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"/>
            <path id="Path_1789" data-name="Path 1789" d="M185.52,336h-1.013a.507.507,0,0,0,0,1.013h1.013a.507.507,0,0,0,0-1.013Z" transform="translate(-164.855 -277.256)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"/>
            <path id="Path_1790" data-name="Path 1790" d="M257.52,171.04a1.52,1.52,0,1,0-1.52-1.52A1.52,1.52,0,0,0,257.52,171.04Zm0-2.026a.507.507,0,1,1-.507.507A.507.507,0,0,1,257.52,169.013Z" transform="translate(-232.296 -119.894)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"/>
            <path id="Path_1791" data-name="Path 1791" d="M298.533,93.066A2.533,2.533,0,1,0,296,90.533,2.533,2.533,0,0,0,298.533,93.066Zm0-4.053a1.52,1.52,0,1,1-1.52,1.52A1.52,1.52,0,0,1,298.533,89.013Z" transform="translate(-269.763 -44.96)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"/>
            <path id="Path_1792" data-name="Path 1792" d="M360,162.026A2.026,2.026,0,1,0,362.026,160,2.026,2.026,0,0,0,360,162.026Zm2.026-1.013a1.013,1.013,0,1,1-1.013,1.013A1.013,1.013,0,0,1,362.026,161.013Z" transform="translate(-329.71 -112.401)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"/>
        </g>
        </svg> Baths : {{ $proper->bath_no }}</span></li>
                                                    <li class="list-inline-item"><span><svg id="selection" xmlns="http://www.w3.org/2000/svg" width="31.409" height="31.409" viewBox="0 0 31.409 31.409">
        <g id="Group_990" data-name="Group 990">
            <path id="Path_1802" data-name="Path 1802" d="M30.6,6.443a.805.805,0,0,0,.805-.805V.805A.805.805,0,0,0,30.6,0H25.771a.805.805,0,0,0-.805.805V2.416H6.443V.805A.805.805,0,0,0,5.637,0H.805A.805.805,0,0,0,0,.805V5.637a.805.805,0,0,0,.805.805H2.416V24.966H.805A.805.805,0,0,0,0,25.771V30.6a.805.805,0,0,0,.805.805H5.637a.805.805,0,0,0,.805-.805V28.993H24.966V30.6a.805.805,0,0,0,.805.805H30.6a.805.805,0,0,0,.805-.805V25.771a.805.805,0,0,0-.805-.805H28.993V6.443ZM27.382,24.966H25.771a.805.805,0,0,0-.805.805v1.611H6.443V25.771a.805.805,0,0,0-.805-.805H4.027V6.443H5.637a.805.805,0,0,0,.805-.805V4.027H24.966V5.637a.805.805,0,0,0,.805.805h1.611V24.966Z" fill="#30ccd3"/>
        </g>
        </svg> Sq Ft: {{ number_format($proper->size_sqft) }}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="fp_footer">
                                                <div class="btn-group mb-3 d-block text-center">
                                                                    <a class="call-btn-1 raise" href="#">Call <i class="fa fa-phone"></i></a> <a class="call-btn-2 raise" href="#">Email <i class="fa fa-envelope-o"></i></a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
					</div>
				</div>
			</div>
		</div>
	</section> --}}


	<!-- Our Testimonials -->
	<section id="our-testimonials" class="our-testimonials">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="main-title text-center">
						<h2 class="mt0">What Our Users Say</h2>
						<p>Discover how Listable can you help you find everything you want.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
					<div class="testimonialsec">
						<ul class="tes-nav">
							<li>
								<img loading="lazy" class="img-fluid" src="{{asset('website')}}/images/testimonial/5.png" alt="5.png"/>
							</li>
							<li>
								<img loading="lazy" class="img-fluid" src="{{asset('website')}}/images/testimonial/3.png" alt="3.png"/>
							</li>
							<li>
								<img loading="lazy" class="img-fluid" src="{{asset('website')}}/images/testimonial/4.png" alt="4.png"/>
							</li>
							<li>
								<img loading="lazy" class="img-fluid" src="{{asset('website')}}/images/testimonial/6.png" alt="6.png"/>
							</li>
							<li>
								<img loading="lazy" class="img-fluid" src="{{asset('website')}}/images/testimonial/7.png" alt="7.png"/>
							</li>
							<li>
								<img loading="lazy" class="img-fluid" src="{{asset('website')}}/images/testimonial/4.png" alt="4.png"/>
							</li>
						</ul>
						<ul class="tes-for">
							<li>
								<div class="testimonial_item">
									<div class="details">
										<h4>Lara Croft</h4>
										<span class="small text-thm">Restaurant Owner</span>
										<p>Especially i want to give thanks to support team, this guys are friendly, correct, gave me quick and complete answers.</p>
										<p class="mt25">Good job!</p>
									</div>
								</div>
							</li>
							<li>
								<div class="testimonial_item">
									<div class="details">
										<h4>Ali Tufan</h4>
										<span class="small text-thm">Restaurant Owner</span>
										<p>Especially i want to give thanks to support team, this guys are friendly, correct, gave me quick and complete answers.</p>
										<p class="mt25">Good job!</p>
									</div>
								</div>
							</li>
							<li>
								<div class="testimonial_item">
									<div class="details">
										<h4>Ali Tufan</h4>
										<span class="small text-thm">Restaurant Owner</span>
										<p>Especially i want to give thanks to support team, this guys are friendly, correct, gave me quick and complete answers.</p>
										<p class="mt25">Good job!</p>
									</div>
								</div>
							</li>
							<li>
								<div class="testimonial_item">
									<div class="details">
										<h4>Ali Tufan</h4>
										<span class="small text-thm">Restaurant Owner</span>
										<p>Especially i want to give thanks to support team, this guys are friendly, correct, gave me quick and complete answers.</p>
										<p class="mt25">Good job!</p>
									</div>
								</div>
							</li>
							<li>
								<div class="testimonial_item">
									<div class="details">
										<h4>Ali Tufan</h4>
										<span class="small text-thm">Restaurant Owner</span>
										<p>Especially i want to give thanks to support team, this guys are friendly, correct, gave me quick and complete answers.</p>
										<p class="mt25">Good job!</p>
									</div>
								</div>
							</li>
							<li>
								<div class="testimonial_item">
									<div class="details">
										<h4>Ali Tufan</h4>
										<span class="small text-thm">Restaurant Owner</span>
										<p>Especially i want to give thanks to support team, this guys are friendly, correct, gave me quick and complete answers.</p>
										<p class="mt25">Good job!</p>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Our Blog -->
	<section class="our-blog Articles">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<div class="main-title text-center">
						<h2>Articles & News</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					</div>
				</div>
			</div>
			<div class="row">
                @if ($news->count())
                    @foreach ($news as $new)
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="for_blog feat_property">
                                <div class="thumb">
                                    <img loading="lazy" class="img-whp" src="{{asset('/storage/'.$new->image)}}" alt="bh1.jpg">
                                </div>
                                <div class="details">
                                    <div class="tc_content">
                                        <p class="text-thm">{{ $new->categories->name }}</p>
                                        <h4>{{ $new->title }}</h4>
                                    </div>
                                    <div class="fp_footer">
                                        <ul class="fp_meta float-left mb0">
                                            <li class="list-inline-item"><a href="#"><img loading="lazy" src="{{asset('/storage/'.$new->company->avatar)}}" alt="pposter1.png"></a></li>
                                            <li class="list-inline-item"><a href="#">{{ $new->company->name }}</a></li>
                                        </ul>
                                        <a class="fp_pdate float-right" href="#">Hello World</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="for_blog feat_property">
                                <div class="thumb">
                                    <img loading="lazy" class="img-whp" src="{{asset('/storage/'.$new->image)}}" alt="Artiacal Image">
                                </div>
                                <div class="details">
                                    <div class="tc_content">
                                        <p class="text-thm">{{ $new->categories->name }}</p>
                                        <h4>{{ $new->title }}</h4>
                                    </div>
                                    <div class="fp_footer">
                                        <ul class="fp_meta float-left mb0">
                                            <li class="list-inline-item"><a href="#"><img loading="lazy" src="{{asset('/storage/'.$new->company->avatar)}}" alt="Publisher Image"></a></li>
                                            <li class="list-inline-item"><a href="#">{{ $new->company->name }}</a></li>
                                        </ul>
                                        <a class="fp_pdate float-right" href="#">7 August 2019</a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    @endforeach
                @endif
			</div>
		</div>
	</section>
{{-- @include('website.auth.auth-modals') --}}

@endsection
