@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.min.css') }}">
@stop

@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('users.index') }}">About Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $user->name }}</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
							<span class="img-thumbnail">
								<img alt="" height="300" class="img-responsive" src="{{ asset('assets/images/team/' . $user->image) }}">
							</span>
            </div>
            <div class="col-md-8">

                <h2 class="mb-none">{{ $user->name }} ({{ $user->birthday->toAge() }})</h2>
                <h4 class="heading-primary">{{ $user->role }}</h4>

                <hr class="solid">

                <p>{{ $user->about }}</p>

                <ul class="social-icons">
                    @if(!empty($user->facebook))
                        <li class="social-icons-facebook"><a target="_blank"
                           href="{{ \App\Utils\UrlGenerator::facebook($user->facebook) }}"><i
                                    class="fa fa-facebook"></i></a></li>
                    @endif
                        <li class="social-icons-email"><a target="_blank" href="mailto:{{ $user->email }}"><i
                                class="fa fa-envelope"></i></a></li>
                </ul>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <hr>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h4 class="mt-xlg mb-xlg text-uppercase">The Work of <strong>{{ $user->name }}</strong></h4>

                <div class="row">

                    <ul class="portfolio-list">
                        @foreach($user->tracks as $track)
                            <li class="col-md-3 col-sm-6 col-xs-12 workItem">
                                <div class="portfolio-item">
                                    <a href="{{ route('tracks.show', $track) }}" data-ajax-on-modal>
                                        <span class="thumb-info thumb-info-hide-wrapper-bg">
                                            <span class="thumb-info-wrapper">
                                                <img src="{{ $track->image }}" class="img-responsive" alt="">
                                                <span class="thumb-info-title">
                                                    <span class="thumb-info-inner">{{ $track->title }}</span>
                                                    <span class="thumb-info-type">{{ $track->category->title }}</span>
                                                </span>
                                            </span>
                                            <span class="thumb-info-action">
                                                <span class="thumb-info-action-icon"><i class="fa fa-play-circle"></i></span>
                                            </span>
                                        </span>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="{{ asset('assets/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/library.js') }}"></script>

@stop