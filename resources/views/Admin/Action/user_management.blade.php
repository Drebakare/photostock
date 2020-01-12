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
                            <li class="breadcrumb-item"><a href="#!">Users</a>
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
                                        <h5>All User</h5>
                                        <span>This example is almost identical to text based individual column example and provides the same functionality, but in this case using select input controls. After the table is initialised, the API is used to build the select inputs through the use of the column().data() method to get the data for each column in turn. The helper methods unique() and sort() are also used to reduce the data for set input to unique and ordered elements. Finally the change event from the select input is used to trigger a column search using the column().search() method.</span>
                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
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
                                            <table class=" table basic-table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <td>id</td>
                                                        <td>Name</td>
                                                        <td>Email</td>
                                                        <td>Role</td>
                                                        <td>Action</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     @foreach($all_users as $all_user)
                                                         <tr>
                                                            <td>{{$all_user->id}}</td>
                                                            <td>{{$all_user->name}}</td>
                                                            <td>{{$all_user->email}}</td>
                                                            <td>@if($all_user->is_seller == 1)
                                                                    Seller
                                                                 @elseif($all_user->is_admin == 1)
                                                                    Admin
                                                                 @else
                                                                    Buyer
                                                                 @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{route('admin.action.delete-user', ["id" => $all_user->id])}}"> <button class="btn btn-danger btn-round waves-effect waves-light">Delete</button></a>
                                                                @if(($all_user->is_seller) && !($all_user->is_activated))
                                                                   <a href="{{route('admin.action.activate-user', ["id" => $all_user->id])}}"> <button class="btn btn-success btn-round waves-effect waves-light">Activate user</button></a>
                                                                @endif
                                                                @if($all_user->is_activated && !($all_user->is_admin))
                                                                    <a href="{{route('admin.action.make-admin', ["id" => $all_user->id])}}"> <button class="btn btn-warning btn-round waves-effect waves-light">Make Admin</button></a>
                                                                @endif
                                                                @if($all_user->is_activated && $all_user->is_admin)
                                                                    <a href="{{route('admin.action.remove-admin', ["id" => $all_user->id])}}"><button class="btn btn-danger btn-round waves-effect waves-light">Remove Admin</button></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                     @endforeach
                                                </tbody>
                                            </table>
                                          {{--  {{$all_users->links()}}--}}
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



