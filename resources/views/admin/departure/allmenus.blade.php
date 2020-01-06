@extends('admin.master')
@section('f_scripts')
<script src="/plugins/jquery/jquery.min.js"></script>
<script>
$(function(){
    var table;
});
</script>
@endsection

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
                    <li class="breadcrumb-item active">Tours</li>
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
                        <h3 class="card-title">Menu List</h3>

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
                                    <th>Description</th>
                                    <th></th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key =>$item)
                                  <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{ substr(strip_tags($item->descriptions),0,10) }}</td>
                                    <td>{{ strlen(strip_tags($item->descriptions)) > 10 ? "...":"" }}</td>
                                    <td>{{$item->days}}</td>
                                    <td>
                                        <a href="{{route('admin.fix-departure',[$item->id])}}">
                                            <button class="btn btn-primary">View</button></a>
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
