@extends('Admin.layouts.app')
@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">

                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class=" breadcrumb breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="index.html"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Category</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <div class="pcoded-inner-content">
            <!-- Main-body start -->
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Add rows table start -->

                                <!-- Add rows table end -->
                                <!-- Individual Column Searching (Text Inputs) start -->

                                <!-- Individual Column Searching (Text Inputs) end -->
                                <!-- Individual Column Searching (Select Inputs) start -->
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Add category</h4>
                                    <form method="get" action="{{route('category.add')}}">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-round" name="category" placeholder="Type category name" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-round waves-effect waves-light">Add Category</button>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="card-header">
                                        <h5>All Category </h5>
                                        <span>This example is almost identical to text based individual column example and provides the same functionality, but in this case using select input controls. After the table is initialised, the API is used to build the select inputs through the use of the column().data() method to get the data for each column in turn. The helper methods unique() and sort() are also used to reduce the data for set input to unique and ordered elements. Finally the change event from the select input is used to trigger a column search using the column().search() method.</span>
                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table class="table basic-table table-bordered table-hover">
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
                                                <thead>
                                                    <tr>
                                                        <td>id</td>
                                                        <td>Title</td>
                                                        <td>Action</td>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach($all_categories as $all_category)
                                                        <tr>
                                                            <td>{{$all_category->id}}</td>
                                                            <td>{{$all_category->title}}</td>
                                                            <td>
                                                                <a href="{{route('admin.action.delete-category', ["id" => $all_category->title])}}"> <button class="btn btn-danger btn-round waves-effect waves-light">Delete</button></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>


                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="styleSelector">

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            $('.table').DataTable();
        } );
    </script>
@endsection



