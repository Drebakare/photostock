@extends('layouts.dashboard_app')
@section('content')
    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner" >

            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>My Downloads</h3>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Dashboard</a></li>
                        <li>My Gallery</li>
                    </ul>
                </nav>
            </div>

            <div class="col-xl-12 col-md-12 ">

                <div class="section-headline margin-bottom-30">
                    {{--<h4>My Gallery</h4>--}}
                </div>
                @include("layouts.browse_photos_section")
            </div>


            <!-- Footer -->
            <div class="dashboard-footer-spacer"></div>
            <!-- Footer / End -->

        </div>
    </div>
@endsection
