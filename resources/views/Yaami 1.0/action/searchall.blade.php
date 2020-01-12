@extends('layouts.app')

@section('content')
<div class="main-wrapper">

    <form class="clearfix" method="post" action="{{url('/search')}}">
         @csrf
        <div class="breadcrumb-wrapper breadcrumb-form">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 col-sm-6 col-md-6 mb-20-sm col-md-offset-3">

                        <div class="input-group-search-form-wrapper">

                            <div class="input-group bg-change-focus-addclass">

                                <input type="text"  name="search" class="form-control" placeholder="KEYWORD" >

                                <div class="input-group-btn dropdown-select">
                                    <div class="dropdown dropdown-select">
                                    </div>
                                </div><!-- /btn-group -->

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>

                            </div><!-- /input-group -->

                        </div>

                    </div>




                </div>

            </div>

        </div>


    </form>

    <div class="content-wrapper">

        <div class="container">

            <div class="section-sm">

                <div class="section-title mb-30">
                    <h3 class="uppercase"><i class="fa fa-pie-chart mr-5"></i> <span class="font600">Nature</span> Photos &amp; Vectors</h3>
                </div>

                <div class="filter-sm-wrapper">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-4 mb-10">
                            <div class="result-count">{{count($searchall)}} items</div>
                        </div>

                        <div class="col-xs-12 col-sm-4 col-md-4 mb-10">
                            <ul class="filter-paging pull-right mt">

                            </ul>
                        </div>
                    </div>
                </div>
                @if(count($searchall)>0)
                    @foreach($searchall as $searchealls)
                <div class="flex-images flex-image category-item-wrapper">

                    <div class="item" data-w="800" data-h="533">
                        <a href="#">
                            <img src="/uploads/{{$searchealls->image}}" alt="image">
                        </a>
                        <div class="category-item-caption">
                            <div class="row gap-0">
                                <div class="col-xs-6 col-sm-6">
                                    <a href="#" data-toggle="tooltip"  data-placement="top" title="Purchase"><i class="fa fa-shopping-cart"></i></a>
                                </div>
                                <div class="col-xs-6 col-sm-6">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Preview"><i class="fa fa-download"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                 @else
                        <div class="section-title mb-30">
                            <h3 class="uppercase" style="color: red">No result found</h3>
                        </div>
                  @endif

                </div>


                <div class="filter-sm-wrapper mt-20">
                    <div class="row">

                        {{$searchall->links()}}
                        <div class="col-xs-12 col-sm-5 col-md-4 mb-10">

                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 mb-10">

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
