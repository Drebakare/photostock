@extends('layouts.app')
@section('search_keywords', $searched_word)
@section('content')
    <div class="clearfix"></div>
    <!-- Header Container / End -->

    <!-- Page Content
    ================================================== -->
    <div class="full-page-container">

        <div class="full-page-sidebar">
            <div class="full-page-sidebar-inner" data-simplebar>
                <div class="sidebar-container">

                    <!-- Location -->

                    <form method="get" action="{{route('complex.search')}}">
                        <div class="sidebar-widget d-none">
                            <h3>Search Photo</h3>
                            <div class="keywords-container">
                                <div class="keyword-input-container">
                                    <input type="text" name="search" class="keyword-input" placeholder="Enter anything here" value="{{ $searched_word }}"/>
                                </div>
                                <div class="keywords-list"><!-- keywords go here --></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <!-- Category -->
                        {{--<div class="sidebar-widget">
                            <h3>Category</h3>
                            <select  class="js-example-basic-single" name="category"  title="Select Category" >
                                    <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{ ucfirst($category->title) }}</option>
                                @endforeach
                            </select>

                        </div>--}}
                        {{--<div class="sidebar-widget">
                            <h3>Category</h3>
                            <select class="selectpicker" --}}{{--multiple data-selected-text-format="count" data-size="7"--}}{{-- title="All Categories">
                                <option>Accounting and Finance</option>
                                <option>Clerical & Data Entry</option>
                                <option>Counseling</option>
                                <option>Court Administration</option>
                                <option>Human Resources</option>
                                <option>Investigative</option>
                                <option>IT and Computers</option>
                                <option>Law Enforcement</option>
                                <option>Management</option>
                                <option>Miscellaneous</option>
                                <option>Public Relations</option>
                            </select>
                        </div>--}}
                        <div class="sidebar-widget">
                            <h3>Pricing</h3>
                            <div class="switches-list">
                                <div class="switch-container">
                                    <label class="switch"><input type="radio" name="pricing" value="1"><span class="switch-button"></span>Free </label><br>
                                    <label class="switch"><input type="radio" name="pricing" value="2"><span class="switch-button"></span>Premium</label>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h3>Image type</h3>
                            <div class="switches-list">
                                <div class="switch-container">
                                    <label class="switch"><input type="radio" name="image_type" value="single"><span class="switch-button"></span>Single photo</label><br>
                                    <label class="switch"><input type="radio" name="image_type" value="collection"><span class="switch-button"></span>Series </label>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h3>Format</h3>
                            <div class="switches-list">
                                <div class="switch-container">
                                    <label class="switch"><input type="radio" name="image_format" value="jpeg"><span class="switch-button"></span>jpeg</label>
                                    <label class="switch"><input type="radio" name="image_format" value="png"><span class="switch-button"></span>png</label>
                                    <label class="switch"><input type="radio" name="image_format" value="jpg"><span class="switch-button"></span>jpg</label>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h3>Orientation</h3>

                            <div class="switches-list">
                                <div class="switch-container">
                                    <label class="switch"><input type="radio" name="orientation" value="portrait"><span class="switch-button"></span>Portrait</label><br>
                                    <label class="switch"><input type="radio" name="orientation" value="landscape"><span class="switch-button"></span>Landscape</label>
                                </div>

                            </div>

                        </div>
                        <div class="sidebar-widget">
                            <h3>Size</h3>

                            <div class="switches-list">
                                <div class="switch-container">
                                    <label class="switch"><input type="radio" name="size" value="small"><span class="switch-button"></span>Small</label>
                                    <label class="switch"><input type="radio" name="size" value="medium"><span class="switch-button"></span>Medium</label>
                                    <label class="switch"><input type="radio" name="size" value="large"><span class="switch-button"></span>Large</label>
                                </div>
                            </div>

                        </div>
                        {{--<div class="sidebar-widget">
                            <h3>Price</h3>
                            <div class="margin-top-55"></div>

                            <input class="range-slider" name="price" type="text" value="" data-slider-currency="#" data-slider-min="500" data-slider-max="15000" data-slider-step="100" data-slider-value="[1500,15000]"/>
                        </div>--}}
                        {{--<div class="sidebar-widget">
                            <h3>Related tags</h3>

                            <div class="tags-container">

                                @foreach( $keyword as $key=> $word)
                                    <div class="tag">
--}}{{--
                                        <input type="checkbox" name="keywords[{{$word->id}}]" value="{{$word}}" id="tag{{$key}}"/>
--}}{{--
                                       <a href="#"><label for="tag{{$key}}">{{$word}} </label></a>
                                    </div>
                                @endforeach

                            </div>
                            <div class="clearfix"></div>
                        </div>--}}
                        <div class="sidebar-search-button-container">
                            <button  type="submit" class="button ripple-effect">Search</button>
                        </div>
                    </form>
                </div>
                <!-- Sidebar Container / End -->

                <!-- Search Button -->

                <!-- Search Button / End-->

            </div>
        </div>
        <!-- Full Page Sidebar / End -->

        <!-- Full Page Content -->
        <div class="full-page-content-container" data-simplebar>
            <div class="full-page-content-inner">

                <h3 class="page-title">Search Results</h3>
                <div class="row">
                    {{--
                                        <div class="col-2"> Related tags:</div>
                    --}}
                    <div class="col-10 pr-5">
                        Related tags:
                        @foreach( $keyword as $key=> $word)
                            <a href="{{route('browse.category',['category' => $word])}}" style="color: teal; font-size: large">{{$word}} </a> ,
                        @endforeach
                    </div>
                </div>
                <div class="section home-page-photos">
                    <div class="row">
                        <div class="col-xl-12">
                        </div>
                    </div>

                    @include("layouts.browse_photos_section")

                </div>

                <div class="clearfix"></div>
                <div class="pagination-container margin-top-20 margin-bottom-20">
                    <nav class="pagination">

                    </nav>
                </div>
                <div class="clearfix"></div>

            </div>
        </div>

        <!-- Full Page Content / End -->

    </div>




@endsection
@section("page_scripts")
    <script type="text/javascript">
        $('.js-example-basic-single').select2({
            height:"50px",
        });

    </script>

@endsection

