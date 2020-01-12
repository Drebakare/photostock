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
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->







            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12 align-self-center">
                    <div class="card  bg-white m-b-30">
                        <div class="card-body new-user">
                            <h5 class="header-title mb-4 mt-0">All Users</h5>
                            @if(session('success'))
                                <div class="alert alert-success" style=" margin-left: 10px;">
                                    {{session('success')}}
                                </div>
                            @endif
                            <div class="table-responsive">
                                {{--<table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td class="border-top-0" style="width:60px;">Id</td>
                                            <td class="border-top-0">Name</td>
                                            <td class="border-top-0">Email</td>
                                            <td class="border-top-0">Role</td>
                                            <td class="border-top-0">Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($all_user as $all_users)
                                        <tr>

                                            <td>
                                                {{$all_users->id}}
                                            </td>
                                            <td>
                                            {{$all_users->name}}
                                            </td>
                                            <td>
                                                {{$all_users->email}}
                                            </td>
                                            <td>
                                               @if($all_users->is_seller)
                                                   seller
                                               @elseif($all_users->is_admin)
                                                    Admin
                                               @else
                                                     Buyer
                                               @endif
                                            </td>
                                            <td>
                                                @if(!($all_users->is_admin))
                                                <a href="{{route('make_admin',['id' => Auth::user()->id])}}"><span class="badge badge-pill badge-info">make Admin</span></a>
                                                @endif
                                                <a href="{{route('view_profile', ['id' => Auth::user()->id])}}"><span class="badge badge-pill badge-warning">View Profile</span></a>
                                                <a href="{{route('delete_user', ['id' => Auth::user()->id])}}"><span class="badge badge-pill badge-danger">Delete</span></a>
                                                @if($all_users->is_admin)
                                                        <a href="{{route('remove_admin', ['id' => Auth::user()->id])}}"><span class="badge badge-pill badge-danger">remove admin</span></a>
                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>--}}

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- container -->


    </div> <!-- Page content Wrapper -->

    </div> <!-- content -->
@endsection
@section("script")
    <script type="text/javascript">
        $(document).ready(function () {
            $(".table").DataTable();
        });
    </script>
@endsection

