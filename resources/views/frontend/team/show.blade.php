@extends('frontend.layout')

@section('title', $user->name)

@section('breadcrumb')
    <li><a href="{{ route('team') }}">{{ trans('labels.about_us') }}</a></li>
    <li><a href="{{ $user->getPath() }}">{{ $user->name }}</a></li>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col xs-12 md-4 lg-3">
                <img src="{{ $user->image }}" class="thumbnail" alt="">
            </div>
            <div class="col xs-12 md-6">
                <h1 class="m-b-none">{{ $user->name }} @if(!empty($user->birthday))({{ \Carbon\Carbon::now()->diffInYears($user->birthday) }}) @endif</h1>
                <h3 class="secondary m-none">{{ $user->role }}</h3>
                <hr class="solid">
                {!! $user->about !!}
                <ul class="social-buttons">
                    @if(!empty($user->url))
                        <li class="url"><a target="_blank"  title="URL" href="{{ $user->url }}"><icon icon="{{ config('icons.url') }}"></icon></a></li>
                    @endif
                    @if(!empty($user->facebook))
                        <li class="facebook"><a target="_blank"  title="Facebook" href="{{ \App\Utils\UrlGenerator::facebook($user->facebook) }}"><icon icon="{{ config('icons.facebook') }}"></icon></a></li>
                    @endif
                        @if(!empty($user->twitter))
                            <li class="twitter"><a target="_blank"  title="Twitter" href="{{ \App\Utils\UrlGenerator::twitter($user->twitter) }}"><icon icon="{{ config('icons.twitter') }}"></icon></a></li>
                        @endif
                        @if(!empty($user->linkedin))
                            <li class="linkedin"><a target="_blank"  title="LinkedIn" href="{{ \App\Utils\UrlGenerator::linkedin($user->linkedin) }}"><icon icon="{{ config('icons.linkedin') }}"></icon></a></li>
                        @endif
                        @if(!empty($user->instagram))
                            <li class="instagram"><a target="_blank"  title="Instagram" href="{{ \App\Utils\UrlGenerator::instagram($user->instagram) }}"><icon icon="{{ config('icons.instagram') }}"></icon></a></li>
                        @endif
                        @if(!empty($user->github))
                            <li class="github"><a target="_blank"  title="GitHub" href="{{ \App\Utils\UrlGenerator::github($user->github) }}"><icon icon="{{ config('icons.github') }}"></icon></a></li>
                        @endif
                    <li class="email"><a target="_blank"  title="E-Mail" href="mailto:{{ $user->email }}"><icon icon="{{ config('icons.email') }}"></icon></a></li>
                </ul>

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col xs-12">
                <h3 class="uppercase center m-b-40">{{ trans('labels.the_work_of_name', ['name' => $user->name]) }}</h3>
                <div class="row">
                    <ul class="portfolio-list">
                        @foreach($user->tracks as $track)
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