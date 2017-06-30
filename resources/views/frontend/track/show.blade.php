@extends('frontend.layout')

@section('title', $track->title)

@section('og-type', 'music')
@section('og-title', $track->title)
@section('og-description', strip_tags($track->description))
@if ($track->image)
    @section('og-image', url($track->image))
@endif
@section('keywords', $track->tags)

@push('og')
<meta property="og:audio" content="{{ url($track->file) }}" >

<meta property="music:musician" content="{{ UrlGenerator::facebook($track->composer->facebook) }}" >
@endpush

@section('breadcrumb')
    <li><a href="{{ route('library') }}">{{ trans('labels.library') }}</a></li>
    <li><a href="{{ $track->getPath() }}">{{ $track->title }}</a></li>
@stop

@section('content')
    <div class="container m-t-40">
        <div class="row">
            <div class="col xs-12 md-4 lg-3">
                <img src="{{ $track->image }}" class="thumbnail" alt="{{ $track->title }}">
                <phoenix-audio file="{{ $track->file }}"></phoenix-audio>
            </div>
            <div class="col xs-12 md-8 lg-9">
                <h1 class="m-none">{{ $track->title }}
                    @if(Auth::check())
                        <a class="small" href="{{ $track->getEditPath() }}">{{ trans('action.edit_track') }}</a>
                    @endif
                </h1>
                <h3 class="primary m-t-5">{{ trans('labels.track') }}</h3>
                {!! $track->description !!}
                <ul class="info-list">
                    <li>
                        <b>{{ trans('labels.composer') }}: </b>
                        <a href="{{ $track->composer->getPath() }}" class="link">{{ $track->composer->name }}</a>
                    </li>
                    @if(count($track->categories))
                        <li>
                            <b>{{ trans('labels.category') }}: </b>
                            @foreach($track->categories as $category)
                                <a href="{{ $category->getPath() }}" class="link">{{ $category->title }}</a>
                                @if(!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </li>
                    @endif
                    @if(!empty($track->album))
                        <li>
                            <b>{{ trans('labels.album') }}: </b>
                            <a href="{{ $track->album->getPath() }}" class="link">{{ $track->album->title }}</a>
                        </li>
                    @endif

                    <li>
                        <b>{{ trans('labels.length') }}: </b>{{ $track->length }}
                    </li>
                    <li>
                        <b>{{ trans('labels.bpm') }}: </b>{{ $track->bpm }}
                    </li>
                    <li>
                        <b>{{ trans('labels.published_at') }}: </b>{{ toDateString($track->published_at) }}
                    </li>
                    @if(!empty($track->tags))
                        <li>
                            <b>{{ trans('labels.tags') }}: </b>{{ $track->tags }}
                        </li>
                    @endif
                </ul>

                <div class="share-buttons">
                    <a class="btn mobile-only whatsapp"
                       href="whatsapp://send?text={{ urlencode($track->getPath()) }}">
                        <icon icon="{{ config('icons.whatsapp') }}"></icon>
                        <span>{{ trans('action.share') }}</span>
                    </a>
                    <a class="btn twitter" href="https://twitter.com/share" target="_blank"
                       data-text="{{ urlencode(strip_tags($track->description)) }}"
                       data-url="{{ $track->getPath() }}">
                        <icon icon="{{ config('icons.twitter') }}"></icon>
                        <span>Tweet</span>
                    </a>

                    <div class="fb-like" data-href="{{ $track->getPath() }}" data-layout="button_count"
                         data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
                </div>

                @if($track->isBuyable() || $track->isLicensable())
                    <div class="available_button_group">
                        <h3 class="secondary">{{ trans('action.get_it_now') }}!</h3>
                        @if (!empty($track->stye))
                            <a href="{{ \App\Utils\UrlGenerator::stye($track->stye) }}" class="available_button"
                               target="_blank"><img alt="SongsToYourEyes"
                                                    src="{{ asset('assets/images/logos/available_on_stye.png') }}"/></a>
                        @endif

                        @if (!empty($track->cdbaby))
                            <a href="{{ \App\Utils\UrlGenerator::cdbaby($track->cdbaby) }}" class="available_button"
                               target="_blank"><img alt="CDBaby"
                                                    src="{{ asset('assets/images/logos/available_on_cdbaby.png') }}"/></a>
                        @endif

                        @if (!empty($track->amazon))
                            <a href="{{ \App\Utils\UrlGenerator::amazon($track->amazon) }}" class="available_button"
                               target="_blank"><img alt="Amazon"
                                                    src="{{ asset('assets/images/logos/available_on_amazon.png') }}"/></a>
                        @endif

                        @if (!empty($track->audiojungle))
                            <a href="{{ \App\Utils\UrlGenerator::audiojungle($track->audiojungle) }}"
                               class="available_button" target="_blank"><img alt="Audiojungle"
                                                                             src="{{ asset('assets/images/logos/available_on_audiojungle.png') }}"/></a>
                        @endif

                        @if (!empty($track->iTunes))
                            <a href="{{ \App\Utils\UrlGenerator::iTunes($track->iTunes) }}" class="available_button"
                               target="_blank"><img alt="iTunes"
                                                    src="{{ asset('assets/images/logos/available_on_itunes.png') }}"/></a>
                        @endif
                        @endif
                        @if (!empty($track->youtube))
                            <a href="{{ \App\Utils\UrlGenerator::youtube($track->youtube) }}" class="available_button"
                               target="_blank"><img alt="youtube"
                                                    src="{{ asset('assets/images/logos/available_on_youtube.png') }}"/></a>
                        @endif
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
</script>@endpush