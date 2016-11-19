@extends('layout')

@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1>Licensing</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="container">

        <h2>Use our tracks in <strong>your projects!</strong></h2>

        <div class="row">
            <div class="col-md-10">
                <p class="lead">
                    If you are interested in using one of our tracks/sounds in your project, you'll need to license this track/sound either on <a href="{{ \App\Utils\UrlGenerator::audiojungle(\App\Models\Settings::audiojungle()) }}">Audiojungle</a> or <a href="{{ \App\Utils\UrlGenerator::stye(\App\Models\Settings::stye()) }}">SongsToYourEyes</a>.<br/>
                    If you are interested in an individual track composition, that fits your project, feel free to contact us.
                </p>
            </div>
            <div class="col-md-2">
                <a href="{{ route('contact') }}" class="btn btn-lg btn-primary mt-xl pull-right">Contact Us!</a>
            </div>
        </div>

        <hr class="tall">

        <div class="featured-boxes featured-boxes-style-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="featured-box featured-box-tertiary featured-box-effect-3">
                        <div class="box-content">
                            <a href="{{ \App\Utils\UrlGenerator::audiojungle(\App\Models\Settings::audiojungle()) }}">
                                <i class="icon-featured fa fa-star"></i>
                                <h4>Licensing on AudioJungle</h4>
                            </a>
                            <p>{{ \App\Models\Settings::textAudiojungle() }}</p>
                            <p>The following tracks/sounds are available for licensing on AudioJungle:</p>
                            <ul class="list list-icons list-tertiary mt-md pull-left">
                                @foreach($audiojungleTracks as $track)
                                    <li><i class="fa fa-check"></i> <a href="{{ \App\Utils\UrlGenerator::audiojungle($track->audiojungle) }}">{{ $track->title }} ({{ $track->composer->name }})</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="featured-box featured-box-quaternary featured-box-effect-3">
                        <div class="box-content">
                            <a href="{{ \App\Utils\UrlGenerator::stye(\App\Models\Settings::stye()) }}">
                                <i class="icon-featured fa fa-star"></i>
                                <h4>Licensing on SongsToYourEyes</h4>
                            </a>
                            <p>{{ \App\Models\Settings::textStye() }}</p>
                            <p>The following tracks/sounds are available for licensing on SongsToYourEyes:</p>
                            <ul class="list list-icons list-quaternary mt-md pull-left">
                                @foreach($styeTracks as $track)
                                    <li><i class="fa fa-check"></i> <a href="{{ \App\Utils\UrlGenerator::stye($track->stye) }}">{{ $track->title }} ({{ $track->composer->name }})</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop