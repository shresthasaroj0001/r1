@extends('admin.master')
@section('b_body')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        {{-- <h1 class="m-0 text-dark">Departure</h1> --}}
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}'">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}'">Tour Selection</a></li>
          <li class="breadcrumb-item active">Departure</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">TOUR NAME: {{ $menu_title}}</h3>

            <div class="card-tools">
              <a href="{{route('admin.fix-departure',$menu_id)}} "><button class="btn btn-primary"
                  type="button">View All Event</button></a>
                  <input type="text" hidden value="{{$menu_id}}" id="menuids">
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12" id="dateselection">
                <label for="">Select Date</label>
                <div id="mdp-demoo"></div>
                <p style="color: red; display: none" id="dateerror"></p>
                <br>
                <div>
                  <button class="btn btn-primary" id="addevents">Add Event</button>
                </div>
              </div>

              <div style="display: none;width: 100%" id="timeselectionDiv">
                <div class="col-md-12 a">
                  Selected Dates:
                  <p id="selectedDate" style="background-color: palegreen;"></p>
                </div>
                {{-- <div class=""> --}}
                <div class="col-md-4">
                  <span>Please choose time</span>
                  <br>
                  <p>e.g: 2 PM just Type: 1400</p>
                  <div class="input-group bootstrap-timepicker timepicker col-md-3" style="padding-left: 0;">
                    <input id="timepicker1" type="text" class="form-control input-small">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  </div>
                  <br>
                  <div>
                    <button class="btn btn-primary" id="addtime">Add Event in this Time</button>
                  </div>
                </div>
                <div class="row" style="display: none; width: 100%; padding-left: 1em; margin-bottom: 2pm"
                  id="rateinputDiv">
                  <div class="col-md-12" style="margin-top: 1em;">
                    <label for="">Rate For Adult</label>
                    <input type="text" class="moneyValidator" id="rateForAdult">
                  </div>
                  <div class="col-md-12">
                    <label for="">Rate For Child</label>
                    <input type="text" class="moneyValidator" id="rateForChild">
                  </div>
                  <div class="col-md-12">
                    <label for="">Number Of Availability</label>
                    <input type="text" id="noOfAvailable" class="">
                  </div>
                  <div class="col-md-12">
                    <button type="button" id="addTOlistBtn" class="btn btn-primary">Add To List</button>
                  </div>
                </div>

              </div>
              <br>
              <div id="12div" class="row col-md-12" style="display: none; width: 100%; margin-top: 1em">
                <table id="mytble" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Time</th>
                      <th>Rate Adult</th>
                      <th>Rate Child</th>
                      <th>No of Seats</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="dataTbl">
                  </tbody>
                </table>
              </div>
              <br>

              <div id="finaldiv" style="display: none; margin-top: 1em" class="row col-md-12">
                <button type="button" class="btn btn-success" id="finalsubmitbtn">Submit</button>
              </div>

            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
  <input type="text" hidden id="tooken" value="{{ csrf_token() }}">
</section>
@endsection

@section('fstylesheet')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="/js/picker/jquery-ui.multidatespicker.css" rel="stylesheet">
@endsection

@section('f_scripts')
{{-- <script src="/plugins/jquery/jquery.min.js" type="text/javascript"></script> --}}
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/bootstrap/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="/js/picker/jquery-ui.multidatespicker.js"></script>
<script type="text/javascript" src="/myjs/departure.js"></script>
@endsection