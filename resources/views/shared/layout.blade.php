<!DOCTYPE html>
<html class="fixed">
<head>
    {{-- General Page Info --}}
    <meta charset="utf-8">
    <title>{{ \App\Models\Settings::pageTitle() }} | @yield('title')</title>
    <meta name="author" content="{{ \App\Models\Settings::pageAuthor() }}">
    <meta name="description" content="{{ strip_tags(\App\Models\Settings::pageDescription()) }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0 maximum-scale=1.0, user-scalable=no">

    {{-- Facebook Open Graph Tags --}}
    <meta property="og:type" content="@yield('og-type')">
    <meta property="og:url" content="{{ url()->full() }}" />
    <meta property="og:site_name" content="{{ Settings::pageTitle() }}">
    <meta property="og:title" content="@yield('og-title')"/>
    <meta property="og:image" content="@yield('og-image')">
    <meta property="og:description" content="@yield('og-description')"/>

    @stack('og')

    {{-- SEO Tags --}}
    <meta name="keywords" content="{{ \App\Models\Settings::pageKeywords() }}, @yield('keywords')">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ \App\Models\Settings::favicon() }}" />

    {{-- CSRF Token --}}
    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };
    </script>

    {{-- CSS --}}
    @stack('css')

</head>
<body>
{{-- Selector for vue instances --}}
<section class="body" id="content-wrapper">

    @yield('header')

    @yield('main')

    @yield('footer')

</section>

{{-- JAVASCRIPT --}}
<script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>

@stack('js')
</body>
</html>
