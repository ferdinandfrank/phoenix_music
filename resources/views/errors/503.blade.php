@extends('errors.layout')

@section('title', trans('messages.503.title'))

@section('content')
    <div class="container m-t-50 m-b-50">
        <div class="row">
            <div class="col xs-12 center">
                <h1>{{ trans('messages.503.title') }}</h1>
                <p>{{ trans('messages.503.content') }}</p>
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