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
        @include('website.search.searchFilters')
         <section class="breadcrumbs-section">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="breadcrumbs">
								<ul class="breadcrumbs-list">
									<li><a href="{{ URL::to('/') }}">Cherwell</a></li>
									<li><i class="fa fa-chevron-right"></i></li>
									<li><a href="{{ URL::to('search?l=' . urlencode('0,'.$location_state->id) . '&t='.$t.'&c='.$c) }}">{{$location_state->name}}</a></li>
									<li><i class="fa fa-chevron-right"></i></li>
									<li><a href="{{ URL::to('search?l=' . urlencode('1,'.$location_area->id) . '&t='.$t.'&c='.$c) }}">{{$location_area->name}}</a></li>
                                    <li><i class="fa fa-chevron-right"></i></li>
									<li>{{$location->name}}</li>
									<!--Area-->
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
        <div class="typesList">
		    <div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<h1 class='page-title'>{{ $title }}</h1>
				</div>
				<div class="col-sm-12 col-md-12">
					<ul style="overflow:hidden;height:30px">
                        @if ($buildings->count())
                            @foreach ($buildings as $item)
                            <li><a href="{{ URL::to('search?l=' . urlencode('3,'.$item->id) . '&t='.$t.'&c='.$c.'&mnp='.$mnp.'&mxp='.$mxp.'&bd='.$bd.'&bh='.$bh.'&mnz='.$mnz.'&mxz='.$mxz.'&v='.$v) }}">{{ $item->name }}
                                <span>({{ $item->properties_count }})</span> </a></li>
                            @endforeach
                            @endif
					</ul>
					<a href="javascript:;" class='viewall'>View All Locations</a>
				</div>

			</div>
			</div>
			</div>

        @include('website.properties.properties')

@endsection
