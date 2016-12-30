@extends('emails.layout')

@section('content')

    <p>{{ trans('email.test_text') }}</p>

    <div class="btn-group">
        <a href="{{ route('home') }}" class="btn" target="_blank">{{ trans('action.to_website') }}</a>
    </div>
@stop