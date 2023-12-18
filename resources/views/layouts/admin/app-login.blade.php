<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Include your common head elements (meta tags, stylesheets, etc.) -->
    @include('layouts.admin.partials.head')
</head>
{{-- <body class="{{ auth()->check() ? 'hold-transition sidebar-mini layout-fixed' : 'hold-transition login-page' }}"> --}}
    <body class="hold-transition sidebar-mini layout-fixed">
    <!-- Content specific to login page -->
    @inertia
    <!-- Include your common scripts (JavaScript, etc.) -->
    @include('layouts.admin.partials.scripts')
</body>
</html>
