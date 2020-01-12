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
                        <li class="breadcrumb-item"><a href="#!">Dashboard </a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <!-- [ page content ] start -->
                    <div class="row">
                        <!-- product profit start -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-red">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Total Upload</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{count($all_uploads)}}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-upload text-c-red f-18"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-blue">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Total Users</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{count($all_users)}}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users text-c-blue f-18"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-green">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Pending Cashout</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{count($all_cashouts)}}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign text-c-green f-18"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-yellow">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Total Download</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{count($all_downloads)}}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tags text-c-yellow f-18"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card prod-p-card card-yellow">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-30">
                                        <div class="col-xl-7">
                                            <h6 class="m-b-5 text-white">Current price ( NGN )</h6>
                                            <h3 class="m-b-0 f-w-700 text-white">{{number_format($latest_price->price)}}</h3>
                                        </div>
                                        <div class="col-xl-4">
                                            <a data-toggle="modal" data-target="#photo-popup-modal" target="_blank"{{--href="{{}}"--}}> <button style="background-color: white" class="btn btn-round waves-effect waves-light">Change</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- [ page content ] end -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="photo-popup-modal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Price</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('dashboard.change-price')}}" >
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="number" name="price" class="form-control form-control-round" placeholder="New Price" min="200">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light ">Change Price</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
@section('script')
    <script>

        @if(session('failure'))
        toastr.error('{{session("failure")}}');

        @endif
        @if(session('success'))
        toastr.success('{{session("success")}}');
        @endif

    </script>
@endsection
