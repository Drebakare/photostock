@extends('layouts.dashboard_app')

@section("page_styles")
    <link rel="stylesheet" href="{{ asset("css/photo_upload.css") }}">
@endsection

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
                <form method="post" action="{{route('edit_upload_pictures', ['id' =>$pictures[0]->upload_id] )}}" enctype="multipart/form-data" id="upload_photos">
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
                        <div class="alert alert-info">
                            <i class="icon-feather-folder-plus"></i> You are to upload 5 Photos in which 3 photos must be uploaded as free
                        </div>

                        <ul class="nav nav-tabs nav-fill upload_tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-target="tabs1"><b>First</b></a></li>
                            <li class="nav-item"><a class="nav-link " data-target="tabs2"><b>Second</b></a></li>
                            <li class="nav-item"><a class="nav-link " data-target="tabs3"><b>Third</b></a></li>
                            <li class="nav-item"><a class="nav-link " data-target="tabs4"><b>Fourth</b></a></li>
                            <li class="nav-item"><a class="nav-link " data-target="tabs5"><b>Fifth</b></a></li>
                        </ul>

                        <div class="dashboard-box margin-top-0">
                            <div class="tab-content">
                                    {{$i = 1}}
                                @foreach($pictures as $key => $picture)
                                       <div class="container  upload_tabs_content" id="tabs{{$i}}">
                                           <div class="content with-padding padding-bottom-10">
                                               <div class="row">

                                                   <div class="col-xl-4">
                                                       <div class="submit-field">
                                                           <div class="uploadButton margin-top-30">
                                                               <div class="thumbnail">
                                                                   <img src="{{'/storage/uploads/original/'.$picture->image}}" style="width: 50px; height: 50px;" class="img-thumbnail" alt="Cinque Terre">
                                                               </div>
                                                               <input class=" {{'uploadButton-input'.$i}}" value="{{'/storage/uploads/original/'.$picture->image}}" type="file"  accept="image/*" name="{{'image'.$i}}" id="{{'upload'.$i}}"/>
                                                               <label class="uploadButton-button ripple-effect" value="{{'/storage/uploads/original/'.$picture->image}}"  for="{{'upload'.$i}}">Select Image</label>
                                                               <small value="{{'/storage/uploads/original/'.$picture->image}}"  class="{{'uploadButton-file-name'.$i}}"></small>
                                                                <input value="{{$picture->id}}" name="{{"picture_id".$i}}" type="number" hidden/>
                                                           </div>
                                                       </div>
                                                   </div>

                                                   <div class="col-xl-4">
                                                       <div class="submit-field">
                                                           <h5>Image Title</h5>
                                                           <div class="input-with-icon">
                                                               <input value="{{$picture->title}}" class="with-border" name="{{'description'.$i}}" type="text" placeholder="Image title">
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="col-xl-4">
                                                       <div class="submit-field">
                                                           <h5>Photo type:</h5>
                                                           <select class="selectpicker with-border" value="{{$picture->type}}" name="{{'type'.$i}}" title="Select Photo Type">
                                                               <option value="1"  @if($picture->type ==1) selected @endif >Basic</option>
                                                               <option value="2"  @if($picture->type ==2) selected @endif >Enhanced</option>
                                                               <option value="3"  @if($picture->type ==3) selected @endif >Premium</option>
                                                           </select>
                                                       </div>
                                                   </div>
                                                   <div class="col-xl-4">
                                                       <div class="submit-field">
                                                           <h5>Photo Category</h5>
                                                           <select class="selectpicker with-border" name="{{'category'.$i}}" title="Select Category">
                                                               @foreach($categories as $category)
                                                                   <option value="{{$category->id}}" @if($picture->category_id == $category->id) selected @endif>{{ ucfirst($category->title) }}</option>
                                                               @endforeach
                                                           </select>
                                                       </div>
                                                   </div>

                                                   <div class="col-xl-4">
                                                       <div class="submit-field">
                                                           <h5>Feature Photo?:</h5>
                                                           <select class="selectpicker with-border" name="{{'feature'.$i}}" title="">
                                                               <option value="1" @if($picture->featured ==1) selected @endif >Yes</option>
                                                               <option value="0" @if($picture->featured ==0) selected @endif >No</option>
                                                           </select>
                                                       </div>
                                                   </div>

                                                   <div class="col-xl-4">
                                                       <div class="submit-field">
                                                           <h5>Price</h5>
                                                           <div class="input-with-icon">
                                                               <input class="with-border" value="{{$picture->price}}" name="{{'price'.$i}}" type="text" placeholder="Price" disabled>
                                                               <i class="currency">NGR</i>
                                                           </div>
                                                       </div>
                                                   </div>

                                                   <div class="col-xl-4">
                                                       <div class="submit-field">
                                                           <h5>Tags   <i class="help-icon" data-tippy-placement="right" title="Maximum of 10 tags"></i></h5>
                                                           <div class="keywords-container">
                                                               <div class="keyword-input-container">
                                                                   <input type="text" value="{{$picture->tags }}"  name="{{'tag'.$i}}" class="keyword-input with-border" placeholder="e.g. job title, responsibilites"/>
                                                                   <button type="button" class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></button>
                                                               </div>
                                                               <div class="keywords-list" data-uploadformindex="{{$i}}"><!-- keywords go here --></div>
                                                               <div class="clearfix"></div>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                    {{$i=$i+1}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <button type="button" class="button dark ripple-effect margin-top-30 upload_previous_button"><i class="icon-feather-arrow-left"></i> Previous</button>
                        <button type="button" class="button ripple-effect margin-top-30 float-right upload_next_button">Next <i class="icon-feather-arrow-right"></i></button>
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
    <script src="{{asset('_landing/js/photo_upload.js')}}"></script>
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
    <script type="text/javascript">



    </script>
@endsection
