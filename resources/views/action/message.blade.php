@extends('layouts.dashboard_app')
@section('content')
    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner" >

            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>Reviews</h3>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Dashboard</a></li>
                        <li>View Reviews</li>
                    </ul>
                </nav>
            </div>

            <div class="row">
                <div class="col-xl-12 col-md-12 dashboard-box ">

                    <div class="section-headline margin-bottom-30">
                        {{-- <h4>All Messages</h4>--}}
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
                            <div class="alert alert-success" style=" margin-top: 10px; margin-left: 10px;">
                                {{session('success')}}
                            </div>
                        @endif
                    </div>

                    <table class=" table basic-table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td>Id</td>
                            <td>Rating</td>
                            <td>Comment</td>
                            <td>Picture Title</td>
                            <td>Date Received</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td data-label="Column 1">{{$message->id}}</td>
                                <td data-label="Column 3"><div class="star-rating" data-rating="{{$message->rating}}"></div></td>
                                <td data-label="Column 4">{{$message->comment}}</td>
                                <td data-label="Column 4">{{$message->photos->slug}}</td>
                                <td data-label="Column 5">{{$message->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
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
@endsection

@section("page_scripts")
    <script type="text/javascript">
        $(document).ready(function () {
            $(".table").DataTable();
        });
    </script>
@endsection
