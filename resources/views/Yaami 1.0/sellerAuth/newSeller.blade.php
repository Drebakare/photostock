@extends('layouts.app')
@section('content')
    <br>
    <br>
    <div class="modal-content  col-lg-4 col-md-offset-4">
        <div class="clear"></div>
        <form id="register-form" action="{{url('/getnewSeller')}}" method="post">
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

                <h4>Register</h4>

                <button class="btn btn-facebook btn-block">Register with Facebook</button>

                <div class="modal-seperator">
                    <span>or</span>
                </div>

                <div class="form-group">
                    <input id="Fullname" name="Fullname" class="form-control" type="text" placeholder="Fullname">
                </div>

                <div class="form-group">
                    <input id="register_email" name="email" class="form-control" type="email" placeholder="Email">
                </div>

                <div class="form-group">
                    <input id="register_password" name="password" class="form-control" type="password" placeholder="Password">
                </div>

                <div class="form-group">
                    <input id="register_password_confirm" name="confirmPassword" class="form-control" type="password" placeholder="Confirm Password">
                </div>

                <div class="clear mb-10"></div>

            </div>

            <div class="modal-footer mt-10">
                <div class="row gap-10">
                    <div class="col-xs-6 col-sm-6 mb-10">
                        <button type="submit" class="btn btn-primary btn-sm btn-block">Register</button>
                    </div>
                </div>

                <div class="text-left">
                    <a href="{{route("signup")}}">  Already have account? <button id="register_login_btn" type="button" class="btn btn-link">Sign-in</button></a>
                </div>

            </div>

        </form>
    </div>

    </div>
@endsection

