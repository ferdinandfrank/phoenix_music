@extends('frontend.layout')

@section('title', trans('labels.about_us'))

@section('breadcrumb')
    <li><a href="{{ route('users.index') }}">{{ trans('labels.about_us') }}</a></li>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col xs-12 md-6">

                <h2>{{ trans('labels.who_is_name', ['name' => Settings::pageTitle()]) }} ?</h2>
                <p class="large">{!! Settings::pageDescription() !!}</p>

                <div class="row">
                    <div class="col xs-12">
                        <a class="block center" href="{{ \App\Utils\UrlGenerator::audiojungle(Settings::audiojungle()) }}">
                            <i class="icon-featured tertiary fa fa-star"></i>
                            <h4 class="tertiary">{{ trans('labels.audiojungle_exclusive_author') }}</h4>
                        </a>
                        {!! Settings::textAudiojungle() !!}
                    </div>
                    <div class="col xs-12">
                        <a class="block center" href="{{ \App\Utils\UrlGenerator::stye(Settings::stye()) }}">
                            <i class="icon-featured secondary fa fa-star"></i>
                            <h4 class="secondary">{{ trans('labels.under_contract_with_stye') }}</h4>
                        </a>
                        {!! Settings::textStye() !!}
                    </div>
                </div>
            </div>
            <div class="col xs-12 md-6">
                <div class="row">
                    <ul class="portfolio-list">
                        @foreach($users as $user)
                            <li class="col-md-6 item">
                                <a href="{{ $user->getPath() }}">
                                    <div class="image" style="background-image: url({{ $user->image }})"></div>
                                    <div class="details">
                                        <p class="title">{{ $user->name }}</p>
                                        @if(!empty($user->role))
                                        <div class="categories">
                                            <span>{{ $user->role }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </a>
                            </li>
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