@extends('admin.master')
@section('b_body')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Gallery</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}'">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('trip.index') }}'">Tourss</a></li>
                    <li class="breadcrumb-item active">Gallery</li>
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
                        <a href="{{ route('trip.index') }}"><button type="button" class="btn btn-default">Back to
                                tours</button></a>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <form action="{{ route('gallery.store',$menu_id) }}" enctype="multipart/form-data" method="post"
                            class="dropzone" id="dropzoneForm">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        </form>
                    </div>
                    <hr>
                    <div class="card-body p-0">
                        <table class="table" id="mytbl">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Feature Image</th>
                                    <th>Status</th>
                                    <th>Order No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
    <div class="modal fade" id="modal-overlays">
        <div class="modal-dialog">
            <div class="modal-content" id="modalsss">
                <div class="modal-header">
                    <h4 class="modal-title">Change Image Settings</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Order No:</label>
                                    <input type="text" class="form-control" id="OrderNoId" placeholder="Enter ...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="" id="statsOption" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Make It Feature Image</label>
                                    <select name="" id="isFeatureImgs" class="form-control">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                    <b>Note: </b> Changes May Apply On Refreshing Page.
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="closeModalBtn">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</section>
<!-- /.content -->
<input type="hidden" name="_token" id="tokken" value="{{ csrf_token() }}">

@endsection

@section('fstylesheet')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
@endsection

@section('f_scripts')
<script src="/plugins/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>

<script src="/plugins/datatables/jquery.dataTables.js"></script>

<script src="/myjs/gallery.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
@endsection