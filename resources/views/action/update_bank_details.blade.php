@extends('layouts.dashboard_app')
@section('content')
    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner" >

            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>Account Details</h3>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Dashboard</a></li>
                        <li>Account Details</li>
                    </ul>
                </nav>
            </div>

            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <form method="post" action="{{route('update-bank-account')}}">
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
                               <div id="test1" class="dashboard-box">

                                   <!-- Headline -->
                                   <div class="headline">
                                       <h3><i class="icon-material-outline-account-circle"></i> Bank Account Details</h3>
                                   </div>

                                   <div class="content with-padding">
                                       <div class="col-xl-12">
                                           <div class="row">
                                               <div class="col-xl-4">
                                                   <div class="submit-field">
                                                       <h5>Account Name</h5>
                                                       <input type="text" @if($get_user) value="{{$get_user->account_name}}" @endif name="account_name" class="with-border">
                                                   </div>
                                               </div>

                                               <div class="col-xl-4">
                                                   <div class="submit-field">
                                                       <h5>Account Number</h5>
                                                       <input type="number" @if($get_user) value="{{$get_user->account_number}}" @endif name="account_number" min="0" class="with-border">
                                                   </div>
                                               </div>

                                               <div class="col-xl-4">
                                                   <div class="submit-field">
                                                       <h5>Bank</h5>
                                                       <input type="text" @if($get_user) value="{{$get_user->bank}}" @endif name="bank" class="with-border">
                                                   </div>
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
                    </form>
                </div>

            </div>
            <br>
            <br>
            <br>
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
