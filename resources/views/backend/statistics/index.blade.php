@extends('backend.layout')

@section('title', trans('labels.statistics'))

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ route('statistics.index') }}">{{ trans('labels.statistics') }}</a></li>
@stop

@section('content')
    <div class="row">
        <div class="col xs-12">
            <panel title="{{ trans('labels.visit_counter') }}">
                <div class="row">
                    <div class="col xs-12 md-6 auto-overflow">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ trans('labels.date') }}</th>
                                <th>{{ trans('labels.page') }}</th>
                                <th>{{ trans('labels.visits') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="bold-border"><b>{{ trans('labels.total') }}</b></td>
                                <td class="bold-border"></td>
                                <td class="bold-border">{{ $totalVisits }}</td>
                            </tr>
                            @foreach($pageViews as $pageView)
                                <tr>
                                    @if(!$loop->first && $pageViews[$loop->index - 1]->date->toDateString() == $pageView->date->toDateString())
                                        <td class="no-border"></td>
                                    @else
                                        <td class="bold-border">{{ toDateString($pageView->date) }}</td>
                                    @endif
                                    <td class="{{ $loop->first || $pageViews[$loop->index - 1]->date->toDateString() != $pageView->date->toDateString() ? 'bold-border' : '' }}">{{ $pageView->page }}</td>
                                    <td class="{{ $loop->first || $pageViews[$loop->index - 1]->date->toDateString() != $pageView->date->toDateString() ? 'bold-border' : '' }}">{{ $pageView->views_count }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col xs-12 md-6">
                        <chart type="line" title="{{ trans('labels.daily_views') }}"
                               :labels="{{ $dailyViews->pluck('date')->map->formatLocalized('%d %B %Y') }}"
                               :data="{{ $dailyViews->pluck('views_count') }}"></chart>
                    </div>
                </div>
            </panel>
        </div>

        <div class="col xs-12">
            <panel title="{{ trans('labels.popular_tracks') }}">
                <div class="row">
                    <div class="col xs-12 md-6 auto-overflow">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('labels.track') }}</th>
                                <th>{{ trans('labels.visits') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($trackViews as $trackView)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ $trackView->track->getPath() }}"
                                           class="link">{{ $trackView->track->title }}</a></td>
                                    <td>{{ $trackView->views_count }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col xs-12 md-6">
                        <chart type="bar" title="{{ trans('labels.visits') }}"
                               :labels="{{ $trackViews->pluck('track.title') }}"
                               :data="{{ $trackViews->pluck('views_count') }}"></chart>
                    </div>
                </div>
            </panel>
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

