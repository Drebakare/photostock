@extends('layouts.app')
@section('content')
    <div class="clearfix"></div>
    <br><br><br>

    <div class="section gray padding-top-65 padding-bottom-70 full-width-carousel-fix">
        <div class="container">
            <div class="row">

                <div class="col-xl-12">
                    <!-- Section Headline -->
                    <div class="section-headline margin-top-0 margin-bottom-25">
                        <h3>Browse All Photographers</h3>
                    </div>
                </div>
                <div class="row col-xl-12">
                    @foreach($sellers as $seller)
                        <div class="col-xl-4 ">
                            <!--Freelancer -->
                                <div class="freelancer col-xl-12">

                                    <!-- Overview -->
                                    <div class="freelancer-overview">
                                        <div class="freelancer-overview-inner">

                                            <!-- Bookmark Icon -->
                                            <span class="bookmark-icon"></span>

                                            <!-- Avatar -->
                                            <div class="freelancer-avatar">
                                                <div class="verified-badge"></div>
                                                <a href="#"><img src="{{ asset("_landing/images/user-avatar-big-01.jpg") }}" alt=""></a>
                                            </div>

                                            <!-- Name -->
                                            <div class="freelancer-name">
                                                <h4><a href="#">{{$seller->name}} <img class="flag" src="images/flags/gb.html" alt="" title="United Kingdom" data-tippy-placement="top"></a></h4>
                                                <span>Seller</span>
                                            </div>

                                            <!-- Rating -->
                                            <div class="freelancer-rating">
                                                <div class="star-rating" data-rating="5.0"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Details -->
                                    <div class="freelancer-details col-xl-12">
                                        <div class="freelancer-details-list">
                                            <ul>
                                                <li>Location <strong><i class="icon-material-outline-location-on"></i> London</strong></li>
                                                <li>Rate <strong>$60 / hr</strong></li>
                                                <li>Job Success <strong>95%</strong></li>
                                            </ul>
                                        </div>
                                       <div class="offset-3">
                                           <a href="{{route('photographers.profile',['name' =>$seller->name])}}" class="button button-sliding-icon ripple-effect">View Profile <i class="icon-material-outline-arrow-right-alt"></i></a>
                                       </div>
                                    </div>
                                </div>
                        </div>
                    @endforeach


                </div>


            </div>
        </div>
    </div>

@endsection



