@extends('backend.layout')

@section('title', trans('labels.dashboard'))

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
@stop

@section('content')
    <div class="row">
        <div class="col xs-12 lg-6">
            <panel avatar="{{ Auth::user()->image }}" cover="{{ \App\Models\Settings::background() }}">
                <p class="secondary m-none">{{ Auth::user()->job }}</p>
                <h2 class="m-t-none">{{ Auth::user()->name }}</h2>
                {!! Auth::user()->about !!}
                <div slot="footer" class="btn-group center">
                    <a href="{{ Auth::user()->getPath() }}">
                        <icon icon="{{ config('icons.user') }}"></icon>
                        {{ trans('labels.profile') }}
                    </a>
                    <a href="{{ Auth::user()->getEditPath() }}">
                        <icon icon="{{ config('icons.edit') }}"></icon>
                        {{ trans('action.edit_profile') }}
                    </a>
                    <form-link :alert="false" redirect="{{ route('login') }}" action="{{ route('logout.post') }}"
                               method="post">
                        <icon icon="{{ config('icons.logout') }}"></icon>{{ trans('action.logout') }}
                    </form-link>
                </div>
            </panel>
        </div>
        <div class="col xs-12 lg-6">
            <div class="row">
                <div class="col xs-12">
                    <panel color="quartenary">
                        @if(!App::isDownForMaintenance())
                            <div class="widget">
                                <div class="widget-icon bg-success">
                                    <icon icon="{{ config('icons.online') }}"></icon>
                                </div>
                                <div class="widget-content">
                                    <div class="title">
                                        <h3>{{ trans('labels.server_status') }}</h3>
                                        <strong class="success">{{ trans('labels.active_mode') }}</strong>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="widget">
                                <div class="widget-icon bg-warning">
                                    <icon icon="{{ config('icons.maintenance') }}"></icon>
                                </div>
                                <div class="widget-content">
                                    <div class="title">
                                        <h3>{{ trans('labels.server_status') }}</h3>
                                        <strong class=" warning">{{ trans('labels.maintenance_mode') }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </panel>
                </div>
                <div class="col xs-12 md-6">
                    <panel color="secondary" border="left">
                        <div class="widget">
                            <div class="widget-icon bg-secondary">
                                <icon icon="{{ config('icons.views') }}"></icon>
                            </div>
                            <div class="widget-content">
                                <div class="title">
                                    <h3>{{ trans_choice('param_labels.visit', $totalVisits, ['visits' => $totalVisits]) }}</h3>
                                    <p>{{ trans('labels.total') }}</p>
                                </div>
                            </div>
                        </div>
                    </panel>
                </div>
                <div class="col xs-12 md-6">
                    <panel color="secondary" border="left">
                        <div class="widget">
                            <div class="widget-icon bg-secondary">
                                <icon icon="{{ config('icons.views') }}"></icon>
                            </div>
                            <div class="widget-content">
                                <div class="title">
                                    <h3>{{ trans_choice('param_labels.visit', $todayVisits, ['visits' => $todayVisits]) }}</h3>
                                    <p>{{ trans('date.today') }}</p>
                                </div>
                            </div>
                        </div>
                    </panel>
                </div>
                <div class="col xs-12 md-6">
                    <panel color="primary" border="left">
                        <div class="widget">
                            <div class="widget-icon">
                                <icon icon="{{ config('icons.track') }}"></icon>
                            </div>
                            <div class="widget-content">
                                <div class="title">
                                    <h3><strong>{{ App\Models\Track::count() }}</strong> {{ trans('labels.tracks') }}
                                        @if($numOfNewTracks > 0)
                                            <span class="warning">({{ trans_choice('param_labels.new', $numOfNewTracks, ['count' => $numOfNewTracks]) }}
                                                )</span>
                                        @endif
                                    </h3>
                                </div>
                                <div class="widget-action">
                                    <a href="{{ route('tracks.index') }}"
                                       class="uppercase link">{{ trans('action.show_all') }}</a>
                                </div>
                            </div>
                        </div>
                    </panel>
                </div>
                <div class="col xs-12 md-6">
                    <panel color="primary" border="left">
                        <div class="widget">
                            <div class="widget-icon">
                                <icon icon="{{ config('icons.album') }}"></icon>
                            </div>
                            <div class="widget-content">
                                <div class="title">
                                    <h3><strong>{{ App\Models\Album::count() }}</strong> {{ trans('labels.albums') }}
                                        @if($numOfNewAlbums > 0)
                                            <span class="warning">({{ trans_choice('param_labels.new', $numOfNewAlbums, ['count' => $numOfNewAlbums]) }}
                                                )</span>
                                        @endif
                                    </h3>
                                </div>
                                <div class="widget-action">
                                    <a href="{{ route('albums.index') }}"
                                       class="uppercase link">{{ trans('action.show_all') }}</a>
                                </div>
                            </div>
                        </div>
                    </panel>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col xs-12 lg-6">
            <div class="row">
                <div class="col xs-12">
                    <panel :actions="true" title="{{ trans('labels.changelog') }}"
                           subtitle="Version: {{ $gitVersion }}">
                        <div class="auto-overflow">
                            <table class="table striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('labels.content') }}</th>
                                    <th>{{ trans('labels.published_at') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($changeLog as $logEntry)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $logEntry->message }}</td>
                                        <td>{{ $logEntry->date->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </panel>
                </div>
            </div>
        </div>
        <div class="col xs-12 lg-6">
            <div class="row">

                @if(Auth::user()->isType(config('user_type.manager')) || Auth::user()->isType(config('user_type.admin')))
                    <div class="col xs-12">
                        <panel :actions="true" title="{{ trans('labels.system_information') }}">
                            <div class="auto-overflow">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>SITE_URL:</td>
                                        <td>{{ $system['url'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>SITE_IP:</td>
                                        <td>{{ $system['ip'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>SITE_TIMEZONE:</td>
                                        <td>{{ $system['timezone'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>PHP_VERSION:</td>
                                        <td>{{ $system['php_version'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>PHP_MEMORY_LIMIT:</td>
                                        <td>{{ $system['php_memory_limit'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>PHP_TIME_LIMIT:</td>
                                        <td>{{ $system['php_time_limit'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>DATABASE_CONNECTION:</td>
                                        <td>{{ $system['db_connection'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>WEB_SERVER:</td>
                                        <td>{{ $system['web_server'] }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </panel>
                    </div>
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
