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
				{{-- <div class="col-sm-6 col-lg-7 col-xl-8">
					<div class="single_property_title">
						<a href="images/property/ls1.jpg" class="upload_btn popup-img"><span class="flaticon-photo-camera"></span> View Photos</a>
					</div>
				</div> --}}
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
                            @if (count($maneities_array))
                            @foreach ($maneities_array as $item)
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
                                   <div class="amenities-title">{{ $item }}</div>
                                </div>
                             </div>
                             @endforeach
                             @endif
                             <div class="col-md-2">
                                <div class="amenities-box">
                                   <div class="amenities-icon">
                                      <h2>16+</h2>
                                   </div>
                                   <div class="amenities-title">Amenities</div>
                                </div>
                             </div>
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
                                <tr>
                                   <td><strong>Agent:</strong></td>
                                   <td>{{ $property->agent->name }}</td>
                                </tr>
                             </tbody>
                          </table>
                       </div>
                       <hr>
                    </div>
                 </div>
              </div>
           </div>

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
           {{-- <div class="row pt-3 near-by-places">
              <div class="col-md-12">
                 <h3><strong class="titles-type1">Nearby Places</strong></h3>
              </div>
              <div class="col-md-12">
                 <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                       <a class="nav-item nav-link active" id="nav-schools-tab" data-toggle="tab" href="#nav-schools" role="tab" aria-controls="nav-schools" aria-selected="true">
                          <button class="pushable">
                             <span class="front">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40.607" height="35.09" viewBox="0 0 40.607 35.09">
                                   <g id="graduation-hat" transform="translate(-1983.971 -1523.23)">
                                      <g id="Group_10453" data-name="Group 10453" transform="translate(1983.97 1523.23)">
                                         <g id="Path_20" data-name="Path 20">
                                            <path id="Path_20-2" data-name="Path 20" d="M2022.735,1551.527a3.216,3.216,0,0,0-.3-5.939l-.34-.124v-13.587l1.7-.679-19.949-7.967-19.877,7.967,9.192,3.685v6.269c0,1.616,1.184,3.1,3.325,4.169a17.04,17.04,0,0,0,7.35,1.534,16.811,16.811,0,0,0,7.391-1.544c2.131-1.06,3.3-2.542,3.3-4.159v-6.258l6.094-2.429v13l-.34.124a3.218,3.218,0,0,0-.319,5.939l.412.2-2.038,6.135,1.379.463,1.637-4.9,1.637,4.9,1.379-.463-2.048-6.135Zm-9.656-10.376c0,2.306-4.23,4.251-9.233,4.251s-9.223-1.945-9.223-4.251v-5.682l9.233,3.7,9.223-3.685Zm-9.233-3.562-15.955-6.392,15.955-6.392,16.006,6.392Zm15.749,11.035a1.76,1.76,0,1,1,1.76,1.76A1.759,1.759,0,0,1,2019.6,1548.624Z" transform="translate(-1983.97 -1523.23)" fill="#30ccd3"/>
                                         </g>
                                      </g>
                                   </g>
                                </svg>
                                Schools
                             </span>
                          </button>
                       </a>
                       <a class="nav-item nav-link" id="nav-hospitals-tab" data-toggle="tab" href="#nav-hospitals" role="tab" aria-controls="nav-hospitals" aria-selected="false">
                          <button class="pushable">
                             <span class="front">
                                <svg xmlns="http://www.w3.org/2000/svg" width="35.09" height="35.09" viewBox="0 0 35.09 35.09">
                                   <g id="hospital" transform="translate(-2 -2)">
                                      <path id="Path_21" data-name="Path 21" d="M36.505,12.527H28.9V2.585A.585.585,0,0,0,28.317,2H10.772a.585.585,0,0,0-.585.585v9.942h-7.6A.585.585,0,0,0,2,13.112V36.505a.585.585,0,0,0,.585.585h33.92a.585.585,0,0,0,.585-.585V13.112A.585.585,0,0,0,36.505,12.527ZM3.17,13.7h7.018V35.92H3.17ZM21.3,30.072V35.92H17.79V30.072Zm6.433,5.848H22.469V30.072h1.17V28.9H15.451v1.17h1.17V35.92H11.357V3.17H27.733Zm8.188,0H28.9V13.7H35.92Z" fill="#30ccd3"/>
                                      <path id="Path_22" data-name="Path 22" d="M50.585,28.679h3.509a.585.585,0,0,0,.585-.585V24.585A.585.585,0,0,0,54.094,24H50.585a.585.585,0,0,0-.585.585v3.509A.585.585,0,0,0,50.585,28.679Zm.585-3.509h2.339v2.339H51.17Z" transform="translate(-19.928 -9.134)" fill="#30ccd3"/>
                                      <path id="Path_23" data-name="Path 23" d="M50.585,38.679h3.509a.585.585,0,0,0,.585-.585V34.585A.585.585,0,0,0,54.094,34H50.585a.585.585,0,0,0-.585.585v3.509A.585.585,0,0,0,50.585,38.679Zm.585-3.509h2.339v2.339H51.17Z" transform="translate(-19.928 -13.285)" fill="#30ccd3"/>
                                      <path id="Path_24" data-name="Path 24" d="M50.585,48.679h3.509a.585.585,0,0,0,.585-.585V44.585A.585.585,0,0,0,54.094,44H50.585a.585.585,0,0,0-.585.585v3.509A.585.585,0,0,0,50.585,48.679Zm.585-3.509h2.339v2.339H51.17Z" transform="translate(-19.928 -17.437)" fill="#30ccd3"/>
                                      <path id="Path_25" data-name="Path 25" d="M10.094,24H6.585A.585.585,0,0,0,6,24.585v3.509a.585.585,0,0,0,.585.585h3.509a.585.585,0,0,0,.585-.585V24.585A.585.585,0,0,0,10.094,24Zm-.585,3.509H7.17V25.17H9.509Z" transform="translate(-1.661 -9.134)" fill="#30ccd3"/>
                                      <path id="Path_26" data-name="Path 26" d="M20.585,25.509h2.339a.585.585,0,0,0,.585-.585V22.585A.585.585,0,0,0,22.924,22H20.585a.585.585,0,0,0-.585.585v2.339A.585.585,0,0,0,20.585,25.509Zm.585-2.339h1.17v1.17H21.17Z" transform="translate(-7.473 -8.303)" fill="#30ccd3"/>
                                      <path id="Path_27" data-name="Path 27" d="M31.924,22H29.585a.585.585,0,0,0-.585.585v2.339a.585.585,0,0,0,.585.585h2.339a.585.585,0,0,0,.585-.585V22.585A.585.585,0,0,0,31.924,22Zm-.585,2.339H30.17V23.17h1.17Z" transform="translate(-11.21 -8.303)" fill="#30ccd3"/>
                                      <path id="Path_28" data-name="Path 28" d="M38,22.585v2.339a.585.585,0,0,0,.585.585h2.339a.585.585,0,0,0,.585-.585V22.585A.585.585,0,0,0,40.924,22H38.585A.585.585,0,0,0,38,22.585Zm1.17.585h1.17v1.17H39.17Z" transform="translate(-14.946 -8.303)" fill="#30ccd3"/>
                                      <path id="Path_29" data-name="Path 29" d="M20.585,33.509h2.339a.585.585,0,0,0,.585-.585V30.585A.585.585,0,0,0,22.924,30H20.585a.585.585,0,0,0-.585.585v2.339A.585.585,0,0,0,20.585,33.509Zm.585-2.339h1.17v1.17H21.17Z" transform="translate(-7.473 -11.625)" fill="#30ccd3"/>
                                      <path id="Path_30" data-name="Path 30" d="M31.924,30H29.585a.585.585,0,0,0-.585.585v2.339a.585.585,0,0,0,.585.585h2.339a.585.585,0,0,0,.585-.585V30.585A.585.585,0,0,0,31.924,30Zm-.585,2.339H30.17V31.17h1.17Z" transform="translate(-11.21 -11.625)" fill="#30ccd3"/>
                                      <path id="Path_31" data-name="Path 31" d="M40.924,30H38.585a.585.585,0,0,0-.585.585v2.339a.585.585,0,0,0,.585.585h2.339a.585.585,0,0,0,.585-.585V30.585A.585.585,0,0,0,40.924,30Zm-.585,2.339H39.17V31.17h1.17Z" transform="translate(-14.946 -11.625)" fill="#30ccd3"/>
                                      <path id="Path_32" data-name="Path 32" d="M20.585,41.509h2.339a.585.585,0,0,0,.585-.585V38.585A.585.585,0,0,0,22.924,38H20.585a.585.585,0,0,0-.585.585v2.339A.585.585,0,0,0,20.585,41.509Zm.585-2.339h1.17v1.17H21.17Z" transform="translate(-7.473 -14.946)" fill="#30ccd3"/>
                                      <path id="Path_33" data-name="Path 33" d="M31.924,38H29.585a.585.585,0,0,0-.585.585v2.339a.585.585,0,0,0,.585.585h2.339a.585.585,0,0,0,.585-.585V38.585A.585.585,0,0,0,31.924,38Zm-.585,2.339H30.17V39.17h1.17Z" transform="translate(-11.21 -14.946)" fill="#30ccd3"/>
                                      <path id="Path_34" data-name="Path 34" d="M40.924,38H38.585a.585.585,0,0,0-.585.585v2.339a.585.585,0,0,0,.585.585h2.339a.585.585,0,0,0,.585-.585V38.585A.585.585,0,0,0,40.924,38Zm-.585,2.339H39.17V39.17h1.17Z" transform="translate(-14.946 -14.946)" fill="#30ccd3"/>
                                      <path id="Path_35" data-name="Path 35" d="M10.094,34H6.585A.585.585,0,0,0,6,34.585v3.509a.585.585,0,0,0,.585.585h3.509a.585.585,0,0,0,.585-.585V34.585A.585.585,0,0,0,10.094,34Zm-.585,3.509H7.17V35.17H9.509Z" transform="translate(-1.661 -13.285)" fill="#30ccd3"/>
                                      <path id="Path_36" data-name="Path 36" d="M10.094,44H6.585A.585.585,0,0,0,6,44.585v3.509a.585.585,0,0,0,.585.585h3.509a.585.585,0,0,0,.585-.585V44.585A.585.585,0,0,0,10.094,44Zm-.585,3.509H7.17V45.17H9.509Z" transform="translate(-1.661 -17.437)" fill="#30ccd3"/>
                                      <path id="Path_37" data-name="Path 37" d="M25.585,11.848h1.754V13.6a.585.585,0,0,0,.585.585h2.339a.585.585,0,0,0,.585-.585V11.848H32.6a.585.585,0,0,0,.585-.585V8.924a.585.585,0,0,0-.585-.585H30.848V6.585A.585.585,0,0,0,30.263,6H27.924a.585.585,0,0,0-.585.585V8.339H25.585A.585.585,0,0,0,25,8.924v2.339A.585.585,0,0,0,25.585,11.848Zm.585-2.339h1.754a.585.585,0,0,0,.585-.585V7.17h1.17V8.924a.585.585,0,0,0,.585.585h1.754v1.17H30.263a.585.585,0,0,0-.585.585v1.754h-1.17V11.263a.585.585,0,0,0-.585-.585H26.17Z" transform="translate(-9.549 -1.661)" fill="#30ccd3"/>
                                      <path id="Path_38" data-name="Path 38" d="M42,56h1.17v1.17H42Z" transform="translate(-16.607 -22.419)" fill="#30ccd3"/>
                                      <path id="Path_39" data-name="Path 39" d="M42,52h1.17v1.17H42Z" transform="translate(-16.607 -20.758)" fill="#30ccd3"/>
                                      <path id="Path_40" data-name="Path 40" d="M42,48h1.17v1.17H42Z" transform="translate(-16.607 -19.098)" fill="#30ccd3"/>
                                   </g>
                                </svg>
                                Hospitals
                             </span>
                          </button>
                       </a>
                       <a class="nav-item nav-link" id="nav-resturant-tab" data-toggle="tab" href="#nav-resturant" role="tab" aria-controls="nav-resturant" aria-selected="false">
                          <button class="pushable">
                             <span class="front">
                                <svg xmlns="http://www.w3.org/2000/svg" width="35.09" height="35.09" viewBox="0 0 35.09 35.09">
                                   <g id="shop" transform="translate(-16 -16)">
                                      <path id="Path_44" data-name="Path 44" d="M50.505,45.826H46.411V34.078a2.543,2.543,0,0,0,1.861-3.4l-1.861-4.84V16.585A.585.585,0,0,0,45.826,16H21.263a.585.585,0,0,0-.585.585v9.248l-1.861,4.84a2.543,2.543,0,0,0,1.861,3.4V45.826H16.585a.585.585,0,0,0-.585.585v4.094a.585.585,0,0,0,.585.585h33.92a.585.585,0,0,0,.585-.585V46.411A.585.585,0,0,0,50.505,45.826Zm-6.433,0V33.353a2.538,2.538,0,0,0,1.17.689V45.826Zm-4.679.585V49.92H37.054V45.826h1.17a.585.585,0,0,0,.585-.585V43.487a.585.585,0,0,0-.585-.585H34.715a.585.585,0,0,0-.585.585v1.754a.585.585,0,0,0,.585.585h1.17V49.92H33.545V46.411a.585.585,0,0,0-.585-.585H31.79V44.072a.585.585,0,0,0-.585-.585h-1.17V34.076a2.542,2.542,0,0,0,1.445-.871c.036.045.074.088.114.13a2.519,2.519,0,0,0,1.847.795h.206a2.519,2.519,0,0,0,1.847-.795c.04-.042.078-.086.114-.13a2.584,2.584,0,0,0,.276.285V35.3a2.927,2.927,0,0,0-2.924,2.924.585.585,0,0,0,.585.585h5.848a.585.585,0,0,0,.585-.585A2.927,2.927,0,0,0,37.054,35.3V34.076a2.51,2.51,0,0,0,.517.053h.183a2.54,2.54,0,0,0,1.939-.9c.015-.018.03-.036.044-.054a2.534,2.534,0,0,0,1.987.952h.113A2.55,2.55,0,0,0,42.9,33.9v9.588h-1.17a.585.585,0,0,0-.585.585v1.754h-1.17A.585.585,0,0,0,39.393,46.411ZM35.3,44.657v-.585h2.339v.585ZM23.927,31.225l1.291-4.7h2.374l-.871,5.283a1.369,1.369,0,0,1-1.355,1.15h-.113a1.374,1.374,0,0,1-1.325-1.735Zm.26,2.673a2.55,2.55,0,0,0,1.065.231h.113a2.534,2.534,0,0,0,1.987-.952c.014.018.029.037.044.054a2.538,2.538,0,0,0,1.469.854v2.968H24.188Zm5.149-.939a1.373,1.373,0,0,1-1.355-1.6l.8-4.836h2.395l-.282,5.135a1.374,1.374,0,0,1-1.371,1.3Zm5.309-.429a1.362,1.362,0,0,1-1,.429h-.206a1.373,1.373,0,0,1-1.371-1.445l.273-4.988h2.4l.273,4.984v0a1.357,1.357,0,0,1-.374,1.016Zm1.554-.869-.282-5.135h2.395l.8,4.836a1.373,1.373,0,0,1-1.355,1.6h-.183a1.374,1.374,0,0,1-1.371-1.3Zm.855,4.807a1.758,1.758,0,0,1,1.654,1.17H34.23a1.758,1.758,0,0,1,1.654-1.17Zm5.875-4.05a1.363,1.363,0,0,1-1.092.541h-.113a1.369,1.369,0,0,1-1.355-1.15L39.5,26.527h2.374l1.29,4.7v0a1.365,1.365,0,0,1-.233,1.194Zm-.612,12.238H42.9v1.17h-.585Zm4.864-13.564a1.374,1.374,0,1,1-2.607.857l-1.49-5.424h2.341ZM21.848,17.17H45.242v8.188H21.848Zm-1.79,15.195a1.355,1.355,0,0,1-.15-1.271l1.756-4.566h2.341l-1.49,5.424a1.378,1.378,0,0,1-1.325,1.01A1.355,1.355,0,0,1,20.059,32.364Zm1.79,1.678a2.538,2.538,0,0,0,1.17-.689V45.826h-1.17ZM26.527,49.92H17.17V47h9.357Zm.585-4.094H24.188v-7.6h4.679v11.7H27.7V46.411A.585.585,0,0,0,27.112,45.826Zm2.924-1.17h.585v1.754a.585.585,0,0,0,.585.585h1.17V49.92H30.036ZM49.92,49.92H40.563V47H49.92Z" fill="#30ccd3"/>
                                      <path id="Path_45" data-name="Path 45" d="M200.772,44.094h-.634a3.517,3.517,0,0,0-2.874-2.874v-.634a.585.585,0,1,0-1.17,0v.635a3.517,3.517,0,0,0-2.875,2.874h-.634a.585.585,0,0,0-.585.585,2.342,2.342,0,0,0,2.339,2.339h4.679a2.342,2.342,0,0,0,2.339-2.339A.585.585,0,0,0,200.772,44.094Zm-4.094-1.754a2.344,2.344,0,0,1,2.265,1.754h-4.531A2.344,2.344,0,0,1,196.679,42.339Zm2.339,3.509h-4.679a1.17,1.17,0,0,1-1.013-.585h6.7A1.17,1.17,0,0,1,199.018,45.848Z" transform="translate(-163.134 -22.246)" fill="#30ccd3"/>
                                      <path id="Path_46" data-name="Path 46" d="M140.418,50.241a.585.585,0,0,0,.26-.487V48h-1.17v1.421a2.574,2.574,0,0,1-.585.214V48h-1.17v1.634a2.575,2.575,0,0,1-.585-.214V48H136v1.754a.585.585,0,0,0,.26.487,3.749,3.749,0,0,0,1.494.585v3.607h1.17V50.826A3.749,3.749,0,0,0,140.418,50.241Z" transform="translate(-111.228 -29.661)" fill="#30ccd3"/>
                                      <path id="Path_47" data-name="Path 47" d="M314.337,40a2.339,2.339,0,0,0-.585,4.6v2.413h1.17V44.6a2.339,2.339,0,0,0-.585-4.6Zm0,3.509a1.17,1.17,0,1,1,1.17-1.17,1.17,1.17,0,0,1-1.17,1.17Z" transform="translate(-274.359 -22.246)" fill="#30ccd3"/>
                                   </g>
                                </svg>
                                Resturants
                             </span>
                          </button>
                       </a>
                       <a class="nav-item nav-link" id="nav-park-tab" data-toggle="tab" href="#nav-park" role="tab" aria-controls="nav-park" aria-selected="false">
                          <button class="pushable">
                             <span class="front">
                                <svg xmlns="http://www.w3.org/2000/svg" width="41.773" height="35.261" viewBox="0 0 41.773 35.261">
                                   <g id="park" transform="translate(0 -39.916)">
                                      <path id="Path_41" data-name="Path 41" d="M48.039,46.4h2.7a.612.612,0,0,0,0-1.224h-2.7a1.879,1.879,0,0,1-1.882-1.764c0-.031,0-.061,0-.091a2.181,2.181,0,0,1,3.88-1.369.612.612,0,0,0,.734.17,1.757,1.757,0,0,1,.747-.165,1.78,1.78,0,0,1,1.533.882.612.612,0,0,0,.84.219,1.313,1.313,0,0,1,1.959.9.612.612,0,0,0,.6.5h1.98a.382.382,0,0,1,.39.351.358.358,0,0,1-.358.365H53.184a.612.612,0,0,0,0,1.224h5.278a1.582,1.582,0,0,0,1.582-1.611,1.606,1.606,0,0,0-1.614-1.553H56.907a2.537,2.537,0,0,0-3.123-1.463,3,3,0,0,0-3.1-.921,3.405,3.405,0,0,0-5.75,2.469q0,.069,0,.139A3.076,3.076,0,0,0,48.039,46.4Z" transform="translate(-41.265)" fill="#30ccd3"/>
                                      <path id="Path_42" data-name="Path 42" d="M41.162,189.841h-.4a5.452,5.452,0,0,0,.932-3.587,22.8,22.8,0,0,0-1.186-6.867c-.637-1.861-1.737-4.08-3.363-4.08-.818,0-1.576.556-2.261,1.654a2.9,2.9,0,0,0-2.26-1.654c-.986,0-1.884.8-2.671,2.392a1.519,1.519,0,0,0-.513-.09h-6.1a.612.612,0,0,0,0,1.224h6.1a.306.306,0,0,1,.306.306v.692a.306.306,0,0,1-.306.306H12.334a.306.306,0,0,1-.306-.306v-.692a.306.306,0,0,1,.306-.306h8.559a.612.612,0,0,0,0-1.224H15.819A8.167,8.167,0,1,0,7.67,182.4v3.485a2.933,2.933,0,0,0-1.074.054A3.625,3.625,0,0,0,.507,189.85a.612.612,0,0,0,.1,1.214h40.55a.612.612,0,0,0,0-1.224Zm-28.8-.893a2.551,2.551,0,0,0-.094-.527h1.954v1.42H12.271A2.606,2.606,0,0,0,12.363,188.948Zm13.282-5.062v.9H16.4v-.9Zm2.593,0c-.039.306-.071.607-.1.9H26.869v-.9Zm2.561,2.125a.141.141,0,0,1,.141.141v.9a.141.141,0,0,1-.141.141H10.975a.141.141,0,0,1-.141-.141v-.9a.141.141,0,0,1,.141-.141Zm-15.352,2.41H26.6v1.42H15.447Zm12.373,0h.49a3.554,3.554,0,0,0,.7,1.42H27.82v-1.42Zm7.758-10.193c.53-1.063,1.116-1.7,1.568-1.7.5,0,1.384.852,2.205,3.252a21.822,21.822,0,0,1,1.12,6.471c0,3.45-1.252,3.45-3.326,3.45-.255,0-.523,0-.788-.011a5.746,5.746,0,0,0,.816-3.439,22.8,22.8,0,0,0-1.186-6.867c-.125-.366-.269-.746-.43-1.121.007-.012.015-.024.021-.037Zm-2.954-1.7c.5,0,1.384.852,2.205,3.252a21.822,21.822,0,0,1,1.12,6.471c0,3.45-1.252,3.45-3.326,3.45-1.645,0-2.585-.062-3.034-1.282H30.8a1.366,1.366,0,0,0,1.365-1.365v-.9a1.366,1.366,0,0,0-1.365-1.365H29.37c.027-.295.061-.6.1-.9a1.53,1.53,0,0,0,1.5-1.528v-.692a1.52,1.52,0,0,0-.309-.917,1.519,1.519,0,0,0,.309-.917v-.692a1.52,1.52,0,0,0-.1-.534.613.613,0,0,0,.043-.076C31.486,177.277,32.125,176.53,32.624,176.53Zm-3.184,4.829a.306.306,0,0,1,.306.306v.692a.306.306,0,0,1-.306.306H12.334a.306.306,0,0,1-.306-.306v-.692a.306.306,0,0,1,.306-.306ZM1.424,174.266a6.943,6.943,0,1,1,13.058,3.292c-.009.017-.017.034-.024.051H12.334a1.531,1.531,0,0,0-1.529,1.529v.692a1.52,1.52,0,0,0,.255.843.621.621,0,0,0-.068.023,6.879,6.879,0,0,1-2.1.491v-4.821l2.114-2.114a.612.612,0,0,0-.865-.865l-1.249,1.249v-1.6a.612.612,0,0,0-1.224,0v3.679L6.493,175.54a.612.612,0,0,0-.865.865l2.043,2.043v2.726a6.953,6.953,0,0,1-6.246-6.908Zm7.47,8.15a8.106,8.106,0,0,0,1.911-.353v.294a1.531,1.531,0,0,0,1.529,1.529h2.84v.9h-4.2a1.366,1.366,0,0,0-1.365,1.365v.394a2.546,2.546,0,0,0-.387.054,2.934,2.934,0,0,0-.329-.252v-3.932Zm-6.867,7.425a2.381,2.381,0,0,1-.753-1.851,2.416,2.416,0,0,1,2.286-2.3A2.387,2.387,0,0,1,5.8,186.962a.612.612,0,0,0,.789.271,1.7,1.7,0,0,1,1.994.456.612.612,0,0,0,.694.172,1.354,1.354,0,0,1,.537-.1,1.363,1.363,0,0,0,1.134.655,1.36,1.36,0,0,1,0,1.421Z" transform="translate(0 -115.888)" fill="#30ccd3"/>
                                      <path id="Path_43" data-name="Path 43" d="M256.926,124.97h6.12a.612.612,0,1,0,0-1.224h-6.12a.729.729,0,0,1-.739-.71s0-.009,0-.011a1.569,1.569,0,0,1,1.529-1.56.612.612,0,0,0,.591-.512,3.121,3.121,0,0,1,6.16.015.612.612,0,0,0,.682.51,1.585,1.585,0,0,1,.2-.015,1.569,1.569,0,0,1,1.348.774.612.612,0,0,0,.528.3H268.9a.6.6,0,0,1,0,1.206h-3.41a.612.612,0,0,0,0,1.224h3.41a1.827,1.827,0,0,0,0-3.654h-1.355a2.8,2.8,0,0,0-1.991-1.069,4.346,4.346,0,0,0-8.358.049,2.8,2.8,0,0,0-2.237,2.729v.019a1.956,1.956,0,0,0,1.963,1.926Z" transform="translate(-234.16 -70.905)" fill="#30ccd3"/>
                                   </g>
                                </svg>
                                Parks
                             </span>
                          </button>
                       </a>
                    </div>
                 </nav>
                 <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-schools" role="tabpanel" aria-labelledby="nav-schools-tab">
                       <div class="row">
                          <div class="col-md-8">
                             <div id="map-canvas"></div>
                          </div>
                          <div class="col-md-4">
                             <a href="#">
                                <div class="list-location" style="display:flex;">
                                   <div class="location"><img loading="lazy" src=
                                      "https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/geocode-71.png">
                                   </div>
                                   <div class="detials">
                                      <h2 class="loc-title">Grammer School Sydney</h2>
                                      <p class="loc-description">45GW 9W Pyrmont NSW, Australia</p>
                                   </div>
                                </div>
                             </a>
                             <a href="#">
                                <div class="list-location" style="display:flex;">
                                   <div class="location"><img loading="lazy" src=
                                      "https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/geocode-71.png">
                                   </div>
                                   <div class="detials">
                                      <h2 class="loc-title">Grammer School Sydney</h2>
                                      <p class="loc-description">45GW 9W Pyrmont NSW, Australia</p>
                                   </div>
                                </div>
                             </a>
                             <a href="#">
                                <div class="list-location" style="display:flex;">
                                   <div class="location"><img loading="lazy" src=
                                      "https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/geocode-71.png">
                                   </div>
                                   <div class="detials">
                                      <h2 class="loc-title">Grammer School Sydney</h2>
                                      <p class="loc-description">45GW 9W Pyrmont NSW, Australia</p>
                                   </div>
                                </div>
                             </a>
                          </div>
                       </div>
                    </div>
                    <div class="tab-pane fade" id="nav-hospitals" role="tabpanel" aria-labelledby="nav-hospitals-tab">
                       <div class="row">
                          <div class="col-md-8">

                          </div>
                          <div class="col-md-4">
                             <a href="#">
                                <div class="list-location" style="display:flex;">
                                   <div class="location"><img loading="lazy" src=
                                      "https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/geocode-71.png">
                                   </div>
                                   <div class="detials">
                                      <h2 class="loc-title">Grammer Hospital Sydney</h2>
                                      <p class="loc-description">45GW 9W Pyrmont NSW, Australia</p>
                                   </div>
                                </div>
                             </a>
                             <a href="#">
                                <div class="list-location" style="display:flex;">
                                   <div class="location"><img loading="lazy" src=
                                      "https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/geocode-71.png">
                                   </div>
                                   <div class="detials">
                                      <h2 class="loc-title">Grammer Hospital Sydney</h2>
                                      <p class="loc-description">45GW 9W Pyrmont NSW, Australia</p>
                                   </div>
                                </div>
                             </a>
                             <a href="#">
                                <div class="list-location" style="display:flex;">
                                   <div class="location"><img loading="lazy" src=
                                      "https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/geocode-71.png">
                                   </div>
                                   <div class="detials">
                                      <h2 class="loc-title">Grammer Hospital Sydney</h2>
                                      <p class="loc-description">45GW 9W Pyrmont NSW, Australia</p>
                                   </div>
                                </div>
                             </a>
                          </div>
                       </div>
                    </div>
                    <div class="tab-pane fade" id="nav-resturant" role="tabpanel" aria-labelledby="nav-resturant-tab">
                       <div class="row">
                          <div class="col-md-8">

                          </div>
                          <div class="col-md-4">
                             <a href="#">
                                <div class="list-location" style="display:flex;">
                                   <div class="location"><img loading="lazy" src=
                                      "https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/geocode-71.png">
                                   </div>
                                   <div class="detials">
                                      <h2 class="loc-title">Resturants Sydney</h2>
                                      <p class="loc-description">45GW 9W Pyrmont NSW, Australia</p>
                                   </div>
                                </div>
                             </a>
                             <a href="#">
                                <div class="list-location" style="display:flex;">
                                   <div class="location"><img loading="lazy" src=
                                      "https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/geocode-71.png">
                                   </div>
                                   <div class="detials">
                                      <h2 class="loc-title">Resturants Sydney</h2>
                                      <p class="loc-description">45GW 9W Pyrmont NSW, Australia</p>
                                   </div>
                                </div>
                             </a>
                             <a href="#">
                                <div class="list-location" style="display:flex;">
                                   <div class="location"><img loading="lazy" src=
                                      "https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/geocode-71.png">
                                   </div>
                                   <div class="detials">
                                      <h2 class="loc-title">Resturants Sydney</h2>
                                      <p class="loc-description">45GW 9W Pyrmont NSW, Australia</p>
                                   </div>
                                </div>
                             </a>
                          </div>
                       </div>
                    </div>
                    <div class="tab-pane fade" id="nav-park" role="tabpanel" aria-labelledby="nav-park-tab">
                       <div class="row">
                          <div class="col-md-8">

                          </div>
                          <div class="col-md-4">
                             <a href="#">
                                <div class="list-location" style="display:flex;">
                                   <div class="location"><img loading="lazy" src=
                                      "https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/geocode-71.png">
                                   </div>
                                   <div class="detials">
                                      <h2 class="loc-title">Sydney Park</h2>
                                      <p class="loc-description">45GW 9W Pyrmont NSW, Australia</p>
                                   </div>
                                </div>
                             </a>
                             <a href="#">
                                <div class="list-location" style="display:flex;">
                                   <div class="location"><img loading="lazy" src=
                                      "https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/geocode-71.png">
                                   </div>
                                   <div class="detials">
                                      <h2 class="loc-title">Sydney Park</h2>
                                      <p class="loc-description">45GW 9W Pyrmont NSW, Australia</p>
                                   </div>
                                </div>
                             </a>
                             <a href="#">
                                <div class="list-location" style="display:flex;">
                                   <div class="location"><img loading="lazy" src=
                                      "https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/geocode-71.png">
                                   </div>
                                   <div class="detials">
                                      <h2 class="loc-title">Sydney Park</h2>
                                      <p class="loc-description">45GW 9W Pyrmont NSW, Australia</p>
                                   </div>
                                </div>
                             </a>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
              <div class="col-lg-12">
                 <div class="sidebar_listing_list">
                    <div class="sidebar_advanced_search_widget" style="display:flex;flex-direction:row">
                       <div class="sl_creator">
                          <h4 class="mb25">Presented by</h4>
                          <div class="media">
                             <span class="imgWrap"><img loading="lazy" class="mr-3" src="{{ asset('storage/'.$property->agent->avatar) }}" alt="lc1.png"></span>
                             <div class="media-body">
                                <h5 class="mt-0 mb0">{{ $property->agent->name }}</h5>
                                <p class="mb0">(123)456-7890</p>
                                <p class="mb0"><a href="#" class="__cf_email__" >Property Advisor</a></p>
                             </div>
                          </div>
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
           </div> --}}
     </section>
     {{-- <div class="container">
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
</div> --}}
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

    <script>
        $(document).ready(function(){
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
                    console.log(res);
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
