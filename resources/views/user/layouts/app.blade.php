<!DOCTYPE html>
<html lang="en-US">
<head>
    <base href="{{ asset('') }}">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">
    <title>@yield('title')</title>
    <link href="bower_components/bower_package/images/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="{{ asset('bower_components/bower_package/font/abc.woff') }}" />
    <link href="{{ asset('bower_components/bower_package/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/bower_package/css/mmenu.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/bower_package/css/mmenu.positioning.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/bower_package/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bower_components/bower_package/css/cate.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    @include('user.layouts.header')
    @yield('content')
    @yield('slide')
    @yield('searchfilter')
    @yield('welcome')
    @yield('categoryfilter')
    @include('user.layouts.social')
    @include('user.layouts.footer')
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/jquery-1.12.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/jquery.easing.1.3.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/mmenu.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/harvey.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/waypoints.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/facts.counter.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/mixitup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/accordion.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/responsive.tabs.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/responsive.table.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/masonry.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/carousel.swipe.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/bxslider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bower_package/js/main.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/js/tables.js') }}"></script>
    <script src="{{ asset('bower_components/bower_package/js/sweetalert.js') }}"></script>
</body>
</html>
