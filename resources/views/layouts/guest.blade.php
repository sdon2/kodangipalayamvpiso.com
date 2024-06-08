<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="{{ $description ?? null }}">
    <meta name="keywords" content="{{ $keywords ?? null }}">
    <meta name="author" content="Saravanakumar Arumugam <saravanakumar.a.o@gmail.com>">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- START: Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <!-- Custom -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Stroke 7 -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/metisMenu/metisMenu.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slickNav/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/typography.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" type="text/css">

    <!-- END: Styles -->
    <!-- jQuery -->
    <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>

    @stack('styles')

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center mr-0" href="https://vptax.tnrd.tn.gov.in/">
                <img src="{{ asset('assets/images/logo.jpg') }}" class="img-fluid pl-0 mr-2 logo_image"
                    alt="Rural Development &amp; Panchayat Raj , Tamil Nadu"
                    title="Rural Development &amp; Panchayat Raj, Tamil Nadu" style="">
                <div class="nav_heading">
                    <h5 class="mt-lg-2 font-17" style="color:#0e446d;font-weight:bold;">
                        கோடங்கிபாளையம் கிராம பஞ்சாயத்து
                    </h5>
                    <p style="color:black;" class="font-19 h5 mt-2">
                        <b>Kodangipalayam Village Panchayath</b>
                    </p>
                </div>
            </a>
        </div>
    </nav>
    <nav class="navbar-expand-lg navbar_menus navbar-light shift">
        <div class="container">
            <div class="row">
                <button class="navbar-toggler ml-5" type="button" data-toggle="collapse"
                    data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @if ($menu->count())
                    <ul class="collapse navbar-collapse p-mobile" id="navbarNavDropdown">
                        @foreach ($menu as $entry)
                            <li class="nav-item">
                                <a class="nav-link px-2" href="{{ route('page', ['slug' => $entry->slug]) }}">
                                    <span
                                        class="menu_name {{ request()->routeIs('page', ['slug' => $entry->slug]) ? 'active' : '' }}">
                                        <i class="{{ $entry->menu_icon ?: '' }} mr-1">{{ $entry->title }}</i>
                                    </span>
                                    @if (!$loop->last)
                                        <span class="menu_seperator"></span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </nav>

    @stack('content')

    <section class="mx-auto mt-4" style="background: #007aff">

        <footer class="pt-3">
            <div class="container text-center pb-4">
                <div class="col-12">
                    Contents Owned and Updated by {{ config('app.name') }}<br><br>
                    Designed &amp; Developed by SVP Infotech, Tiruppur.
                </div>
            </div>
        </footer>

    </section>

    <!-- START: Scripts -->
    <!-- Bootstrap -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Custom -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @stack('scripts')

    <!-- END: Scripts -->

</body>

</html>
