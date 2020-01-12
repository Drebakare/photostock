@extends('layouts.dashboard_app')
@section('content')
    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner" >

            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>My Uploads</h3>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Dashboard</a></li>
                        <li>My uploads</li>
                    </ul>
                </nav>
            </div>

            <div class="col-xl-12 col-md-12 dashboard-box">
                <br>
                <div class="section-headline margin-bottom-30">
                    {{--<h4>My Uploads</h4>--}}
                </div>

                <table class=" table basic-table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Status</td>
                            <td>Date Uploaded</td>
                            <td>Comment</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($all_uploads as $key=> $all_upload)
                        <tr>
                            <td data-label="Column 1">{{$all_upload->id}}</td>
                            <td data-label="Column 2">{{$all_upload->user->name}}</td>
                            <td data-label="Column 3">{{$all_upload->user->email}}</td>
                            <td data-label="Column 4">@if($all_upload->approved == 0)
                                    Pending
                                @elseif($all_upload->approved == 1)
                                    Approved
                                @else
                                    Rejected
                                @endif
                            </td>
                            <td data-label="Column 5">{{$all_upload->created_at}}</td>
                            <td data-label="Column 6">@if($all_upload->comment )
                                    <div class="d-none"> {{$key = $key + 1}}</div>
                                    <a href="#small-dialog-{{$key}}" class="popup-with-zoom-anim btn btn-sm btn-info text-white">Check Comment<i class="icon-material-outline-arrow-right-alt"></i></a>
                                @else
                                    No Comment Yet
                                @endif
                            </td><td data-label="Column 7">@if($all_upload->approved >1 && $all_upload->is_collection != 1)
                                    <a href="{{ route('dashboard.edit-upload',["upload_id" =>$all_upload->id ]) }}" class="btn btn-sm btn-info text-white">
                                        Edit Upload
                                    </a>
                                @else
                                    Nil
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>


                </table>
            </div>

            <!-- Footer -->
            <div class="dashboard-footer-spacer"></div>
            <div class="small-footer margin-top-15">
                <div class="small-footer-copyrights">
                    © 2018 <strong>Hireo</strong>. All Rights Reserved.
                </div>
                <ul class="footer-social-links">
                    <li>
                        <a href="#" title="Facebook" data-tippy-placement="top">
                            <i class="icon-brand-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Twitter" data-tippy-placement="top">
                            <i class="icon-brand-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Google Plus" data-tippy-placement="top">
                            <i class="icon-brand-google-plus-g"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="LinkedIn" data-tippy-placement="top">
                            <i class="icon-brand-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- Footer / End -->

        </div>
    </div>


@foreach($all_uploads as $key => $all_upload)
   <div class="d-none"> {{$key = $key + 1}}</div>
    <div id="small-dialog-{{$key}}" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

        <!--Tabs -->
        <div class="sign-in-form">

            <ul class="popup-tabs-nav">
                <li><a href="#tab">Comment</a></li>
            </ul>

            <div class="popup-tabs-container">

                <!-- Tab -->
                <div class="popup-tab-content" id="tab">

                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h3>Admin's Comment</h3>
                    </div>
                    <div class="text-center ">
                        {{$all_upload->comment}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endforeach
@endsection
@section("page_scripts")
    <script type="text/javascript">
        $(document).ready(function () {
            $(".table").DataTable();
        });
    </script>
@endsection

