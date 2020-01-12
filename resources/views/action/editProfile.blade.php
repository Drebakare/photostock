@extends('layouts.dashboard_app')
@section('content')
    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner" >

            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>Settings</h3>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Dashboard</a></li>
                        <li>Settings</li>
                    </ul>
                </nav>
            </div>
            <form  method="post" action="{{route('dashboard.edit_profile_account', ['id' =>Auth::user()->id])}}">
                @csrf
                @if(count($errors)>0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger"  style="margin-top: 10px; margin-left: 10px;">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
                @if(session('bad'))
                    <div class="alert alert-danger" style="margin-top: 10px; margin-left: 10px;">
                        {{session('bad')}}
                    </div>
                @endif
                @if(session('good'))
                    <div class="alert alert-success" style=" margin-top: 10px; margin-left: 10px;">
                        {{session('good')}}
                    </div>
                @endif
                    <div class="col-xl-12 col-md-12">
                        <div class="content with-padding">
                            <div class="col-xl-12">
                                <div id="test1" class="dashboard-box">

                                    <div class="headline">
                                        <h3><i class="icon-material-outline-account-circle"></i> My Account</h3>
                                    </div>

                                    <div class="content with-padding padding-bottom-0">

                                        <div class="row">
                                            <div class="col">

                                                <div class="row">

                                                        <div class="col-xl-4">
                                                            <div class="submit-field">
                                                                <h5>Last Name</h5>
                                                                <input type="text" name="fullname" class="with-border" value="{{Auth::user()->name}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-3">
                                                            <!-- Account Type -->
                                                            <div class="submit-field">
                                                                <h5>Account Type</h5>
                                                                <div class="account-type">
                                                                    @if((Auth::user()->is_seller)==1)
                                                                        <div>
                                                                            <input type="radio" name="account_type" id="freelancer-radio" class="account-type-radio"  checked />
                                                                            <label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Seller </label>
                                                                        </div>
                                                                    @endif
                                                                    @if((Auth::user()->is_seller)==0 &&(Auth::user()->is_admin)==0)
                                                                        <div>
                                                                            <input type="radio"  name="account_type" id="employer-radio" class="account-type-radio" checked />
                                                                            <label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center" ></i> Buyer</label>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-5">
                                                            <div class="submit-field">
                                                                <h5>Email</h5>
                                                                <input type="text" name="email" class="with-border" value="{{Auth::user()->email}}">
                                                            </div>
                                                        </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <button type="submit" class="button ripple-effect big margin-top-30">Save Changes</button>
                        </div>
                    </div>
            </form>
            <form method="post" action="{{route('dashboard.edit_profile_password', ['id' =>Auth::user()->id])}}">
                @csrf
                <div class="col-xl-12 col-md-12">
                    <div class="content with-padding">
                        <div class="col-xl-12">
                            <div id="test1" class="dashboard-box">

                                <!-- Headline -->
                                <div class="headline">
                                    <h3><i class="icon-material-outline-lock"></i> Password & Security</h3>
                                </div>

                                <div class="content with-padding">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="submit-field">
                                                <h5>Current Password</h5>
                                                <input type="password" name="previous_password" class="with-border" required>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="submit-field">
                                                <h5>New Password</h5>
                                                <input type="password" name="new_password" class="with-border" required>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="submit-field">
                                                <h5>Repeat New Password</h5>
                                                <input type="password" name="confirm_password" class="with-border" required>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="col-xl-12">
                            <button type="submit" class="button ripple-effect big margin-top-30">Save Changes</button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Row / End -->

            <!-- Footer -->
            <div class="dashboard-footer-spacer"></div>
            <div class="small-footer margin-top-15">
                <div class="small-footer-copyrights">
                    © 2018 <strong>Hireo</strong>. All Rights Reserved.
                </div>
                <ul class="footer-social-links">
                    <li>
                        <a href="#" title="Facebook" data-tippy-placement="top">
                            <i class="icon-brand-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Twitter" data-tippy-placement="top">
                            <i class="icon-brand-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Google Plus" data-tippy-placement="top">
                            <i class="icon-brand-google-plus-g"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="LinkedIn" data-tippy-placement="top">
                            <i class="icon-brand-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- Footer / End -->

        </div>
    </div>
@endsection
