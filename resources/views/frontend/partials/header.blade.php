<header id="header" class="header scroll">
    <div class="header-control">
        <div class="header-logo">
            <a href="{{ route('home') }}">
                <img src="{{ Settings::logo() }}">
            </a>
        </div>
        <div class="navbar-toggle" v-on:click="toggleNavbar">
            <icon icon="{{ config('icons.menu') }}"></icon>
        </div>
    </div>
    <nav class="header-nav main-nav">
        <ul class="nav-pills">
            <li class="@if (isRoute('home')) active @endif">
                <a href="{{ route('home') }}">
                    {{ trans('labels.home') }}
                </a>
            </li>
            <li class="@if (isRoute('library', true)) active @endif">
                <a href="{{ route('library') }}">
                    {{ trans('labels.library') }}
                </a>
            </li>
            <li class="@if (isRoute('licensing')) active @endif">
                <a href="{{ route('licensing') }}">
                    {{ trans('labels.licensing') }}
                </a>
            </li>
            <li class="@if (isRoute('team', true)) active @endif">
                <a href="{{ route('team') }}">
                    {{ trans('labels.about_us') }}
                </a>
            </li>
            <li class="@if (isRoute('contact')) active @endif">
                <a href="{{ route('contact') }}">
                    {{ trans('labels.contact_us') }}
                </a>
            </li>
            @if(Auth::check())
                <li>
                    <a href="{{ route('admin') }}">
                        {{ trans('labels.dashboard') }}
                    </a>
                </li>
            @endif
        </ul>
    </nav>
    <nav class="header-nav">
        <ul class="nav-pills light nav-links">
            @if(!empty(Settings::audiojungle()))
                <li>
                    <a target="_blank" href="{{ UrlGenerator::audiojungle(Settings::audiojungle()) }}">AudioJungle</a>
                </li>
            @endif
            @if(!empty(Settings::stye()))
                <li>
                    <a target="_blank" href="{{ UrlGenerator::stye(Settings::stye()) }}">SongsToYourEyes</a>
                </li>
            @endif
            @if(!empty(Settings::cdbaby()))
                <li>
                    <a target="_blank" href="{{ UrlGenerator::cdbaby(Settings::cdbaby()) }}">CDBaby</a>
                </li>
            @endif
            @if(!empty(Settings::amazon()))
                <li>
                    <a target="_blank" href="{{ UrlGenerator::amazon(Settings::amazon()) }}">Amazon</a>
                </li>
            @endif
            @if(!empty(Settings::iTunes()))
                <li>
                    <a target="_blank" href="{{ UrlGenerator::iTunes(Settings::iTunes()) }}">iTunes</a>
                </li>
            @endif
        </ul>
    </nav>
    <ul class="social-buttons main-nav">
        @foreach(config('app.locales') as $locale => $country)
            @if(!App::isLocale($locale))
                <li><a href="{{ localizeRoute($locale) }}" title="{{ $country }}">
                        <img src="{{ asset('assets/images/flag_' . App::getLocale() . '.png') }}" />
                    </a></li>
            @endif
        @endforeach
        @if(!empty(Settings::facebook()))
            <li class="facebook"><a href="{{ UrlGenerator::facebook(Settings::facebook()) }}" target="_blank"
                                    title="Facebook">
                    <icon icon="{{ config('icons.facebook') }}"></icon>
                </a></li>
        @endif
        @if(!empty(Settings::youtube()))
            <li class="youtube"><a href="{{ UrlGenerator::youtube(Settings::youtube()) }}" target="_blank"
                                   title="YouTube">
                    <icon icon="{{ config('icons.youtube') }}"></icon>
                </a></li>
        @endif
        @if(!empty(Settings::twitter()))
            <li class="twitter"><a href="{{ UrlGenerator::twitter(Settings::twitter()) }}" target="_blank"
                                   title="Twitter">
                    <icon icon="{{ config('icons.twitter') }}"></icon>
                </a></li>
        @endif
    </ul>
    <p class="center small main-nav">
        <icon icon="{{ config('icons.copyright') }}"></icon> {{ \Carbon\Carbon::now()->year }} {{ Settings::pageTitle() }}
    </p>
</header>