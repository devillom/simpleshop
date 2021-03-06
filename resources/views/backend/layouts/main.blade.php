<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{csrf_token()}}">
    <base href="{{url('/')}}" />
    <title>@yield('title')</title>

    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,400italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href="{{ asset('bower_components/uikit/css/uikit.gradient.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/uikit/css/components/nestable.gradient.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/uikit/css/components/form-file.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/uikit/css/components/placeholder.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/uikit/css/components/progress.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/uikit/css/components/upload.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/toastr/toastr.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/chosen/chosen.min.css') }}" rel="stylesheet">

    <link href="{{ asset('bower_components/animate.css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="tm-navbar uk-navbar uk-navbar-attached">
    <div class="uk-container uk-container-center">
        <a href="" class="uk-navbar-brand">
            <img src="{{ asset('images/logo_mobile.png') }}" alt="">
        </a>
        <ul class="uk-navbar-nav">
            <li @if(Route::getCurrentRoute()->getName()=='manager.index') class="active" @endif>
                <a href="{{route('manager.index')}}" >Главная</a>
            </li>
            <li @if(Route::getCurrentRoute()->getName()=='manager.user.index') class="active" @endif>
                <a href="{{route('manager.user.index')}}" >Пользователи</a>
            </li>
            <li class="uk-parent @if(strpos(Route::getCurrentRoute()->getName(),'manager.shop') !== false) active @endif" data-uk-dropdown ><a  >Магазин</a>
                <div class="uk-dropdown uk-dropdown-navbar">
                    <ul class="uk-nav uk-nav-navbar">
                        <li @if(Route::getCurrentRoute()->getName()=='manager.shop.category.index') class="active" @endif>
                            <a href="{{route('manager.shop.category.index')}}">Категории</a>
                        </li>
                        <li @if(Route::getCurrentRoute()->getName()=='manager.shop.product.index') class="active" @endif>
                            <a href="{{route('manager.shop.product.index')}}">Товары</a>
                        </li>
                        <li @if(Route::getCurrentRoute()->getName()=='manager.shop.field.index') class="active" @endif>
                            <a href="{{route('manager.shop.field.index')}}">Параметры категории</a>
                        </li>
                        <li @if(Route::getCurrentRoute()->getName()=='manager.shop.setting.index') class="active" @endif>
                            <a href="{{route('manager.shop.setting.index')}}">Настройки</a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</nav>

<div class="breadcrumbs-wrapper">
    <div class="uk-container uk-container-center">
        {!! Breadcrumbs::render() !!}
    </div>
</div>
<div class="uk-container uk-container-center">
    <div class="main-content">


        @include('backend.messages')
        @yield('content')
    </div>
</div>

<div class="footer">
    <div class="uk-container uk-container-center">
        <div class="uk-text-center">  <img src="{{ asset('images/logo.png') }}" alt=""> <br> v. 0.1</div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('bower_components/vue/dist/vue.js') }}"></script>
<script src="{{ asset('bower_components/uikit/js/uikit.js') }}"></script>
<script src="{{ asset('bower_components/uikit/js/components/nestable.js') }}"></script>
<script src="{{ asset('bower_components/uikit/js/components/upload.js') }}"></script>
<script src="{{ asset('bower_components/toastr/toastr.js') }}"></script>
<script src="{{ asset('bower_components/chosen/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/vue-resource/dist/vue-resource.js') }}"></script>
<script src="{{ asset('js/backend/app.js') }}"></script>
@yield('scripts')
</body>
</html>
