@extends('admin.layout.layout')

{{--@dd($menus)--}}
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <style>

        ul
        {
            list-style-type: none;
        }

        ul li a
        {
            color: #b3b3b3!important;
        }


        .toggle-btn {
            cursor: pointer;
            font-weight: bold;
            color: blue;
            margin-left: 5px;
        }

        .submenu {
            display: none;
            background-color: #f8f9fa;
            padding-left: 20px;
        }

        .submenu li {
            padding: 8px;
            list-style-type: none;
        }


        .menu-item {
            cursor: pointer;
        }

        .menu-item:hover {
            background-color: #f1f1f1;
        }
    </style>


    <div class="row">
        <div class="col-lg-2"><a href="{{ route('course_group.create') }}" class="btn btn-success">افزودن</a></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"></div>
    </div>

    <hr class="my-3">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        <hr class="my-3">
    @endif



    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
        <hr class="my-3">
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> لیست گروه بندی دوره ها
                </div>
                <div class="card-body">

                    <ul class="list-group">
                        @foreach($course_groups as $cg)
                            @include('admin.course_group.coursegroup-tree', ['cg' => $cg, 'level' => 0])
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>

    </div>


@endsection




@section('custom-js')


@endsection

