<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>


    <link href="{{ asset('bower_components/uikit/css/uikit.almost-flat.css') }}" rel="stylesheet">




    <link href="{{ asset('bower_components/animate.css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="uk-container uk-container-center">
    <nav class="uk-navbar">
        <a href="" class="uk-navbar-brand">Simple-Shop v 0.1</a>
        <ul class="uk-navbar-nav">
            <li><a href="" >Главная</a></li>
            <li><a href="" >Пользователи</a></li>
            <li><a href="" >Магазин</a></li>
        </ul>
    </nav>
</div>

<div class="uk-container uk-container-center">
   <div class="main-content">
       @yield('content')
   </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('bower_components/vue/dist/vue.js') }}"></script>
<script src="{{ asset('bower_components/vue-resource/dist/vue-resource.js') }}"></script>
<script src="{{ asset('js/backend/app.js') }}"></script>
</body>
</html>
