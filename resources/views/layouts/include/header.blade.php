 <header id="header-container" class="fullwidth @if(Route::currentRouteName() == 'homepage' ) transparent-header @ @endif">

        <!-- Header -->
        <div id="header">
            <div class="container" style="position: initial">

                <!-- Left Side Content -->
                <div class="left-side">

                    <!-- Logo -->
                    <div id="logo">
                        <a href="{{ route("homepage") }}"><img src="{{asset('_landing/images/logo2.png')}}" data-sticky-logo="{{asset('_landing/images/logo.png')}}" alt=""></a>
                    </div>

                    <nav id="navigation">
                        <ul id="responsive">

                            <li><a class="current" href="{{route("homepage")}}">Home</a></li>

                            <li><a href="{{route('browse.all')}}">StockPhoto</a></li>
                        </ul>
                    </nav>
                    <div class="clearfix"></div>
                </div>
                <div class="right-side">
                        @if(Route::currentRouteName() == 'homepage' ||  Route::currentRouteName() == 'all.picture' )
                            <div class="header-notifications user-menu mr-4">
                                <div class="header-notifications-trigger">
                                    <a href="#" style="border:1px solid #F5F5F5; padding: 2px 15px 10px">
                                        <img class="pr-3" style="height: 13px" src="{{asset("flags/NG.png")}}"><small  style="font-family: Arial, sans-serif; font-size: 12px; color: blue">Nigeria
                                        </small></a>
                                </div>
                                <!-- Dropdown -->
                                <div class="header-notifications-dropdown " style="width:150px !important;">
                                    <ul class="user-menu-small-nav">
                                        @foreach($regions as $region)
                                            <a   href="{{route('location.change',["currency_code" => $region->currency_code])}}">
                                                <div id="country" class="row">
                                                    <span class="mb-3 pr-3"><img src="{{asset("flags/".$region->country->flag)}}"></span>
                                                    <li id="country">{{$region->name}}</li>
                                                </div>
                                            </a>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if(!(Auth::check()))
                        <div class="header-widget">
                            <a href="#sign-in-dialog" class="popup-with-zoom-anim log-in-button"><i class="icon-feather-log-in"></i> <span>Log In / Register</span></a>
                        </div>
                        @else

                        <span class="mmenu-trigger">
					    <button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					    </button>
				        </span>
                        <div class="header-widget">

                        <!-- Messages -->
                        <div class="header-notifications user-menu">
                            <div class="header-notifications-trigger">
                                <a href="#"><div class="user-avatar status-online"><img src="{{asset('_landing/images/user-avatar-small-01.jpg')}}" alt=""></div></a>
                            </div>

                            <!-- Dropdown -->
                            <div class="header-notifications-dropdown">
                                <div class="user-status">
                                    <div class="user-details">
                                        <div class="user-avatar status-online"><img src="{{asset('_landing/images/user-avatar-small-01.jpg')}}" alt=""></div>
                                        <div class="user-name">
                                            {{Auth::user()->name}} <span>
                                                @if(Auth::user()->is_seller)
                                                    SELLER
                                                @else
                                                    BUYER
                                                 @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <ul class="user-menu-small-nav">
                                    <li><a href="{{route('dashboard')}}"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
                                    <li><a href="dashboard-settings.html"><i class="icon-material-outline-settings"></i> Settings</a></li>
                                    <li><a href="{{route('logout')}}"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    <span class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
				</span>
                </div>
            </div>
        </div>
    </header>
