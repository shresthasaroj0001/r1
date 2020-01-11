@extends('front.master')
@section('fcss')
<link rel="stylesheet" href="css/pages/contact.css" type="text/css" />
<link rel="stylesheet" href="css/common/inner-all.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('bodycontent')
<section class="inner-header img-pos" style="background-image: url('img/contact.jpg');">
    <div class="overlay">
        <div class="container">
            <h1 class="page-title">Booking</h1>
            <ul class="breadcrumb">
                <li> <a href="/">Home</a> </li>
                <li class="active"> <a>Booking</a> </li>
            </ul>
        </div>
    </div>
</section>
<section class="section-pad-top section-pad-bottom">
    <div class="container">
        <div class="booking-wrap">
            <div>
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
            </div>

            <form class="row flex-row" method="POST" id="bookingForm" action="{{route('bookSubmit')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <input type="hidden" name="calId" id="calId" value="{{ $ids }}">
                <input type="hidden" name="adults" id="adults" value="{{ $adults }}">
                <input type="hidden" name="childs" id="childs" value="{{ $childs }}">

                <div class="form-group col-xs-12 col-md-6">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name"
                        required>
                    <span class="form_error" id="invalid_firstname" style="display:none">First Name is required</span>
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name"
                        required>
                    <span class="form_error" id="invalid_lastname" style="display:none">Last Name is required</span>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <label>Mobile Number</label>
                    <input type="text" class="form-control" name="mobilenos" id="mobilenos" placeholder="phone number"
                        required>
                    <span class="form_error" id="invalid_mobilenos" style="display:none">Mobile Number is
                        required</span>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <label>Alternate Mobile Number</label>
                    <input type="text" class="form-control" name="alt_mobilenos" id="alt_mobilenos"
                        placeholder="alternate phone number">
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <label>Email Address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="email" required>
                    <span class="form_error" id="invalid_email" style="display:none">Email is required</span>
                    <span class="form_error" id="invalid_email_invalid" style="display:none">Email is invalid</span>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <label>From / to which Cruise Terminal?</label>
                    <br>
                    <label class="radio-inline">
                        <input type="radio" name="cruiseterminal" value="circularQuay"> Circular Quay
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="cruiseterminal" value="whiteBay"> White Bay
                    </label>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <label>From / to which Airport?</label>
                    <br>
                    <label class="radio-inline">
                        <input type="radio" name="airport" value="domestic"> Domestic
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="airport" value="international"> International
                    </label>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <label>Other</label>
                    <input type="text" class="form-control" name="other">
                </div>
                <div class="form-group col-xs-12 col-md-12" id="triptypeDiv">
                    <label>Is this a Single or Return trip?</label>
                    <br>
                    <label class="radio-inline">
                        <input type="radio" id="triptyperdr" name="triptype" value="Single Trip"> Single Trip
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="triptype" value="Return Trip"> Return Trip
                    </label>
                    <div>
                        <span class="form_error" id="invalid_triptype" style="display:none">Please Specify Trip
                            type</span>
                    </div>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label>Travel Date/ Time</label>
                    <input type="text" class="form-control" name="traveldate" required
                        placeholder="Travel Date and Time" readonly id="traveldate">
                    <input type="hidden" hidden readonly name="traveldatetime" id="traveldatetime">
                    <span class="form_error" id="invalid_traveldate" style="display:none">Travel Date Time is
                        required</span>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label>Pickup/ Destination Address</label>
                    <input type="text" name="pickupaddress" id="pickupaddress" class="form-control"
                        placeholder="pickup or destination address" required>
                    <span class="form_error" id="invalid_pickupaddress" style="display:none">Pickup/Destination is
                        required</span>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label>Number of Passengers</label>
                    <select name="noofpassenger" id="noofpassenger" class="form-control" required>
                        <option value="">Select Passenger Number</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                    <span class="form_error" id="invalid_noofpassenger" style="display:none">Passenger Number is
                        required</span>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label>Flight Number/ Cruise Name</label>
                    <input type="text" name="flightinfo" id="flightinfo" class="form-control"
                        placeholder="flight number or cruise name">
                    <span class="form_error" id="invalid_flightinfo" style="display:none">Flight / Cruise Information is
                        required</span>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label>Child Seats</label>
                    <br>

                    <label class="checkbox-inline">
                        <input type="checkbox" name="childseats[]" value="1">Baby Seat Required
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="childseats[]" value="2"> Booster Seat Required
                    </label>
                </div>

                <div class="form-group col-xs-12 col-md-12" id="privatecharterDiv">
                    <label>Private Charter</label>
                    <br>
                    <label class="radio-inline">
                        <input type="radio" id="pvtcharter" name="privatecharter" value="1"> Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="privatecharter" value="0"> No
                    </label>
                    <div>
                        <span class="form_error" id="invalid_privatecharter" style="display:none">Please charter</span>
                    </div>
                </div>

                <div class="form-group col-xs-12 col-md-12">
                    <label>Additional Info</label>
                    <textarea name="additionalinfo" class="form-control" rows="5"></textarea>
                </div>

                <div class="form-group col-xs-12">
                    <button type="button" class="submitbtn btn btn-danger btn-lg">Confirm & Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
<style>
    .form_error {
        color: red;
        margin-top: 2px !important;
    }
</style>
@endsection
@section('fscripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="/myjs/f/booknow.js"></script>
@endsection