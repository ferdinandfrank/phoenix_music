@extends('frontend.layout')

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
                <a class="block center" href="{{ \App\Utils\UrlGenerator::audiojungle(\App\Models\Settings::audiojungle()) }}">
                    <i class="icon-featured tertiary fa fa-star"></i>
                    <h4 class="tertiary">{{ trans('labels.licensing_on_audiojungle') }}</h4>
                </a>
                <p>{{ \App\Models\Settings::textAudiojungle() }}</p>
                <p>{{ trans('descriptions.licensing_on_audiojungle') }}:</p>
                <ul class="check-list">
                    @foreach($audiojungleTracks as $track)
                        <li><a class="link" href="{{ \App\Utils\UrlGenerator::audiojungle($track->audiojungle) }}">{{ $track->title }} ({{ $track->composer->name }})</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col xs-12 md-6">
                <a class="block center" href="{{ \App\Utils\UrlGenerator::stye(\App\Models\Settings::stye()) }}">
                    <i class="icon-featured secondary fa fa-star"></i>
                    <h4 class="secondary">{{ trans('labels.licensing_on_stye') }}</h4>
                </a>
                <p>{{ \App\Models\Settings::textStye() }}</p>
                <p>{{ trans('descriptions.licensing_on_stye') }}:</p>
                <ul class="check-list">
                    @foreach($styeTracks as $track)
                        <li><a class="link" href="{{ \App\Utils\UrlGenerator::stye($track->stye) }}">{{ $track->title }} ({{ $track->composer->name }})</a></li>
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
