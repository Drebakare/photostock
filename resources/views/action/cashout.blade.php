@extends('layouts.dashboard_app')
@section('content')
    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner" >

            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>Cashout</h3>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Dashboard</a></li>
                        <li>Cashout</li>
                    </ul>
                </nav>
            </div>

            <!-- Row -->
            <div class="row">

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


                    <div class="col-xl-12">
                        <div class="dashboard-box margin-top-0">

                            <!-- Headline -->
                            <div class="headline">
                                <h3><i class="icon-material-outline-account-circle"></i>Previous Withdrawal</h3>
                            </div>

                            <div class="content with-padding padding-bottom-0">

                                <div class="col-xl-12 col-md-12 ">


                                        <div class="add-note-button offset-8 col-xl-4 col-md-4">
                                            <a href="#small-dialog" class="popup-with-zoom-anim button full-width button-sliding-icon">Click here to withdraw cash <i class="icon-material-outline-arrow-right-alt"></i></a>
                                        </div>


                                    @if(count($all_requests)>0)
                                        <table class=" table basic-table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <td>Id</td>
                                                    <td>Name</td>
                                                    <td>Amount</td>
                                                    <td>Status</td>
                                                    <td>Date requested</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($all_requests as $all_request)
                                                <tr>
                                                    <td data-label="Column 1">{{$all_request->id}}</td>
                                                    <td data-label="Column 2">{{$all_request->user->name}}</td>
                                                    <td data-label="Column 3">{{$all_request->amount}}</td>
                                                    <td data-label="Column 4">
                                                        @if($all_request->status == 0)
                                                            pending
                                                        @elseif($all_request->status == 1)
                                                            Approved
                                                        @else
                                                            Rejected
                                                        @endif
                                                    </td>
                                                    <td data-label="Column 5">{{$all_request->created_at}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Button -->


            </div>
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
    <div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

        <!--Tabs -->
        <div class="sign-in-form">

            <ul class="popup-tabs-nav">
                <li><a href="#tab">Withdrawal</a></li>
            </ul>

            <div class="popup-tabs-container">

                <!-- Tab -->
                <div class="popup-tab-content" id="tab">

                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h3>Cash Withdrawal</h3>
                    </div>

                    <!-- Form -->
                    <form method="post" action="{{route('cashout.submit')}}">
                        @csrf

                            <div class="selectpicker with-border default margin-bottom-20">
                                <h5>Enter Amount to withdraw</h5>
                                <input type="number" name="amount" min="0" class="with-border">
                            </div>
                          <button class="button full-width button-sliding-icon ripple-effect" type="submit" >Submit request <i class="icon-material-outline-arrow-right-alt"></i></button>
                    </form>

                    <!-- Button -->


                </div>

            </div>
        </div>
    </div>
@endsection
@section("page_scripts")
    <script type="text/javascript">
        @if(session('bad'))
        toastr.error('{{session("bad")}}');

        @endif
        @if(session('good'))
        toastr.success('{{session("good")}}');

        @endif
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".table").DataTable();
        });
    </script>

@endsection

