<header id="header" data-plugin-options='{"stickyEnabled": false, "stickyEnableOnBoxed": false, "stickyEnableOnMobile": false}'>
<div class="header-body">
    <div class="header-container container">
        <div class="header-row">
            <div class="header-column">
                <div class="header-logo">
                    <a href="{{ route('home') }}">
                        <img alt="Phoenix Music" width="210" height="110" data-sticky-width="82" data-sticky-height="40" data-sticky-top="33" src="{{ asset('assets/images/logos/full_logo.png') }}">
                    </a>
                </div>
            </div>
            <div class="header-column">
                <div class="header-row">
                    <div class="header-nav">
                        <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
                            <i class="fa fa-bars"></i>
                        </button>
                        <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
                            <nav>
                                <ul class="nav nav-pills" id="mainNav">
                                    <li class="@if (Request::is('/')) active @endif">
                                        <a href="{{ route('home') }}">
                                            Home
                                        </a>
                                    </li>
                                    <li class="dropdown dropdown-mega @if (Request::is('tracks')) active @endif">
                                        <a class="dropdown-toggle" href="{{ route('tracks.index') }}">
                                            Library
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="dropdown-mega-content">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <span class="dropdown-mega-sub-title">Category</span>
                                                            <ul class="dropdown-mega-sub-nav">
                                                                <li><a href="{{ route('tracks.index') }}">Show All</a></li>
                                                                <li><a href="{{ route('tracks.index') }}#TrailerMusic">Trailer Music</a></li>
                                                                <li><a href="{{ route('tracks.index') }}#AlbumTrack">Album Music</a></li>
                                                                <li><a href="{{ route('tracks.index') }}#MenuTheme">Menu Themes</a></li>
                                                                <li><a href="{{ route('tracks.index') }}#Logo">Logos</a></li>
                                                                <li><a href="{{ route('tracks.index') }}#Sound">Sounds</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="dropdown-mega-sub-title">Buyable</span>
                                                            <ul class="dropdown-mega-sub-nav">
                                                                <li><a href="{{ route('tracks.index') }}#buyable">Show All</a></li>
                                                                <li><a href="{{ route('tracks.index') }}#cdbaby">On CDBaby</a></li>
                                                                <li><a href="{{ route('tracks.index') }}#amazon">On Amazon</a></li>
                                                                <li><a href="{{ route('tracks.index') }}#itunes">On iTunes</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="dropdown-mega-sub-title">Licensable</span>
                                                            <ul class="dropdown-mega-sub-nav">
                                                                <li><a href="{{ route('tracks.index') }}#licensable">Show All</a></li>
                                                                <li><a href="{{ route('tracks.index') }}#audiojungle">On AudioJungle</a></li>
                                                                <li><a href="{{ route('tracks.index') }}#stye">On SongsToYourEyes</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="@if (Request::is('licensing')) active @endif">
                                        <a href="{{ route('licensing') }}">
                                            Licensing
                                        </a>
                                    </li>
                                    <li class="dropdown @if (Request::is('team')) active @endif">
                                        <a class="dropdown-toggle" href="{{ route('users.index') }}">
                                            About Us
                                        </a>
                                        <ul class="dropdown-menu">
                                            @foreach(\App\Models\User::all() as $user)
                                            <li><a href="{{ route('users.show', $user) }}">{{ $user->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="@if (Request::is('contact')) active @endif">
                                        <a href="{{ route('contact') }}">
                                            Contact Us
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="header-row mt-lg">
                    <nav class="header-nav-top">
                        <ul class="nav nav-pills">
                            <li class="hidden-xs">
                                <a href="{{ \App\Utils\UrlGenerator::audiojungle(\App\Models\Settings::audiojungle()) }}"><i class="fa fa-angle-right"></i> AudioJungle</a>
                            </li>
                            <li class="hidden-xs">
                                <a href="{{ \App\Utils\UrlGenerator::stye(\App\Models\Settings::stye()) }}"><i class="fa fa-angle-right"></i> SongsToYourEyes</a>
                            </li>
                            <li class="hidden-xs">
                                <a href="{{ \App\Utils\UrlGenerator::cdbaby(\App\Models\Settings::audiojungle()) }}"><i class="fa fa-angle-right"></i> CDBaby</a>
                            </li>
                            <li class="hidden-xs">
                                <a href="{{ \App\Utils\UrlGenerator::amazon(\App\Models\Settings::amazon()) }}"><i class="fa fa-angle-right"></i> Amazon</a>
                            </li>
                            <li class="hidden-xs">
                                <a href="{{ \App\Utils\UrlGenerator::iTunes(\App\Models\Settings::iTunes()) }}"><i class="fa fa-angle-right"></i> iTunes</a>
                            </li>
                        </ul>
                    </nav>
                    <ul class="header-social-icons social-icons mt-xlg hidden-xs hidden-sm">
                        <li class="social-icons-facebook"><a href="{{ \App\Utils\UrlGenerator::facebook(\App\Models\Settings::facebook()) }}" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li class="social-icons-youtube"><a href="{{ \App\Utils\UrlGenerator::youtube(\App\Models\Settings::youtube()) }}" target="_blank" title="YouTube"><i class="fa fa-youtube"></i></a></li>
                        <li class="social-icons-twitter"><a href="{{ \App\Utils\UrlGenerator::twitter(\App\Models\Settings::twitter()) }}" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                    <p class="hidden-xs hidden-sm text-sm center"><i class="fa fa-copyright"></i> {{ \App\Utils\LocalDate::now()->year }} {{ config('app.name') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</header>