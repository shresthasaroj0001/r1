@extends('admin.master')
@section('b_body')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tours</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}'">Home</a></li>
                    <li class="breadcrumb-item active">Tour</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@include('admin.messages')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tour List</h3>

                        <div class="card-tools">
                            <a href="{{ route('trip.create') }}"><button type="button" class="btn btn-default">Add</button></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover" id="mytbl">
                            <thead>
                                <tr>
                                    <th>S N</th>
                                    <th>Title</th>
                                    {{-- <th>Description</th> --}}
                                    {{-- <th></th> --}}
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key =>$item)
                                  <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$item->title}}</td>
                                    {{-- <td>{{ substr(strip_tags($item->descriptions),0,10) }}</td> --}}
                                    {{-- <td>{{ strlen(strip_tags($item->descriptions)) > 10 ? "...":"" }}</td> --}}
                                    <td>{{$item->days}}</td>
                                    <td>
                                        @if ($item->stats ==1)
                                        <span class="label label-success">Active</span>
                                @else
                                <span class="label label-danger">In-Active</span>
                                @endif
                                    </td>
                                    <td>
                                        <a href="{{route('gallery.index',[$item->id])}}">
                                            <button class="btn btn-success">Gallery</button></a>
                                        <a href="{{route('trip.edit',[$item->id])}}">
                                            <button class="btn btn-primary">Edit</button></a>
                            <button type="button" class="btn btn-danger action-delete" rowid="{{$item->id}}"> Delete </button>
                                    </td>
                                </tr>  
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<input type="hidden" name="_token" id="tokken" value="{{ csrf_token() }}">

@endsection

@section('fstylesheet')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">    
@endsection

@section('f_scripts')
<script src="/plugins/jquery/jquery.min.js"></script>
<script src="/plugins/datatables/jquery.dataTables.js"></script>
<script>
$(function(){
    var table;
        table = $("#mytbl").DataTable({});

    $(".action-delete").click(function(){
        button = null;
        button = $(this);
        //(button.attr('rowid'));

        var result = confirm("Are You Sure You want to delete ?");
        if (result) {
            var i = window.location.href+"/"+(button.attr('rowid'));
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $("#tokken").val()},
                url:i,
                type: 'Delete',
                success: function (ddata) {
                    if(ddata==0){
                        alert('Internal Error');
                        return false;
                    }
                    
                    if(ddata==1){
                        button.closest('tr').addClass('Row4Delete');
                        $('.Row4Delete').remove();
                    }
                }
            });
        }
    });

});
</script>
@endsection