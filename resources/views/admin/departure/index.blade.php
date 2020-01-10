@extends('admin.master')
@section('b_body')

<div class="content-header">
  <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0 text-dark">Departure</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}'">Home</a></li>
                  <li class="breadcrumb-item active">Tour Selection</li>
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
                        <a href="{{route('admin.fix-departure.add',$menu_id)}} "><button class="btn btn-primary ">Add Multiple
                          Event</button></a>
                      </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <input type="text" hidden value="{{ $menu_id }}" id="menuId">
                    <div id='calendar'></div>
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
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<link href="/js/calender/fullcalendar.css" rel="stylesheet">
<style>
  .navbar {
    margin-bottom: 0px !important;
    border: 0px !important;
  }

  html {
    font-size: medium;
    line-height: 1.5;
  }

  span.fc-title {
    padding-left: 4px;
    padding-right: 4px;
  }

  td.fc-event-container {
    padding-left: 4px;
    padding-right: 4px;
  }

  a.fc-day-grid-event.fc-h-event.fc-event.fc-start.fc-end {
    margin-bottom: 3px;
  }

  .fc-row.fc-week.fc-widget-content.fc-rigid {
    height: 100%;
  }

  .fc-basic-view .fc-body .fc-row {
    min-height: inherit;
  }

  .fc-content .fc-title {
    color: white;
    font-size: large;
    white-space: normal;
  }
</style>
@endsection

@section('f_scripts')
{{-- <script src="/plugins/jquery/jquery.min.js"></script> --}}


{{-- <script src="/plugins/fullcalendar/main.min.js"></script> --}}

{{-- <script src="/vendor/bootstrap/js/bootstrap.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="/js/calender/fullcalendar.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js">
</script>  


<script src="/myjs/calender.js"></script>
@endsection