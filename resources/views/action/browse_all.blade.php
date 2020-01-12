@extends('layouts.app')
@section('content')
<div class="clearfix"></div>

<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h2>Browse Photos</h2>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/')}}">Search Pictures</a></li>
                        <li><a href="{{url('/browse_all')}}">Browse Photos</a></li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>


<div class="section white home-page-photos">
    <div class="row">
        <div class="col-xl-12">
        </div>
    </div>

    @include("layouts.browse_photos_section")


</div>
@endsection
