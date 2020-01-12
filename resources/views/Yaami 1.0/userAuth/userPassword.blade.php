@extends('layouts.app')
@section('content')
    <br>
    <br>
    <div class="modal-content  col-lg-4 col-md-offset-4">



        <div class="clear"></div>

        <!-- Begin # DIV Form -->
        <div id="modal-login-form-wrapper">
                    <form id="lost-form">
                        <div class="modal-body pb-5">

                            <h4>Forgot password</h4>

                            <div class="form-group">
                                <input id="lost_email" class="form-control" type="text" placeholder="Enter Your Email">
                            </div>

                            <div class="text-center mt-10 mb-10">
                                <a href="{{route("signup")}}">  <button id="lost_login_btn" type="button" class="btn btn-link">Sign-in</button><a/> or
                                    <a href="{{url('/register')}}"> <button id="lost_register_btn" type="button" class="btn btn-link">Register</button></a>
                            </div>

                        </div>

                        <div class="modal-footer mt-10">
                            <div class="row gap-10">
                                <div class="col-xs-6 col-sm-6">
                                    <button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
                                </div>
                                <div class="col-xs-6 col-sm-6">
                                    <button type="submit" class="btn btn-main btn-sm btn-inverse btn-block" data-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </div>

                        </div>

                    </form>
        </div>

    </div>

<div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>
@endsection


