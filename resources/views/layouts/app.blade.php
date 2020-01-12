<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title Of Site -->
    <title>@yield('page_title', 'Photos, Collections') | Yaami</title>
    <meta name="description" content="HTML Responsive Landing Page Template for Stock Photo Online Based on Twitter Bootstrap 3.x.x" />
    <meta name="keywords" content="microstock, photo, stockphoto, photography, footage, vector, free photo, free image, photostock" />
    <meta name="author" content="crenoveative">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    {{--Template style sheets--}}

    <link rel="stylesheet" href="{{ asset('_landing/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('_landing/css/colors/blue.css') }}">

    {{--Bootstrap--}}
    {{--<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('../../dist/css/bootstrap.min.css')}}" rel="stylesheet">--}}

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--<link type="text/css" href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">--}}

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet" href="{{ asset("_bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("_fontawesome/css/all.min.css") }}">

    {{--Custom Css--}}
    <link rel="stylesheet" href="{{ asset("css/custom.css") }}">
    <link rel="stylesheet" href="{{ asset('_landing/css/select2.min.css') }}">

    <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5c6ed4f87056550011c4ab31&product=inline-share-buttons' async='async'></script>
    <style type="text/css">
        .imageStyle{
            border: 3px solid white;
        }
    </style>
</head>
<body class="">
<div id="wrapper" class="main">
    @include('layouts.include.header')
    <div id="content">
        @yield('content')
    </div>
    <div class="clear">
        @if(!in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['homepage','browse.all','search','browse.category','complex.search']))
            {{--@include('layouts.include.footer')--}}
        @endif
    </div>
</div>
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
    <!--Tabs -->
    <div class="sign-in-form ">

        <ul class="popup-tabs-nav">
            <li><a href="#login">Log In</a></li>
            <li><a href="#register">Register</a></li>
        </ul>

        <div class="popup-tabs-container">

            <!-- Login -->
            <div class="popup-tab-content" id="login">


                <div class="welcome-text">
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
                        <div class="alert alert-success" style="margin-top: 10px; margin-left: 10px;">
                            {{session('success')}}
                        </div>
                    @endif
                    <h3>We're glad to see you again!</h3>
                    <span>Don't have an account? <a href="#" class="register-tab">Sign Up!</a></span>
                </div>

                <!-- Form -->
                <form method="post" id="login-form" action="{{route('login')}}">
                    @csrf
                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="text" class="input-text with-border" name="email" id="emailaddress" placeholder="Email Address" required/>
                    </div>

                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password" id="password" placeholder="Password" required/>
                    </div>
                    <a href="#" class="forgot-password">Forgot Password?</a>

                    <button class="button full-width button-sliding-icon ripple-effect" type="submit" >Log In <i class="icon-material-outline-arrow-right-alt"></i></button>
                </form>

                <!-- Social Login -->
                <div class="social-login-separator"><span>or</span></div>
                <div class="social-login-buttons">
                    <button class="facebook-login ripple-effect"><a href="{{route('login.social', ['social' => 'facebook'])}}"><i class="icon-brand-facebook-f"></i> Log In via Facebook</a></button>
                    <button class="google-login ripple-effect"><a href="{{route('login.social', ['social' => 'google'])}}"><i class="icon-brand-google-plus-g"></i> Log In via Google+</a></button>
                </div>

            </div>

            <!-- Register -->
            <div class="popup-tab-content" id="register">

                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Let's create your account!</h3>
                </div>

                <form method="post" id="register-account-form" action="{{route('register')}}">
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
                        <div class="alert alert-success" style="margin-top: 10px; margin-left: 10px;">
                            {{session('success')}}
                        </div>
                    @endif
                    <div class="account-type">
                        <div>
                            <input type="radio" name="accountType" id="freelancer-radio" value="buyer" class="account-type-radio" checked/>
                            <label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> BUYER</label>
                        </div>

                        <div>
                            <input type="radio" name="accountType" id="employer-radio" value="seller" class="account-type-radio"/>
                            <label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> SELLER</label>
                        </div>
                    </div>
                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-account-circle"></i>
                        <input type="text" class="input-text with-border" name="fullname" id="fullname-register" placeholder="Fullname" required/>
                    </div>
                    <div class="input-with-icon-left">
                        <i class="icon-material-baseline-mail-outline"></i>
                        <input type="email" class="input-text with-border" name="email" id="emailaddress-register" placeholder="Email Address" required/>
                    </div>

                    <div class="input-with-icon-left" title="Should be at least 8 characters long" data-tippy-placement="bottom">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password" id="password-register" placeholder="Password" required/>
                    </div>

                    <div class="input-with-icon-left">
                        <i class="icon-material-outline-lock"></i>
                        <input type="password" class="input-text with-border" name="password_confirmation" id="password-repeat-register" placeholder="Repeat Password" required/>
                    </div>
                    <button class="margin-top-10 button full-width button-sliding-icon ripple-effect" type="submit" form="register-account-form">Register <i class="icon-material-outline-arrow-right-alt"></i></button>

                </form>

                <!-- Button -->

                <!-- Social Login -->
                <div class="social-login-separator"><span>or</span></div>
                <div class="social-login-buttons">
                    <button class="facebook-login ripple-effect"><a href="{{route('login.social', ['social' => 'facebook'])}}"><i class="icon-brand-facebook-f"></i> Register via Facebook</a></button>
                    <button class="google-login ripple-effect"><a href="{{route('login.social', ['social' => 'google'])}}"><i class="icon-brand-google-plus-g"></i> Register via Google+</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
@yield('form')

<script type="text/javascript">
    const webRoot = '{{ route('homepage') }}';
    const webRoot1 = '{{ url()->current()}}';
    const _token = '{!! csrf_token() !!}';
</script>


{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
<script src="{{ asset('_landing/js/jquery-3.3.1.min.js') }}"></script>

<script src="{{ asset('_landing/js/jquery-migrate-3.0.0.min.js') }}"></script>
<script src="{{ asset('_landing/js/mmenu.min.js') }}"></script>
<script src="{{ asset('_landing/js/tippy.all.min.js') }}"></script>
<script src="{{ asset('_landing/js/simplebar.min.js') }}"></script>
<script src="{{ asset('_landing/js/bootstrap-slider.min.js') }}"></script>
<script src="{{ asset('_landing/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('_landing/js/snackbar.js') }}"></script>
<script src="{{ asset('_landing/js/clipboard.min.js') }}"></script>
<script src="{{ asset('_landing/js/counterup.min.js') }}"></script>
<script src="{{ asset('_landing/js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('_landing/js/slick.min.js') }}"></script>
<script src="{{ asset('_landing/js/custom.js') }}"></script>

<script src="{{ asset('_landing/js/browse_photos_lazy_loading.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.min.js"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://api.demo.payant.ng/assets/js/inline.min.js"></script>





@yield("page_scripts")

<!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->
<script>
    // Snackbar for user status switcher
    $('#snackbar-user-status label').click(function() {
        Snackbar.show({
            text: 'Your status has been changed!',
            pos: 'bottom-center',
            showAction: false,
            actionText: "Dismiss",
            duration: 3000,
            textColor: '#fff',
            backgroundColor: '#383838'
        });
    });
</script>
<script>

    @if(session('failure'))
    toastr.error('username or password incorrect');
    $(document).on('ready', function(){
        $.magnificPopup.open({
            items:{
                src: '#sign-in-dialog',
                type: 'inline'
            },
            mainClass:'main'

        });

        $("#country").hover(function(){
            console.log("country");
        })
    });

    @endif
    @if(session('success'))
    toastr.success('{{session("success")}}');
    @endif

</script>

<!-- Google Autocomplete -->
<script>
    function initAutocomplete() {
        var options = {
            types: ['(cities)'],
            // componentRestrictions: {country: "us"}
        };

        var input = document.getElementById('autocomplete-input');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
    }

    // Autocomplete adjustment for homepage
    if ($('.intro-banner-search-form')[0]) {
        setTimeout(function(){
            $(".pac-container").prependTo(".intro-search-field.with-autocomplete");
        }, 300);
    }

</script>

</body>
</html>
