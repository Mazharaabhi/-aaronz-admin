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
									<li>{{$location_area->name}}</li>
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
                        @php
                            $location_name = $location_area->name ? $location_area->name : 'your location';
                        @endphp
                        <h1 class='page-title'>Properties for Sale in {{$location_name}}</h1>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <ul style="overflow:hidden;height:30px">
                            @if ($locations->count())
                                @foreach ($locations as $item)
                                <li><a href="{{ route('property-by-city-area-location', ['city' => $location_state->slug, 'area' => $location_area->slug, 'location' => $item->slug]) }}">{{ $item->name }}
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
