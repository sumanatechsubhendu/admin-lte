<!-- Common head elements (meta tags, stylesheets, etc.) -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AdminLTE 3 | Log in</title>
<!-- Include your stylesheets -->
{{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
<!-- Scripts -->
 <!-- Scripts -->
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Add this line to include AdminLTE CSS -->
<link rel="stylesheet" href="{{ asset('admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin-lte/dist/css/adminlte.min.css') }}">

 @routes
 @vite('resources/js/app.js')
 @inertiaHead
<!-- Include additional stylesheets if needed -->
