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
              <a href="{{route('admin.fix-departure',$menu_id)}} "><button class="btn btn-primary" type="button">View
                  All Event</button></a>
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
                {{-- <div class="row" style="display: none; width: 100%; padding-left: 1em; margin-bottom: 2pm"
                  id="rateinputDiv">
                  <div class="col-md-12" style="margin-top: 1em;">
                    <label for="">Rate For 1-4 people</label>
                    <input type="text" class="moneyValidator" id="rateFor1_4">
                  </div>
                  <div class="col-md-12" style="margin-top: 1em;">
                    <label for="">Rate For 5-7 people</label>
                    <input type="text" class="moneyValidator" id="rateFor5_7">
                  </div>
                  <div class="col-md-12" style="margin-top: 1em;">
                    <label for="">Rate For 9-11 people</label>
                    <input type="text" class="moneyValidator" id="rateFor9_11">
                  </div>
                  <div class="col-md-12" style="margin-top: 1em;">
                    <label for="">Rate For 12-23 people</label>
                    <input type="text" class="moneyValidator" id="rateFor12_23">
                  </div>
                  
                  <div class="col-md-12">
                    <button type="button" id="addTOlistBtn" class="btn btn-primary">Add To List</button>
                  </div>
                </div> --}}

              </div>
              <br>
              <div id="12div" class="row col-md-12" style="display: none; width: 100%; margin-top: 1em">
                <table id="mytble" class="table table-bordered">
                  <thead id="dataTbl_head">
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

  <div class="modal fade" id="modal-overlays">
    <div class="modal-dialog">
      <div class="modal-content" id="modalsss">
        <div class="modal-header">
          <h4 class="modal-title" id="headingss"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" class="form-horizontal">
            <table class='table table-bordered' id='feeratetbl'>
              <thead>
                <tr>
                  <th>Group Size</th>
                  <th>Rate</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($feeNames as $item)
                <tr>

                  <td>
                    <label>Group {{$item->grpLow}} - {{$item->grpHigh}}</label></td>
                  <td>
                    <input type="text" class="moneyValidator" name="Group {{$item->grpLow}} - {{$item->grpHigh}}" id="{{$item->id}}"></td>
                </tr>
                @endforeach
              </tbody>

            </table>

          </form>
          <b>Note: </b> Changes May Apply On Refreshing Page.
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="addTOlistBtn">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
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