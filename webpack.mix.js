const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .css('resources/css/app.css', 'public/css')
   .copy('node_modules/jquery/dist/jquery.min.js', 'public/js')
   .copy('node_modules/admin-lte/plugins/jquery/jquery.min.js', 'public/js')
   .copy('node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js', 'public/js')
   .copy('node_modules/admin-lte/plugins/fontawesome-free/css/all.min.css', 'public/css')
   .copy('node_modules/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css', 'public/css')
   .copy('node_modules/admin-lte/dist/js/adminlte.min.js', 'public/js')
   .copy('node_modules/admin-lte/dist/css/adminlte.min.css', 'public/css');

