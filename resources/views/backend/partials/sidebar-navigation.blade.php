<div class="sidebar-content scroll">
    <nav>
        <ul class="nav nav-main">
            <li @if (Request::is('admin')) class="nav-active" @endif>
                <a href="{{ route('admin') }}">
                    <icon icon="{{ config('icons.dashboard') }}"></icon>
                    <span>{{ trans('labels.dashboard') }}</span>
                </a>
            </li>
            <li @if (Request::is('admin/tracks')) class="nav-active" @endif>
                <a href="{{ route('tracks.index') }}">
                    <icon icon="{{ config('icons.track') }}"></icon>
                    <span>{{ trans('labels.tracks') }}</span>
                    <span class="label">{{ App\Models\Track::count() }}</span>
                </a>
            </li>
            <li @if (Request::is('admin/albums')) class="nav-active" @endif>
                <a href="{{ route('albums.index') }}">
                    <icon icon="{{ config('icons.album') }}"></icon>
                    <span>{{ trans('labels.albums') }}</span>
                    <span class="label">{{ App\Models\Album::count() }}</span>
                </a>
            </li>
            <li @if (Request::is('admin/categories')) class="nav-active" @endif>
                <a href="{{ route('categories.index') }}">
                    <icon icon="{{ config('icons.category') }}"></icon>
                    <span>{{ trans('labels.categories') }}</span>
                    <span class="label">{{ App\Models\Category::count() }}</span>
                </a>
            </li>
            <li @if (Request::is('admin/users*')) class="nav-active" @endif>
                <a href="{{ route('users.index') }}">
                    <icon icon="{{ config('icons.user') }}"></icon>
                    <span>{{ trans('labels.users') }}</span>
                </a>
            </li>
            <li @if (Request::is('admin/media*')) class="nav-active" @endif>
                <a href="{{ route('media') }}">
                    <icon icon="{{ config('icons.media') }}"></icon>
                    <span>{{ trans('labels.media') }}</span>
                </a>
            </li>
            <li @if (Request::is('admin/statistics*')) class="nav-active" @endif>
                <a href="{{ route('statistics.index') }}">
                    <icon icon="{{ config('icons.statistics') }}"></icon>
                    <span>{{ trans('labels.statistics') }}</span>
                </a>
            </li>
            @can('update', \App\Models\Settings::class)
            <li @if (Request::is('admin/tools*')) class="nav-active" @endif>
                <a href="{{ route('tools.index') }}">
                    <icon icon="{{ config('icons.tools') }}"></icon>
                    <span>{{ trans('labels.tools') }}</span>
                </a>
            </li>
            <li @if (Request::is('admin/settings*')) class="nav-active" @endif>
                <a href="{{ route('settings.index') }}">
                    <icon icon="{{ config('icons.settings') }}"></icon>
                    <span>{{ trans('labels.settings') }}</span>
                </a>
            </li>
            @endcan
            <li @if (Request::is('admin/help*')) class="nav-active" @endif>
                <a href="{{ route('help') }}">
                    <icon icon="{{ config('icons.help') }}"></icon>
                    <span>{{ trans('labels.help') }}</span>
                </a>
            </li>
        </ul>
    </nav>

    <hr class="separator"/>

    <nav>
        <p class="sidebar-title">{{ trans('labels.actions') }}</p>
        <ul class="nav nav-main">
            <li @if (Request::is('admin/tracks/create')) class="nav-active" @endif>
                <a href="{{ route('tracks.create') }}">
                    <icon icon="{{ config('icons.track') }}"></icon>
                    <span>{{ trans('action.upload_track') }}</span>
                </a>
            </li>
            @can('store', \App\Models\Album::class)
            <li @if (Request::is('admin/albums/create')) class="nav-active" @endif>
                <a href="{{ route('albums.create') }}">
                    <icon icon="{{ config('icons.album') }}"></icon>
                    <span>{{ trans('action.create_album') }}</span>
                </a>
            </li>
            @endcan
            @can('store', \App\Models\Category::class)
            <li @if (Request::is('admin/categories/create')) class="nav-active" @endif>
                <a href="{{ route('categories.create') }}">
                    <icon icon="{{ config('icons.category') }}"></icon>
                    <span>{{ trans('action.create_category') }}</span>
                </a>
            </li>
            @endcan
        </ul>
    </nav>

    <hr class="separator"/>

    <nav>
        <p class="sidebar-title">{{ trans('labels.server_status') }}</p>
        <ul class="status-list nav nav-main">
            @if(App::isDownForMaintenance())
                <li class="error"><a href="#"><span>{{ trans('labels.maintenance_mode') }}</span></a></li>
            @else
                <li class="success"><a href="#"><span>{{ trans('labels.active_mode') }}</span></a></li>
            @endif
        </ul>
    </nav>
</div>

