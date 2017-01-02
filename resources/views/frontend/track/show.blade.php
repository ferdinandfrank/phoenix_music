@extends('frontend.layout')

@section('breadcrumb')
    <li><a href="{{ route('library') }}">{{ trans('labels.library') }}</a></li>
    <li><a href="{{ $track->getPath() }}">{{ $track->title }}</a></li>
@stop

@section('content')
    <div class="container m-t-40">
        <div class="row">
            <div class="col xs-12 md-4 lg-3">
                <img src="{{ $track->image }}" class="thumbnail" alt="">
                <phoenix-audio file="{{ $track->file }}"></phoenix-audio>
            </div>
            <div class="col xs-12 md-8 lg-9">
                <h1 class="m-none">{{ $track->title }}</h1>
                <h3 class="primary m-none">{{ trans('labels.track') }}</h3>
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
                @if($track->isBuyable() || $track->isLicensable())
                <h3 class="secondary">{{ trans('action.get_it_now') }}!</h3>
                @if (!empty($track->stye))
                    <a href="{{ \App\Utils\UrlGenerator::stye($track->stye) }}" class="available_button" target="_blank"><img alt="SongsToYourEyes" src="{{ asset('assets/images/logos/available_on_stye.png') }}" /></a>
                @endif

                @if (!empty($track->cdbaby))
                    <a href="{{ \App\Utils\UrlGenerator::cdbaby($track->cdbaby) }}" class="available_button" target="_blank"><img alt="CDBaby" src="{{ asset('assets/images/logos/available_on_cdbaby.png') }}" /></a>
                @endif

                @if (!empty($track->amazon))
                    <a href="{{ \App\Utils\UrlGenerator::amazon($track->amazon) }}" class="available_button" target="_blank"><img alt="Amazon" src="{{ asset('assets/images/logos/available_on_amazon.png') }}" /></a>
                @endif

                @if (!empty($track->audiojungle))
                    <a href="{{ \App\Utils\UrlGenerator::audiojungle($track->audiojungle) }}" class="available_button" target="_blank"><img alt="Audiojungle" src="{{ asset('assets/images/logos/available_on_audiojungle.png') }}" /></a>
                @endif

                @if (!empty($track->iTunes))
                    <a href="{{ \App\Utils\UrlGenerator::iTunes($track->iTunes) }}" class="available_button" target="_blank"><img alt="iTunes" src="{{ asset('assets/images/logos/available_on_itunes.png') }}" /></a>
                @endif
                @endif
                @if (!empty($track->youtube))
                    <a href="{{ \App\Utils\UrlGenerator::youtube($track->youtube) }}" class="available_button" target="_blank"><img alt="youtube" src="{{ asset('assets/images/logos/available_on_youtube.png') }}" /></a>
                @endif
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