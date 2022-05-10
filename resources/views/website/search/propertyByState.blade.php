@extends('layouts.app')

@section('content')

         @include('website.search.searchFilters')
         <section class="breadcrumbs-section">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="breadcrumbs">
								<ul class="breadcrumbs-list">
									<li><a href="{{ URL::to('/') }}">Cherwell</a></li>
									<li><i class="fa fa-chevron-right"></i></li>
									<li>{{$location_state->name}}</li>
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
                        @if ($areas->count())
                        @foreach ($areas as $item)
                        <li><a href="{{ URL::to('search?l=' . urlencode('1,'.$item->id) . '&t='.$t.'&c='.$c.'&mnp='.$mnp.'&mxp='.$mxp.'&bd='.$bd.'&bh='.$bh.'&mnz='.$mnz.'&mxz='.$mxz.'&v='.$v) }}">{{ $item->name }}
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
