@extends('frontend.layout')

@section('title', $album->title)

@section('breadcrumb')
    <li><a href="{{ route('library') }}">{{ trans('labels.albums') }}</a></li>
    <li><a href="{{ $album->getPath() }}">{{ $album->title }}</a></li>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col xs-12 md-4 lg-3">
                <img src="{{ $album->image }}" class="thumbnail" alt="">
            </div>
            <div class="col xs-12 md-6">
                <h1 class="m-none">{{ $album->title }}</h1>
                <h3 class="primary m-none">{{ trans('labels.album') }}</h3>
                <p>{!! $album->description !!}</p>
                <ul class="info-list">
                    <li>
                        <b>{{ trans('labels.published_at') }}: </b>{{ toDateString($album->published_at) }}
                    </li>
                    @if(!empty($track->tags))
                    <li>
                        <b>{{ trans('labels.tags') }}: </b>{{ $album->tags }}
                    </li>
                    @endif
                </ul>
                @if($album->isBuyable() || $album->isLicensable())
                <h3 class="secondary">{{ trans('action.get_it_now') }}!</h3>
                @if (!empty($album->stye))
                    <a href="{{ \App\Utils\UrlGenerator::stye($album->stye) }}" class="available_button" target="_blank"><img alt="SongsToYourEyes" src="{{ asset('assets/images/logos/available_on_stye.png') }}" /></a>
                @endif

                @if (!empty($album->cdbaby))
                    <a href="{{ \App\Utils\UrlGenerator::cdbaby($album->cdbaby) }}" class="available_button" target="_blank"><img alt="CDBaby" src="{{ asset('assets/images/logos/available_on_cdbaby.png') }}" /></a>
                @endif

                @if (!empty($album->amazon))
                    <a href="{{ \App\Utils\UrlGenerator::amazon($album->amazon) }}" class="available_button" target="_blank"><img alt="Amazon" src="{{ asset('assets/images/logos/available_on_amazon.png') }}" /></a>
                @endif

                @if (!empty($album->audiojungle))
                    <a href="{{ \App\Utils\UrlGenerator::audiojungle($album->audiojungle) }}" class="available_button" target="_blank"><img alt="Audiojungle" src="{{ asset('assets/images/logos/available_on_audiojungle.png') }}" /></a>
                @endif

                @if (!empty($album->iTunes))
                    <a href="{{ \App\Utils\UrlGenerator::iTunes($album->iTunes) }}" class="available_button" target="_blank"><img alt="iTunes" src="{{ asset('assets/images/logos/available_on_itunes.png') }}" /></a>
                @endif
                @endif
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col xs-12">
                <h3 class="uppercase center m-b-40">{{ trans('labels.the_tracks_of', ['name' => $album->title]) }}</h3>
                <div class="row">
                    <ul class="portfolio-list">
                        @foreach($album->tracks as $track)
                            @include('frontend.track.portfolio_item')
                        @endforeach
                    </ul>

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