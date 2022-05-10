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
									<li><a href="">Buy</a></li>
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
					<h1 class='page-title'>Properties for Buy</h1>
				</div>
				<div class="col-sm-12 col-md-12">
					<ul style="overflow:hidden;height:30px">
						@if ($propertyCategories->count())
                            @foreach ($propertyCategories as $item)
                                <li><a href="{{ route('list-buy-properties') }}">{{ $item->name }}
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
