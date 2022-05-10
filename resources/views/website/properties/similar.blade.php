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
						@if ($similar_properties->count())
                            @foreach ($similar_properties as $sim_prop)
                            	<div class="item">
                                    <div class="property-blk grid-layout">
                                        <a @if ($sim_prop->property_type_id == 1)
                                            href="{{ route('list-single-buy-properties', $sim_prop->slug) }}"
                                            @else
                                            href="{{ route('list-single-rents-properties', $sim_prop->slug) }}"
                                            @endif>
                                        <div class="thumbnail">
                                            <img loading="lazy" class="img-whp" src="{{asset('storage/'.$sim_prop->images[0]->image)}}" alt="fp1.jpg">
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
                                                @if ($sim_prop->property_type_id == 1)
                                                {{ number_format($sim_prop->price) }}</a>
                                                @else
                                                    {{ number_format($sim_prop->month_rent) }}</a>
                                                @endif
                                                </span> {{ $sim_prop->property_type_id != 1 ? '/mon' : '' }}
                                                </a>

                                                <h4>{{ $sim_prop->title }}</h4>
                                                <div class="text-thm">
                                                <div class=' tags-type-1'>
                                                <ul class="tag mb0">
                                                    <li class="list-inline-item"><a href="#">{{ $sim_prop->property_type_id == 1 ? 'For Sale' : 'For Rent' }}</a></li>
                                                    <li class="list-inline-item"><a href="#">{{ $sim_prop->category->name }}</a></li>
                                                </ul>
                                                </div>
                                                </div>
                                                <p class="property_desc">Exclusive! Furnished 2BR | High Floor | Canal View...</p>
                                                <ul class="prop_details mb0">
                                                    <li class="list-inline-item"><span><svg xmlns="http://www.w3.org/2000/svg" width="31.409" height="22.29" viewBox="0 0 31.409 22.29">
        <path id="bed" d="M38.9,96.718H38.4V92.665a2.029,2.029,0,0,0-2.026-2.026V82.026A2.029,2.029,0,0,0,34.343,80H13.066a2.029,2.029,0,0,0-2.026,2.026v8.612a2.029,2.029,0,0,0-2.026,2.026v4.053H8.507A.507.507,0,0,0,8,97.224v2.026a.507.507,0,0,0,.507.507h.507v2.026a.507.507,0,0,0,.507.507h1.52a.506.506,0,0,0,.5-.407l.426-2.126H35.447l.426,2.126a.506.506,0,0,0,.5.407h1.52a.507.507,0,0,0,.507-.507V99.757H38.9a.507.507,0,0,0,.507-.507V97.224A.507.507,0,0,0,38.9,96.718ZM12.053,82.026a1.015,1.015,0,0,1,1.013-1.013H34.343a1.015,1.015,0,0,1,1.013,1.013v8.612H34.343V88.612a2.029,2.029,0,0,0-2.026-2.026H26.237a2.029,2.029,0,0,0-2.026,2.026v2.026H23.2V88.612a2.029,2.029,0,0,0-2.026-2.026H15.092a2.029,2.029,0,0,0-2.026,2.026v2.026H12.053ZM33.33,88.612v2.026H25.224V88.612A1.015,1.015,0,0,1,26.237,87.6h6.079A1.015,1.015,0,0,1,33.33,88.612Zm-11.145,0v2.026H14.079V88.612A1.015,1.015,0,0,1,15.092,87.6h6.079A1.015,1.015,0,0,1,22.185,88.612ZM10.026,92.665a1.015,1.015,0,0,1,1.013-1.013h25.33a1.015,1.015,0,0,1,1.013,1.013v4.053H10.026Zm.6,8.612h-.6v-1.52h.9Zm26.758,0h-.6l-.3-1.52h.9ZM38.4,98.744H9.013V97.731H38.4Z" transform="translate(-8 -80)" fill="#30ccd3"/>
        </svg> Beds : {{ $sim_prop->bed_no }}</span></li>
                                                    <li class="list-inline-item"><span><svg xmlns="http://www.w3.org/2000/svg" width="31.509" height="27.963" viewBox="0 0 31.509 27.963">
        <g id="bathing" transform="translate(-7.95 -39.95)">
            <path id="Path_1787" data-name="Path 1787" d="M38.9,55.2H34.343v-1.52a.507.507,0,0,0-.507-.507H27.757a.507.507,0,0,0-.507.507V55.2H13.066V43.546a2.533,2.533,0,1,1,5.066,0V44.6a3.044,3.044,0,0,0-2.533,3v.507a.507.507,0,0,0,.507.507h5.066a.507.507,0,0,0,.507-.507V47.6a3.044,3.044,0,0,0-2.533-3V43.546a3.546,3.546,0,0,0-7.092,0V55.2H8.507A.507.507,0,0,0,8,55.7v1.52a.507.507,0,0,0,.507.507h1.52v3.546a5.582,5.582,0,0,0,4.053,5.362v.717a.507.507,0,0,0,1.013,0v-.53c.167.015.336.023.507.023H31.81c.171,0,.339-.008.507-.023v.53a.507.507,0,0,0,1.013,0v-.717a5.582,5.582,0,0,0,4.053-5.362V57.731H38.9a.507.507,0,0,0,.507-.507V55.7A.507.507,0,0,0,38.9,55.2ZM20.665,47.6H16.612a2.026,2.026,0,0,1,4.053,0Zm7.6,6.586H33.33V62.8H28.264ZM9.013,56.718v-.507H27.251v.507Zm27.356,4.559a4.565,4.565,0,0,1-4.559,4.559H15.6a4.565,4.565,0,0,1-4.559-4.559V57.731H27.251V63.3a.507.507,0,0,0,.507.507h6.079a.507.507,0,0,0,.507-.507V57.731h2.026ZM38.4,56.718H34.343v-.507H38.4Z" transform="translate(0 0)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"/>
            <path id="Path_1788" data-name="Path 1788" d="M78.079,336H72.507a.507.507,0,0,0,0,1.013h5.573a.507.507,0,0,0,0-1.013Z" transform="translate(-59.947 -277.256)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"/>
            <path id="Path_1789" data-name="Path 1789" d="M185.52,336h-1.013a.507.507,0,0,0,0,1.013h1.013a.507.507,0,0,0,0-1.013Z" transform="translate(-164.855 -277.256)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"/>
            <path id="Path_1790" data-name="Path 1790" d="M257.52,171.04a1.52,1.52,0,1,0-1.52-1.52A1.52,1.52,0,0,0,257.52,171.04Zm0-2.026a.507.507,0,1,1-.507.507A.507.507,0,0,1,257.52,169.013Z" transform="translate(-232.296 -119.894)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"/>
            <path id="Path_1791" data-name="Path 1791" d="M298.533,93.066A2.533,2.533,0,1,0,296,90.533,2.533,2.533,0,0,0,298.533,93.066Zm0-4.053a1.52,1.52,0,1,1-1.52,1.52A1.52,1.52,0,0,1,298.533,89.013Z" transform="translate(-269.763 -44.96)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"/>
            <path id="Path_1792" data-name="Path 1792" d="M360,162.026A2.026,2.026,0,1,0,362.026,160,2.026,2.026,0,0,0,360,162.026Zm2.026-1.013a1.013,1.013,0,1,1-1.013,1.013A1.013,1.013,0,0,1,362.026,161.013Z" transform="translate(-329.71 -112.401)" fill="#30ccd3" stroke="#30ccd3" stroke-width="0.1"/>
        </g>
        </svg> Baths : {{ $sim_prop->bath_no }}</span></li>
                                                    <li class="list-inline-item"><span><svg id="selection" xmlns="http://www.w3.org/2000/svg" width="31.409" height="31.409" viewBox="0 0 31.409 31.409">
        <g id="Group_990" data-name="Group 990">
            <path id="Path_1802" data-name="Path 1802" d="M30.6,6.443a.805.805,0,0,0,.805-.805V.805A.805.805,0,0,0,30.6,0H25.771a.805.805,0,0,0-.805.805V2.416H6.443V.805A.805.805,0,0,0,5.637,0H.805A.805.805,0,0,0,0,.805V5.637a.805.805,0,0,0,.805.805H2.416V24.966H.805A.805.805,0,0,0,0,25.771V30.6a.805.805,0,0,0,.805.805H5.637a.805.805,0,0,0,.805-.805V28.993H24.966V30.6a.805.805,0,0,0,.805.805H30.6a.805.805,0,0,0,.805-.805V25.771a.805.805,0,0,0-.805-.805H28.993V6.443ZM27.382,24.966H25.771a.805.805,0,0,0-.805.805v1.611H6.443V25.771a.805.805,0,0,0-.805-.805H4.027V6.443H5.637a.805.805,0,0,0,.805-.805V4.027H24.966V5.637a.805.805,0,0,0,.805.805h1.611V24.966Z" fill="#30ccd3"/>
        </g>
        </svg> Sq Ft: {{ number_format($sim_prop->size_sqft) }}</span></li>
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
