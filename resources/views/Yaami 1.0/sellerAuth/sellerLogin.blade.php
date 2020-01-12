@extends('layouts.app')
@section('content')
    <br>
    <br>
    <div class="modal-content  col-lg-4 col-md-offset-4">



        <div class="clear"></div>

        <!-- Begin # DIV Form -->
        <div id="modal-login-form-wrapper">

            <!-- Begin # Login Form -->
            <form id="login-form" method="post" action="{{url('/getloggedIn')}}">
                @csrf
                @if(count($errors)>0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger"  style="margin-top: 10px; margin-left: 10px;">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
                @if(session('failure'))
                    <div class="alert alert-danger" style="margin-top: 10px; margin-left: 10px;">
                        {{session('failure')}}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success" style=" margin-top: 10px; margin-left: 10px;">
                        {{session('success')}}
                    </div>
                @endif
                <div class="modal-body pb-5">

                    <h4>Sign-in</h4>

                    <button class="btn btn-facebook btn-block">Sign-in with Facebook</button>

                    <div class="modal-seperator">
                        <span>or</span>
                    </div>

                    <div class="form-group">
                        <input id="email" class="form-control" name="email" placeholder="Email" type="text">
                    </div>
                    <div class="form-group">
                        <input id="login_password" name="password" class="form-control" placeholder="password" type="password">
                    </div>

                    <div class="form-group mt-10 mb-10">
                        <div class="row gap-5">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="checkbox-block fa-checkbox">
                                    <input id="remember_me_checkbox" name="remember_me_checkbox" class="checkbox" value="First Choice" type="checkbox">
                                    <label class="" for="remember_me_checkbox">remember</label>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 text-right mt-5">
                                <a href="{{url('/forgotpassword')}}"><button id="login_lost_btn" type="button" class="btn btn-link">forgot password?</button></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">

                    <div class="row gap-10">
                        <div class="col-xs-6 col-sm-6 mb-10">
                            <button type="submit" class="btn btn-primary btn-sm btn-block">Sign-in</button>
                        </div>

                    </div>
                    <div class="text-left">
                        No account?
                        <a href="{{url('/register')}}">  <button id="login_register_btn" type="button" class="btn btn-link">Register</button></a>
                    </div>

                </div>

            </form>
            <!-- End # Login Form -->

            <!-- Begin | Lost Password Form -->

            <!-- Begin | Register Form -->

            <!-- End | Register Form -->

        </div>
        <!-- End # DIV Form -->
    </div>

    </div>




@endsection



