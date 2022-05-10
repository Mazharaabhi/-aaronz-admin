@extends('layouts.app')

@section('content')
    	

        @include('website.properties.searchFilters')
       
         <section class="breadcrumbs-section">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="breadcrumbs">
								<ul class="breadcrumbs-list">
									<li><a href="{{ URL::to('/') }}">Cherwell</a></li>
									<li><i class="fa fa-chevron-right"></i></li>
									<li><a href="{{ route('property-by-city', ['city' => $location_state->slug]) }}">{{$location_state->name}}</a></li>
									<li><i class="fa fa-chevron-right"></i></li>
									<li><a href="{{ route('property-by-city-area', ['city' => $location_state->slug, 'area' => $location_area->slug]) }}">{{$location_area->name}}</a></li>
                                    <li><i class="fa fa-chevron-right"></i></li>
								    <li><a href="{{ route('property-by-city-area-location', ['city' => $location_state->slug, 'area' => $location_area->slug, 'location' => $location->slug]) }}">{{$location->name}}</a></li>
                                    <li><i class="fa fa-chevron-right"></i></li>
									<li>{{$location_area->name}}</li>
									<!--Area-->
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
        @include('website.properties.properties')
@endsection
