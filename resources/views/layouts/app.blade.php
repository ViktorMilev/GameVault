<!DOCTYPE html>
<html lang="bg">
<head>
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('build/images/favicon/favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('layoutComponents.header')
    @include('layoutComponents.navbar')
    @yield('body')
    @include('layoutComponents.footer')
</body>