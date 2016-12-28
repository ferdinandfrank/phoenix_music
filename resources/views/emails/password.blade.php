@extends('emails.layout')

@section('content')
    <h3>{{ trans('email.greeting') }},</h3>

    <p>{{ trans('email.password_text', ['title' => Settings::pageTitle()]) }}</p>

    <div class="btn-group">
        <a href="{{ route('password.reset', ['token' => $token]) }}" class="btn" target="_blank">{{ trans('action.reset_password') }}</a>
    </div>
@stop