<section class="home-six home6-overlay inner-page">
    <div class="container">
        <div class="row posr">
            <div class="col-lg-12">
                <div class="home_content home6">
                    <div class="home_adv_srch_opt home6">
                        <form action="{{ route('search') }}">
                        <div class="tab-content home1_adsrchfrm" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="home1-advnc-search home6">
                                    <ul class="h1ads_1st_list mb0">
                                        <li class="list-inline-item firstBox">
                                            <div class="form-group">
                                                <select name="l" id="l" class="form-control select2_el" multiple required></select>
												<label for="exampleInputEmail"><span class="flaticon-maps-and-flags"></span></label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item scndBox">
                                            <div class="innerradio">
                                                <label><input type="radio" name="t" id="t" value="1" {{ $t == 1 ? 'checked' : '' }}> <span>Sale</span></label>
												<label><input type="radio" name="t" id="t" value="3" {{ $t == 3 ? 'checked' : '' }}> <span>Rent</span></label>
                                            </div>
                                        </li>
                                        <li class="list-inline-item scndBox">
                                            <div class="search_option_two">
                                                <div class="candidate_revew_select twoFields">
                                                    <select id="mnp" name="mnp" class="">
                                                    </select>
                                                    <select id="mxp" name="mxp" class="">
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-inline-item fourtBox">
                                            <div class="search_option_two">
                                                <div class="candidate_revew_select">
                                                    <select name="c" id="c" class="w100 show-tick">
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="h1ads_1st_list mb0">
                                        <li class="list-inline-item lastBox">
                                            <div class="candidate_revew_select twoFields">
                                                <select name="bd" id="bd" class="">
                                                    <option value="">BEDS</option>
                                                    <option value="0">All</option>
                                                    <option value="">Studio</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8+</option>
                                                </select>
                                                <select name="bh" id="bh" class="">
                                                    <option value="">BATHS</option>
                                                    <option value="0">All</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li class="list-inline-item scndBox">
                                            <div class="candidate_revew_select twoFields">
                                                <select name="mnz" id="mnz" class="">
                                                </select>
                                                <select name="mxz" id="mxz" class="">
                                                </select>
                                            </div>
                                        </li>
                                        <li class="list-inline-item scndBox">
                                            <div class="candidate_revew_select twoFields">
                                                <select name="v" id="v" class="">
                                                    @if ($views->count())
                                                        @foreach ($views as $vie)
                                                            <option value="{{ $vie->id }}">{{ $vie->title }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </li>

                                        <li class="custome_fields_520 list-inline-item">
                                            <div class="navbered">
                                                <div class="mega-dropdown home6">
                                                    {{-- <span id="show_advbtn" class="dropbtn">Advanced <i class="flaticon-more pl10 flr-520"></i></span> --}}
                                                    <div class="dropdown-content">
                                                        <div class="mega_dropdown_content_closer">
                                                            <h5 class="text-thm text-right mt15"><span id="hide_advbtn" class="curp">Hide</span></h5>
                                                        </div>
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
                                                                        <select class="">
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
                                                                        <select class="">
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
                                                                        <select class="">
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
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        /**Search Filter Parameters*/
        const mnp =  "{{ $mnp }}";
        const mxp =  "{{ $mxp }}";
        const bd =  "{{ $bd }}";
        const bh =  "{{ $bh }}";
        const mnz =  "{{ $mnz }}";
        const mxz =  "{{ $mxz }}";
        const t =  "{{ $t }}";
        setTimeout(function(){
        getPropertyTypes("{{ $t }}");
            $('#mnp').val(mnp);
            $('#mxp').val(mxp);
            $('#bd').val(bd);
            $('#bh').val(bh);
            $('#mnz').val(mnz);
            $('#mxz').val(mxz);

         }, 50);

         function getPropertyTypes(type){
            $.ajax({
                url: "{{ route('get-property-categories') }}",
                method:"POST",
                data:{type, _token: "{{ csrf_token() }}"},
                success:function(res)
                {
                    const data = JSON.parse(res);
                    $('#c').html(data.categories);
                    $('#c').val("{{ $property_category_id }}");
                    $('#mnp').html(data.mnp);
                    $('#mnp').val(mnp);
                    $('#mxp').html(data.mxp);
                    $('#mxp').val(mxp);
                    $('#mnz').html(data.mnz);
                    $('#mnz').val(mnz);
                    $('#mxz').html(data.mxz);
                    $('#mxz').val(mxz);
                },
                error:function(xhr)
                {
                    console.log(xhr.responseText);
                }
            });
        }

    })
</script>

