@extends('frontend.layout')

@section('title', trans('labels.privacy_policy'))

@section('og-type', 'website')
@section('og-title', trans('labels.privacy_policy'))

@section('breadcrumb')
    <li><a href="{{ route('privacy_policy') }}">{{ trans('labels.privacy_policy') }}</a></li>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col xs-12">
                {!!  Settings::privacyPolicy(app()->getLocale()) !!}
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