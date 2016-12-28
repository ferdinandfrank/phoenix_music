@extends('shared.layout')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ elixir('assets/css/backend.css') }}">
@endpush

@section('header')
    @include('backend.partials.header')
    <header class="sub-header">
        <div>
            <div class="sidebar-control">
                <p class="sidebar-title">
                    {{ trans('labels.navigation') }}
                </p>
                <div class="sidebar-toggle" v-on:click="toggleSidebar">
                    <icon icon="{{ config('icons.menu') }}"></icon>
                </div>
            </div>
            <h3 class="sub-header-title">@yield('title')</h3>
        </div>

        <div>
            <ol class="breadcrumb xs-hidden m-r-40">
                <li>
                    <a href="{{ route('admin') }}">
                        <icon icon="{{ config('icons.dashboard') }}"></icon>
                    </a>
                </li>
                @yield('breadcrumb')
            </ol>
        </div>
    </header>
@stop

@section('main')
    <main class="inner-wrapper">
        <aside class="sidebar">
            @include('backend.partials.sidebar-navigation')
        </aside>
        <section role="main" class="content-body">

            @yield('content')
        </section>
    </main>
@stop

@section('footer')
    <footer class="footer">
        @include('backend.partials.footer')
    </footer>
@stop

@push('js')
    <script type="text/javascript" src="{{ elixir('assets/js/backend.js') }}"></script>
@endpush
