@extends('shared.layout')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ elixir('assets/css/frontend.css') }}">
@endpush

@section('header')
    @include('frontend.partials.header')
@stop

@section('main')
    <main class="main" style="{{ !isRoute('home') ? "background-image: url(". Settings::background() .")" : '' }}">
        @if(!isRoute('home'))
            <section class="page-header">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <ul class="breadcrumb">
                                <li><a href="{{ route('home') }}">{{ trans('labels.home') }}</a></li>
                                @yield('breadcrumb')
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @yield('content')
    </main>
@stop

@push('js')
<script type="text/javascript" src="{{ elixir('assets/js/frontend.js') }}"></script>
@endpush