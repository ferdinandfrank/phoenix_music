@extends('shared.layout')

@section('title', trans('action.forgot_password'))

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
                    action="{{ route('password.forgot.store') }}"
                    alert-key="password_forgot"
                    :clear="true"
                    method="post">

                <h3 class="m-t-none m-b-30 center secondary">{{ trans('action.forgot_password') }}</h3>
                <form-input name="email" :required="true" value="{{ $email or old('email') }}"
                            icon="{{ config('icons.user') }}"></form-input>

                <div class="btn-group center">
                    <button type="submit" class="btn btn-primary">{{ trans('action.send_reset_link') }}</button>
                </div>

                <hr>

                <div class="center flex-column">
                    <a href="{{ route('login') }}" class="link">{{ trans('action.login') }}</a>
                    <a href="{{ route('blog') }}" class="link">{{ trans('common.back_to_blog') }}</a>
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