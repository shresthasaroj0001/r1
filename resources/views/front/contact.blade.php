@extends('front.master')
@section('fcss')
<link rel="stylesheet" href="css/common/inner-all.css" type="text/css" />
<link rel="stylesheet" href="css/pages/contact.css" type="text/css" />
@endsection
@section('bodycontent')
<section class="inner-header img-pos" style="background-image: url('img/contact.jpg');">
    <div class="overlay">
      <div class="container">
        <h1 class="page-title">Contact</h1>
        <ul class="breadcrumb">
          <li> <a href="#">Home</a> </li>
          <li class="active"> <a href="#">Contact</a> </li>
        </ul>
      </div>
    </div>
  </section>
<section class="bgWhite section-pad-top section-pad-bottom">
  <div class="container">
    <div class="row">
      <div class="col-md-7 col-lg-7 col-md-push-5 col-md-push-5 mb-30">
        <h1><strong>Contact</strong> Info</h1>
        <p>Our customer service team are available weekdays 8am to 10pm
          and weekends 9am to 5pm (AEST)</p>
          <div class="row">
            <div class="col-sm-6 mb-30">
                <h6> <strong>ADDRESS</strong> </h6>
                <p>
                    155-163 FRYAR ROAD, EAGLEBY QLD, EAGLEBY, QLD, 4207, Australia
                </p>
                <p>
                    20 Shepherd Street, Liverpool, NSW, 2170, Australia
                </p>

                <p>
                    79 Railway Pde, Marrickville, NSW, 2204, Australia
                </p>
            </div>
            <div class="col-sm-6 mb-30">
                <h6> <strong>CONTACT</strong> </h6>
                <p>
                    <a href="tel:1800865845">1800 865 845</a><br>
                    <a href="mailto: sher@shellytours.com">sher@shellytours.com</a>
                </p>
            </div>
        </div>
        <div class="row">
          <div class="col-sm-6 mb-30">
            <h6> <strong>WORKING HOURS</strong> </h6>
            <p>Weekdays: 10 AM – 8 PM<br>
              Weekends: by appoinment</p>
          </div>
          <div class="col-sm-6 mb-30">
            <h6> <strong>SOCIALS</strong> </h6>
            <div class="social-icons">
              <a href="#">
                <i class="fa fa-facebook"></i>
              </a>
              <a href="#">
                <i class="fa fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fa fa-youtube-play"></i>
              </a>

              <a href="#">
                <i class="fa fa-instagram"></i>
              </a>
              <a href="#">
                <i class="fa fa-linkedin"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5 col-lg-5 col-md-pull-7 col-lg-pull-7 mb-30">
        <img src="img/about.jpg" class="img-responsive" alt="" />
      </div>
    </div>
  </div>
</section>
<section class="section-pad-top section-pad-bottom">
  <div class="container">
    <div class="booking-wrap">
      <h3>Contact Information</h3>
      <p>Please provide us with your contact details so that we can share the results of the booking review with
        you.</p>
        <div class="heading-block mb-60">
          @if(count($errors)>0)
          <div class="alert alert-danger" role="alert">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>
                      {{ $error }}
                  </li>
                @endforeach
              </ul>
            </div>
          @endif
          
          @if(session('success'))
          <div class="alert alert-success">
              {{session('success')}}
          </div>
          @endif
          
          @if(session('error'))
          <div class="alert alert-danger">
              {{session('error')}}
          </div>
          @endif
          <style>
        .form_error {
          color: red;
        }
      </style>
          
  </div>
        <form class="row flex-row" method="POST" id="contactForm" action="{{ route('contactus')}}">
          {{-- <form class="row flex-row"> --}}
            @csrf
            <input type="hidden" name="g-recaptcha-response" value="{{ csrf_token() }}">  
        <div class="form-group col-xs-12">
          <label>Full Name</label>
          <input type="text" class="form-control" id="fullname" name="name" placeholder="Full Name">
                    <span class="form_error" id="invalid_fullname" style="display:none">Full Name is required</span>

        </div>
        {{-- <div class="form-group col-xs-12 col-md-6">
          <label>Email Address</label>
          <input type="email" class="form-control" name="name" placeholder="Email Address">
        </div> --}}
        <div class="form-group col-xs-12 col-md-6">
          <label>Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="john@abc.com">
          <span class="form_error" id="invalid_email" style="display:none">Email is required</span>
          <span class="form_error" id="invalid_email_invalid" style="display:none">Email is not valid</span>
        </div>
                  

        <div class="form-group col-xs-12 col-md-6">
          <label>Subject</label>
          <input type="text" class="form-control"  id="subject"   name="subject" placeholder="Subject">
          <span class="form_error" id="invalid_subject" style="display:none">Subject is required</span>
        </div>
        
        <div class="form-group col-xs-12 col-md-12">
          <label>Your Message</label>
          <textarea class="form-control" name="message" id="msgs"  placeholder="Message" rows="6"></textarea>
                    <span class="form_error" id="invalid_msgs" style="display:none">Please write your message</span>

        </div>
        
        <div class="form-group col-xs-12 col-md-12">
         <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="{{env('RECAPTCHA_SITE_KEY')}}"></div>
          @if ($errors->has("g-recaptcha-response"))
          <span class="invalid-feedback" style="display: block">
            <strong>
              {{$errors->first('g-recaptcha-response')}}
            </strong>
          </span>
                    @endif

        </div>
        
        <div class="form-group col-xs-12">
          <button type="button" class="btn btn-danger btn-lg sendmailbtn">Send Message</button>
        </div>
      </form>
    </div>
  </div>
</section>
<div id="mapp">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3310.346527864473!2d150.9211823!3d-33.9322144!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b1295a441b9e4ed%3A0x35e7d2936b064fc2!2zMjAgU2hlcGhlcmQgU3QsIExpdmVycG9vbCBOU1cgMjE3MCwg4KSF4KS34KWN4KSf4KWN4KSw4KWH4KSy4KS_4KSv4KS-!5e0!3m2!1sne!2snp!4v1576291585157!5m2!1sne!2snp" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
</div>
@endsection
@section('fscripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script  type="text/javascript" > function recaptchaCallback() {
  $("#contactForm .sendmailbtn").removeAttr("disabled");
} </script>
<script type="text/javascript" src="/js/contact.js"></script>
@endsection