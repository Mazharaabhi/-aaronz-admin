@extends('layouts.app')

@section('content')

        @include('website.services.searchFilters')
        <section class="breadcrumbs-section">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="breadcrumbs">
								<ul class="breadcrumbs-list">
									<li><a href="{{ URL::to('/') }}">Cherwell</a></li>
									<li><i class="fa fa-chevron-right"></i></li>
									<li><a href="">Buy</a></li>
									<!--Area-->
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
            <section class="our-listing bgc-f7 pb30-991 pdBottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="listing_sidebar dn db-991">
                                <div class="sidebar_content_details style3">
                                    <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
                                    <div class="sidebar_listing_list style2 mobile_sytle_sidebar mb0">
                                        <div class="sidebar_advanced_search_widget">
                                            <h4 class="mb25">Advanced Search <a class="filter_closed_btn float-right" href="#"><small>Hide Filter</small> <span class="flaticon-close"></span></a></h4>
                                            <ul class="sasw_list style2 mb0">
                                                <li class="search_area">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="exampleInputName1" placeholder="keyword">
                                                        <label for="exampleInputEmail"><span class="flaticon-magnifying-glass"></span></label>
                                                    </div>
                                                </li>
                                                <li class="search_area">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="exampleInputEmail" placeholder="Location">
                                                        <label for="exampleInputEmail"><span class="flaticon-maps-and-flags"></span></label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="search_option_two">
                                                        <div class="candidate_revew_select">
                                                            <select class="selectpicker w100 show-tick">
                                                                <option>Status</option>
                                                                <option>Apartment</option>
                                                                <option>Bungalow</option>
                                                                <option>Condo</option>
                                                                <option>House</option>
                                                                <option>Land</option>
                                                                <option>Single Family</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="search_option_two">
                                                        <div class="candidate_revew_select">
                                                            <select class="selectpicker w100 show-tick">
                                                                <option>Property Type</option>
                                                                <option>Apartment</option>
                                                                <option>Bungalow</option>
                                                                <option>Condo</option>
                                                                <option>House</option>
                                                                <option>Land</option>
                                                                <option>Single Family</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="small_dropdown2">
                                                        <div id="prncgs" class="btn dd_btn">
                                                            <span>Price</span>
                                                            <label for="exampleInputEmail2"><span class="fa fa-angle-down"></span></label>
                                                        </div>
                                                        <div class="dd_content2">
                                                            <div class="pricing_acontent">
                                                                <span id="slider-range-value1"></span>
                                                                <span class="mt0" id="slider-range-value2"></span>
                                                                <div id="slider"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="search_option_two">
                                                        <div class="candidate_revew_select">
                                                            <select class="selectpicker w100 show-tick">
                                                                <option>Bathrooms</option>
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5</option>
                                                                <option>6</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="search_option_two">
                                                        <div class="candidate_revew_select">
                                                            <select class="selectpicker w100 show-tick">
                                                                <option>Bedrooms</option>
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5</option>
                                                                <option>6</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="search_option_two">
                                                        <div class="candidate_revew_select">
                                                            <select class="selectpicker w100 show-tick">
                                                                <option>Garages</option>
                                                                <option>Yes</option>
                                                                <option>No</option>
                                                                <option>Others</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="search_option_two">
                                                        <div class="candidate_revew_select">
                                                            <select class="selectpicker w100 show-tick">
                                                                <option>Year built</option>
                                                                <option>2013</option>
                                                                <option>2014</option>
                                                                <option>2015</option>
                                                                <option>2016</option>
                                                                <option>2017</option>
                                                                <option>2018</option>
                                                                <option>2019</option>
                                                                <option>2020</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="min_area style2 list-inline-item">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="exampleInputName2" placeholder="Min Area">
                                                    </div>
                                                </li>
                                                <li class="max_area list-inline-item">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="exampleInputName3" placeholder="Max Area">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div id="accordion" class="panel-group">
                                                        <div class="panel">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a href="#panelBodyRating" class="accordion-toggle link" data-toggle="collapse" data-parent="#accordion"><i class="flaticon-more"></i> Advanced features</a>
                                                                </h4>
                                                            </div>
                                                            <div id="panelBodyRating" class="panel-collapse collapse">
                                                                <div class="panel-body row">
                                                                    <div class="col-lg-12">
                                                                        <ul class="ui_kit_checkbox selectable-list float-left fn-400">
                                                                            <li>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                                                    <label class="custom-control-label" for="customCheck1">Air Conditioning</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck4">
                                                                                    <label class="custom-control-label" for="customCheck4">Barbeque</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck10">
                                                                                    <label class="custom-control-label" for="customCheck10">Gym</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck5">
                                                                                    <label class="custom-control-label" for="customCheck5">Microwave</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck6">
                                                                                    <label class="custom-control-label" for="customCheck6">TV Cable</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                                                    <label class="custom-control-label" for="customCheck2">Lawn</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck11">
                                                                                    <label class="custom-control-label" for="customCheck11">Refrigerator</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                                                                    <label class="custom-control-label" for="customCheck3">Swimming Pool</label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                        <ul class="ui_kit_checkbox selectable-list float-right fn-400">
                                                                            <li>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck12">
                                                                                    <label class="custom-control-label" for="customCheck12">WiFi</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck14">
                                                                                    <label class="custom-control-label" for="customCheck14">Sauna</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck7">
                                                                                    <label class="custom-control-label" for="customCheck7">Dryer</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck9">
                                                                                    <label class="custom-control-label" for="customCheck9">Washer</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck13">
                                                                                    <label class="custom-control-label" for="customCheck13">Laundry</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck8">
                                                                                    <label class="custom-control-label" for="customCheck8">Outdoor Shower</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="customCheck15">
                                                                                    <label class="custom-control-label" for="customCheck15">Window Coverings</label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="search_option_button">
                                                        <button type="submit" class="btn btn-block btn-thm">Search</button>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="row">
                                <div class="grid_list_search_result">
                                    <div class="col-sm-12 col-md-4 col-lg-6 col-xl-6">
                                        <div class="left_area tac-xsd">
                                            <form class='furnishfilter'>
                                                <strong>Furnish Type:</strong>
                                                <input type='checkbox' id='all' name='all'>
                                                <label for='all'>All</label>
                                                <input type='checkbox' id='furnished' name='furnished'>
                                                <label for='furnished'>Furnished</label>
                                                <input type='checkbox' id='unfurnished' name='unfurnished'>
                                                <label for='unfurnished'>Unfurnished</label>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-6 col-xl-6">
                                        <div class="right_area text-right tac-xsd">
                                            <a href="#" class="openFilter"><span></span><span></span><span></span></a>
                                            <ul>
                                                <li class="list-inline-item">
                                                    <span class="stts">Status:</span>
                                                    <select class="selectpicker show-tick">
                                                        <option>All Status</option>
                                                        <option>Recent</option>
                                                        <option>Old Review</option>
                                                    </select>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span class="shrtby">Sort by:</span>
                                                    <select class="selectpicker show-tick">
                                                        <option>Featured First</option>
                                                        <option>Featured 2nd</option>
                                                        <option>Featured 3rd</option>
                                                        <option>Featured 4th</option>
                                                        <option>Featured 5th</option>
                                                    </select>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="our-service">
                                <div class="row">
                                    @if (count($list_services) > 0)
                                        @foreach ($list_services as $service)
                                        <div class="col-lg-12">
                                            <a href="{{ route('services.request_services_adds', $service->id) }}">
                                            </a>
                                            <div class="feat_property list">
                                               <a href="{{ route('services.request_services_adds', $service->id) }}">
                                                  <div class="thumb">
                                                     <img class="" src="{{ asset('storage/'.$service->image) }}" alt="fp1.jpg">
                                                  </div>
                                               </a>
                                               <div class="details">
                                                  <a href="{{ route('services.request_services_adds', $service->id) }}">
                                                  </a>
                                                  <div class="tc_content">
                                                     <a class="fp_service" href="#">{{ $service->title }} </a>
                                                     <a href="{{ route('services.request_services_adds', $service->id) }}">
                                                     </a><a class="fp_price" href="#">AED <span>
                                                     {{ number_format($service->hourly_charges) }} / Hour
                                                     </span> </a>
                                                    </a><a class="fp_price" href="#">AED <span>
                                                        {{ number_format($service->daily_charges) }} / Day
                                                        </span> </a>
                                                     {{-- <a class="fp_tag" href="#">Signature</a> --}}
                                                     <h4></h4>
                                                     <h4>{{ $service->sub_service->name }}</h4>
                                                     <ul class="service-feature" style="
                                                        font-size: 14px;
                                                        margin: 10px;
                                                        ">
                                                        <li>Service Feature 1</li>
                                                        <li>Service Feature 2</li>
                                                        <li>Service Feature 3</li>
                                                        <li>Service Feature 4</li>
                                                     </ul>
                                                  </div>
                                                  <div class="fp_footer">
                                                     <div class="btn-group d-block">
                                                        <div class="profile-detail">
                                                           <div class="profile-img-ser"><img src="{{ asset('storage/'.$service->company->avatar) }}"></div>
                                                           <div class="profile-title-ser">{{ $service->company->company_name }}
                                                              <a class="call-btn-1 raise" href="{{ route('services.request_services_adds', $service->id) }}">Send Request <i class=""></i></a>
                                                           </div>
                                                        </div>
                                                     </div>
                                                     <img class="developer-logo" src="{{ asset('storage/'.$service->company->avatar) }}">
                                                  </div>
                                               </div>
                                            </div>
                                         </div>
                                        @endforeach
                                    @endif
                                </div>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    <div class="col-lg-4 col-xl-4">
                            {{-- <div class="sidebar_listing_grid1 dn-991">
                                Be the first to hear about new properties
                                <button class="alert-about-prop" aria-label="Alert me of new properties"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" ><path fill="none" d="M0 0h24v24H0z"></path><path d="M12 21.5a2 2 0 0 0 2-2h-4a2 2 0 0 0 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V3.5a1.5 1.5 0 0 0-3 0v.68C7.63 4.86 6 7.42 6 10.5v5l-2 2v1h16v-1z"></path></svg>Alert me of new properties</button>

                                <div class="side-grid blk-appartments">
                                        <h3>Near Jumeriah lake Towers</h3>
                                        <ul>
                                            <li>Studio for sale in Jumeirah Lake Towers (JLT)</li>
                                            <li>Studio for sale in Jumeirah Lake Towers (JLT)</li>
                                            <li>Studio for sale in Jumeirah Lake Towers (JLT)</li>
                                            <li>Studio for sale in Jumeirah Lake Towers (JLT)</li>
                                            <li>Studio for sale in Jumeirah Lake Towers (JLT)</li>
                                            <li>Studio for sale in Jumeirah Lake Towers (JLT)</li>
                                        </ul>
                                </div>
                                <div class="side-grid blk-appartments">
                                    <img src="https://tpc.googlesyndication.com/simgad/17737378121799229297"/>
                                </div>
                                <div class="side-grid blk-prop-list">
                                            <ul>
                                            <li>
                                                <div class="blk-prop-list-item">
                                                    <div class="blk-img"><img loading="lazy" src="https://images.bayut.com/thumbnails/51316276-240x180.webp"></div>
                                                    <div class="blk-detail">
                                                    <span class="title">Jumeirah Lake Towers (JLT)</span>
                                                    <span class="desc">Lorem ipsum text is dummy</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="blk-prop-list-item">
                                                    <div class="blk-img"><img loading="lazy" src="https://images.bayut.com/thumbnails/51316276-240x180.webp"></div>
                                                    <div class="blk-detail">
                                                    <span class="title">Jumeirah Lake Towers (JLT)</span>
                                                    <span class="desc">Lorem ipsum text is dummy</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="blk-prop-list-item">
                                                    <div class="blk-img"><img loading="lazy" src="https://images.bayut.com/thumbnails/51316276-240x180.webp"></div>
                                                    <div class="blk-detail">
                                                    <span class="title">Jumeirah Lake Towers (JLT)</span>
                                                    <span class="desc">Lorem ipsum text is dummy</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="blk-prop-list-item">
                                                    <div class="blk-img"><img loading="lazy" src="https://images.bayut.com/thumbnails/51316276-240x180.webp"></div>
                                                    <div class="blk-detail">
                                                    <span class="title">Jumeirah Lake Towers (JLT)</span>
                                                    <span class="desc">Lorem ipsum text is dummy</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="blk-prop-list-item">
                                                    <div class="blk-img"><img loading="lazy" src="https://images.bayut.com/thumbnails/51316276-240x180.webp"></div>
                                                    <div class="blk-detail">
                                                    <span class="title">Jumeirah Lake Towers (JLT)</span>
                                                    <span class="desc">Lorem ipsum text is dummy</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                </div>
                            </div> --}}
                        </div>

                    </div>
                </div>
            </section>
@endsection
