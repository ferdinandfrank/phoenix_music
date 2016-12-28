<header class="header">
    <div class="header-left">
        <a href="{{ route('admin') }}">
            <img src="{{ \App\Models\Settings::logo() }}" height="35"/>
        </a>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">

        <ul class="header-buttons">
            <li>
                <a href="{{ route('home') }}">
                    <icon icon="{{ config('icons.frontend') }}"></icon>
                </a>
            </li>
            <li v-on:click="markNotifications">
                <dropdown activate="#notifications-menu" :constrain-width="false"
                          :class="!notificationsMarked ? '{{ count(Auth::user()->unreadNotifications) ? 'with-badge' : '' }}' : ''">
                    <icon icon="{{ config('icons.notifications') }}">
                        @if(count(Auth::user()->unreadNotifications))
                            <span v-if="!notificationsMarked" class="badge">{{ count(Auth::user()->unreadNotifications) }}</span>
                        @endif
                    </icon>
                </dropdown>

                <div id="notifications-menu" class="dropdown-menu">
                    <ul class="notification-list">
                        @if(count(Auth::user()->notifications))
                            @foreach (Auth::user()->notifications as $notification)
                                @include('backend.notifications.' . snake_case(class_basename($notification->type)))
                            @endforeach
                        @else
                            <li class="no-data">{{ trans('messages.no_notifications') }}</li>
                        @endif
                    </ul>
                </div>
            </li>
        </ul>

        <span class="separator sm-hidden"></span>

        <div class="userbox">
            <dropdown activate="#user-menu" :below-origin="false" alignment="none">
                <div class="avatar x-small" style="background-image: url({{ Auth::user()->image }})"></div>
                <div class="profile-info">
                    <span class="name">{{ Auth::user()->name }}</span>
                    <span class="role">{{ Auth::user()->getTypeAsString() }}</span>
                </div>

                <i class="fa custom-caret"></i>
            </dropdown>

            <div id="user-menu" class="dropdown-menu user-menu">
                <ul class="list-unstyled">
                    <li class="divider"></li>
                    <li @if (Request::is('user')) class="active" @endif>
                        <a href="{{ Auth::user()->getEditPath() }}">
                            <icon icon="{{ config('icons.user') }}"></icon>
                            {{ trans('labels.profile') }}
                        </a>
                    </li>
                    <li @if (Request::is('admin/profile/*')) class="active" @endif>
                        <a href="{{ Auth::user()->getEditPath() }}">
                            <icon icon="{{ config('icons.edit') }}"></icon>
                            {{ trans('action.edit_profile') }}
                        </a>
                    </li>
                    <li id="logout-button">
                        <form-link form-id="logout-form" action="{{ route('logout') }}" method="POST">
                            <icon icon="{{ config('icons.logout') }}"></icon>{{ trans('action.logout') }}
                        </form-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>
