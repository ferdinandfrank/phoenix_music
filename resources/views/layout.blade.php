<!DOCTYPE html>
<html class="side-header side-header-semi-transparent">
<head>
    {{-- General Page Info --}}
    <meta charset="utf-8">
    <title>{{ \App\Models\Settings::pageTitle() }}</title>
    <meta name="author" content="{{ \App\Models\Settings::pageAuthor() }}">
    <meta name="description" content="{{ \App\Models\Settings::pageDescription() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0 maximum-scale=1.0, user-scalable=no">

    {{-- SEO Tags --}}
    <meta name="keywords" content="{{ \App\Models\Settings::pageKeywords() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/favicon.ico') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}">

    {{-- CSRF Token --}}
    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };
    </script>

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/perfect-scrollbar/jquery.mCustomScrollbar.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <!-- Slider CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/rs-plugin/css/settings.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/vendor/rs-plugin/css/layers.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/vendor/rs-plugin/css/navigation.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/vendor/circle-flip-slideshow/css/component.css') }}" media="screen">

    <!-- Head Libs -->
    <script src="{{ asset('assets/vendor/modernizr/modernizr.min.js') }}"></script>
    @yield('css')
</head>
<body>
    <div class="body">
        @include('navbar')

        <div role="main" class="main">
            @yield('content')
        </div>
    </div>

{{-- JAVASCRIPT --}}
<!-- Theme Base, Components and Settings -->


<!-- Vendor -->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.appear/jquery.appear.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-cookie/jquery-cookie.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/common/common.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.lazyload/jquery.lazyload.min.js') }}"></script>
<script src="{{ asset('assets/vendor/vide/vide.min.js') }}"></script>
<script src="{{ asset('assets/vendor/perfect-scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>


<!-- Slider JS -->
<script src="{{ asset('assets/vendor/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('assets/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('assets/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js') }}"></script>


@yield('js')
</body>
</html>