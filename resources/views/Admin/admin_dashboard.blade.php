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

                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="col-3 align-self-center">
                                    <div class="round">
                                        <i class="mdi mdi-account-multiple-plus"></i>
                                    </div>
                                </div>
                                <div class="col-6 text-center align-self-center">
                                    <div class="m-l-10 ">

                                        <h5 class="mt-0 round-inner">{{session('success')}}</h5>

                                        <p class="mb-0 text-muted">Total Users</p>
                                    </div>
                                </div>
                                <div class="col-3 align-self-end align-self-center">
                                    <h6 class="m-0 float-right text-center text-success"> <i class="mdi mdi-arrow-up"></i> </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="col-3 align-self-center">
                                    <div class="round ">
                                        <i class="mdi mdi-basket"></i>
                                    </div>
                                </div>
                                <div class="col-6 align-self-center text-center">
                                    <div class="m-l-10 ">
                                        <h5 class="mt-0 round-inner">{{count($all_uploads)}}</h5>
                                        <p class="mb-0 text-muted">All Upload</p>
                                    </div>
                                </div>
                                <div class="col-3 align-self-end align-self-center">
                                    <h6 class="m-0 float-right text-center text-danger"> <i class="mdi mdi-arrow-up"></i></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->

                <!-- Column -->
            </div>




            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-8 align-self-center">
                    <div class="card bg-white m-b-30">
                        <div class="card-body new-user">
                            <h5 class="header-title mb-4 mt-0">All Upload</h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0" style="width:60px;">Id</th>
                                        <th class="border-top-0">Name</th>
                                        <th class="border-top-0">Email</th>
                                        <th class="border-top-0">Status</th>
                                        <th class="border-top-0">No of downloads</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($all_uploads as $all_upload)
                                    <tr>
                                        <td>
                                            {{$all_upload->id}}
                                        </td>
                                        <td>
                                            {{$all_upload->user->name}}
                                        </td>
                                        <td>
                                           <a href="{{route("check_upload",['id' => $all_upload->id])}}">{{$all_upload->user->email}}</a>
                                        </td>
                                        <td>
                                            @if(($all_upload->approved)==1)
                                                approved
                                             @elseif(($all_upload->approved)==0)
                                                 Not checked yet
                                             @else
                                                 rejected
                                             @endif
                                        </td>
                                        <td>
                                            0
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
        </div><!-- container -->


    </div> <!-- Page content Wrapper -->

    </div> <!-- content -->
@endsection

