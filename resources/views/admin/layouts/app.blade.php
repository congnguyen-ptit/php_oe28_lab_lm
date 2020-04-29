<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <base href="{{ asset('') }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_package/bower_components/bootstrap/dist/css/bootstrap.min.css ')}}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_package/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_package/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_package/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_package/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_package/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bower_package/css/abc.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_package/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_package/bower_components/datatables.net-bs/css/dataTables.boostrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_package/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bower_package/css/main.min.css') }}">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="image/x-icon"/>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('admin.layouts.header')
        @include('admin.layouts.aside')
        @yield('content')
        <div class="control-sidebar-bg"></div>
    </div>
    <script src="{{ asset('bower_components/bower_package/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/bower_components/chart.js/Chart.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/dist/js/pages/dashboard2.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/dist/js/demo.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/js/abc.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/js/tables.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/js/crud.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/bower_components/datatables.net/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
</body>
</html>
