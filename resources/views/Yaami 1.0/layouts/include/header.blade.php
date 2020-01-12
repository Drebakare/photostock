<!-- BEGIN # MODAL LOGIN -->

<div class="wrapper container-wrapper">
<header id="header">

    <!-- start Navbar (Menu) -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">

        <div class="container">

            <div class="navbar-header">
                <a class="navbar-brand" href="index-2.html"><i class="fa fa-camera-retro"></i> Photock</a>
            </div>

            <div id="navbar" class="collapse navbar-collapse navbar-arrow pull-left">

                <ul class="nav navbar-nav" id="responsive-menu">
                    <li>
                        <a href="{{url('/')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{url('/allPictures')}}">StockPhoto</a>
                    </li>
                    <li><a href="contact.html">Contact Us</a></li>
                    @if(Auth::check())
                        @if((Auth::user()->is_seller)==1)
                            <li>   <a href="{{route('upload')}}"></i>Upload</a></li>
                        @endif
                    @endif
                </ul>
            </div><!--/.nav-collapse -->

            <div class="pull-right">
                <div class="navbar-mini">
                    <ul class="clearfix">
                        @if(Auth::check())
                            <li>
                                <a href="#"><i class="fa fa-user"></i> Profile</a>
                            </li>
                            <li>
                                <a href="{{url('/logout')}}"><span>{{Auth::user()->name}}</span><i class="fa fa-sign-out"></i> Sign Out</a>
                            </li>
                        @else
                        <li class="user-action">
                            <a data-toggle="modal" href="{{route("signup")}}" class="btn">Sign up/in</a>
                        </li>
                        @endif
                    </ul>
                </div>

            </div>

        </div>

        <div id="slicknav-mobile"></div>

    </nav>


</header>
</div>
