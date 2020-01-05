@extends('front.master')
@section('fcss')
<link rel="stylesheet" href="css/common/inner-all.css" type="text/css" />
<link rel="stylesheet" href="css/pages/faq.css" type="text/css" />
@endsection
@section('bodycontent')
<section class="inner-header img-pos" style="background-image: url('img/faq.jpg');">
    <div class="overlay">
      <div class="container">
        <h1 class="page-title">FAQ</h1>
        <ul class="breadcrumb">
          <li> <a href="#">Home</a> </li>
          <li class="active"> <a href="#">FAQ</a> </li>
        </ul>
      </div>
    </div>
  </section>
  <section class="section-pad-top section-pad-bottom">
    <div class="container">
      <div class="faq-wrap">

        <div id="faq-accordion" role="tablist">
          <div class="faq-panel">
            <h5>
              <a role="button" data-toggle="collapse" data-parent="#faq-accordion" href="#faq1" aria-expanded="true"
                aria-controls="faq1">Will I receive a confirmation of my online reservation?</a>
            </h5>
            <div id="faq1" class="panel-collapse collapse in" role="tabpanel">
              <p>Yes, you will be notified through email upon final booking process.</p>
            </div>
          </div>
          <div class="faq-panel">
            <h5>
              <a role="button" data-toggle="collapse" data-parent="#faq-accordion" href="#faq2" aria-expanded="false"
                aria-controls="faq2">What documents do I need to pick up the car?</a>
            </h5>
            <div id="faq2" class="panel-collapse collapse" role="tabpanel">
              <p>The renter must present a Full Australian driver's licence or a valid International license that has
                been held for a minimum of one year. An international driver’s license must include a photo of
                yourself and is in English. You will&nbsp; also be required to present your passport, original license
                with your international drivers license, visa copy, address in Australia if living in a hotel or any
                other accommodation.</p>
            </div>
          </div>
          <div class="faq-panel">
            <h5>
              <a role="button" data-toggle="collapse" data-parent="#faq-accordion" href="#faq3" aria-expanded="false"
                aria-controls="faq3">Can my partner or friend drive the car?</a>
            </h5>
            <div id="faq3" class="panel-collapse collapse" role="tabpanel">
              <p>Yes your partner, friend or relative can drive the car provided they meet all licensing conditions.
                They need to be added to the rental agreement by signing an "Additional Driver" form. An additional
                fee (once-off) $10 per&nbsp; driver will apply. The Renter must&nbsp; provide details of additional
                driver&nbsp; name, address, date of birth &amp; license number.</p>
            </div>
          </div>
          <div class="faq-panel">
            <h5>
              <a role="button" data-toggle="collapse" data-parent="#faq-accordion" href="#faq4" aria-expanded="false"
                aria-controls="faq4">How can I pay for the car bookings? Is Cash acceptable?</a>
            </h5>
            <div id="faq4" class="panel-collapse collapse" role="tabpanel">
              <p>We&nbsp; accept Credit cards and debit cards (Master or Visa). There will be 3% surcharge for
                Amex&nbsp; and dinners. Rental bond must be paid by Credit cards. No Cash payment.</p>
            </div>
          </div>
          <div class="faq-panel">
            <h5>
              <a role="button" data-toggle="collapse" data-parent="#faq-accordion" href="#faq5" aria-expanded="false"
                aria-controls="faq5">Can I keep the car a bit longer than the agreed date and time? Is there any
                cancellation fee?</a>
            </h5>
            <div id="faq5" class="panel-collapse collapse" role="tabpanel">
              <p>Yes, you can keep the car longer than originally rented period for. Please let us know by phone
                immediately and also subjected to car availability for sure.<br>we won't charge for cancellation or
                change the booking if you notify us within 12 hours of pick up date and time. however, during busy
                seasons such as Christmas and new year and Easter and other long holidays, you will be charged a
                $50.00 cancellation fee.</p>
            </div>
          </div>
          <div class="faq-panel">
            <h5>
              <a role="button" data-toggle="collapse" data-parent="#faq-accordion" href="#faq6" aria-expanded="false"
                aria-controls="faq6">What is included in your rates? Do you charge additional fees?</a>
            </h5>
            <div id="faq6" class="panel-collapse collapse" role="tabpanel">
              <p>All our rates are displayed while you make a booking. There will be a charge for insurance excess,
                GPS, Child seats, additional driver, Credit card (Amex and Dinner).<br>All child seats are charged at
                AUD $3 per day and is capped at $84 per seat. GPS are charges at $3 per day and is capped at $60
                .&nbsp; An additional driver will attract a once off fee of $10 per person.</p>
            </div>
          </div>
          <div class="faq-panel">
            <h5>
              <a role="button" data-toggle="collapse" data-parent="#faq-accordion" href="#faq7" aria-expanded="false"
                aria-controls="faq7">What is the basic excess in the event of an accident? do I have to buy an
                insurance
                for protection?</a>
            </h5>
            <div id="faq7" class="panel-collapse collapse" role="tabpanel">
              <p>The standard excess is $2500. you can reduce your liability to $1200 by taking an&nbsp;excess waiver
                ($8 per day) and is optional. furthermore, your damage liability can be reduced to $450 by taking a
                &nbsp;top cover of $29 per day.</i>
                <div><i>&nbsp;Please note that any overhead, interior, under body, reversing, third party property,
                    windscreen and tyre damage,&nbsp;driven car on unsealed roads ,careless and wilfully driving will
                    not be covered and treated as a breach of Terms and conditions.
              </p>
            </div>
          </div>
        </div>
        <div class="faq-panel">
          <h5>
            <a role="button" data-toggle="collapse" data-parent="#faq-accordion" href="#faq8" aria-expanded="false"
              aria-controls="faq8">Do I need to buy&nbsp; roadside assistance in the event of a breakdown?</a>
          </h5>
          <div id="faq8" class="panel-collapse collapse" role="tabpanel">
            <p>you are covered by NRMA&nbsp;24 hour roadside assistance. Some rental companies do charge for Breakdown
              help unless you buy roadside cover assistance, but we don't. <br>In the event of car&nbsp;breakdown
              please contact NRMA on 1300 369 349 and give them our Membership number, car registration,&nbsp; located
              in&nbsp;the car glove box. In the case of flat tyre, spare tyre and car jack is located under the boot
              if you able to change them.<br>However, a callout fee of $75 is applicable as a result of human error
              such as batteries gone flat because of lights being left-on, keys being locked or lost in a vehicle
              etc.<br>A replacement fee of $800 is payable in the event of lost keys.</p>
          </div>
        </div>
        <div class="faq-panel">
          <h5>
            <a role="button" data-toggle="collapse" data-parent="#faq-accordion" href="#faq9" aria-expanded="false"
              aria-controls="faq9">Do I need to pay rental bond for booking?</a>
          </h5>
          <div id="faq9" class="panel-collapse collapse" role="tabpanel">
            <p>Yes. We charge a rental bond of $200 &nbsp;(PRE-AUTH) to complete your booking and must be paid by a
              valid Credit card. This amount will be reserved in order to secure a car or booking.
              Please&nbsp;understand this is for security and insurance purposes and will be refunded upon returning
              the car provided that there are no additional charges or damages incurred. The refund may take between
              3-5 days to hit your account depending on your banking institutions.</p>
          </div>
        </div>
        <div class="faq-panel">
          <h5>
            <a role="button" data-toggle="collapse" data-parent="#faq-accordion" href="#faq10" aria-expanded="false"
              aria-controls="faq10">Do you have mileage limit?</a>
          </h5>
          <div id="faq10" class="panel-collapse collapse" role="tabpanel">
            <p>We allow 120 km per day for a Limited use and any extra km will be charged at 30 cents per km. &nbsp;If
              you expecting &nbsp;longer trips or countryside travelling, you would be better off with&nbsp; our
              Unlimited km’s option.</p>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
@endsection