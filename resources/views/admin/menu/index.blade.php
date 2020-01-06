@extends('admin.master')
@section('b_body')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Menu</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}'">Home</a></li>
                    <li class="breadcrumb-item active">Menu</li>
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
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key =>$item)
                                  <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->days}}</td>
                                    <td>
                                        <a href="{{route('trip.edit',[$item->id])}}">
                                            <button class="btn btn-primary">Edit</button></a>
                            <button type="button" class="btn btn-danger btn-sm action-delete" rowid="{{$item->id}}"> Delete </button>
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
@section('f_scripts')
<script src='https://cdn.tiny.cloud/1/{{env('TINY_API_KEY')}}/tinymce/5/tinymce.min.js'> </script>
<script>
    tinymce.init({ selector: '#descriptions',plugins:'link' });
    tinymce.init({ selector: '#inclusionlist',plugins:'link' });
    tinymce.init({ selector: '#exclusionlist',plugins:'link' });
    tinymce.init({ selector: '#infos',plugins:'link' });
</script>
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