@extends('layouts.app')

@section('content')

    <div class="clearfix"></div>
    <!-- Header Container / End -->

    <!-- Intro Banner -->
    <div class="intro-banner dark-overlay" data-background-image="{{asset('_landing/images/home-background-02.jpg')}}">

        <!-- Transparent Header Spacer -->
        <div class="transparent-header-spacer"></div>

        <div class="container">

            <!-- Intro Headline -->
            <div class="row sd-none">
                <div class="col-md-8 offset-2">
                    <div class="banner-headline">
                        <div>
                            <h1>Great stories start here.</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="row">
                <div class="col-md-8 offset-2">

                    <div class="">
                        @foreach($categories as $category)
                            <a href="{{route('browse.category',['category' => $category->keyword])}}" class="field-title btn">{{$category->keyword}}</a>
                        @endforeach
                    </div>

                    <form method="get" action="{{route('search')}}">
                        <div class="intro-banner-search-form margin-top-5">

                            <div class="intro-search-field">
                                <input id="intro-keywords" name="search" required type="text" placeholder="e.g black man">
                            </div>

                            <!-- Search Field -->
                           {{-- <div class="intro-search-field ">
                                <select class="selectpicker default" name="category" title="Select any Category" >
                                    <option value="0">All Categories</option>
                                    @foreach($categories as $category)
                                         <option value="{{$category->id}}">{{dd($category)}}</option>
                                    @endforeach
                                </select>
                            </div>--}}

                            <!-- Button -->
                             <div class="intro-search-button">
                                <button class="button ripple-effect" type="submit" ><i class="icon-material-outline-search"></i> Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 offset-2">
                    <div>
                        <small>Huge community of Photographers, developers and creatives ready for your project.</small>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="section white home-page-photos">
        <div class="row">
            <div class="col-xl-12">
                <!-- Section Headline -->
                <div class="section-headline margin-top-0 margin-bottom-25">
                    <h3>Random Photos</h3>
                </div>
            </div>
        </div>

        @include("layouts.browse_photos_section")


        <div class="col-xl-12 d-none">
            <!-- Section Headline -->
            <div class="section-headline margin-top-0 margin-bottom-25">
                <a href="{{route('browse.all')}}" class="headline-link" style="color: blue; font-size: larger">Browse All Photos</a>
            </div>
        </div>
    </div>

    <div class="section gray padding-top-65 padding-bottom-70 full-width-carousel-fix d-none">
        <div class="container">
            <div class="row">

                <div class="col-xl-12">
                    <!-- Section Headline -->
                    <div class="section-headline margin-top-0 margin-bottom-25">
                        <h3>Highest Rated Photographers</h3>
                        <a href="{{route('photographers')}}" class="headline-link">Browse All Photographers</a>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="default-slick-carousel freelancers-container freelancers-grid-layout">
                        @foreach($sellers as $seller)
                        <!--Freelancer -->
                        <div class="freelancer">

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
                            <div class="freelancer-details">
                                <div class="freelancer-details-list">
                                    <ul>
                                        <li>Location <strong><i class="icon-material-outline-location-on"></i> London</strong></li>
                                        <li>Rate <strong>$60 / hr</strong></li>
                                        <li>Job Success <strong>95%</strong></li>
                                    </ul>
                                </div>
                                <a href="{{route('photographers.profile',['name' =>$seller->name])}}" class="button button-sliding-icon ripple-effect">View Profile <i class="icon-material-outline-arrow-right-alt"></i></a>
                            </div>
                        </div><div class="freelancer">

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
                            <div class="freelancer-details">
                                <div class="freelancer-details-list">
                                    <ul>
                                        <li>Location <strong><i class="icon-material-outline-location-on"></i> London</strong></li>
                                        <li>Rate <strong>$60 / hr</strong></li>
                                        <li>Job Success <strong>95%</strong></li>
                                    </ul>
                                </div>
                                <a href="{{route('photographers.profile',['name' =>$seller->name])}}" class="button button-sliding-icon ripple-effect">View Profile <i class="icon-material-outline-arrow-right-alt"></i></a>
                            </div>
                        </div>

                        @endforeach



                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Popular Job Categories -->
    <div class="section margin-top-65 margin-bottom-30 d-none">
        <div class="container">
            <div class="row">

                <!-- Section Headline -->
                <div class="col-xl-12">
                    <div class="section-headline centered margin-top-0 margin-bottom-45">
                        <h3>Check out our Popular Categories</h3>
                    </div>
                </div>

                @foreach($categories as $category)

                        <div class="col-xl-3 col-md-6">
                            <!-- Photo Box -->
                            <a href="{{url('/search/'.$category->id)}}" class="photo-box small" data-background-image="{{'/uploads/'.$category->image}}">
                                <div class="photo-box-content">
                                    <h3>{{$category->category}}</h3>
                                </div>
                            </a>
                        </div>

                @endforeach

            </div>
        </div>
    </div>
    <!-- Features Cities -->
    <div class="section margin-top-65 margin-bottom-65 d-none">
        <div class="container">
            <div class="row">

                <!-- Section Headline -->
                <div class="col-xl-12">
                    <div class="section-headline centered margin-top-0 margin-bottom-45">
                        <h3>Featured Photos</h3>
                    </div>
                </div>
                @foreach($featured_pictures as $featured_picture)
                <div class="col-xl-3 col-md-6">
                    <!-- Photo Box -->
                    <a href="{{url('/getImage/'.$featured_picture->image)}}" class="photo-box" data-background-image="{{'/uploads/'.$featured_picture->image}}">
                        <div class="photo-box-content">
                            <h3>{{$featured_picture->category->category}}</h3>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>
            {{$featured_pictures->links()}}
        </div>
    </div>
    <!-- Features Cities / End -->
@endsection

@section("page_scripts")
    <script type="text/javascript">
        const photos_flex_each_overlay = $(".photos-flex-each-overlay");

        $.each(photos_flex_each_overlay, function (key, val) {
            let this_parent_div = $(this).parent().height();
            //$(this).height(this_parent_div);
            console.log(val + photos_flex_each_overlay.height());
        });

    </script>
@endsection

