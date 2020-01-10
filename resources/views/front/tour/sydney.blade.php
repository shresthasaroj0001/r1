@extends('front.master')

@section('fcss')
<link rel="stylesheet" href="/css/pages/destination.css" type="text/css" />
<link rel="stylesheet" href="/plugins/imageViewer/viewer.min.css">

@endsection

@section('bodycontent')
<section class="inner-header img-pos" style="background-image: url('img/slider3.jpg');">
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
				{{-- <div class="destination-thumb">
					<div>
						<img src="/img/destination.jpg" class="img-responsive" />
					</div>
					<div>
						<img src="/img/destination.jpg" class="img-responsive" />
					</div>
					
				</div> --}}
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="package-detail-wrap bgWhite">
					<h3>{{ $tour[0]->title }}</h3>
					{!! $tour[0]->infos !!}
					{{-- <h3>SYDNEY FULL AND HALF DAY LUXURY PRIVATE TOURS</h3>
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
					</ul> --}}
					<a href="/booknow" class="btn btn-danger mgbottom15">Book Now</a>
					<a href="/booknow" class="btn btn-danger mgbottom15">Check Availabiliy</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="bgWhite">
					<div class="tab-wrap">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs detail-tab" role="tablist">
							<li role="presentation" class="active"><a href="#itinerary" aria-controls="itinerary"
									role="tab" data-toggle="tab" aria-expanded="false">Itinerary</a></li>
							<li role="presentation" class=""><a href="#includes" aria-controls="includes" role="tab"
									data-toggle="tab" aria-expanded="false">Package Includes</a></li>
							<li role="presentation" class=""><a href="#videos" aria-controls="videos" role="tab"
									data-toggle="tab" aria-expanded="false">Duration & Departure</a></li>
							<li role="presentation" class=""><a href="#gallery" aria-controls="gallery" role="tab"
									data-toggle="tab" aria-expanded="false">Gallery</a></li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content detail-content">
							<div role="tabpanel" class="tab-pane active" id="itinerary">
								{!! $tour[0]->itinerary !!}
							</div>
							<div role="tabpanel" class="tab-pane" id="includes">
								<div class="trip-incl">
									{!! $tour[0]->packageincludes !!}
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="videos">
								{!! $tour[0]->durationdetail !!}
							</div>
							<div role="tabpanel" class="tab-pane" id="gallery">
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
</section>

@endsection

@section('fscripts')
<script src="/plugins/imageViewer/viewer.min.js"></script>
<script src="/plugins/imageViewer/jquery-viewer.js"></script>

<!-- <script src="/dist/jquery-viewer.min.js"></script> -->
<script type="text/javascript">
	$('#images').viewer({
    // options here
    });
</script>
@endsection