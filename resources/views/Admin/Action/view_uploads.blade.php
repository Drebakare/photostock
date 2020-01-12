@extends('Admin.layouts.app')
@section('content')
    <div class="pcoded-content">
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
                            <li class="breadcrumb-item"><a href="#!">Upload</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Photos</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- Page-body start -->
                    <div class="page-body">
                        <!-- Error-layout card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5>All Photos</h5>

                            </div>
                            <div class="card-block" >
                                <div class="row" >
                                    @foreach($all_photos as $all_photo)
                                            <div class="col-sm-4 m-b-30 "  style="width: 100%; height: 100%; border: 1px solid #D9D9D9;min-height: 250px; max-height: 250px;overflow: hidden;">
                                                <a data-toggle="modal" data-target="#photo-popup-modal-{{ $all_photo->id }}" target="_blank">
                                                    <img style="object-fit: scale-down;" src="{{ asset('/uploads/original/'.$all_photo->image)}}" alt="Layout-1" class="img-fluid img-thumbnail">
                                                </a>
                                            </div>

                                        <div class="modal" id="photo-popup-modal-{{ $all_photo->id }}">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">

                                                    <div class="modal-body">
                                                        <img src="{{ asset('/uploads/original/'.$all_photo->image)}}" alt="Layout-1" class="img-fluid img-thumbnail">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="row">
                                                            <div class="col-md-3 margin-left-20" >
                                                                Title: {{$all_photo->slug}}
                                                            </div>
                                                            <div class="col-md-3">
                                                               Price: {{$all_photo->price}}
                                                            </div>
                                                            <div class="col-md-6">
                                                               Tags: {{$all_photo->tags}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="col-lg-3">
                                       <a href="{{route('admin.upload.accept',['id' => $all_photo->upload_id])}}"> <button class="btn btn-success btn-round waves-effect waves-light">Accept Upload</button></a>
                                    </div>
                                    <div class="col-lg-3">
                                        <a data-toggle="modal" data-target="#photo-popup-modal" target="_blank"{{--href="{{}}"--}}> <button class="btn btn-danger btn-round waves-effect waves-light">Reject Upload</button></a>
                                    </div>
                                    <div class="modal" id="photo-popup-modal">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Drop comment for the user</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="{{route('admin.upload.reject',['id' => $all_photo->upload_id])}}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <div class="col-sm-12">
                                                                <textarea rows="3" name="comment"  class="form-control" placeholder="Comment here!"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger waves-effect waves-light ">Drop comment</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <hr>

                        </div>
                        <!-- Error-layout card end -->
                    </div>
                    <!-- Page-body end -->
                </div>
            </div>
        </div>
    </div>
@endsection
