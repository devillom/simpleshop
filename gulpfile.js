var elixir = require('laravel-elixir');

elixir.config.sourcemaps = false;


elixir(function(mix) {

    mix.sass('backend/backend.scss', 'public/css/backend.css')
       .sass('frontend/frontend.scss', 'public/css/frontend.css')
       .sass('all.scss', 'public/css/base.css');

    mix.scriptsIn('resources/assets/js/backend', 'public/js/backend/app.js')
        .scriptsIn('resources/assets/js/frontend','public/js/frontend/app.js');


});
