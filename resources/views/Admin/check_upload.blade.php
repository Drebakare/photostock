@extends('layouts.app1')
@section('content')
    <div class="page-content-wrapper ">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">{{Auth::user()->name}}</a></li>
                                <li class="breadcrumb-item active">Check Upload</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Check Upload</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h4 class="m-t-20 m-b-30">{{$confirm_uploads[0]->upload->user->name}}</h4>
                    <div class="card-deck-wrapper">
                        <div class="card-deck col-md-12 col-lg-12">
                            @foreach($confirm_uploads as $confirm_upload)
                                <div class="card col-md-4 col-lg-4">
                                    <img class="card-img-top img-fluid" src="{{'/uploads/'.$confirm_upload->image}}" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title font-20 mt-0">Description</h4>
                                        <p class="card-text">{{$confirm_upload->description}}</p>
                                        <p class="card-text">
                                            <small class="text-muted">{{$confirm_upload->tags}}</small>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

            </div>    <!-- end col -->
        </div> <!-- end row -->
        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->
@endsection


