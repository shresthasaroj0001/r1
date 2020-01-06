@extends('admin.master') 
@section('b_body')
<div class="">
  <div class="row">
    <div style="font-family: Trocchi;margin-top: 1em;
      font-size: 50px;
      color: steelblue;
      text-align: center;">
      <div id="top" style="">Oops!</div>

      <div id="middle" style="
          font-weight: bold;">404</div>
          {{-- <a href="/"><img src="/images/homepage.jpg" height="53px" alt="Return Home"></a> --}}
      <div id="bottom" style="font-size: 30px;margin-left:5em;">Sorry, couldn't find what you're looking for</div>
    </div>
  </div>
</div>
@endsection