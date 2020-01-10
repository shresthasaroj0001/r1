@extends('front.master')

@section('fcss')
<link rel="stylesheet" href="/css/pages/destination.css" type="text/css" />
<link rel="stylesheet" href="/plugins/imageViewer/viewer.min.css">

@endsection

@section('bodycontent')
<section class="inner-header img-pos" style="background-image: url('/img/slider3.jpg');">
	<div class="overlay">
		<div class="container">
			<h1 class="page-title">Tours</h1>
			<ul class="breadcrumb">
				<li> <a href="/">Home</a> </li>
				<li class="active"> <a>{{ $tour[0]->title }}</a> </li>
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
							@if ($tour[0]->featureImg == "")
							<img src="/img/tours/sydney-full-day/2.jpg" class="img-responsive" />
							@else
							<img src="/uploads/{{ $tour[0]->featureImg }}" class="img-responsive" />
							@endif
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4" style="" id="infosDiv">
				<div class="package-detail-wrap bgWhite">
					<h3>{{ $tour[0]->title }}</h3>
					{!! $tour[0]->infos !!}
					<button class="btn btn-danger mgbottom15" type="button">Book Now</button>
					<button class="btn btn-danger mgbottom15" type="button">Check Availabiliy</button>
				</div>
			</div>
			<div class="col-lg-4 col-md-4" style="display: none" id="boksDiv">
				<div class="package-detail-wrap bgWhite" style="padding: 10px !important;">
					<h3>Start Booking now</h3>
					<div class="row">
						<div class="col-md-3">Adult</div>
						<div class="col-md-3">
							<p id="AdultRate"></p>
						</div>
						<div class="col-md-3">
							<select name="" class="changeqty" id="adultqty">
								<option value="0">0</option>
								<option value="1" selected>1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
							</select>
						</div>
						<div class="col-md-3">
							<p id="adultfinalr"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">Child</div>
						<div class="col-md-3">
							<p id="ChildRate"></p>
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
						<div class="col-md-3">
							<p id="childfinalr"></p>
						</div>
					</div>
					<input type="text" hidden value="{{ $tour[0]->id}}" id="product-id">

					<div class="row">
						<div id="datepicker" class="col-md-12"></div>
					</div>
					<div class="row" style="margin-top: 0.5em;">
						<div class="col-md-12" style="margin-bottom: 5px;">
							<select name="t" id="bookingtimeselection" class="form-control" style="height: auto">
								<option value="0">Select Time</option>
								<option value=""></option>
							</select>
						</div>
						<div class="col-md-4">
							<label for="">Total</label>
							<p id="totalprice"></p>
						</div>
						<div id="sa" class="col-md-8">
							<div id="bookingbtnDiv" style="display: none">
								<button id="BookNowBtn" class="btn btn-success" type="button">Book Now</button></div>
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
			</div>
		</div>
		<div class="row" style="margin-top: 1em;">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="bgWhite">
					<div class="tab-wrap">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs detail-tab" role="tablist">
							<li role="presentation" class="iti" id="iti1" style="display: none"><a href="#infoos"
									aria-controls="infoos" role="tab" data-toggle="tab"
									aria-expanded="false">Information</a></li>
							<li role="presentation" class="iti active"><a href="#itinerary" aria-controls="itinerary"
									role="tab" data-toggle="tab" aria-expanded="false">Itinerary</a></li>
							<li role="presentation" class="iti "><a href="#includes" aria-controls="includes" role="tab"
									data-toggle="tab" aria-expanded="false">Package Includes</a></li>
							<li role="presentation" class="iti "><a href="#videos" aria-controls="videos" role="tab"
									data-toggle="tab" aria-expanded="false">Duration & Departure</a></li>
							<li role="presentation" class="iti "><a href="#gallery" aria-controls="gallery" role="tab"
									data-toggle="tab" aria-expanded="false">Gallery</a></li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content detail-content">
							<div role="tabpanel" class="tab-pane sa123" id="infos">
								{!! $tour[0]->infos !!}
							</div>

							<div role="tabpanel" class="tab-pane sa123 active" id="itinerary">
								{!! $tour[0]->itinerary !!}
							</div>
							<div role="tabpanel" class="tab-pane sa123" id="includes">
								<div class="trip-incl">
									{!! $tour[0]->packageincludes !!}
								</div>
							</div>
							<div role="tabpanel" class="tab-pane sa123" id="videos">
								{!! $tour[0]->durationdetail !!}
							</div>
							<div role="tabpanel" class="tab-pane sa123" id="gallery">
								<ul id="images">
									@foreach ($galleries as $key => $item)
									<li><img src="/uploads/{{ $item->title}}" alt="Picture{{$key}}"></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="panel contact-panel">
					<h4 class="colorRed">Need Help?</h4>
					<p class="help-wrap"> <i class="fa fa-phone"></i> 1 (800) 865 845 </p>
					<p class="help-wrap"> <i class="fa fa-envelope-o"></i> <a
							href="mailto:sher@shellytours.com">sher@shellytours.com</a>
					</p>
				</div>
			</div>

		</div>
	</div>
	<div style="display: none">
		<form action="/book-now" id="redirectForm" method="post">
			<input type="text" hidden value="{{ csrf_token()}}" name="_token" id="tokenn">
			<input type="text" hidden id="redirectFrmId" value="" name="redirectFrmId">
			<input type="text" hidden id="redirectFrmadults" value="" name="redirectFrmadults">
			<input type="text" hidden id="redirectFrmchilds" value="" name="redirectFrmchilds">
			<button type="submit" id="redirectSubmit"></button>
		</form>
	</div>
	
</section>

@endsection

@section('fscripts')
<script src="/plugins/imageViewer/viewer.min.js"></script>
<script src="/plugins/imageViewer/jquery-viewer.js"></script>
<script src="/myjs/f/booking.js"></script>
<!-- <script src="/dist/jquery-viewer.min.js"></script> -->
<script type="text/javascript">
	$('#images').viewer({
    // options here
    });
</script>
@endsection