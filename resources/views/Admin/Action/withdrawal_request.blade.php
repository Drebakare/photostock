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
                            <li class="breadcrumb-item"><a href="#!">Withdrawal Requests</a>
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
                                        <h5>All Withdrawal Request</h5>
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
                                                    <td>Amount</td>
                                                    <td>Status</td>
                                                    <td>Action</td>
                                                </tr>
                                                </thead>
                                                    <tbody>
                                                        @foreach($all_withdrawals as $all_withdrawal)
                                                            <tr>
                                                                <td>{{$all_withdrawal->id}}</td>
                                                                <td>{{$all_withdrawal->user->name}}</td>
                                                                <td>{{$all_withdrawal->user->email}}</td>
                                                                <td>{{$all_withdrawal->amount}}</td>
                                                                <td>@if($all_withdrawal->status == 1)
                                                                        Approved
                                                                    @elseif($all_withdrawal->approved == 0)
                                                                        Pending
                                                                    @else
                                                                        Rejected
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($all_withdrawal->status ==1)
                                                                        <a href="{{route('admin.withdrawal-request.reject', ["id" => $all_withdrawal->id])}}"> <button class="btn btn-danger btn-round waves-effect waves-light">Reject</button></a>
                                                                    @else
                                                                        <a href="{{route('admin.withdrawal-request.accept', ["id" => $all_withdrawal->id])}}"> <button class="btn btn-success btn-round waves-effect waves-light">Approve</button></a>
                                                                    @endif

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
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            $('.table').DataTable();
        } );
    </script>
@endsection





