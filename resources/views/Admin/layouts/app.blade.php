<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Admindek | Admin Template</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="colorlib" />
    <!-- Favicon icon -->
    <link rel="icon" href="https://colorlib.com//polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('_mddesign/css/dataTables.bootstrap4.min.css')}}">

    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('_admin/files/bower_components/bootstrap/css/bootstrap.min.css')}}">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{asset('_admin/files/assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
    <!-- feather icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('_admin/files/assets/icon/feather/css/feather.css')}}">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="{{asset('_admin/files/assets/css/font-awesome-n.min.css')}}">
    <!-- Chartlist chart css -->
    <link rel="stylesheet" href="{{asset('_admin/files/bower_components/chartist/css/chartist.css')}}" type="text/css" media="all">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('_admin/files/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('_admin/files/assets/css/widget.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('_admin/files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('_admin/files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('_admin/files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">

    {{--Bootstrap--}}
    <link rel="stylesheet" href="{{ asset("_bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}


    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    {{--Custom Css--}}
   {{-- <link rel="stylesheet" href="{{ asset("css/custom.css") }}">--}}



</head>
<body >
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            @include('Admin.layouts.include.header')
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    @include('Admin.layouts.include.sidebar')
                    @yield('content')
                    <div id="styleSelector">
                    </div>
                </div>
            </div>
        </div>
    </div>
   {{-- <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            @include('Admin.layouts.include.header')
             <div class="pcoded-main-container">
                 <div class="pcoded-wrapper">
                    @include('Admin.layouts.include.sidebar')
                     @yield('content')
                     <div id="styleSelector">
                     </div>
                 </div>
             </div>
        </div>
    </div>
        @include('Admin.layouts.include.footer')--}}





<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('_admin/files/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('_admin/files/bower_components/popper.js/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('_admin/files/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- waves js -->
<script src="{{asset('_admin/files/assets/pages/waves/js/waves.min.js')}}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{asset('_admin/files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
<!-- Float Chart js -->
<script src="{{asset('_admin/files/assets/pages/chart/float/jquery.flot.js')}}"></script>
<script src="{{asset('_admin/files/assets/pages/chart/float/jquery.flot.categories.js')}}"></script>
<script src="{{asset('_admin/files/assets/pages/chart/float/curvedLines.js')}}"></script>
<script src="{{asset('_admin/files/assets/pages/chart/float/jquery.flot.tooltip.min.js')}}"></script>
<!-- Chartlist charts -->
<script src="{{asset('_admin/files/bower_components/chartist/js/chartist.js')}}"></script>
<!-- amchart js -->
<script src="{{asset('_admin/files/assets/pages/widget/amchart/amcharts.js')}}"></script>
<script src="{{asset('_admin/files/assets/pages/widget/amchart/serial.js')}}"></script>
<script src="{{asset('_admin/files/assets/pages/widget/amchart/light.js')}}"></script>
<!-- Custom js -->
<script src="{{asset('_admin/files/assets/js/pcoded.min.js')}}"></script>
<script src="{{asset('_admin/files/assets/js/vertical/vertical-layout.min.js')}}"></script>
<script type="text/javascript" src="{{asset('_admin/files/assets/pages/dashboard/custom-dashboard.min.js')}}"></script>
<script type="text/javascript" src="{{asset('_admin/files/assets/js/script.min.js')}}"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
    <script src="{{asset('_mddesign/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('_mddesign/js/dataTables.bootstrap4.min.js')}}"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>
 @yield('script')
</body>
</html>
