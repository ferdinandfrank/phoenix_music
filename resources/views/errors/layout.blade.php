@extends('shared.layout')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ elixir('assets/css/frontend.css') }}">
@endpush

@section('header')
    @include('frontend.partials.header')
@stop

@section('main')
    <main class="main" style="{{ !Request::is('/') ? "background-image: url(". Settings::background() .")" : '' }}">
        @yield('content')
    </main>
@stop

@push('js')
<script type="text/javascript" src="{{ elixir('assets/js/frontend.js') }}"></script>
@endpush