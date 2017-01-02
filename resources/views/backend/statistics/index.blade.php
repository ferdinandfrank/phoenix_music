@extends('backend.layout')

@section('title', trans('labels.statistics'))

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ route('statistics.index') }}">{{ trans('labels.statistics') }}</a></li>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <panel title="{{ trans('labels.visit_counter') }}">
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.date') }}</th>
                        <th>{{ trans('labels.page') }}</th>
                        <th>{{ trans('labels.visits') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pageViews as $pageView)
                        <tr>
                            @if(!$loop->first && $pageViews[$loop->index - 1]->date->toDateString() == $pageView->date->toDateString())
                                <td class="no-border"></td>
                            @else
                                <td class="bold-border">{{ toDateString($pageView->date) }}</td>
                            @endif
                            <td class="{{ !$loop->first && $pageViews[$loop->index - 1]->date->toDateString() != $pageView->date->toDateString() ? 'bold-border' : '' }}">{{ $pageView->page }}</td>
                            <td class="{{ !$loop->first && $pageViews[$loop->index - 1]->date->toDateString() != $pageView->date->toDateString() ? 'bold-border' : '' }}">{{ $pageView->views_count }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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

