<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','ADT-MART здесь продается все')</title>
    {{--<link rel="apple-touch-icon" href="apple-touch-icon.png">--}}
    <!-- Place favicon.ico in the root directory -->
    <link href="{{ asset('bower_components/animate.css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">
    @yield('head')
</head>

<body>

@include('frontend.layouts.partials.header')
@yield('content-top')
<div class="main">
    <div class="container">
        @yield('content')
    </div>
</div>
@include('frontend.layouts.partials.footer')

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/frontend/app.js') }}"></script>
@yield('scripts')
</body>

</html>
