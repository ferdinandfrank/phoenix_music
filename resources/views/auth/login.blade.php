@extends('shared.layout')

@section('title', trans('action.login'))

@push('css')
<link rel="stylesheet" type="text/css" href="{{ elixir('assets/css/backend.css') }}">
@endpush

@section('main')

    <section class="window-center col xs-12 sm-8 sm-offset-2 md-6 md-offset-3 lg-4 lg-offset-4">

        <div class="center">
            <img src="{{ \App\Models\Settings::logo() }}" height="120" alt="{{ Settings::pageTitle() }}"/>
        </div>

        <panel border="top" color="primary">
            <ajax-form
                    redirect="{{ route('admin') }}"
                    action="{{ route('login') }}"
                    :alert="false"
                    method="post">
                <form-input name="email" :required="true"
                            icon="{{ config('icons.user') }}"></form-input>

                <form-input name="password" type="password" :required="true"
                            icon="{{ config('icons.password') }}"></form-input>

                <form-checkbox name="remember_me" :value="true"></form-checkbox>

                <div class="btn-group center">
                    <button type="submit" class="btn btn-large btn-primary">{{ trans('action.login') }}</button>
                </div>

                <hr>

                <div class="center flex-column">
                    <a href="{{ route('password.forgot') }}" class="link">{{ trans('auth.forgot_my_password') }}</a>
                    <a href="{{ route('home') }}" class="link">{{ trans('action.back_to_website') }}</a>
                </div>

            </ajax-form>
        </panel>

        <p class="muted center">&copy; Copyright {{ \App\Utils\LocalDate::now()->year }}. All
            Rights Reserved.</p>

    </section>
@stop

@push('js')
    <script type="text/javascript" src="{{ elixir('assets/js/backend.js') }}"></script>
    <script>
        $(document).ready(function () {
            new VueModel({
                el: '#content-wrapper'
            });
        });
    </script>
@endpush