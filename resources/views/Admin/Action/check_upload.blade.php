@extends('Admin.layouts.app')
@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">

                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class=" breadcrumb breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="index.html"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Uploads</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <div class="pcoded-inner-content">
            <!-- Main-body start -->
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Add rows table start -->

                                <!-- Add rows table end -->
                                <!-- Individual Column Searching (Text Inputs) start -->

                                <!-- Individual Column Searching (Text Inputs) end -->
                                <!-- Individual Column Searching (Select Inputs) start -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5>All Upload</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table class="table basic-table table-bordered table-hover">
                                                @if(count($errors)>0)
                                                    @foreach($errors->all() as $error)
                                                        <div class="alert alert-danger"  style="margin-top: 10px; margin-left: 10px;">
                                                            {{$error}}
                                                        </div>
                                                    @endforeach
                                                @endif
                                                @if(session('failure'))
                                                    <div class="alert alert-danger" style="margin-top: 10px; margin-left: 10px;">
                                                        {{session('failure')}}
                                                    </div>
                                                @endif
                                                @if(session('success'))
                                                    <div class="alert alert-success" style="margin-top: 10px; margin-left: 10px;">
                                                        {{session('success')}}
                                                    </div>
                                                @endif
                                                <thead>
                                                    <tr>
                                                        <td>id</td>
                                                        <td>Name</td>
                                                        <td>Email</td>
                                                        <td>Status</td>
                                                        <td>Action</td>
                                                    </tr>
                                                </thead>


                                                    <tbody>
                                                    @foreach($all_uploads as $key => $all_upload)
                                                        <tr>
                                                            <td>{{$all_upload->id}}</td>
                                                            <td>{{$all_upload->user->name}}</td>
                                                            <td>{{$all_upload->user->email}}</td>
                                                            <td>@if($all_upload->approved == 1)
                                                                    Approved
                                                                @elseif($all_upload->approved == 0)
                                                                    Not yet checked
                                                                @else
                                                                    Rejected
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{route('admin.upload.view-upload', ["id" => $all_upload->id])}}"> <button class="btn btn-success btn-round waves-effect waves-light">View Upload</button></a>
                                                                <a data-toggle="modal" data-target="#update-rate-{{$key}}" target="_blank"> <button class="btn btn-danger waves-effect waves-light">Delete Upload</button></a>
{{--
                                                                <a href="{{route('admin.upload.view-upload', ["id" => $all_upload->id])}}"> <button class="btn btn-danger btn-round waves-effect waves-light">Delete Upload</button></a>
--}}

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>


                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div id="styleSelector">

            </div>--}}
        </div>
    </div>
    @foreach($all_uploads as $key => $all_upload)
    <div class="modal" id="update-rate-{{$key}}">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Upload </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('admin.delete-upload', ['id' => $all_upload->id ])}}" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <h4 class="text-center">Are you sure you want to delete this upload?</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light ">Delete Upload</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @endforeach
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            $('.table').DataTable();
        } );
    </script>
@endsection




