@extends('layouts.app')

@section('content')
    <div class="main-wrapper">

        <div class="breadcrumb-wrapper">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 col-sm-6">
                        <h2 class="page-title">Upload Images</h2>
                    </div>

                    <div class="col-xs-12 col-sm-6">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Page</a></li>
                            <li class="active">Upload Images</li>
                        </ol>
                    </div>

                </div>

            </div>

        </div>

        <div class="content-wrapper">

            <div class="container">

                <div class="section-sm">

                    <div class="row">

                        <div class="col-xs-12 col-sm-4 col-md-3">
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-9">

                            <div class="section-title mb-10">
                                <h4 class="text-left">Upload Photos</h4>
                            </div>

                            <p>You are to upload five photos out of which admin will select 3 free ones</p>



                            <div class="uploaded-item-wrapper">
                                <form method="post" action="{{url('/uploadpictures/'.Auth::user()->id)}}" enctype="multipart/form-data">
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
                                    <div class="uploaded-item clearfix">
                                        <div class="image">

                                            <div class="form-group">
                                                <input type="file" name="image1" id="input01">
                                            </div>

                                        </div>


                                        <div class="content">

                                            <div class="row">

                                                <div class="col-sm-6">

                                                    <label for="sel1">Select Photo type:</label>
                                                    <select class="form-control" name="type1">
                                                        <option value="1">Basic</option>
                                                        <option value="2">Enhanced</option>
                                                        <option value="3">Premium</option>
                                                    </select>

                                                </div>
                                                <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label>Tag:</label>
                                                        <input type="text" name="tag1" class="form-control" />
                                                    </div>

                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Description:</label>
                                                        <textarea name="description1" class="form-control" rows="1"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label>Price:</label>
                                                        <input type="text" name="price1" class="form-control" />
                                                    </div>

                                                </div>



                                                <div class="col-sm-6">

                                                    <label for="sel1">Feature Photo?:</label>
                                                    <select class="form-control" name="feature1">
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>

                                                    </select>

                                                </div>
                                                <div class="col-sm-6">

                                                    <label for="sel1">Select Category:</label>
                                                    <select class="form-control" name="category1">
                                                        <option value="1">car</option>
                                                        <option value="2">building</option>
                                                        <option value="3">nature</option>
                                                        <option value="4">Love</option>
                                                        <option value="5">mobile</option>
                                                        <option value="6">travel</option>
                                                        <option value="7">bike</option>
                                                        <option value="8">computer</option>
                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="uploaded-item clearfix">
                                        <div class="image">

                                            <div class="form-group">
                                                <input type="file" name="image2" id="input02">
                                            </div>

                                        </div>


                                        <div class="content">

                                            <div class="row">

                                                <div class="col-sm-6">

                                                    <label for="sel1">Select Photo type:</label>
                                                    <select class="form-control" name="type2">
                                                        <option value="1">Basic</option>
                                                        <option value="2">Enhanced</option>
                                                        <option value="3">Premium</option>
                                                    </select>

                                                </div>
                                                <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label>Tag:</label>
                                                        <input type="text" name="tag2" class="form-control" />
                                                    </div>

                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Description:</label>
                                                        <textarea name="description2" class="form-control" rows="1"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label>Price:</label>
                                                        <input type="text" name="price2" class="form-control" />
                                                    </div>

                                                </div>



                                                <div class="col-sm-6">

                                                    <label for="sel1">Feature Photo?:</label>
                                                    <select class="form-control" name="feature2">
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>

                                                    </select>

                                                </div>
                                                <div class="col-sm-6">

                                                    <label for="sel1">Select Category:</label>
                                                    <select class="form-control" name="category2">
                                                        <option value="1">car</option>
                                                        <option value="2">building</option>
                                                        <option value="3">nature</option>
                                                        <option value="4">Love</option>
                                                        <option value="5">mobile</option>
                                                        <option value="6">travel</option>
                                                        <option value="7">bike</option>
                                                        <option value="8">computer</option>
                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="uploaded-item clearfix">
                                        <div class="image">

                                            <div class="form-group">
                                                <input type="file" name="image3" id="input03">
                                            </div>

                                        </div>


                                        <div class="content">

                                            <div class="row">

                                                <div class="col-sm-6">

                                                    <label for="sel1">Select Photo type:</label>
                                                    <select class="form-control" name="type3">
                                                        <option value="1">Basic</option>
                                                        <option value="2">Enhanced</option>
                                                        <option value="3">Premium</option>
                                                    </select>

                                                </div>
                                                <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label>Tag:</label>
                                                        <input type="text" name="tag3" class="form-control" />
                                                    </div>

                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Description:</label>
                                                        <textarea name="description3" class="form-control" rows="1"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label>Price:</label>
                                                        <input type="text" name="price3" class="form-control" />
                                                    </div>

                                                </div>



                                                <div class="col-sm-6">

                                                    <label for="sel1">Feature Photo?:</label>
                                                    <select class="form-control" name="feature3">
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>

                                                    </select>

                                                </div>
                                                <div class="col-sm-6">

                                                    <label for="sel1">Select Category:</label>
                                                    <select class="form-control" name="category3">
                                                        <option value="1">car</option>
                                                        <option value="2">building</option>
                                                        <option value="3">nature</option>
                                                        <option value="4">Love</option>
                                                        <option value="5">mobile</option>
                                                        <option value="6">travel</option>
                                                        <option value="7">bike</option>
                                                        <option value="8">computer</option>
                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="uploaded-item clearfix">
                                        <div class="image">

                                            <div class="form-group">
                                                <input type="file" name="image4" id="input04">
                                            </div>

                                        </div>


                                        <div class="content">

                                            <div class="row">

                                                <div class="col-sm-6">

                                                    <label for="sel1">Select Photo type:</label>
                                                    <select class="form-control" name="type4">
                                                        <option value="1">Basic</option>
                                                        <option value="2">Enhanced</option>
                                                        <option value="3">Premium</option>
                                                    </select>

                                                </div>
                                                <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label>Tag:</label>
                                                        <input type="text" name="tag4" class="form-control" />
                                                    </div>

                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Description:</label>
                                                        <textarea name="description4" class="form-control" rows="1"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label>Price:</label>
                                                        <input type="text" name="price4" class="form-control" />
                                                    </div>

                                                </div>



                                                <div class="col-sm-6">

                                                    <label for="sel1">Feature Photo?:</label>
                                                    <select class="form-control" name="feature4">
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>

                                                    </select>

                                                </div>
                                                <div class="col-sm-6">

                                                    <label for="sel1">Select Category:</label>
                                                    <select class="form-control" name="category4">
                                                        <option value="1">car</option>
                                                        <option value="2">building</option>
                                                        <option value="3">nature</option>
                                                        <option value="4">Love</option>
                                                        <option value="5">mobile</option>
                                                        <option value="6">travel</option>
                                                        <option value="7">bike</option>
                                                        <option value="8">computer</option>
                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="uploaded-item clearfix">
                                        <div class="image">

                                            <div class="form-group">
                                                <input type="file" name="image5" id="input05">
                                            </div>

                                        </div>


                                        <div class="content">

                                            <div class="row">

                                                <div class="col-sm-6">

                                                    <label for="sel1">Select Photo type:</label>
                                                    <select class="form-control" name="type5">
                                                        <option value="1">Basic</option>
                                                        <option value="2">Enhanced</option>
                                                        <option value="3">Premium</option>
                                                    </select>

                                                </div>
                                                <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label>Tag:</label>
                                                        <input type="text" name="tag5" class="form-control" />
                                                    </div>

                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Description:</label>
                                                        <textarea name="description5" class="form-control" rows="1"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label>Price:</label>
                                                        <input type="text" name="price5" class="form-control" />
                                                    </div>

                                                </div>



                                                <div class="col-sm-6">

                                                    <label for="sel1">Feature Photo?:</label>
                                                    <select class="form-control" name="feature5">
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>

                                                    </select>

                                                </div>
                                                <div class="col-sm-6">

                                                    <label for="sel1">Select Category:</label>
                                                    <select class="form-control" name="category5">
                                                        <option value="1">car</option>
                                                        <option value="2">building</option>
                                                        <option value="3">nature</option>
                                                        <option value="4">Love</option>
                                                        <option value="5">mobile</option>
                                                        <option value="6">travel</option>
                                                        <option value="7">bike</option>
                                                        <option value="8">computer</option>
                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <br>
                                        <div class="col-sm-12">

                                            <button class="btn btn-success btn-sm">Submit</button>


                                        </div>


                                </form>


                            </div>

                            <div class="clear mb-50"></div>

                            <div class="section-title mb-10">
                                <h4 class="text-left">Photo with the following taggings are most wanted</h4>
                            </div>

                            <div class="tagging-cloud clearfix">

                                <a href="#">car</a>
                                <a href="#">building</a>
                                <a href="#">nature</a>
                                <a href="#">love</a>
                                <a href="#">mobile</a>
                                <a href="#">travel</a>
                                <a href="#">bike</a>
                                <a href="#">computer</a>
                                <a href="#">car</a>
                                <a href="#">building</a>
                                <a href="#">building</a>
                                <a href="#">nature</a>
                                <a href="#">love</a>
                                <a href="#">mobile</a>
                                <a href="#">travel</a>
                                <a href="#">bike</a>
                                <a href="#">computer</a>
                                <a href="#">car</a>
                                <a href="#">building</a>
                                <a href="#">nature</a>
                                <a href="#">nature</a>
                                <a href="#">love</a>
                                <a href="#">mobile</a>
                                <a href="#">travel</a>
                                <a href="#">bike</a>
                                <a href="#">computer</a>
                                <a href="#">car</a>
                                <a href="#">building</a>
                                <a href="#">nature</a>
                                <a href="#">love</a>
                                <a href="#">mobile</a>
                                <a href="#">travel</a>
                                <a href="#">bike</a>
                                <a href="#">computer</a>
                                <a href="#">car</a>
                                <a href="#">building</a>
                                <a href="#">nature</a>
                                <a href="#">love</a>
                                <a href="#">mobile</a>
                                <a href="#">travel</a>
                                <a href="#">bike</a>
                                <a href="#">computer</a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!-- end Main Wrapper -->



@endsection
