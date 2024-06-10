<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- START: Styles -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500%7cNunito+Sans:400,600,700%7cPT+Serif:400,400i"
        rel="stylesheet" type="text/css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/fontawesome/css/font-awesome.min.css') }}">
    <!-- Stroke 7 -->
    <link rel="stylesheet"
        href="{{ asset('assets/bower_components/pixeden-stroke-7-icon/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css') }}">
    <!-- Flickity -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/flickity/dist/flickity.min.css') }}">
    <!-- Photoswipe -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/photoswipe/dist/photoswipe.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/bower_components/photoswipe/dist/default-skin/default-skin.css') }}">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <!-- END: Styles -->
    <!-- jQuery -->
    <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>

    @stack('styles')

</head>

<body>

    <div class="nk-main bg-white" style="background: #dcdcdc" id="app">

        <div class="container-fluid mb-4" style="background: #196d19; color: #ffffff">
            <div class="container py-4">
                <div class="row">
                    <div class="col-12">
                        <h3>{{ config('app.name') }} : Admininstration</h3>
                    </div>
                </div>
            </div>
        </div>

        {{ $slot }}


        <div class="container-fluid mb-4" style="background: #196d19; color: #ffffff">
            <div class="container py-2">
                <div class="row">
                    <div class="col-12">
                        <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name') }}.<br>All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- START: Scripts -->
    {{-- <!-- GSAP -->
<script src="{{ asset('assets/bower_components/gsap/src/minified/TweenMax.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/gsap/src/minified/plugins/ScrollToPlugin.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/bower_components/tether/dist/js/tether.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- nK Share -->
<script src="{{ asset('assets/plugins/nk-share/nk-share.js') }}"></script>
<!-- Sticky Kit -->
<script src="{{ asset('assets/bower_components/sticky-kit/dist/sticky-kit.min.js') }}"></script>
<!-- Jarallax -->
<script src="{{ asset('assets/bower_components/jarallax/dist/jarallax.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/jarallax/dist/jarallax-video.min.js') }}"></script>
<!-- Flickity -->
<script src="{{ asset('assets/bower_components/flickity/dist/flickity.pkgd.min.js') }}"></script>
<!-- Isotope -->
<script src="{{ asset('assets/bower_components/isotope/dist/isotope.pkgd.min.js') }}"></script>
<!-- Photoswipe -->
<script src="{{ asset('assets/bower_components/photoswipe/dist/photoswipe.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/photoswipe/dist/photoswipe-ui-default.min.js') }}"></script>
<!-- Jquery Form -->
<script src="{{ asset('assets/bower_components/jquery-form/dist/jquery.form.min.js') }}"></script>
<!-- Jquery Validation -->
<script src="{{ asset('assets/bower_components/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<!-- Hammer.js -->
<script src="{{ asset('assets/bower_components/hammer.js/hammer.min.js') }}"></script>
<!-- Social Likes -->
<script src="{{ asset('assets/bower_components/social-likes/dist/social-likes.min.js') }}"></script>
<!-- NanoSroller -->
<script src="{{ asset('assets/bower_components/nanoscroller/bin/javascripts/jquery.nanoscroller.min.js') }}"></script>
<!-- Keymaster -->
<script src="{{ asset('assets/bower_components/keymaster/keymaster.js') }}"></script>
<!-- Piroll -->
<script src="{{ asset('assets/js/piroll.min.js') }}"></script>
<script src="{{ asset('assets/js/piroll-init.js') }}"></script> --}}
    <!-- Custom -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>

    @stack('scripts')

    <!-- END: Scripts -->

</body>

</html>
