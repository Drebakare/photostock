@extends('layouts.app')
@section('page_title', ucwords($photoDetails->title))
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-12">
                <div class="single-page-section photo-details-left-image">
                    <img id="mainImage" src="{{asset('uploads/original/'.$photoDetails->image)}}" class="img-thumbnail mb-3">
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
            <div class="col-xl-4 col-lg-4 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="sidebar-container">
                            @if($photoDetails->price === 0.0 )
                                <div class="photo-details-right">
                                    <div class="photo-details-right-title">
                                        {{ $photoDetails->title }}
                                        <small class="text-muted" style="text-transform: capitalize; font-size: 60%">( Single Image )</small>
                                    </div>
                                    <div class="photo-details-right-user mt-1">
                                        <small class="text-muted"><i class="fa fa-user"></i> {{ $photoDetails->upload->user->name }}</small>
                                    </div>
                                    <div class="photo-details-right-rating mt-2">
                                        @if($image_review == 0)
                                            <small class="text-muted">No review</small>
                                        @else
                                            @for($i = 0; $i < $image_review ; $i++)
                                                  <i class="fa fa-star"></i>
                                            @endfor
                                        @endif
                                    </div>
                                    <div class="photo-details-right-price mt-2">
                                        Free
                                    </div>
                                    <hr>
                                    <form method="post" action="{{route('download',['slug' => $photoDetails->image])}}">
                                        @csrf
                                        <div class="photo-details-right-size mt-2 text-muted">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="size" id="exampleRadios1" value="small" checked>
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        Small Size (width: 100px )
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="size" id="exampleRadios2" value="medium">
                                                    <label class="form-check-label" for="exampleRadios2">
                                                        Medium Size (width: 250px)
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="size" id="exampleRadios2" value="large">
                                                    <label class="form-check-label" for="exampleRadios2">
                                                        Original Size
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="photo-details-right-button mt-2 mb-4">
                                            <button type="submit" class="btn btn-success btn-block text-uppercase">
                                                <small><i class="fa fa-download"></i> Download Photo</small>
                                            </button>
                                        </div>
                                    </form>
                                    <div class="photo-details-right-license mt-3 text-muted">
                                        <div class="">
                                            <b>License</b>
                                        </div>
                                        <div>
                                            Lorem Ipsum ios a akjsno i jsn os osnpi dos
                                            Lorem Ipsum ios a akjsno i jsn os osnpi dos
                                            Lorem Ipsum ios a akjsno i jsn os osnpi dos
                                        </div>
                                    </div>
                                    <div class="photo-details-right-share mt-4">
                                        <div class="row">
                                            <div class="col-xl-12 col-sm-12 text-center"><span><small><b>Share:</b></small></span></div>
                                            <div class="col-xl-12 col-sm-12 sharethis-inline-share-buttons mr-1"></div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @if(!(Auth::check()))
                                    <div class="photo-details-right">
                                        <div class="photo-details-right-title">
                                            {{ $photoDetails->title }}
                                            @if($photoDetails->price == null)
                                                <small class="text-muted" style="text-transform: capitalize; font-size: 60%">( collection of {{count($all_photos)}} Images)</small>
                                            @else
                                                <small class="text-muted" style="text-transform: capitalize; font-size: 60%">( Single Image )</small>
                                            @endif
                                        </div>
                                        <div class="photo-details-right-user mt-1">
                                            <small class="text-muted"><i class="fa fa-user"></i> {{ $photoDetails->upload->user->name }}</small>
                                        </div>
                                        <div class="photo-details-right-rating mt-2">
                                            @if($image_review == 0)
                                                <small class="text-muted">No review</small>
                                            @else
                                                @for($i = 0; $i < $image_review ; $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                            @endif
                                        </div>
                                        <div class="photo-details-right-price mt-2">
                                            @if($photoDetails->price!=null)
                                                ${{number_format($photoDetails->price)}} {{--<small style="font-size: 50%">( {{$get_region->country->currency_symbol}} {{ number_format( $photoDetails->price * $get_region->rate) }} )</small>--}}
                                            @else
                                                ${{number_format($photoDetails->price = ($photoDetails->upload->collections->price))}} {{--<small style="font-size: 50%">( {{$get_region->country->currency_symbol}} {{ number_format($photoDetails->upload->collections->price * $get_region->rate) }} )</small>--}}
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="mt-3" id="login" style="display: block">
                                           <form method="post" action="{{route("checkout.login")}}">
                                               @csrf
                                               <div class="form-group">
                                                   <input class="form-control" type="email" name="email" placeholder="Email Address" required>
                                               </div>
                                               <div class="form-group">
                                                   <input class="form-control" type="password" name="password" placeholder="Password" required>
                                               </div>
                                               <div class="form-group">
                                                   <button type="submit" class="btn btn-success btn-block">Sign In to Download</button>
                                               </div>
                                               <div class="photo-details-right-rating mt-2">
                                                   <small class="text-muted">Dont have an account? <a style="color: blue" href="#"  onclick="changeRegisterationForm()">Register</a> </small>
                                               </div>
                                           </form>
                                       </div>
                                        <div class="mt-3" id="register" style="display: none">
                                           <form method="post" action="{{route("checkout.register")}}">
                                               @csrf
                                               <div class="form-group">
                                                   <input class="form-control" type="text" placeholder="Fullname" name="fullname" required>
                                               </div>
                                               <div class="form-group">
                                                   <input class="form-control" placeholder="Email Address" name="email" type="email" required>
                                               </div>
                                               <div class="form-group">
                                                   <input class="form-control" placeholder="Password" name="password" type="password" required>
                                               </div>
                                               <div class="form-group">
                                                   <input class="form-control" type="password" name="confirm_password" placeholder="Repeat Password">
                                               </div>
                                               <div class="form-group">
                                                   <button type="submit" class="btn btn-success btn-block">Register</button>
                                               </div>
                                               <div class="photo-details-right-rating mt-2">
                                                   <small class="text-muted">Already have an account? <a style="color: blue" href="#"  onclick="changeLoginForm()">Login</a> </small>
                                               </div>
                                           </form>
                                       </div>
                                        <div class="photo-details-right-license mt-3 text-muted">
                                            <div class="">
                                                <b>License</b>
                                            </div>
                                            <div>
                                                Lorem Ipsum ios a akjsno i jsn os osnpi dos
                                                Lorem Ipsum ios a akjsno i jsn os osnpi dos
                                                Lorem Ipsum ios a akjsno i jsn os osnpi dos
                                            </div>
                                        </div>
                                        <div class="photo-details-right-share mt-4">
                                            <div class="row">
                                                <div class="col-xl-12 col-sm-12 text-center"><span><small><b>Share:</b></small></span></div>
                                                <div class="col-xl-12 col-sm-12 sharethis-inline-share-buttons mr-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                 @else
                                    <div class="photo-details-right">
                                        <div class="photo-details-right-title">
                                            {{ $photoDetails->title }}
                                            @if($photoDetails->price == null)
                                                <small class="text-muted" style="text-transform: capitalize; font-size: 60%">( collection of {{count($all_photos)}} Images)</small>
                                            @else
                                                <small class="text-muted" style="text-transform: capitalize; font-size: 60%">( Single Image )</small>
                                            @endif
                                        </div>
                                        <div class="photo-details-right-user mt-1">
                                            <small class="text-muted"><i class="fa fa-user"></i> {{ $photoDetails->upload->user->name }}</small>
                                        </div>
                                        <div class="photo-details-right-rating mt-2">
                                            @if($image_review == 0)
                                                <small class="text-muted">No review</small>
                                            @else
                                                @for($i = 0; $i < $image_review ; $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                            @endif
                                        </div>
                                        <div class="photo-details-right-price mt-2">
                                            @if($photoDetails->price!=null)
                                                ${{number_format($photoDetails->price)}}
                                            @else
                                                ${{number_format($photoDetails->price = ($photoDetails->upload->collections->price))}} <small style="font-size: 50%">( {{$get_region->country->currency_symbol}} {{ number_format($photoDetails->upload->collections->price * $get_region->rate) }} )</small>
                                            @endif
                                        </div>
                                        <hr>
                                        <form id="form" method="post" action="{{route('download',['slug' => $photoDetails->image])}}">
                                            @csrf
                                            <div class="photo-details-right-size mt-2 text-muted">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="size" id="exampleRadios1" value="small" checked>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Small Size (width: 100px )
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="size" id="exampleRadios2" value="medium">
                                                        <label class="form-check-label" for="exampleRadios2">
                                                            Medium Size (width: 250px)
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="size" id="exampleRadios2" value="large">
                                                        <label class="form-check-label" for="exampleRadios2">
                                                            Original Size
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($is_paid)
                                                <div class="photo-details-right-button mt-2 mb-4">
                                                    <button type="submit" class="btn btn-success btn-block text-uppercase">
                                                        <small><i class="fa fa-download"></i> Download Photo</small>
                                                    </button>
                                                </div>
                                            @else
                                                <div class="photo-details-right-button mt-2 mb-4">
                                                    <button type="button" onclick="payWithPayant()" class="btn btn-primary btn-block text-uppercase">
                                                        <small><i class="fa fa-credit-card"></i> Make Payment</small>
                                                    </button>
                                                </div>
                                            @endif

                                        </form>
                                        <div class="photo-details-right-license mt-3 text-muted">
                                            <div class="">
                                                <b>License</b>
                                            </div>
                                            <div>
                                                Lorem Ipsum ios a akjsno i jsn os osnpi dos
                                                Lorem Ipsum ios a akjsno i jsn os osnpi dos
                                                Lorem Ipsum ios a akjsno i jsn os osnpi dos
                                            </div>
                                        </div>
                                        <div class="photo-details-right-share mt-4">
                                            <div class="row">
                                                <div class="col-xl-12 col-sm-12 text-center"><span><small><b>Share:</b></small></span></div>
                                                <div class="col-xl-12 col-sm-12 sharethis-inline-share-buttons mr-1"></div>
                                            </div>
                                        </div>
                                        <div class="photo-details-right-share mt-4">
                                            <a href="#small-dialog-2" class="popup-with-zoom-anim button ripple-effect margin-top-5 margin-bottom-10"><i class="icon-material-outline-thumb-up"></i> Leave a Review</a>
                                        </div>
                                    </div>
                                @endif

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="single-page-section">
                <h3>Search Images Using Tags</h3>
                <div class="task-tags">
                   @foreach($categories as $category)
                    <a href="{{route('browse.category',['category' => $category->keyword])}}"><span>{{$category->keyword}}</span></a>
                   @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="section-headline centered margin-top-0 margin-bottom-45">
                    <h3>Popular photos</h3>
                </div>
            </div>
            @foreach($featured_pictures as $featured_picture)
                <div class="col-xl-3 col-md-6">
                    <!-- Photo Box -->
                    <a href="{{route('all.picture',['image_name' =>$featured_picture->slug,'id' => $featured_picture->id])}}" class="photo-box small" data-background-image="{{asset('/uploads/original/'.$featured_picture->image)}}">
                        <div class="photo-box-content">
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
    <div id="small-dialog-2" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

        <!--Tabs -->
        <div class="sign-in-form">
            <ul class="popup-tabs-nav">
            </ul>
            <div class="popup-tabs-container">
                <!-- Tab -->
                <div class="popup-tab-content" id="tab2">
                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h3>Leave a Review</h3>
                        <span>Rate <a href="#">{{$photoDetails->upload->user->name}}</a> for the project </span>
                        <h3 id="success-message"  style="color:green; display: none">Photographer successfully rated</h3>
                        <h3 id="failure-message"  style="color:Red; display: none">Error rating the photographer</h3>
                    </div>

                    <!-- Form -->
                    <form method="post" id="leave-review-form">
                        <div class="feedback-yes-no">
                            <strong>Your Rating</strong>
                            <div class="leave-rating">
                                <input type="radio" name="rating" id="rating-radio-1" value="5" required>
                                <label for="rating-radio-1" class="icon-material-outline-star"></label>
                                <input type="radio" name="rating" id="rating-radio-2" value="4" required>
                                <label for="rating-radio-2" class="icon-material-outline-star"></label>
                                <input type="radio" name="rating" id="rating-radio-3" value="3" required>
                                <label for="rating-radio-3" class="icon-material-outline-star"></label>
                                <input type="radio" name="rating" id="rating-radio-4" value="2" required>
                                <label for="rating-radio-4" class="icon-material-outline-star"></label>
                                <input type="radio" name="rating" id="rating-radio-5" value="1" required>
                                <label for="rating-radio-5" class="icon-material-outline-star"></label>
                            </div><div class="clearfix"></div>
                        </div>
                        {{--  <input name="image_id" value="" type="number" hidden="hidden">--}}
                        <textarea class="with-border" placeholder="Comment" name="message2" id="message2" cols="7" required></textarea>
                    </form>
                    <button class="button full-width button-sliding-icon ripple-effect" id="review-submit" type="submit" form="leave-review-form">Leave a Review <i class="icon-material-outline-arrow-right-alt"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div id="small-dialog-3" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
        <!--Tabs -->
        <div class="sign-in-form">
            <ul class="popup-tabs-nav">
            </ul>
            <div class="popup-tabs-container"><!-- Tab -->
                <div class="popup-tab-content" id="tab2">
                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h3>Leave a Review</h3>
                        <span>Rate <a href="#">Peter Valentín</a> for the project <a href="#">Simple Chrome Extension</a> </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Spacer -->
    <div class="margin-top-15"></div>
    <!-- Spacer / End-->
    <meta name="_token" content="{{ app('Illuminate\Encryption\Encrypter')->encrypt(csrf_token()) }}" />
    <meta name="_token" content="{{ app('Illuminate\Encryption\Encrypter')->encrypt(csrf_token()) }}" />
@endsection

@section('page_scripts')
    <script type="text/javascript">
        $(document).on("ready", function () {
            var imageUrl = $("#mainImage").attr("src");
            $("#divContainer img").each(function () {
                console.log(imageUrl);
                var currentImage = $(this).attr("src");
                console.log(currentImage);
                if (currentImage === imageUrl ){
                    console.log("its here");
                    $(this).parent().hide();
                }
                else{
                    console.log("its here");
                    $(this).parent().show();
                }
            })
        })
    </script>
    <script type="text/javascript">
       $(document).on("ready", function(){
          $("#divContainer img").on({
            mouseover : function () {
                $(this).css({
                    "cursor":"pointer",
                    "border-color": "blue",
                });
            },
            mouseout: function () {
                $(this).css({
                    "cursor":"default",
                    "border-color": "white",
                });
            },
            click : function () {
                var imageUrl = $(this).attr("src");
                $("#mainImage").fadeOut(300, function(){
                   $(this).attr("src", imageUrl);
                }).fadeIn(300);
                $("#divContainer img").each(function () {
                    var currentImage = $(this).attr("src");
                    console.log(currentImage);
                    if (currentImage === imageUrl ){
                        console.log("its here");
                        $(this).parent().hide();
                    }
                    else{
                        console.log("its here");
                        $(this).parent().show();
                    }
                })
            }
          });
       });
    </script>
    <script type="text/javascript">
       function changeRegisterationForm() {
           $("#register").css("display" , "block");
           $("#login").css("display" , "none");
       }
       function changeLoginForm() {
           $("#register").css("display" , "none");
           $("#login").css("display" , "block");
       }
    </script>
    <script>
        @if(session('failure'))
        toastr.error('username or password incorrect');
        @endif
        @if(session('success'))
        toastr.success('{{session("success")}}');
        @endif
    </script>
    <script type="text/javascript">
        /*$("form#form").on("submit", function(e){
            e.preventDefault();
            console.log("its here");
        });*/
        function genericSocialShare(url){
            window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
            return true;
        }
    </script>
    @if(Auth::check())
        <script type="text/javascript">
            function payWithPayant() {
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
                            "item": "{{$photoDetails->slug}}",
                            "description": "yaami.com/make-payment",
                            "unit_cost": "{{$photoDetails->price}}",
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
                        url: "{{route('checkout.payment') }}",
                        method: 'post',
                        data: {
                            email: '{{Auth::user()->email}}',
                            image_id: "{{$photoDetails->id}}",
                            price: '{{$photoDetails->price}}',
                            reference_key: response.reference_code,
                            _token: '{!! csrf_token() !!}',
                        },
                        cache: false,

                        success: function(status){
                            if(status.status){
                                location.reload();
                            }
                            else{
                                toastr.success('Payment Could not be made.Please try again!');
                            }
                        },
                        failure: function (result) {
                            console.log(result);
                        }
                    });
                }
            }
        </script>
        <script type="text/javascript">
            $(document).on("ready",function(){
                $('form#leave-review-form').on('submit',function(e){
                    e.preventDefault();
                    console.log("its here");
                    var rating = $("input[name='rating']:checked").val();
                    var comment  = $('#message2').val();
                    var user_id = '{{$photoDetails->upload->user->id}}';
                    var image_id = '{{$photoDetails->id}}';
                    $.ajaxSetup({
                        headers: {
                            'X-XSRF-Token': $('meta[name="_token"]').attr('content')
                        }
                    });
                    var data =  {
                        rating : rating,
                        comment: comment,
                        user_id: user_id,
                        image_id: image_id,
                        _token: '{!! csrf_token() !!}',
                    }
                    $.ajax({
                        url: "{{route('user.rate') }}",
                        method: 'POST',
                        contentType:"application/json",
                        dataType: "json",
                        data: JSON.stringify(data),
                        cache: false,
                        success: function(status){
                            console.log(status.status);
                            if(status.status == "true"){
                                $("#success-message").css("display" , "block");
                                setTimeout(function () {
                                    location.reload();
                                },720);
                            }
                            else{
                                $("#failure-message").css("display" , "block");
                                setTimeout(function () {
                                    location.reload();
                                },720);
                            }

                        },
                        failure: function (result) {
                            console.log(result);
                        }
                    });
                });
            });
        </script>
    @endif
@endsection

