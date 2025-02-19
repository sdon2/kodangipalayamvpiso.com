<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="{{ $description ?? null }}">
    <meta name="keywords" content="{{ $keywords ?? null }}">
    <meta name="author" content="Saravanakumar Arumugam <saravanakumar.a.o@gmail.com>">
        <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __(config('app.name')) }} &raquo; @yield('title')</title>
    <!-- START: Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Stroke 7 -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/metisMenu/metisMenu.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slickNav/slicknav.min.css') }}" type="text/css">
    <!-- Custom -->
    <link rel="stylesheet" href="{{ asset(mix('assets/css/style.css')) }}">
    <!-- END: Styles -->
    <!-- jQuery -->
    <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ticker.min.css') }}" />

    @stack('styles')

</head>

<body>

    <x-navbar />

    <x-scroll-text />

    <x-featured-image />

    @stack('content')

    <x-footer />

    <!-- START: Scripts -->
    <!-- Bootstrap -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Custom -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @stack('scripts')

    <!-- END: Scripts -->

</body>

</html>
