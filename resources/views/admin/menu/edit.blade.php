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
                    <li class="breadcrumb-item"><a href="{{ route('trip.index') }}'">Menu</a></li>
                    <li class="breadcrumb-item active">Update</li>
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
                        <h3 class="card-title">Edit Menu</h3>

                        <div class="card-tools">
                            <a href="{{ route('trip.index') }}"><button type="button" class="btn btn-primary">View All
                                    Menus</button></a>
                        </div>
                    </div>

                    <div class="card card-info">
                        <form class="form-horizontal"  method="POST" action="{{ route('trip.update',$menu->id)}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">

                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" required class="form-control" value="@if(old('title')==""){{$menu->title}}@else{{old('title')}}@endif"
                                            id="title" placeholder="Title" name="title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="itinerary" class="col-sm-2 col-form-label">Itinerary <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea name="itinerary" required id="itinerary"
                                            cols="30">@if(old('itinerary')==""){{$menu->itinerary}}@else{{old('itinerary')}}@endif</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="packageincludes" class="col-sm-2 col-form-label">Inclusions <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea name="packageincludes" required id="packageincludes"
                                            cols="30">@if(old('packageincludes')==""){{$menu->packageincludes}}@else{{old('packageincludes')}}@endif</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="durationdetail" class="col-sm-2 col-form-label">Duration & Departure<span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea name="durationdetail" required id="durationdetail"
                                            cols="30">@if(old('durationdetail')==""){{$menu->durationdetail}}@else{{old('durationdetail')}}@endif</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="infos" class="col-sm-2 col-form-label">Information <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea name="infos" id="infos" required cols="30">@if(old('infos')==""){{$menu->infos}}@else{{old('infos')}}@endif</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" required id="stats" name="stats">
                                                @if(old('stats')=='')
                                                    <option value="0" @if($menu->stats==0) selected="selected" @endif>In-Active</option>
                                                    <option value="1" @if($menu->stats==1) selected="selected" @endif>Active</option>
                                                @else
                                                    <option value="0" @if(old('stats')==0) selected="selected" @endif>In-Active</option>
                                                    <option value="1" @if(old('stats')==1) selected="selected" @endif>Active</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="orderb">Order No</label>
                                            <input type="number" required name="orderb" class="form-control" placeholder=""
                                                value="@if(old('orderb')==""){{$menu->orderb}}@else{{old('orderb')}}@endif">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" id="savebtn" class="btn btn-info">Update</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>

                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('f_scripts')
<script src='https://cdn.tiny.cloud/1/{{env('TINY_API_KEY')}}/tinymce/5/tinymce.min.js'> </script>
<script>
    tinymce.init({ selector: '#itinerary',plugins:'link' });
    tinymce.init({ selector: '#packageincludes',plugins:'link' });
    tinymce.init({ selector: '#durationdetail',plugins:'link' });
    tinymce.init({ selector: '#infos',plugins:'link' });
</script>
<script src="/plugins/jquery/jquery.min.js"></script>

<script>
$(function(){
    $("#savebtn").click(function(){
        if($('#title').val() == '' || $('#title').val() == ' '){
            alert('Please Write Title');
            return;
        }

        var editorContent = tinyMCE.get('itinerary').getContent();
        if (editorContent == '')
        {
            alert('Please Write descriptions');
            return;
        }
       
        if(tinyMCE.get('packageincludes').getContent() == ''){
            alert('Please Write Package Inclusion');
            return;
        }
        if(tinyMCE.get('durationdetail').getContent() == ''){
            alert('Please Write About Duration and Departure');
            return;
        }
        if(tinyMCE.get('infos').getContent() == ''){
            alert('Please Write infos');
            return;
        }
        if($('#status').val() == '' || $('#status').val() == ' '){
            alert('Please select status');
            return;
        }
        if($('#status').val() == '' || $('#status').val() == ' '){
            alert('Please Write Order No');
            return;
        }

        $('.form-horizontal').submit();

    });
});
</script>
@endsection