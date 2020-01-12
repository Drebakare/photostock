<div class="dashboard-sidebar">
    <div class="dashboard-sidebar-inner" data-simplebar>
        <div class="dashboard-nav-container">

            <!-- Responsive Navigation Trigger -->
            <a href="#" class="dashboard-responsive-nav-trigger">
                        <span class="hamburger hamburger--collapse" >
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </span>
                <span class="trigger-title">Dashboard Navigation</span>
            </a>

            <!-- Navigation -->
            <div class="dashboard-nav">
                <div class="dashboard-nav-inner">

                    <ul {{--data-submenu-title="Start"--}}>
                        <li class="{{ (Route::currentRouteName()== "dashboard") ? "active" : "" }}"><a href="{{route('dashboard')}}"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
                        @if((Auth::user()->is_seller)==1)
                            <li class="{{ (Route::currentRouteName()== "view-message") ? "active" : "" }}"><a href="{{route('view-message')}}"><i class="icon-material-outline-question-answer"></i> Reviews </a></li>
                            <li class="{{ in_array(Route::currentRouteName(), ["dashboard.upload_photos", "dashboard.upload_collection_photos"] ) ? "active active-submenu" : "" }}"><a href="#"><i class="icon-material-outline-business-center"></i> Upload Photos</a>
                                <ul>
                                    <li><a href="{{route('dashboard.upload_photos')}}">Upload Single Photos</a></li>
                                   {{-- <li><a href="{{route('dashboard.upload_collection_photos')}}">Upload Collection</a></li>--}}
                                </ul>
                            </li>
                            <li class="{{ (Route::currentRouteName()== "upload-status") ? "active" : "" }}"><a href="{{route('upload-status')}}"><i class="icon-material-outline-check-circle"></i> Upload Status </a></li>
                            <li class="{{ (Route::currentRouteName()== "view-photos") ? "active" : "" }}"><a href="{{route('view-photos')}}"><i class="icon-material-outline-check-circle"></i> View Uploaded Photos </a></li>
                            <li class="{{ (Route::currentRouteName()== "cashout") ? "active" : "" }}"><a href="{{route('cashout')}}"><i class="icon-material-outline-monetization-on"></i> Cash Out </a></li>
                            <li class="{{ (Route::currentRouteName()== "update-bank-account") ? "active" : "" }}"><a href="{{route('update-bank-account')}}"><i class="icon-material-outline-account-balance-wallet"></i> Update Bank Details</a></li>
                        @endif
                            <li class="{{ (Route::currentRouteName()== "dashboard.my-gallery") ? "active" : "" }}"><a href="{{route('dashboard.my-gallery')}}"><i class="icon-material-outline-rate-review"></i> My Gallery</a></li>


                            {{--<li><a href="dashboard-manage-jobs.html">Manage Jobs <span class="nav-tag">3</span></a></li>
                            <li><a href="dashboard-manage-candidates.html">Manage Candidates</a></li>
                            <li><a href="dashboard-post-a-job.html">Post a Job</a></li>--}}
                    </ul>





                       {{-- <ul data-submenu-title="Organize and Manage">
                            <li><a href="#"><i class="icon-material-outline-business-center"></i> Upload Photos</a>
                                <ul>
                                    <li><a href="dashboard-manage-jobs.html">Manage Jobs <span class="nav-tag">3</span></a></li>
                                    <li><a href="dashboard-manage-candidates.html">Manage Candidates</a></li>
                                    <li><a href="dashboard-post-a-job.html">Post a Job</a></li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="icon-material-outline-assignment"></i> Tasks</a>
                                <ul>
                                    <li><a href="dashboard-manage-tasks.html">Manage Tasks <span class="nav-tag">2</span></a></li>
                                    <li><a href="dashboard-manage-bidders.html">Manage Bidders</a></li>
                                    <li><a href="dashboard-my-active-bids.html">My Active Bids <span class="nav-tag">4</span></a></li>
                                    <li><a href="dashboard-post-a-task.html">Post a Task</a></li>
                                </ul>
                            </li>
                        </ul>--}}

                        <ul data-submenu-title="Account">
                            <li class="{{ (Route::currentRouteName()== "dashboard.update_account") ? "active" : "" }}" ><a href="{{route('dashboard.update_account')}}"><i class="icon-material-outline-settings"></i>Update Account</a></li>
                            <li><a href="{{route('logout')}}"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
                        </ul>

                </div>
            </div>
            <!-- Navigation / End -->

        </div>
    </div>
</div>
