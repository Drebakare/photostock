@extends('layouts.dashboard_app')
@section('content')
    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner" >

            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>Upload photos</h3>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li>Upload Photos</li>
                    </ul>
                </nav>
            </div>

            <!-- Row -->
            <div class="row">
                <form method="post" action="{{route('upload_collection_pictures')}}" enctype="multipart/form-data" id="upload_photos">
                @csrf
                <!-- Dashboard Box -->
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
                    <div class="col-xl-12">
                        <div class="dashboard-box margin-top-0">

                            <!-- Headline -->
                            <div class="alert alert-info">
                                <i class="icon-feather-folder-plus"></i> Upload multiple pictures as a collection
                            </div>
                            @for($i = 1 ; $i<2; $i++)
                                <div class="content with-padding padding-bottom-10">
                                    <div class="row">

                                        <div class="col-xl-4">
                                            <div class="submit-field">
                                                <div class="uploadButton margin-top-30">
                                                    <input class=" {{'uploadButton-input'.$i}}" type="file"  accept="image/*" name="{{'image'.$i}}[]" id="{{'upload'.$i}}" multiple/>
                                                    <label class="uploadButton-button ripple-effect" for="{{'upload'.$i}}">Upload Image</label>
                                                    <span class="{{'uploadButton-file-name'.$i}}">Upload Photo here</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="submit-field">
                                                <h5>Image Title</h5>
                                                <div class="input-with-icon">
                                                    <input class="with-border" name="{{'description'.$i}}" type="text" placeholder="Image title">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="submit-field">
                                                <h5>Photo type:</h5>
                                                <select class="selectpicker with-border" name="{{'type'.$i}}" title="Select Photo Type">
                                                    <option value="1">Basic</option>
                                                    <option value="2">Enhanced</option>
                                                    {{--<option value="3">Premium</option>--}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="submit-field">
                                                <h5>Photo Category</h5>
                                                <select class="selectpicker with-border" name="{{'category'.$i}}" title="Select Category">
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{ ucfirst($category->title) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                      {{--  <div class="col-xl-4">
                                            <div class="submit-field">
                                                <h5>Feature Photo?:</h5>
                                                <select class="selectpicker with-border" name="{{'feature'.$i}}" title="">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>--}}
                                        <div class="col-xl-4">
                                            <div class="submit-field">
                                                <h5>Price</h5>
                                                <div class="input-with-icon">
                                                    <input class="with-border"  type="text" placeholder="{{number_format($latest_price->price)}}" disabled>
                                                    <i class="currency">NGR</i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="submit-field">
                                                <h5>Tags   <i class="help-icon" data-tippy-placement="right" title="Maximum of 10 tags"></i></h5>
                                                <div class="keywords-container">
                                                    <div class="keyword-input-container">
                                                        <input type="text"  name="{{'tag'.$i}}" class="keyword-input with-border" placeholder="e.g. job title, responsibilites"/>
                                                        <button type="button" class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></button>
                                                    </div>
                                                    <div class="keywords-list" data-uploadformindex="{{$i}}"><!-- keywords go here --></div>
                                                    <div class="clearfix"></div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="headline">
                                    <h3></h3>
                                </div>
                            @endfor


                        </div>
                    </div>

                    <div class="col-xl-12">
                        <button type="submit" class="button ripple-effect big margin-top-30"><i class="icon-feather-plus"></i> Upload Pictures</button>
                    </div>
                </form>

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
@endsection

@section("page_scripts")
    <script type="text/javascript">
        const keyword_input_fields = $("input.keyword-input");
        keyword_input_fields.on("keydown", function (event) {
            if(event.which === 13)
                event.preventDefault();
        });

        $('#upload_photos').on('submit', function(){
            var keywords_list = $(".keywords-list");

            $.each(keywords_list, function(){
                var upload_form_index = $(this).data("uploadformindex");
                var keyword_list_tags_span = $("span.keyword-text");
                var keyword_list_tags = "";

                keyword_list_tags_span.each(function () {
                    keyword_list_tags += $(this).text() + ",";
                });

                $("input[name=tag"+upload_form_index+"]").val(keyword_list_tags);
            });
        })
    </script>
@endsection
