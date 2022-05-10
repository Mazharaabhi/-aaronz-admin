@extends('layouts.app')

@section('content')

        @include('website.services.searchFilters')
        <section class="breadcrumbs-section" style="padding-top: 30px!important;">
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

            <section>
                <div class="container">
                    <h3 class="text-center" style="font-weight: bold">{{ $service_category->name }} Services</h3>
                    <hr width="60%">
                    <div class="row" id="load-services">
                        @if ($list_services->count())
                            @foreach ($list_services as $service_item)
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                <a href="{{ route('services.get_services_adds', $service_item->slug) }}"><div class="service_grid">
                                    <div class="thumb">
                                        <img class="img-fluid w100" src="{{ asset('storage/'.$service_item->image) }}" alt="1.jpg">
                                    </div>
                                    <div class="details">
                                        <h4 style="color:black">{{ $service_item->name }}</h4>
                                        <br>
                                        <p><span class="float-left">Total Adds <b>{{  $service_item->list_services_count }}</b></span> <span class="float-right">Average Price <b>AED  {{ count($service_item->list_services) > 0 ? $service_item->list_services[0]->hourly_charges : 0 }} / Hour</b></span></p>
                                    </div>
                                </div></a>
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

                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}


@endsection
