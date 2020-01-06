@extends('front.master')

@section('fcss')
    <link rel="stylesheet" href="css/pages/destination.css" type="text/css"/>

@endsection

@section('bodycontent')
    <section class="inner-header img-pos" style="background-image: url('img/slider3.jpg');">
        <div class="overlay">
            <div class="container">
                <h1 class="page-title">Book Now</h1>
                <ul class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active"><a>SYDNEY FULL AND HALF DAY LUXURY PRIVATE TOURS</a></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="section-pad-top section-pad-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="destination-slide-wrap">
                        <div class="destination-big">
                            <div>
                                <img src="img/tours/sydney-full-day/1.jpg" class="img-responsive"/>
                            </div>
                            <div>
                                <img src="img/tours/sydney-full-day/2.jpg" class="img-responsive"/>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="destination-thumb">
                        <div>
                            <img src="img/destination.jpg" class="img-responsive" />
                        </div>
                        <div>
                            <img src="img/destination.jpg" class="img-responsive" />
                        </div>

                    </div> --}}
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="package-detail-wrap bgWhite">
                        <h3>Start Booking now</h3>
                        <div class="row">
                            <div class="col-md-3">Adult</div>
                            <div class="col-md-3">
                                <p id="AdultRate">123</p>
                            </div>
                            <div class="col-md-3">
                                <select name="" class="changeqty"  id="adultqty">
                                    <option value="0">0</option>
                                    <option value="1" selected>1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                            <div class="col-md-3"><p id="adultfinalr"></p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Child</div>
                            <div class="col-md-3">
                                <p id="ChildRate">123</p>
                            </div>
                            <div class="col-md-3">
                                <select name="" class="changeqty" id="childqty">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                            <div class="col-md-3"><p id="childfinalr"></p></div>
                        </div>
                        <br>
                        {{-- <input type="text" hidden value="{{ csrf_token()}}" id="tokenn">
                        <input type="text" hidden value="{{$menu_id}}" id="product-id"> --}}

                        <div class="row">
                            <div id="datepicker" class="col-md-12"></div>
                           
                        </div>
                        <div class="row" style="margin-top: 0.5em;">
                            <div class="col-md-12">
                                <select name="t" id="bookingtimeselection" class="form-control">
                                    <option value="0">Select Time</option>
                                    <option value=""></option>
                                </select>
                                <br>
                                <div class="">
                                    <label for="">Total</label>
                                    <p id="totalprice"></p>
                                </div>
                                <br>
                                <div id="sa" class="">
                                    <div id="bookingbtnDiv" style="display: none"><button id="" class="btn btn-success">Book Now</button></div>
                                    <div id="bookingnotAvailable" style="display: none">
                                        <button disabled="disabled" class="btn btn-danger">Booking Not Available</button>
                                    </div>
                                    <div id="bookingExced" style="display: none">
                                        <button disabled="disabled" class="btn btn-danger">Booking Exceed</button>
                                    </div>
                                    <div id="bookingtimeNotselected">
                                        <div class="alert alert-danger">Please Select Time</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="/booking" class="btn btn-danger mgbottom15">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="bgWhite">
                        <div class="tab-wrap">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs detail-tab" role="tablist">
                                <li role="presentation" class="active"><a href="#gallery" aria-controls="gallery"
                                                                          role="tab" data-toggle="tab"
                                                                          aria-expanded="false">Booking Details</a></li>
                                <li role="presentation" class=""><a href="#itinerary" aria-controls="itinerary"
                                                                    role="tab"
                                                                    data-toggle="tab"
                                                                    aria-expanded="false">Itinerary</a></li>
                                <li role="presentation" class=""><a href="#includes" aria-controls="includes" role="tab"
                                                                    data-toggle="tab" aria-expanded="false">Package
                                        Includes</a></li>
                                <li role="presentation" class=""><a href="#videos" aria-controls="videos" role="tab"
                                                                    data-toggle="tab"
                                                                    aria-expanded="false">Duration & Departure</a></li>

                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content detail-content">
                                <div role="tabpanel" class="tab-pane " id="itinerary">
                                    <p>
                                        On this full day Sydney Attractions and Highlights tour you can sit back and
                                        enjoy the luxury of fully escorted private touring on this 8 hour comprehensive
                                        tour of Sydney City and surrounding areas.
                                    </p>
                                    <p>
                                        From the Sydney Opera House to Bondi Beach in the East, to Manly Beach and
                                        Kirribilli in the North - this tour visits all of the Famous Sydney landmarks
                                        across the City, The Rocks District, the Eastern Suburbs and North Shore plus
                                        much, much more!
                                    </p>
                                    <p>
                                        Being a Private Tour, there is time for numerous stops and opportunities to
                                        wander around and create treasured memories!
                                    </p>
                                    <p>
                                        You will be able to walk along the sand of the world famous Bondi Beach and if
                                        you like, you can even dip your feet in the pristine water! The tour will also
                                        stop at the iconic Bondi 'Icebergs' club where you can take some fabulous photos
                                        encompassing the whole of Bondi!
                                    </p>
                                    <p>
                                        In addition to visiting all of the main tourist attractions and sights - We will
                                        also take you to many spectacular lookouts and stunning harbourside locations
                                        that are well off the tourist track - these are local 'secret spots' where other
                                        tour operators don't go - meaning you get to know the 'real' Sydney with your
                                        local expert guide!
                                    </p>
                                    <p>
                                        After exploring the beautiful Eastern side of Sydney the tour heads across the
                                        Sydney Harbour Bridge (being driven across this Aussie icon is a 'Must do!'
                                        activity when in Sydney) once over the bridge we make our way through the leafy
                                        North Shore to Sydney's other famous beach, Manly Beach where there will be
                                        plenty of time to walk along the promenade and watch the surfers and Sydney
                                        Harbour Ferries go by!
                                    </p>
                                    <p>
                                        The tour then takes in the city sights including Mrs Macquaries Chair - for the
                                        Best views of the Sydney Opera House and Harbour Bridge. As the day comes to an
                                        end, the final area we visit is the Historic Rocks area where the settlement of
                                        Sydney started - your guide will tell you about this areas fascinating colonial
                                        history.
                                    </p>
                                    <p>
                                        Throughout the day you will enjoy numerous stops and opportunities to take
                                        memorable photos.
                                    </p>
                                    <p>
                                        We will stop for lunch at either Bondi, Woolloomooloo or Manly - the choice is
                                        yours and your guide will be happy to assist you with recommendations based on
                                        your preferences!
                                    </p>
                                    <p>
                                        Your Friendly, Professional and Knowledgeable Aussie local guide will provide an
                                        interesting and informative commentary
                                    </p>
                                    <p>
                                        On this tour you can relax and enjoy the day knowing that everything is taken
                                        care of!
                                    </p>

                                </div>
                                <div role="tabpanel" class="tab-pane" id="includes">
                                    <div class="trip-incl">
                                        <p>
                                            <strong>What's Included in this tour</strong>
                                        </p>

                                        <div class="icon-list included mgbottom15">
                                            <ul>
                                                <li>Enjoy a delicious complimentary morning tea at a stunning
                                                    harbourside location
                                                </li>
                                                <li>Complimentary bottled water</li>
                                                <li>Customer service - smoothing out the headaches of travel 24 / 7</li>
                                                <li>Luxury, Fully Escorted Private Touring</li>
                                                <li>Pick up and drop off to your hotel, accommodation, airport or cruise
                                                    terminal
                                                </li>
                                            </ul>
                                        </div>
                                        <p>
                                            <strong>Whats not included in this tour</strong>
                                        </p>

                                        <div class="icon-list not-included">
                                            <ul>
                                                <li>Guests will have the opportunity to purchase lunch at a venue of
                                                    their choice
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="videos">

                                    <p>
                                        Pick up from your hotel or accommodation is 8:00 am. (If you require an earlier
                                        or later starting time we can accommodate this)
                                    </p>
                                    <p>
                                        8hours duration
                                    </p>
                                    <p>
                                        We pick guests up from your requested location in Sydney including hotels,
                                        cruise terminals, airport
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane active" id="gallery">
                                    <div class="package-detail-wrap bgWhite">
                                        <h3>SYDNEY FULL AND HALF DAY LUXURY PRIVATE TOURS</h3>
                                        <p class="price-tag">$395.00 per Adult </p>
                                        <p class="price-tag">$195.00 per Child (under 16 years) </p>
                                        <ul class="list-unstyled iti-list">

                                            <li>
                                                <strong>Destination:</strong> Rushcutters Bay, NSW
                                            </li>
                                            <li>
                                                <strong>Arrival on:</strong> Sydney, Australia
                                            </li>
                                            <li>
                                                <strong>Duration:</strong> 8 Hours (approx.)
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="panel contact-panel">
                        <h4 class="colorRed">Need Help?</h4>
                        <p></p>
                        <p class="help-wrap"><i class="fa fa-phone"></i> 1 (800) 865 845 </p>
                        <p class="help-wrap"><i class="fa fa-envelope-o"></i>
                            <a href="mailto:sher@shellytours.com">sher@shellytours.com</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('fscripts')
<script type="text/javascript" src="/js/pages/booking.js"></script>

@endsection