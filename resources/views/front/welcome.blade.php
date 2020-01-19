@extends('front.master')

@section('fscripts')
<script src="/myjs/f/welcome.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js">
</script>
@endsection

@section('bodycontent')

 <!-- *************** Start Hero Banner *************** -->
  <input type="text" hidden id="tokken" value="{{ csrf_token()}}">
 <section id="heroSlide" class="master-slider">
  <div class="ms-slide">

    <img src="img/service/cruise/cruise-2.jpg" alt="">

    <div class="ms-layer desc-box" data-ease="easeOutBack" data-effect="skewbottom(-30,50,0,50)"

      data-duration="1800" data-delay="0" data-hide-effect="skewbottom(0,180,0,0,l)" data-parallax="3">

      <h1>Do you need a ride?</h1>

      <p>The Shelly Touring Company gives door-to-door cruise transport hire service </p>

      <a class="btn btn-danger" href="#">How it Works <i class="fa fa-angle-right"></i></a>

    </div>

  </div>
  </section>
  <section class="bgWhite section-pad-top section-pad-bottom destination-section-wrap">
    <div class="container">
      <h1 class="text-center section-title">OUR MOST POPULAR TOURS</h1>
      <div class="row" id="tourss">
        
      </div>
    </div>
  </section>
  <!-- *************** End Hero Banner *************** -->
{{-- 
  <section class="section-pad-top section-pad-bottom">

    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <div class="offer-wrap">

            <h6>View offer</h6>

            <h1>Check out available packages</h1>

            <a class="btn btn-danger" href="#">View full list of offers</a>

          </div>

        </div>

        <div class="col-lg-9">

          <div class="row">

            <div class="col-md-4">

              <div class="offer-thumb">

                <div class="offer-caption">

                  <h5>VEHICLES TO MEET THE DEMANDS</h5>

                  <p>Camry Hybrid for Interstate Travel and.Saves $$ on fuel

                    Tarago is ideal when you need more seats, space, and comfort</p>

                  <a href="#">Rent Car <i class="fa fa-angle-right"></i></a>

                </div>

                <img src="img/groupcars.jpg" class="img-responsive"

                  alt="VEHICLES TO MEET THE DEMANDS">

              </div>

            </div>

            <div class="col-md-4">

              <div class="offer-thumb">

                <div class="offer-caption">

                  <h5>ONLY CLEAN AND RELIABLE VEHICLES</h5>

                  <p>Clean and reliable Toyota Vehicle

                    FREE Ambipur Car scent,

                    FREE Bottle of water,

                    FREE Baby Board,

                    FREE mints</p>

                  <a href="#">Rent Car <i class="fa fa-angle-right"></i></a>

                </div>

                <img src="img/Toyota-Hiace-clean.jpg" class="img-responsive" alt="CLEAN AND RELIABLE VEHICLES">

              </div>

            </div>

            <div class="col-md-4">

              <div class="offer-thumb">

                <div class="offer-caption">

                  <h5>FREE DROP OFF & PICK UP AREAS</h5>

                  <p> Free dropoff and pickup on these areas Hurstville, Sth Hurstville, Allawah, Carlton, Kogarah,

                    Oatley, Penshurst.

                  </p>

                  <a href="#">Rent Car <i class="fa fa-angle-right"></i></a>

                </div>

                <img src="img/pickupplace.jpg" class="img-responsive"

                  alt="DROP OFF & PICK UP AREA">

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>

  <section class="section-pad-top section-pad-bottom img-pos fetaure-wrap"

    style="background-image: url('img/t1.jpg');">

    <div class="container">

      <h1 class="text-center section-title colorWhite">Why chooose Shelly Touring Company</h1>

      <div class="row flex-row">

        <div class="col-md-3 col-sm-6 col-xs-12 mb-30">

          <div class="feature-list-wrap">

            <img src="img/ico-2.png" alt="" />

            <h6>Vehicles To Meet Demands</h6>

          </div>

        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 mb-30">

          <div class="feature-list-wrap">

            <img src="img/ico-3.png" alt="" />

            <h6>Great Daily And Weekly Rates</h6>

          </div>

        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 mb-30">

          <div class="feature-list-wrap">

            <img src="img/ico-4.png" alt="" />

            <h6>96% Happy Traveller</h6>

          </div>

        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 mb-30">

          <div class="feature-list-wrap">

            <img src="img/ico-1.png" alt="" />

            <h6>Real Time Online Booking</h6>

          </div>

        </div>

      </div>

    </div>

  </section> --}}

  <section class="featured-product-slide">

    <div class="product-wrap">

      <img src="img/prortraiteImage/airport.jpg" alt="" />

      <div class="featured-product-content">

        <div class="featured-product-content-inner">

          <span class="featured-product-number">01</span>

          <h5><a href="#">Door-to-door airport service</a></h5>

          <div class="featured-product-text">

            <p>Service to the Sydney International and Domestic Airports.</p>

          </div>

        </div>

        <a class="featured-product-link" href="/airport">more info</a>

      </div>

    </div>

    <div class="product-wrap">

      <img src="img/prortraiteImage/cruise.jpg" alt="" />

      <div class="featured-product-content">

        <div class="featured-product-content-inner">

          <span class="featured-product-number">02</span>

          <h5><a href="#">Door-to-door transport to cruise</a></h5>

          <div class="featured-product-text">

            <p>Service to the Sydney Cruise Terminals at Circular Quay or White Bay</p>

          </div>

        </div>

        <a class="featured-product-link" href="/cruise">more info</a>

      </div>

    </div>

    <!-- <div class="product-wrap">

      <img src="img/service-1.jpg" alt="" />

      <div class="featured-product-content">

        <div class="featured-product-content-inner">

          <span class="featured-product-number">07</span>

          <h5><a href="#">Product title here</a></h5>

          <div class="featured-product-text">

            <p>Product description here</p>

          </div>

        </div>

        <a class="featured-product-link" href="#">more info</a>

      </div>

    </div>

    <div class="product-wrap">

      <img src="img/service-3.jpg" alt="" />

      <div class="featured-product-content">

        <div class="featured-product-content-inner">

          <span class="featured-product-number">08</span>

          <h5><a href="#">Product title here</a></h5>

          <div class="featured-product-text">

            <p>Product description here</p>

          </div>

        </div>

        <a class="featured-product-link" href="#">more info</a>

      </div>

    </div>

    <div class="product-wrap">

      <img src="img/service-4.jpg" alt="" />

      <div class="featured-product-content">

        <div class="featured-product-content-inner">

          <span class="featured-product-number">09</span>

          <h5><a href="#">Product title here</a></h5>

          <div class="featured-product-text">

            <p>Product description here</p>

          </div>

        </div>

        <a class="featured-product-link" href="#">more info</a>

      </div>

    </div> -->

  </section>

  <section class="bgWhite section-pad-top section-pad-bottom">

    <div class="container">

      <div class="row">

        <div class="col-md-8 mb-30">

          <div class="about-wrap">

            <h6>About</h6>

            <h1>A <strong>Touring</strong> company </h1>

            <p>We warmly welcome you to <strong>Shelly Touring Company</strong>. Shelly touring company is dedicated to provide admirable and personalized service. We plan together with you and supply you with all information necessary for your security, luxury and happiness. Our goal is to make your holiday better with us.</p>

            <a class="btn btn-danger" href="/about">Discover More</a>

          </div>

        </div>

        <div class="col-md-4 mb-30">

          <img src="img/about.jpg" class="img-responsive" alt="" />

        </div>

      </div>

    </div>

  </section>

@endsection