@extends('layouts.app')

@section('content')


        <!-- Main Header Nav For Mobile -->
        <div id="page" class="stylehome1 h0">
            <div class="mobile-menu">
                <div class="header stylehome1">
                    <div class="main_logo_home2 text-center">
                        <img loading="lazy" class="nav_logo_img img-fluid mt20" src="images/logo.svg" alt="header-logo2.png">
                    </div>
                    <ul class="menu_bar_home2">
                        <li class="list-inline-item list_s"><a href="page-register.html"><span class="flaticon-user"></span></a></li>
                        <li class="list-inline-item">
                            <div class="search_overlay">
                                  <div id="search-button-listener2" class="mk-search-trigger style2 mk-fullscreen-trigger">
                                       <div id="search-button2"><i class="flaticon-magnifying-glass"></i></div>
                                  </div>
                                <div class="mk-fullscreen-search-overlay" id="mk-search-overlay2">
                                    <button class="mk-fullscreen-close" id="mk-fullscreen-close-button2"><i class="fa fa-times"></i></button>
                                    <div id="mk-fullscreen-search-wrapper2">
                                          <form method="get" id="mk-fullscreen-searchform2">
                                            <input type="text" value="" placeholder="Search courses..." id="mk-fullscreen-search-input2">
                                            <i class="flaticon-magnifying-glass fullscreen-search-icon"><input value="" type="submit"></i>
                                          </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-inline-item"><a href="#menu"><span></span></a></li>
                    </ul>
                </div>
            </div><!-- /.mobile-menu -->
            <nav id="menu" class="stylehome1">
                <ul>
                    <li>
                        <a href="index.html"><span class="title">HOME</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="title">RENT</span></a>
                    </li>
                    <li>
                        <a href="page-service.html"><span class="title">SERVICES</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="title">PROPERTIES</span></a>
                    </li>
                    <li>
                        <a href="investment.html"><span class="title">INVESTMENTS</span></a>
                    </li>
                    <li>
                        <a href="calculator.html"><span class="title">CALCULATOR</span></a>
                    </li>
                    <li class="last">
                        <a href="page-contact.html"><span class="title">CONTACT</span></a>
                    </li>
                </ul>
            </nav>
        </div>


        <!-- 6th Home Design -->
        <section class="home-six listingList">
            <div class="container">
                <div class="row posr">
                    <div class="col-lg-12">
                        <div class="home_content home6">
                            <div class="home_adv_srch_opt home6">
                                <div class="tab-content home1_adsrchfrm" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <div class="home1-advnc-search home6">
                                            <ul class="h1ads_1st_list mb0">
                                                <li class="list-inline-item firstBox">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="search_txt" placeholder="Location" required>
                                                        <label for="exampleInputEmail"><span class="flaticon-maps-and-flags"></span></label>
                                                    </div>
                                                </li>
                                                <li class="list-inline-item scndBox">
                                                    <div class="innerradio">
                                                        <label><input type="radio" name="status"> <span>Sale</span></label>
                                                        <label><input type="radio" name="status"> <span>Rent</span></label>
                                                    </div>
                                                </li>
                                                <li class="list-inline-item thirdBox">
                                                    <div class="search_option_two">
                                                        <div class="candidate_revew_select">
                                                            <select class="selectpicker w100 show-tick">
                                                                <option>Real Estate</option>
                                                                <option>Property Services</option>
                                                                <option>Mortgage</option>
                                                                <option>Insurance</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-inline-item fourtBox">
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
                                                <li class="list-inline-item lastBox">
                                                    <div class="candidate_revew_select twoFields">
                                                        <select class="selectpicker w100 show-tick">
                                                            <option>Min Beds</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                        </select>
                                                        <select class="selectpicker w100 show-tick">
                                                            <option>Max Beds</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                        </select>
                                                    </div>
                                                  </li>
                                                <li class="list-inline-item lastBox">
                                                    <div class="candidate_revew_select twoFields">
                                                        <select class="selectpicker w100 show-tick">
                                                            <option>Min Baths</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                        </select>
                                                        <select class="selectpicker w100 show-tick">
                                                            <option>Max Baths</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                        </select>
                                                    </div>
                                                  </li>
                                                <li class="custome_fields_520 list-inline-item">
                                                    <div class="navbered">
                                                          <div class="mega-dropdown home6">
                                                              {{-- <span id="show_advbtn" class="dropbtn">Advanced <i class="flaticon-more pl10 flr-520"></i></span> --}}
                                                            <div class="dropdown-content">
                                                                <div class="mega_dropdown_content_closer"><h5 class="text-thm text-right mt15"><span id="hide_advbtn" class="curp">Hide</span></h5></div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="typesList">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <ul>
                            @if ($propertyCategories->count())
                            @foreach ($propertyCategories as $item)
                            <li><a href="#">{{ $item->name }}
                                <span>({{ $item->properties_count }})</span> </a></li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listing Grid View -->
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
                                                            <!-- <input type="text" class="amount" placeholder="$52,239">
                                                            <input type="text" class="amount2" placeholder="$985,14">
                                                            <div class="slider-range"></div> -->
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
                    <div class="col-lg-6">
                        <div class="dn db-991 mt30 mb0">
                            <div id="main2">
                                <span id="open2" class="flaticon-filter-results-button filter_open_btn style2"> Show Filter</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-9">

                        <div class="row">
                            @if (count($properties) > 0)
                                @foreach ($properties as $prop)
                                <div class="col-lg-12">
                                    <div class="feat_property list propList">
                                        <div class="thumb">
                                            <img loading="lazy" class="img-whp" src="{{ asset('storage') }}/{{ $prop->images[0]->image }}" alt="fp1.jpg">
                                            <div class="thmb_cntnt">
                                                <ul class="icon mb0">
                                                    <li class="list-inline-item"><a href="#"><span class="flaticon-transfer-1"></span></a></li>
                                                    <li class="list-inline-item"><a href="#"><span class="flaticon-heart"></span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="details">
                                            <div class="tc_content">
                                                <div class="dtls_headr">
                                                    <a class="fp_price" href="{{ route('list-single-rents-properties', $prop->slug) }}">{{ number_format($prop->price) }} AED<small></small></a>
                                                </div>
                                                <h4>{{ $prop->title }}</h4>
                                                <p><span class="flaticon-placeholder"></span> {{ $prop->location }}</p>
                                                <ul class="prop_details mb0">
                                                    <li class="list-inline-item"><a href="#"><i class="fa fa-bed"></i>Beds: {{ $prop->bed_no }}</a></li>
                                                    <li class="list-inline-item"><a href="#"><i class="fa fa-bath"></i>Baths: {{ $prop->bath_no }}</a></li>
                                                    <li class="list-inline-item"><a href="#"><i class="fa fa-map-marker"></i>Sq Ft: {{ number_format($prop->size_sqft) }}</a></li>
                                                </ul>

                                                <ul class="fp_meta float-left mb0">
                                                    <li class="list-inline-item"><a href="#"><img loading="lazy" src="{{ asset('storage') }}/{{ $prop->developer->image }}" width="50px" height="50px" alt="pposter1.png"></a></li>
                                                    <li class="list-inline-item"><a href="#">{{ $prop->developer->name }}</a></li>
                                                </ul>
                                            </div>
                                            <div class="fp_footer">
                                                {{-- <p>Apartment for Sale in Horizon Tower</p> --}}
                                                <a href="{{ route('list-single-rents-properties', $prop->slug) }}" class="rqst">View Details</a>
                                                {{-- <div class="fp_pdate float-right">4 years ago</div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3">
                        <div class="sidebar_listing_grid1">

                            <div class="sidebar_listing_list">
                                <div class="sidebar_advanced_search_widget">
                                    <h4 class="title mb25">Mortgage Calculator</h4>
                                    <ul class="sasw_list mb0">
                                        <li class="search_area">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Total Amount">
                                                <label for="exampleInputName1"><span class="flaticon-money-bag"></span></label>
                                            </div>
                                        </li>
                                        <li class="search_area">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputAmount" placeholder="Down Payment">
                                                <label for="exampleInputAmount"><span class="flaticon-money-bag"></span></label>
                                            </div>
                                        </li>
                                        <li class="search_area">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputAmount2" placeholder="Interest Rate">
                                                <label for="exampleInputAmount2"><span class="flaticon-percent"></span></label>
                                            </div>
                                        </li>
                                        <li class="search_area">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputYear" placeholder="Loan Term (Years)">
                                                <label for="exampleInputYear"><span class="flaticon-calendar"></span></label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="search_option_two">
                                                <div class="candidate_revew_select">
                                                    <select class="selectpicker w100 show-tick">
                                                        <option>Monthly</option>
                                                        <option>Weekly</option>
                                                        <option>Yearly</option>
                                                        <option>Daily</option>
                                                        <option>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="search_option_button style2">
                                                <button type="submit" class="btn btn-block btn-thm">Search</button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="terms_condition_widget">
                                <h4 class="title">Featured Properties</h4>
                                <div class="sidebar_feature_property_slider">
                                    <div class="item">
                                        <div class="feat_property home7">
                                            <div class="thumb">
                                                <img loading="lazy" class="img-whp" src="images/property/fp1.jpg" alt="fp1.jpg">
                                                <div class="thmb_cntnt">
                                                    <ul class="tag mb0">
                                                        <li class="list-inline-item"><a href="#">For Rent</a></li>
                                                        <li class="list-inline-item"><a href="#">Featured</a></li>
                                                    </ul>
                                                    <a class="fp_price" href="#">$13,000<small>/mo</small></a>
                                                    <h4 class="posr color-white">Renovated Apartment</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="feat_property home7">
                                            <div class="thumb">
                                                <img loading="lazy" class="img-whp" src="images/property/fp2.jpg" alt="fp2.jpg">
                                                <div class="thmb_cntnt">
                                                    <ul class="tag mb0">
                                                        <li class="list-inline-item"><a href="#">For Rent</a></li>
                                                        <li class="list-inline-item"><a href="#">Featured</a></li>
                                                    </ul>
                                                    <a class="fp_price" href="#">$13,000<small>/mo</small></a>
                                                    <h4 class="posr color-white">Renovated Apartment</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="feat_property home7">
                                            <div class="thumb">
                                                <img loading="lazy" class="img-whp" src="images/property/fp3.jpg" alt="fp3.jpg">
                                                <div class="thmb_cntnt">
                                                    <ul class="tag mb0">
                                                        <li class="list-inline-item"><a href="#">For Rent</a></li>
                                                        <li class="list-inline-item"><a href="#">Featured</a></li>
                                                    </ul>
                                                    <a class="fp_price" href="#">$13,000<small>/mo</small></a>
                                                    <h4 class="posr color-white">Renovated Apartment</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="feat_property home7">
                                            <div class="thumb">
                                                <img loading="lazy" class="img-whp" src="images/property/fp4.jpg" alt="fp4.jpg">
                                                <div class="thmb_cntnt">
                                                    <ul class="tag mb0">
                                                        <li class="list-inline-item"><a href="#">For Rent</a></li>
                                                        <li class="list-inline-item"><a href="#">Featured</a></li>
                                                    </ul>
                                                    <a class="fp_price" href="#">$13,000<small>/mo</small></a>
                                                    <h4 class="posr color-white">Renovated Apartment</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="feat_property home7">
                                            <div class="thumb">
                                                <img loading="lazy" class="img-whp" src="images/property/fp5.jpg" alt="fp5.jpg">
                                                <div class="thmb_cntnt">
                                                    <ul class="tag mb0">
                                                        <li class="list-inline-item"><a href="#">For Rent</a></li>
                                                        <li class="list-inline-item"><a href="#">Featured</a></li>
                                                    </ul>
                                                    <a class="fp_price" href="#">$13,000<small>/mo</small></a>
                                                    <h4 class="posr color-white">Renovated Apartment</h4>
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
        </section>
@endsection
