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
                    <li class="breadcrumb-item active">Create</li>
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
                        <h3 class="card-title">Create Menu</h3>

                        <div class="card-tools">
                            <a href="{{ route('trip.index') }}"><button type="button" class="btn btn-primary">View All
                                    Menus</button></a>
                        </div>
                    </div>

                    <div class="card card-info">
                        <form class="form-horizontal"  method="POST" action="{{ route('trip.store')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" required class="form-control" value="{{ old('title') }}"
                                            id="title" placeholder="Title" name="title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="descriptions" class="col-sm-2 col-form-label">Description <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea name="descriptions" required id="descriptions"
                                            cols="30">{{ old('descriptions') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inclusionlist" class="col-sm-2 col-form-label">Inclusions <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea name="inclusionlist" required id="inclusionlist"
                                            cols="30">{{ old('inclusionlist') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exclusionlist" class="col-sm-2 col-form-label">Exclusions <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea name="exclusionlist" required id="exclusionlist"
                                            cols="30">{{ old('exclusionlist') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="infos" class="col-sm-2 col-form-label">Information <span
                                            style="color: red">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea name="infos" id="infos" required cols="30">{{ old('infos') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" required id="stats" name="stats">
                                                <option value="1" @if (old('stats')==1) selected="selected" @endif
                                                    class="form-control">Active</option>
                                                <option value="0" @if (old('stats')==0) selected="selected" @endif
                                                    class="form-control">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="orderb">Order No</label>
                                            <input type="number" required name="orderb" class="form-control" placeholder="Enter ..."
                                                value="{{ old('orderb') }}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" id="savebtn" class="btn btn-info">Save</button>
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
    tinymce.init({ selector: '#descriptions',plugins:'link' });
    tinymce.init({ selector: '#inclusionlist',plugins:'link' });
    tinymce.init({ selector: '#exclusionlist',plugins:'link' });
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

        var editorContent = tinyMCE.get('descriptions').getContent();
        if (editorContent == '')
        {
            alert('Please Write descriptions');
            return;
        }
       
        if(tinyMCE.get('inclusionlist').getContent() == ''){
            alert('Please Write inclusionlist');
            return;
        }
        if(tinyMCE.get('exclusionlist').getContent() == ''){
            alert('Please Write exclusionlist');
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