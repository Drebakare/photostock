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
                            <li class="breadcrumb-item"><a href="#!">Region</a>
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
                                    <div class="row">
                                        <div class="card-header">
                                            <h5>Available Countries</h5>
                                        </div>
                                        <div class="card-header offset-7">
                                            <a data-toggle="modal" data-target="#photo-popup-modal" target="_blank"> <button class="btn btn-primary waves-effect waves-light">Add Region</button></a>
                                            <a data-toggle="modal" data-target="#update-rate" target="_blank"> <button class="btn btn-success waves-effect waves-light">Update Rate</button></a>
                                        </div>
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
                                                    <td>Country ID</td>
                                                    <td>Currency Code</td>
                                                    <td>Name</td>
                                                    <td>Rate</td>
                                                    <td>Action</td>
                                                </tr>
                                                </thead>
                                                    <tbody>
                                                        @foreach($regions as $region)
                                                            <tr>
                                                                <td>{{$region->id}}</td>
                                                                <td>{{$region->country_id}}</td>
                                                                <td>{{$region->currency_code}}</td>
                                                                <td>{{$region->country->name}}</td>
                                                                <td>{{$region->rate}}</td>
                                                                <td>
                                                                    <a href="{{route("admin.delete-country", ["id" => $region->id])}}"> <button class="btn btn-danger btn-round waves-effect waves-light">Delete</button></a>
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

            <div id="styleSelector">

            </div>
        </div>
    </div>
    <div class="modal" id="photo-popup-modal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Country </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('admin.add-country')}}" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <select name="country" class="form-control " style="height: auto">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{$country->name}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light ">Add Country</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal" id="update-rate">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Rate</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('admin.update-rate')}}" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <h5>CLICK CONTINUE TO UPDATE</h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light ">Continue</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            $('.table').DataTable();
        } );
    </script>
@endsection





