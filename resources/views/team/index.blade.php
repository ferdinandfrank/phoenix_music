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
                    <h1>About Us</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <h2>Who is <strong>Phoenix Music?</strong></h2>
                <p class="lead">{!!  \App\Models\Settings::about() !!}</p>

                <div class="row mt-xlg mb-xl">
                    <div class="col-md-12">
                        <div class="feature-box feature-box-style-2">
                            <div class="feature-box-icon">
                                <i class="fa fa-star text-color-tertiary"></i>
                            </div>
                            <div class="feature-box-info">
                                <h4 class="mb-xs"><a class="lnk-tertiary"
                                                     href="{{ \App\Utils\UrlGenerator::audiojungle(\App\Models\Settings::audiojungle()) }}">Exclusive
                                        Author on Audiojungle</a></h4>
                                <p>{{ \App\Models\Settings::textAudiojungle() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="feature-box feature-box-style-2">
                            <div class="feature-box-icon">
                                <i class="fa fa-star text-color-quaternary"></i>
                            </div>
                            <div class="feature-box-info">
                                <h4 class="mb-xs"><a class="lnk-quaternary"
                                                     href="{{ \App\Utils\UrlGenerator::stye(\App\Models\Settings::stye()) }}">Under
                                        Contract with SongsToYourEyes</a></h4>
                                <p>{{ \App\Models\Settings::textStye() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <h4>Our <strong>Team</strong></h4>
                <div class="row">
                    <ul class="team-list">
                        @foreach($users as $user)
                            <li class="col-md-6">
                                <span class="thumb-info thumb-info-hide-wrapper-bg mb-xlg">
                                    <span class="thumb-info-wrapper">
                                        <a href="{{ route('users.show', $user) }}">
                                            <img src="{{ asset('assets/images/team/' . $user->image) }}"
                                                 class="img-responsive" alt="">
                                            <span class="thumb-info-title">
                                                <span class="thumb-info-inner">{{ $user->name }}</span>
                                                <span class="thumb-info-type">{{ $user->role }}</span>
                                            </span>
                                        </a>
                                    </span>
                                    <span class="thumb-info-caption">
                                        <span class="thumb-info-caption-text">{{ $user->about }}</span>
                                        <span class="thumb-info-social-icons">
                                            @if(!empty($user->facebook))
                                                <a target="_blank"
                                                   href="{{ \App\Utils\UrlGenerator::facebook($user->facebook) }}"><i
                                                            class="fa fa-facebook"></i><span>Facebook</span></a>
                                            @endif
                                            <a target="_blank" href="mailto:{{ $user->email }}"><i
                                                        class="fa fa-envelope"></i><span>E-Mail</span></a>
                                        </span>
                                    </span>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@stop