@extends('backend.layout')

@section('title', trans('labels.media'))

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ route('media') }}">{{ trans('labels.media') }}</a></li>
@stop

@section('content')
    <panel title="{{ trans('labels.media') }}">
        <media-manager></media-manager>
    </panel>
@stop

@push('js')
<script>
    $(document).ready(function () {
        new VueModel({
            el: '#content-wrapper',
            created: function () {
                window.eventHub.$on('media-manager-notification', function (message, type, time) {
                    showAlert(type, null, message, time);
                });
            }
        });
    });
</script>
@endpush

