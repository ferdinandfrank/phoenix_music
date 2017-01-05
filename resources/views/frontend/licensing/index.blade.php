@extends('frontend.layout')

@section('title', trans('labels.licensing'))

@section('breadcrumb')
    <li><a href="{{ route('licensing') }}">{{ trans('labels.licensing') }}</a></li>
@stop

@section('content')
    <div class="container">

        <h1>{{ trans('labels.use_our_tracks') }}!</h1>

        <div class="row">
            <div class="col xs-12 md-10">
                <p class="large">{{ trans('descriptions.licensing') }}</p>
            </div>
            <div class="col xs-12 md-2">
                <a href="{{ route('contact') }}" class="btn btn-lg btn-primary">{{ trans('labels.contact_us') }}!</a>
            </div>
        </div>

        <hr class="tall">

        <div class="row">
            <div class="col xs-12 md-6">
                <a class="block center" href="{{ UrlGenerator::audiojungle(Settings::audiojungle()) }}">
                    <i class="icon-featured tertiary fa fa-star"></i>
                    <h4 class="tertiary">{{ trans('labels.licensing_on_audiojungle') }}</h4>
                </a>
                {!! Settings::textAudiojungle() !!}
                <p>{{ trans('descriptions.licensing_on_audiojungle') }}:</p>
                <ul class="check-list">
                    @foreach($audiojungleTracks as $track)
                        <li><a class="link" href="{{ UrlGenerator::audiojungle($track->audiojungle) }}">{{ $track->title }} ({{ $track->composer->name }})</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col xs-12 md-6">
                <a class="block center" href="{{ UrlGenerator::stye(Settings::stye()) }}">
                    <i class="icon-featured secondary fa fa-star"></i>
                    <h4 class="secondary">{{ trans('labels.licensing_on_stye') }}</h4>
                </a>
                {!! Settings::textStye() !!}
                <p>{{ trans('descriptions.licensing_on_stye') }}:</p>
                <ul class="check-list">
                    @foreach($styeTracks as $track)
                        <li><a class="link" href="{{ UrlGenerator::stye($track->stye) }}">{{ $track->title }} ({{ $track->composer->name }})</a></li>
                    @endforeach
                </ul>
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
