@extends('layouts.app')

@section('content')
        <style>
            .etitle.black {
                color: #1D1D1B;
            }
            .emb-30px {
                margin-bottom: 30px;
            }
            .etitle {
                font-size: 40px;
                font-weight: 700;
                line-height: 1;
            }
            .bg-orange .container {
                max-width: 1236px;
            }
            .categories .bg-orange {
            background: #30ccd3;
            padding: 60px 0;
            }
            .category-box:hover span {
                color: #30ccd3;
            }
            .category-box p small {
                color: #30ccd3;
            }
            .categories .slider {
                display: flex;
                flex-wrap: nowrap;
                justify-content: space-around;
            }
            .categories .slider .item {
            width: 100%;
            margin-right: 20px;
            }
            .category-box {
                display: flex;
                flex-wrap: wrap;
                flex-direction: column;
                padding: 20px 20px 20px 25px;
                width: 100%;
                height: 100%;
                background: #FAFBFC;
                border-radius: 6px;
                justify-content: flex-start;
            }
            .category-box figure {
                display: flex;
                flex-wrap: wrap;
                align-content: center;
                width: 100%;
                height: 100px;
                margin-bottom: 20px;
            }
            figure {
                margin: 0 0 1rem;
            }
            .category-box span {
                width: 100%;
                font-size: 20px;
                line-height: 1;
                font-weight: 700;
                color: #1D1D1B;
                margin-bottom: 10px;
            }
            .category-box figure img {
                float: left;
                max-height: 100px;
            }
            .category-box
            {    display: block;
                /* flex-wrap: wrap; */
                /* flex-direction: column; */
                padding: 20px 20px 20px 25px;
                width: 100%;
                height: 100%;
                background: #FAFBFC;
                border-radius: 6px;
                /* justify-content: flex-start; */
            }
            .category-box figure {
                /* display: flex; */
                /* flex-wrap: wrap; */
                /* align-content: center; */
                display: block;
                width: 100%;
                height: 100px;
                margin-bottom: 20px;
            }
            .category-box figure img {
                object-fit: scale-down;
            }
            #categoriesCarousel .owl-stage{
            display:flex;
            }
            #categoriesCarousel.slider .item {
                width: 100%;
                height: 100%;
            }
        </style>
        @include('website.services.searchFilters')
        <section class="breadcrumbs-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumbs">
                            <ul class="breadcrumbs-list">
                                <li><a href="{{ URL::to('/') }}">Cherwell</a></li>
                                <li><i class="fa fa-chevron-right"></i></li>
                                <li><a href="">Services</a></li>
                                <!--Area-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
		</section>
        <section class="emt-70px emt-sm-50px">
            <section class="categories">
                <div class="container">
                    <h2 class="etitle black emb-30px emb-sm-20px">Categories</h2>
                </div>
                <div class="bg-orange">
                    <div class="container">
                        <div class="slider" id="categoriesCarousel">
                            @if ($services->count())
                            @foreach ($services as $item)
                            <div class="item">
                                <!--[ module : category-box ]-->
                                <a href="{{ route('services.index', $item->slug) }}" class="category-box">
                                    <figure><img src="{{ asset('storage/'.$item->image) }}" alt="maintenance" title="maintenance"></figure>
                                    <span>{{ $item->name}}</span>
                                    <p><small>{{ $item->sub_services_count }}</small> services</p>
                                </a>
                            </div>
                            @endforeach
                            @endif
                </div>
            </section>
        </section>
        <section>
            <div class="container">
                <h3 class="text-center" style="font-weight: bold">Popular Services For Your Properties In UAE</h3>
                <hr width="60%">
                <div class="row" id="load-services">

                </div>
            </div>
        </section>
<script>
    $(document).ready(function(){
        $.ajax({
            url: "{{ route('services.get-service-sub-categories') }}",
            method:"GET",
            success:function(res){
                $('#load-services').html(res)
                // console.log(res)
            },error:function(xhr){
                console.log(xhr.responseText)
            }
        });

        if($('#categoriesCarousel').length){
            $('#categoriesCarousel').owlCarousel({
                loop:true,
                margin:30,
                dots:true,
                nav:false,
                rtl:false,
                autoplayHoverPause:false,
                autoplay: false,
                singleItem: true,
                smartSpeed: 500,
                navText: [
                '<i class="fa fa-arrow-left"></i>',
                '<i class="fa fa-arrow-right"></i>'
                ],
                responsive: {
                    0: {
                        items:1
                    },
                    480:{
                        items:1
                    },
                    600: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    992: {
                        items: 4
                    },
                    1200: {
                        items: 4
                    },
                    1280: {
                        items: 5
                    }
                }
            })
        }
    })
</script>
@endsection
