@extends('frontend.layout')

@section('title', trans('labels.home'))

@section('content')
    <video autoplay muted loop poster="{{ Settings::background() }}" class="fullscreen">
        <source src="{{ Settings::introVideo() }}" type="video/mp4">
    </video>
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