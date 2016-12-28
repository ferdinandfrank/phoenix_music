@extends('frontend.layout')

@section('breadcrumb')
    <li><a href="{{ route('contact') }}">{{ trans('labels.contact_us') }}</a></li>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="primary mt-lg">{{ trans('labels.get_in_touch') }}!</h2>
            <p class="large">{{ trans('texts.contact_description') }}</p>
            <div class="col xs-12 md-8">
                <ajax-form
                        alert-key="contact"
                        :clear="true"
                        method="post"
                        action="{{ route('contact.store') }}">
                    <div class="row">
                        <div class="col xs-12 md-6">
                            <form-input name="name" :required="true"></form-input>
                        </div>
                        <div class="col xs-12 md-6">
                            <form-input name="email" type="email" :required="true"></form-input>
                        </div>
                        <div class="col xs-12">
                            <form-textarea name="message" :required="true"></form-textarea>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn">
                            {{ trans('action.send') }}
                            <icon icon="{{ config('icons.send') }}"></icon>
                        </button>
                    </div>

                </ajax-form>
            </div>

            <div class="col xs-12 md-4">
                <div class="sm-center m-t-30">
                    <ul class="mail-list">
                        <li><strong>{{ trans('labels.general_contact') }}</strong>
                            <br>
                            <a class="link"
                               href="mailto:{{ Settings::emailContact() }}">{{ Settings::emailContact() }}</a>
                        </li>
                        <li><strong>{{ trans('labels.technical_contact') }}</strong>
                            <br>
                            <a class="link" href="mailto:{{ Settings::emailAdmin() }}">{{ Settings::emailAdmin() }}</a>
                        </li>
                        @foreach($users as $user)
                            <li><strong>{{ $user->name }}</strong>
                                <br>
                                <a class="link" href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="widget xs-center">
                        <h4>{{ trans('labels.imprint') }}</h4>
                        {!! Settings::imprint() !!}
                    </div>
                </div>
            </div>

        </div>
        @stop

        @push('js')
        <script>
            $(document).ready(function () {
                new VueModel({
                    el: '#content-wrapper'
                });
            });
        </script>
    @endpush