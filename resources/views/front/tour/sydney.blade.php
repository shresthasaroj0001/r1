@extends('front.master')

@section('fcss')
<link rel="stylesheet" href="/css/pages/destination.css" type="text/css" />
<link rel="stylesheet" href="/plugins/imageViewer/viewer.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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

@include('admin.messages')
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
					<div class="title-captions">
						{!! $tour[0]->infos !!}
					</div>
					<h4 class="section-title"> Cost </h4>
					<table class="table table-responsive">
						<thead>
							<tr>
								<th> Type </th>
								<th> Per Price </th>
								<th> Qty </th>
								<th> Total </th>	
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<label> Adult </label>
								</td>
								<td>
									<span id="AdultRate"><span>
								</td>
								<td>
									<select name="" class="changeqty" id="adultqty">
										<option value="0">0</option>
										<option value="1" selected="">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select>
								</td>
								<td>
									<span id="adultfinalr"></span>
								</td>
							</tr>
							<tr>
								<td>
									<label> Child </label>
								</td>
								<td>
									<span id="ChildRate"><span>
								</td>
								<td>
									<select name="" class="changeqty" id="childqty">
										<option value="0" selected="">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select>
								</td>
								<td>
									<span id="childfinalr"></span>
								</td>
							</tr>
							<tr>
								<td colspan="4" style="display: none" id="boksDiv">
									<span id="datepicker"></span>
								</td>
							</tr>
							<tr>
								<td colspan="4" style="display: none" id="boksDiv">
									<select name="t" id="bookingtimeselection" class="form-control">
										<option value="0">Select Time</option>
										<option value=""></option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<label for="">Total: </label>
									<span id="totalprice"></span>
								</td>
							</tr>
						
						</tbody>
						
					</table>
					
					{{-- <div class="rates">
						<p> <label>$<span id="adult-rate"></span>.00</label> per Adult </p>
						<p><label> $<span id="child-rate"></span>.00</label> per Child (under 16 years)
					</div> --}}
					<div class="rates-caption mb-30">
						<span> *PRICE IS FULLY INCLUSIVE OF GOODS AND SERVICES TAX (GST)</span> <br>
						<span> *PRICES ARE QUOTED IN AUSTRALIAN DOLLARS </span>
					</div>
					<div id="checkavailabityBtn">
					<button class="btn btn-danger mgbottom15" type="button">Book Now</button>
					<button class="btn btn-danger mgbottom15" type="button">Check Availabiliy</button>
					</div>
					<div class="book-now-btn" style="display: none" id="boksDiv" >
						<div id="sa">
							<div id="bookingbtnDiv" style="display: none">
								<button id="BookNowBtn" class="btn btn-danger"  type="button" data-backdrop="static" >Book Now</button></div>
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
			<div class="col-lg-4 col-md-4" style="display: none" id="boksDiv">
				<div class="package-detail-wrap bgWhite" style="padding: 10px !important;">
					{{-- <h3>Start Booking now</h3> --}}
					<input type="text" hidden value="{{ $tour[0]->id}}" id="product-id">

					{{-- <div class="row">
						<div id="datepicker" class="col-md-12"></div>
					</div> --}}
					{{-- <div class="row" style="margin-top: 0.5em;">
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
						
					</div> --}}
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
<input type="text" hidden value="{{ $dates }}" id="mydates">
	</div>
</section>
<div class="modal fade" id="modal-overlaysss">
	<div class="modal-dialog">
		<div class="modal-content" id="modales">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Confirm Booking</h4>
			</div>
			<div class="modal-body">
				<form class="row flex-row" method="POST" id="bookingForm" action="{{ route('bookingsubmit')}}">
					<input type="text" hidden id="redirectFrmId" value="" name="calId">
					<input type="text" hidden id="redirectFrmadults" value="" name="adults">
					<input type="text" hidden id="redirectFrmchilds" value="" name="childs">
					<input type="text" hidden value="0" name="noofpassenger ">

					<input type="hidden" name="_token" id="tokenn" value="{{ csrf_token() }}">
					<div class="form-group col-xs-12 col-md-6">
						<label>First Name <span class="required"> *</span> </label>
						<input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name"
							required>
						<span class="form_error" id="invalid_firstname" style="display:none">First Name is required</span>
					</div>
					<div class="form-group col-xs-12 col-md-6">
						<label>Last Name <span class="required"> *</span></label>
						<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name"
							required>
						<span class="form_error" id="invalid_lastname" style="display:none">Last Name is required</span>
					</div>
					<div class="form-group col-xs-12 col-md-6">
						<label>Mobile Number <span class="required"> *</span> </label>
						<input type="text" class="form-control" name="mobilenos" id="mobilenos" placeholder="Phone Number"
							required>
						<span class="form_error" id="invalid_mobilenos" style="display:none">Mobile Number is
							required</span>
					</div>
					<div class="form-group col-xs-12 col-md-6">
						<label>Alternate Mobile Number</label>
						<input type="text" class="form-control" name="alt_mobilenos" id="alt_mobilenos"
							placeholder="Alternate Phone Number">
					</div>
					<div class="form-group col-xs-12 col-md-6">
						<label>Email Address <span class="required"> *</span> </label>
						<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
						<span class="form_error" id="invalid_email" style="display:none">Email is required</span>
						<span class="form_error" id="invalid_email_invalid" style="display:none">Email is invalid</span>
					</div>
	
					<div class="form-group col-xs-12 col-md-12">
						<label>Additional Info</label>
						<textarea name="additionalinfo" class="form-control" placeholder="Additional Informations" id="adInfos" rows="5"></textarea>
					</div>
					<div class="form-group col-xs-12 col-md-12">
						<span class="required"> *</span> are required fields.
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{{-- <button type="button" class="btn btn-primary" id="closeModalBtn">Save changes</button> --}}
				<button type="button" class="submitbtn btn btn-danger">Confirm & Submit</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
@endsection

@section('fscripts')
<script src="/plugins/imageViewer/viewer.min.js"></script>
<script src="/plugins/imageViewer/jquery-viewer.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="/myjs/f/booking.js"></script>
{{-- <script type="text/javascript" src="/myjs/f/booknow.js"></script> --}}
<!-- <script src="/dist/jquery-viewer.min.js"></script> -->
<script type="text/javascript">
	$('#images').viewer({
    // options here
		});
	// $('#modal-overlaysss').modal({backdrop: 'static', keyboard: false})  
</script>
@endsection