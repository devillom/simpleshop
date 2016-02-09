<html>
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <base href="{{url('/')}}" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <title></title>
        {!! Minify::stylesheet([
            '/bower_components/semantic/dist/semantic.css',
            '/css/backend.css'
        ]) !!}
    </head>
    <body>
        @include('backend.layouts.menu')

        <div class="ui container">
            @yield('content')
        </div>

        {!! Minify::javascript([
            '/bower_components/jquery/dist/jquery.js',
            '/bower_components/semantic/dist/semantic.js',
            '/bower_components/vue/dist/vue.min.js',
            '/bower_components/vue-resource/dist/vue-resource.js',
            '/js/backend/app.js',
        ]) !!}
    </body>
</html>