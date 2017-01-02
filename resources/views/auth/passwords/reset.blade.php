@extends('shared.layout')

@section('title', trans('action.reset_password'))

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
                    action="{{ route('password.reset.store') }}"
                    alert-key="password_reset"
                    redirect="{{ route('login') }}"
                    method="post">

                <h3 class="m-t-none m-b-30 center secondary">{{ trans('action.reset_password') }}</h3>

                <input type="hidden" name="token" value="{{ $token }}">

                <form-input name="email" :required="true" value="{{ $email or old('email') }}"
                            icon="{{ config('icons.user') }}"></form-input>

                <form-input name="password"
                            :max-length="{{ config('validation.user.password.max') }}"
                            type="password" :required="true"
                            icon="{{ config('icons.password') }}"></form-input>

                <form-input name="password_confirmation" type="password" :required="true"
                            icon="{{ config('icons.password') }}"></form-input>

                <div class="btn-group center">
                    <button type="submit" class="btn btn-primary">{{ trans('action.reset_password') }}</button>
                </div>

                <hr>

                <div class="center flex-column">
                    <a href="{{ route('login') }}" class="link">{{ trans('action.login') }}</a>
                    <a href="{{ route('home') }}" class="link">{{ trans('action.back_to_website') }}</a>
                </div>

            </ajax-form>
        </panel>

        <p class="muted center">&copy; Copyright {{ \Carbon\Carbon::now()->year }}. All
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
