@extends('layouts.app')

@section('content')
    <div class="main-wrapper">

        <!-- start hero-header -->
        <div class="hero" style="background-image:url('images/hero-header/01.jpg');">
            <div class="container">
                <div class="row gap-0">

                    <div class="col-md-10 col-md-offset-1">
                        <div class="section-title-special">

                            <p class="p-title">Find everything you need for your creative projects. Download instantly.</p>
                        </div>
                    </div>

                    <div class="col-md-8 col-md-offset-2">
                        <form id="search" action="{{url('/search')}}" method="post">
                            @csrf
                        <div class="input-group-search-form-wrapper size-lg">

                            <div class="input-group bg-change-focus-addclass">

                                <input type="text" name="tag" class="form-control" placeholder="Search images, footage, vector" >


                                <div class="input-group-btn hidden-xss">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>

                            </div><!-- /input-group -->
                        </div>
                        </form>


                    </div>

                </div>
                <div class="col-md-10 col-md-offset-1">
                    <div class="section-title-special">

                        <p class="p-title">make money for picture upload? <a href="{{url('/newSeller')}}">click here</a> </p>
                    </div>
                </div>

            </div>

        </div>
        <!-- end hero-header -->

        <div class="content-wrapper">

            <div class="section pb-50">

                <div class="container">

                    <div class="row gap-">
                        <div class="col-md-10 col-md-offset-1">

                            <div class="section-title-special mb-30">
                                <h2>Over Millions Photos, Vectors &amp; Footages</h2>
                                <p>High quality royalty-free stockphotos at flexible pricing.<br/>Download instantly for your creative products!</p>
                            </div>

                        </div>
                    </div>

                    <div class="row gap-0 mb-50">
                        <div class="col-md-8 col-md-offset-2">

                            <p class="text-center">You can use our stock content for publications, TV commercials, goods packaging or smartphone applications. Because it's Royalty Free, once you purchase it you can use it for anything you need. </p>

                        </div>
                    </div>

                    <div class="row gap-20 mb-70">
                        @foreach($approved_uploads as $approved_upload)
                            @foreach($approved_upload->photos as $photo)
                        <div class="col-xss-12 col-xs-6 col-sm-6">
                            <div class="category-image-bg" style="background-image:url({{'/uploads/'.$photo->image}});">
                                <a href="#">
										<span class="text">
											Food
										</span>
                                </a>
                            </div>
                        </div>
                             @endforeach
                        @endforeach









                    </div>

                    <div class="row gap-0">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="section-title-special mb-30">
                                <h2>Stock Photos Search Categories</h2>
                                <p>You can search through our stock from popular categories such as <br/>People, Nature, Landscape or Business</p>
                            </div>
                        </div>
                    </div>

                    <ul class="home-category-list clearfix mt-10">
                        @foreach($category as $categories)
                        <li><a href="{{url('/'.$categories->id)}}">{{$categories->category}}</a></li>
                        @endforeach
                    </ul>

                    <div class="clear mb-50"></div>

                    <div class="row price-wrapper-sm">

                        <div class="col-sm-4 mb-30">
                            <a href="pricing-01.html" class="price-item-sm">
                                <div class="icon"><i class="pe-7s-date"></i></div>
                                <h4>Monthly packs</h4>
                                <span>from $1.20 / image</span>
                            </a>
                        </div>

                        <div class="col-sm-4 mb-30">
                            <a href="pricing-01.html" class="price-item-sm">
                                <div class="icon"><i class="pe-7s-cash"></i></div>
                                <h4>Pay-as-you-go credits</h4>
                                <span>from 76¢ / image</span>
                            </a>
                        </div>

                        <div class="col-sm-4 mb-30">
                            <a href="pricing-01.html" class="price-item-sm">
                                <div class="icon"><i class="pe-7s-note2"></i></div>
                                <h4>Daily subscriptions</h4>
                                <span>from 20¢ / image</span>
                            </a>
                        </div>

                    </div>

                    <div class="text-center mt-20">
                        <a href="#modalSignUp" class="btn btn-primary btn-lg">Sign Up Now for Free</a>
                    </div>

                    <div class="clear mb-90"></div>

                    <div class="row gap-0">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="section-title-special mb-30">
                                <h2>Featured Contributor</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row featured-contributor-wrapper">

                        <div class="col-sm-4 mb-30">
                            <div class="featured-contributor-item clearfix">
                                <a href="#" class="clearfix">
                                    <div class="image-wrapper">
                                        <div class="image-bg"><div style="background-image:url('images/grid/01.html');"></div></div>
                                        <div class="image-bg"><div style="background-image:url('images/grid/02.jpg');"></div></div>
                                        <div class="image-bg"><div style="background-image:url('images/grid/03.jpg');"></div></div>
                                        <div class="image-bg"><div style="background-image:url('images/grid/04.jpg');"></div></div>
                                    </div>
                                    <div class="clear mb-15"></div>
                                    <div class="contributor">
                                        <div class="image">
                                            <img src="images/testimonial/01.jpg" alt="image" class="img-circle"/>
                                        </div>
                                        <h4 class="uppercase">Albert Esthrone</h4>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-30">
                            <div class="featured-contributor-item clearfix">
                                <a href="#" class="clearfix">
                                    <div class="image-wrapper">
                                        <div class="image-bg"><div style="background-image:url('images/grid/05.html');"></div></div>
                                        <div class="image-bg"><div style="background-image:url('images/grid/06.jpg');"></div></div>
                                        <div class="image-bg"><div style="background-image:url('images/grid/07.jpg');"></div></div>
                                        <div class="image-bg"><div style="background-image:url('images/grid/08.html');"></div></div>
                                    </div>
                                    <div class="clear mb-15"></div>
                                    <div class="contributor">
                                        <div class="image">
                                            <img src="images/testimonial/02.jpg" alt="image" class="img-circle"/>
                                        </div>
                                        <h4 class="uppercase">Charles Darwin </h4>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-30">
                            <div class="featured-contributor-item clearfix">
                                <a href="#" class="clearfix">
                                    <div class="image-wrapper">
                                        <div class="image-bg"><div style="background-image:url('images/grid/09.jpg');"></div></div>
                                        <div class="image-bg"><div style="background-image:url('images/grid/10.jpg');"></div></div>
                                        <div class="image-bg"><div style="background-image:url('images/grid/11.html');"></div></div>
                                        <div class="image-bg"><div style="background-image:url('images/grid/12.jpg');"></div></div>
                                    </div>
                                    <div class="clear mb-15"></div>
                                    <div class="contributor">
                                        <div class="image">
                                            <img src="images/testimonial/03.html" alt="image" class="img-circle"/>
                                        </div>
                                        <h4 class="uppercase">Pablo Picasso</h4>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
