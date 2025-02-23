<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.0-alpha.6
 * @link http://coreui.io
 * Copyright (c) 2017 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
<!DOCTYPE html>
<html lang="fa"  dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,Angular 2,Angular4,Angular 4,jQuery,CSS,HTML,RWD,Dashboard,React,React.js,Vue,Vue.js">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <title>پنل مدیریت</title>

    <!-- Icons -->
    <link href=" {{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href=" {{ asset('assets/css/simple-line-icons.css') }}" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href=" {{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href=" {{ asset('bootstrap-5.0.2/dist/css/bootstrap.css') }}" rel="stylesheet">
    <link href=" {{ asset('WebFonts/css/style.css') }}" rel="stylesheet">
    <link href=" {{ asset('WebFonts/css/fontiran.css') }}" rel="stylesheet">
    <link href=" {{ asset('bootstrap/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href=" {{ asset('custom/style.css') }}" rel="stylesheet">
    <link href=" {{ asset('bootstrap-fonts/bootstrap-icons.css') }}" rel="stylesheet">



    <link rel="stylesheet" href="{{ asset('jalalidatepicker/jalalidatepicker.css') }}">
</head>


<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">

    @include('admin.layout.header')

<div class="app-body">

    @include('admin.layout.sidebar')

    <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">میزکار</li>

            <li class="breadcrumb-item active">میزکار</li>

            <!-- Breadcrumb Menu-->
{{--            <li class="breadcrumb-menu d-md-down-none">
                <div class="btn-group" role="group" aria-label="Button group">
                    <a class="btn" href="#"><i class="icon-speech"></i></a>
                    <a class="btn" href="./"><i class="icon-graph"></i> &nbsp;میزکار</a>
                    <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;تنظیمات</a>
                </div>
            </li>--}}
        </ol>


        <div class="container-fluid">

            @yield('content')
            {{--@include('admin.dashboard')--}}


        </div>
        <!-- /.conainer-fluid -->
    </main>



    @include('admin.layout.aside')
</div>

    @include('admin.layout.footer')

<!-- Bootstrap and necessary plugins -->
<script src="{{ asset('assets/js/jquery-3.7.1.js') }} "></script>
<script src="{{ asset('jalalidatepicker/jalalidatepicker.min.js') }}"></script>
<script src="{{ asset('CK-editor/ckeditor.js') }}"></script>

<script src="{{ asset('custom/script.js') }} "></script>

<script src="{{ asset('bootstrap-5.0.2/dist/js/popper.min.js') }}"></script>
<script src="{{ asset('bootstrap-5.0.2/dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/views/pace.min.js') }}"></script>


<!-- Plugins and scripts required by all views -->
<script src=" {{ asset('assets/js/views/charts.js') }}"></script>
<script src=" {{ asset('assets/js/views/chart.min.js') }}"></script>

<!-- GenesisUI main scripts -->

<script src="{{ asset('assets/js/app.js') }}"></script>





<!-- Plugins and scripts required by this views -->

<!-- Custom scripts required by this view -->
<script src="{{ asset('assets/js/views/main.js') }}"></script>

<script src="{{ asset('bootstrap-datatables/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('bootstrap-datatables/js/dataTables.min.js') }}"></script>


</body>

</html>
