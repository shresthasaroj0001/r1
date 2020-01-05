@extends('front.master')
@section('fcss')
<link rel="stylesheet" href="css/common/inner-all.css" type="text/css" />
@endsection
@section('bodycontent')
<section class="inner-header img-pos" style="background-image: url('img/service/airport/sydney-airport-2.jpg');">
    <div class="overlay">
        <div class="container">
            <h1 class="page-title">Services</h1>
            <ul class="breadcrumb">
                <li> <a href="#">Services</a> </li>
                <li class="active"> <a href="#">Airport</a> </li>
            </ul>
        </div>
    </div>
</section>
<section class="bgWhite section-pad-top section-pad-bottom">
    <div class="container">
        <img src="img/service/airport/sydney-airport-3.jpg" alt="">
        <br>
        <br>
        <div class="row">
            <div class="col-md-8 mb-30">
                <div class="about-wrap">
                    <h6>Services</h6>
                    <h1><strong>Door-to-door Airport Service</strong></h1>
                    <p>
                        Shelly Touring Company has been providing door to door service to the Sydney International and
                        Domestic
                        Airports over the years. If you are looking for an airport service in the <strong>FRYAR ROAD,
                            LIVERPOOL,
                            MARRICKVILLE </strong> regions, we offer you our reliable and online booking system in
                        affortable price. We are familiar with dealing with a huge range of customers, teams and
                        institutions.
                    </p>
                    <a class="btn btn-danger" href="">Get In Touch</a>
                </div>
            </div>
            <div class="col-md-4 mb-30">
                <div id="faq-accordion" role="tablist">
                    <div class="faq-panel">
                        <h5>
                            <a role="button" data-toggle="collapse" data-parent="#faq-accordion" href="#faq1"
                                aria-expanded="true" aria-controls="faq1">Pickup Instruction</a>
                        </h5>
                        <div id="faq1" class="panel-collapse collapse in" role="tabpanel">
                            <ul class="pickup-instruction">
                                <li>
                                    <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                    Sydney International Airport Pickup Point</li>
                                <li><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                    Sydney Domestic Airport Pickup Point</li>
                                <li><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                    Sydney Airport Meeting Points</li>
                                <li><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                    Sydney International Arrival</li>
                                <li><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                    Smart traveller</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- <img src="img/service/airport/sydney-airport-1.jpg" class="img-responsive" alt="" /> -->
            </div>
        </div>
    </div>
</section>
@endsection