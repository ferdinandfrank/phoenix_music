@extends('emails.layout')

@section('content')
    <h3>{{ trans('email.greeting', ['name' => $user->first_name]) }},</h3>

    <p>{{ trans('email.registration_text', ['title' => Settings::pageTitle()]) }}</p>

    <ul>
        <li>{{ trans('input.email') }}: <span>{{ $user->email }}</span></li>
        <li>{{ trans('input.password') }}: <span>{{ $password }}</span></li>
    </ul>

    <div class="btn-group">
        <a href="{{ route('login.show') }}" class="btn" target="_blank">{{ trans('action.sign_in_now') }}</a>
    </div>
@stop