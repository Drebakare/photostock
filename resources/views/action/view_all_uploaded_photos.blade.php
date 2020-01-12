@extends('layouts.dashboard_app')
@section('content')
    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner" >

            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>My Uploads</h3>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Dashboard</a></li>
                        <li>My uploads</li>
                    </ul>
                </nav>
            </div>

            <div class="col-xl-12 col-md-12 dashboard-box">
                <br>
                <div class="section-headline margin-bottom-30">
                    {{--<h4>My Uploads</h4>--}}
                </div>
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
                <table class=" table basic-table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Title</td>
                            <td>Photo Type</td>
                            <td>Tags</td>
                            <td>Featured?</td>
                            {{--<td>Comment</td>--}}
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($all_photos as $key=> $all_photo)
                        <tr>
                            <td data-label="Column 1">{{$all_photo->id}}</td>
                            <td data-label="Column 2">{{$all_photo->title}}</td>
                            <td data-label="Column 3">@if($all_photo->type === 1) Free @else Enhanced @endif</td>
                            <td data-label="Column 4">{{$all_photo->tags}}</td>
                            <td data-label="Column 4">@if($all_photo->featured === 1) Yes @else No @endif</td>
                            <td data-label="Column 6">@if($all_photo->featured == 0 )
                                    <div class="d-none"> {{$key = $key + 1}}</div>
{{--
                                    <a href="#small-dialog-feature-{{$key}}" class="popup-with-zoom-anim btn btn-sm btn-info text-white">View Image<i class="icon-material-outline-arrow-right-alt"></i></a>
--}}
{{--
                                    <a href="#small-dialog-feature-{{$key}}" class="popup-with-zoom-anim btn btn-sm btn-success text-white">Feature Image<i class="icon-material-outline-arrow-right-alt"></i></a>
--}}
                                    <button type="button" class="btn btn-sm btn-info text-white" data-toggle="modal" data-target="#myModal-{{$key}}">
                                        View Image<i class="icon-material-outline-arrow-right-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-success text-white" data-toggle="modal" data-target="#myModal-feature-{{$key}}">
                                        Feature Image{{--<i class="icon-material-outline-arrow-right-alt"></i>--}}
                                    </button>
                                    {{--
                                    <button c class="btn btn-sm btn-success text-white">Feature Image</button>
--}}
                                @else
                                    nil
                                @endif
                            {{--</td><td data-label="Column 7">@if($all_upload->approved >1 && $all_upload->is_collection != 1)
                                    <a href="{{ route('dashboard.edit-upload',["upload_id" =>$all_upload->id ]) }}" class="btn btn-sm btn-info text-white">
                                        Edit Upload
                                    </a>
                                @else
                                    Nil
                                @endif--}}
                            </td>
                        </tr>

                    @endforeach
                    </tbody>


                </table>
            </div>
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
   @foreach($all_photos as $key => $all_photo)
       <div class="d-none"> {{$key = $key + 1}}</div>
       <div class="modal fade" id="myModal-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
           <div class="modal-dialog" role="document">
               <div class="modal-content">

                   <div class="modal-body">
                       <img class="imageStyle" src="{{'/storage/uploads/original/'.$all_photo->image}}"/>
                   </div>

               </div>
           </div>
       </div>
   @endforeach
    @foreach($all_photos as $key => $all_photo)
        <div class="d-none"> {{$key = $key + 1}}</div>
       <div class="modal fade" id="myModal-feature-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLongTitle">Feature Image</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body text-center">
                       Featuring an Image requires a service charge of #180, and you can pay with your earnings or through a payment gateway
                   </div>
                   <div class="modal-footer">
                       <form method="post" action="{{route('feature.payment.wallet')}} ">
                           @csrf
                           <input value="{{$all_photo->id}}" name="image_id" hidden>
                           <button type="submit" class="btn btn-sm btn-info text-white" >
                               Use Wallet<i class="icon-material-outline-arrow-right-alt"></i>
                           </button>
                       </form>
                       <button type="button" class="btn btn-sm btn-success text-white" onclick="payWithPayant({{$all_photo}})">
                           Pay with Card{{--<i class="icon-material-outline-arrow-right-alt"></i>--}}
                       </button>
                   </div>
               </div>
           </div>
       </div>
   @endforeach
{{--
    @foreach($all_photos as $key => $all_photo)
        <div class="d-none"> {{$key = $key + 1}}</div>
        <div id="small-dialog-{{$key}}" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

            <!--Tabs -->
            <div class="sign-in-form">

                <ul class="popup-tabs-nav">
                    <li><a href="#tab">View Image</a></li>
                </ul>

                <div class="popup-tabs-container">

                    <div class="col-xl-12 col-lg-12 col-12">
                        <div class="single-page-section photo-details-left-image">
                            <img id="mainImage" src="{{'/storage/uploads/original/'.$all_photo->image}}" style="max-height: 500px" class="img-thumbnail mb-3">
                            --}}{{--@if(count($all_photos)>0)
                                <div id="divContainer" class="row">
                                    @foreach($all_photos as $key => $all_photo)
                                        <div class="col-xl-3 col-sm-1 col-lg-3" id="{{$key}}">
                                            <img class="imageStyle" src="{{'/storage/uploads/original/'.$all_photo->image}}"/>
                                        </div>
                                    @endforeach
                                </div>
                            @endif--}}{{--
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
    @foreach($all_photos as $key => $all_photo)
       <div class="d-none"> {{$key = $key + 1}}</div>
        <div id="small-dialog-feature-{{$key}}" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

            <!--Tabs -->
            <div class="sign-in-form">

                <ul class="popup-tabs-nav">
                    <li><a href="#tab">View Image</a></li>
                </ul>

                <div class="popup-tabs-container">

                    <div class="col-xl-12 col-lg-12 col-12">
                        <div class="single-page-section photo-details-left-image">
                            <img id="mainImage" src="{{'/storage/uploads/original/'.$all_photo->image}}" style="max-height: 500px" class="img-thumbnail mb-3">
                            @if(count($all_photos)>0)
                                <div id="divContainer" class="row">
                                    @foreach($all_photos as $key => $all_photo)
                                        <div class="col-xl-3 col-sm-1 col-lg-3" id="{{$key}}">
                                            <img class="imageStyle" src="{{'/storage/uploads/original/'.$all_photo->image}}"/>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endforeach--}}
{{--@foreach($all_photos as $key => $all_photo)
   <div class="d-none"> {{$key = $key + 1}}</div>
    <div id="small-dialog-feature-{{$key}}" class="zoom-anim-dialog mfp-hide  col-xl-6 col-lg-6 col-6">

        <!--Tabs -->
        <div class="sign-in-form">

            <ul class="popup-tabs-nav">
                <li><a href="#tab">View Image</a></li>
            </ul>

            <div class="popup-tabs-container">

                <div class="col-xl-6 col-lg-6 col-6">
                    vnmvnvnb
                </div>

            </div>
        </div>
    </div>
@endforeach--}}
{{--@foreach($all_photos as $key => $all_photo)
   <div class="d-none"> {{$key = $key + 1}}</div>
    <div id="small-dialog-feature-{{$key}}" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

        <!--Tabs -->
        <div class="sign-in-form">

            <ul class="popup-tabs-nav">
                <li><a href="#tab">View Image</a></li>
            </ul>

            <div class="popup-tabs-container">

                <div class="col-xl-12 col-lg-12 col-12">
                    <div class="single-page-section photo-details-left-image">
                        <img id="mainImage" src="{{'/storage/uploads/original/'.$all_photo->image}}" style="max-height: 500px" class="img-thumbnail mb-3">
                        @if(count($all_photos)>0)
                            <div id="divContainer" class="row">
                                @foreach($all_photos as $key => $all_photo)
                                    <div class="col-xl-3 col-sm-1 col-lg-3" id="{{$key}}">
                                        <img class="imageStyle" src="{{'/storage/uploads/original/'.$all_photo->image}}"/>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

            </div>
            <!-- Register -->

        </div>
    </div>
@endforeach--}}
{{--  @foreach($all_photos as $key => $all_photo)
        <div class="d-none"> {{$key = $key + 1}}</div>
         <div id="small-dialog-feature-{{$key}}" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

             <!--Tabs -->
             <div class="sign-in-form">

                 <ul class="popup-tabs-nav">
                     <li><a href="#tab">Feature Image</a></li>
                 </ul>
                 <div class="popup-tabs-container">

                     <!-- Welcome Text -->
                     --}}{{--<div class="welcome-text">
                         <h3 style="text-align: center" class="col-xl-5">Featuring an Image requires a service charge of #180, and you can pay with your earnings or through a payment gateway</h3>
                     </div>--}}{{--
                     <div>
                         <button onclick="payWithPayant({{$all_photo}})" class="btn btn-sm btn-info text-white">Use Wallet</button>
                         <button onclick="payWithPayant({{$all_photo}})" class="btn btn-sm btn-success text-white">Pay with Card</button>

                     </div>

                 </div>
             </div>
         </div>
    @endforeach--}}
    <meta name="_token" content="{{ app('Illuminate\Encryption\Encrypter')->encrypt(csrf_token()) }}" />
@endsection
@section("page_scripts")
    <script type="text/javascript">
        $(document).ready(function () {
            $(".table").DataTable();

        });
    </script>
    <script type="text/javascript">
        function payWithPayant(image){
            var handler = Payant.invoice({
                "key": "14f61fa44ef42e93ddfd35c97f85a0d8fbcd6ef1",
                "client": {
                    "first_name": "{{Auth::user()->name}}",
                    "last_name": "Yaami",
                    "email": "{{Auth::user()->email}}",
                    "phone": "+2348102780566"
                },
                "due_date": "{{date('m/d/Y')}}",
                "fee_bearer": "client",
                "items": [
                    {
                        "item": image.slug,
                        "description": "yaami.com/make-payment",
                        "unit_cost": 180,
                        "quantity": "1"
                    }
                ],
                callback: function(response) {
                    recordTransaction(response);
                },
                onClose: function() {
                    console.log('Window Closed.');
                }
            });
            handler.openIframe();
            function recordTransaction(response) {
                console.log(response.reference_code);
                $.ajaxSetup({
                    headers: {
                        'X-XSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('feature.payment') }}",
                    method: 'post',
                    data: {
                        email: '{{Auth::user()->email}}',
                        image_id: image.id,
                        reference_key: response.reference_code,
                        _token: '{!! csrf_token() !!}',
                    },
                    cache: false,

                    success: function(status){
                        if(status.status){
                            toastr.success('Image successfully featured');
                            location.reload();
                        }
                        else{
                            toastr.failure('Error!, image could not be featured');
                            location.reload();
                        }
                    },
                    failure: function (result) {
                        console.log(result);
                    }
                });
            }


        }
    </script>
@endsection

