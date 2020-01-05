@extends('front.master')
@section('fcss')
<link rel="stylesheet" href="css/common/inner-all.css" type="text/css" />
@endsection
@section('bodycontent')
<section class="inner-header img-pos" style="background-image: url('img/service/night/night-party-1.jpg');">
    <div class="overlay">
        <div class="container">
            <h1 class="page-title">Services</h1>
            <ul class="breadcrumb">
                <li> <a href="#">Services</a> </li>
                <li class="active"> <a href="#">Sydney By Night Hire</a> </li>
            </ul>
        </div>
    </div>
</section>
<section class="bgWhite section-pad-top section-pad-bottom">
    <div class="container">
        <img src="img/service/night/night-party-3.jpg" alt="">
        <br>
        <br>
        <div class="row">
            <div class="col-md-8 mb-30">
                <div class="about-wrap">
                    <h6>Services</h6>
                    <h1><strong>Sydney By Night Hire Service</strong></h1>
                    <p>
                        Shelly Touring Company provides you with the transportation, to all of you and your friends for
                        a late night parties in this pleasing city Sydney. We present you with safe and pleasant
                        experience with your friends for night out. We help you and your friends in bringing back all
                        safe and sound to your location.
                    </p>
                    <a class="btn btn-danger" href="">Get In Touch</a>
                </div>
            </div>
            <div class="col-md-4 mb-30">

                <img src="img/service/night/night-party-2.jpg" class="img-responsive" alt="" />
            </div>
        </div>
    </div>
</section>

@endsection