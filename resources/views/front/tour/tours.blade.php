@extends('front.master')

@section('fcss')

<link rel="stylesheet" href="css/pages/destination.css" type="text/css" />

@endsection

@section('bodycontent')

<section class="inner-header img-pos" style="background-image: url('img/contact.jpg');">
    <div class="overlay">
        <div class="container">
            <h1 class="page-title">Tours</h1>
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active"><a>Tours</a></li>
            </ul>
        </div>
    </div>
</section>

@if ($email !="")
<div class="alert alert-success">
    Thank You for booking. We have sent your detail in email: {{$email}}
</div>
@endif


<section class="bgWhite section-pad-top section-pad-bottom">

    <div class="container">

        <div class="row">

            <div class="col-md-12 mb-30">

                <div class="about-wrap">

                    <h6>Tours</h6>

                    <h2> PRIVATE TOUR & LUXURY EXPERIENCE SPECIALISTS</h2>
                    <p>
                        At Sydney Private Day Tours we only offer private charters. Being a private charter you will
                        have your own comfortable vehicle and your own experienced driver - guide. You can choose a
                        full day tour, half day tour or night tour.
                    </p>
                    <p>
                        Our tour itineraries and destinations are chosen with care aimed at providing our guests
                        with a truly memorable experience. Our itineraries include the ' must do ' things around
                        Sydney and you will get to experience Sydney like a local!
                    </p>

                    <h2>CUSTOM & TAILORED TOURS</h2>
                    <p>
                        If you would like a more personalised experience, we give you the flexibility to tailor the
                        tour to meet any of your special requests. We are experts at creating unique custom private
                        tours and luxury VIP experiences.
                    </p>
                    <p>
                        Please contact us to discuss your 'wish list' visit and let us craft the ultimate Sydney
                        experience for you.
                    </p>

                    <h2>MULTI DAY CUSTOM PRIVATE TOURS</h2>
                    <p>
                        We can offer custom Sydney Half Day PrivateTours, Sydney Full Day Private Tours and Multi
                        Day Private Tour options including Sydney City and Beaches Tours, Hunter Valley Private
                        Winery Tours, Blue Mountains Private Tours, Foodie Tours and 'Off the Beaten Path - Non
                        Touristy' options.
                    </p>
                </div>
            </div>
        </div>

    </div>

</section>

<input type="text" hidden value="{{ csrf_token()}}" id="tokken">
<section class="bgWhite section-pad-bottom">
    <div class="container">
        <div class="row" id="tourss">
            <div class="col-md-4 mb-30">
                <div class="product-wrap">
                    <img src="img/destination.jpg" alt="">
                    <div class="featured-product-content">
                        <div class="featured-product-content-inner">
                            <h5><a href="/sydney" tabindex="0">SYDNEY FULL AND HALF DAY LUXURY PRIVATE TOURS</a>
                            </h5>
                        </div>
                        <a class="featured-product-link" href="/sydney" tabindex="0">more info</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-30">
                <div class="product-wrap">
                    <img src="img/destination.jpg" alt="">
                    <div class="featured-product-content">
                        <div class="featured-product-content-inner">
                            <h5><a href="/sydney" tabindex="0">BLUE MOUNTAINS FULLY INCLUSIVE TOURS</a></h5>
                        </div>
                        <a class="featured-product-link" href="/sydney" tabindex="0">more info</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-30">
                <div class="product-wrap">
                    <img src="img/destination.jpg" alt="">
                    <div class="featured-product-content">
                        <div class="featured-product-content-inner">
                            <h5><a href="/sydney" tabindex="0">SYDNEY BY NIGHT LUXURY PRIVATE TOURS</a></h5>
                        </div>
                        <a class="featured-product-link" href="/sydney" tabindex="0">more info</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-30">
                <div class="product-wrap">
                    <img src="img/destination.jpg" alt="">
                    <div class="featured-product-content">
                        <div class="featured-product-content-inner">
                            <h5><a href="/sydney" tabindex="0">HUNTER VALLEY WINERY TOURS DEPARTING FROM SYDNEY</a>
                            </h5>
                        </div>
                        <a class="featured-product-link" href="/sydney" tabindex="0">more info</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-30">
                <div class="product-wrap">
                    <img src="img/destination.jpg" alt="">
                    <div class="featured-product-content">
                        <div class="featured-product-content-inner">
                            <h5><a href="/sydney" tabindex="0">CANBERRA - AUSTRALIA'S NATIONAL CAPITAL</a></h5>
                        </div>
                        <a class="featured-product-link" href="/sydney" tabindex="0">more info</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-30">
                <div class="product-wrap">
                    <img src="img/destination.jpg" alt="">
                    <div class="featured-product-content">
                        <div class="featured-product-content-inner">
                            <h5><a href="/sydney" tabindex="0">CENTRAL COAST BEACHES & WILDLIFE PARK PRIVATE
                                    TOURS</a></h5>
                        </div>
                        <a class="featured-product-link" href="/sydney" tabindex="0">more info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('fscripts')
<script src="/myjs/f/tours.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js">
</script>
@endsection