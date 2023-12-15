<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Include your common head elements (meta tags, stylesheets, etc.) -->
    @include('layouts.admin.partials.head')
</head>
<body class="hold-transition login-page">
    <!-- Content specific to login page -->
    @inertia
    <!-- Include your common scripts (JavaScript, etc.) -->
    @include('layouts.admin.partials.scripts')
</body>
</html>
