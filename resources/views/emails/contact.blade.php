@extends('emails.layout')

@section('content')
    <h3>{{ trans('email.greeting_plain') }},</h3>

    <p>{{ trans('email.contact_text') }}</p>

    <ul>
        <li>{{ trans('input.name') }}: <span>{{ $name }}</span></li>
        <li>{{ trans('input.email') }}: <span>{{ $email }}</span></li>
    </ul>

    <p>{{ $content }}</p>

    <div class="btn-group">
        <a href="{{ route('home') }}" class="btn" target="_blank">{{ trans('action.to_website') }}</a>
    </div>
@stop

