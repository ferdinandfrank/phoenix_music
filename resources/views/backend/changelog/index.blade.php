@extends('backend.layout')

@section('title', trans('labels.changelog'))

@section('breadcrumb')
    <li><span>{{ trans('labels.dashboard') }}</span></li>
    <li><span>{{ trans('labels.changelog') }}</span></li>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <panel title="{{ trans('labels.changelog') }}"
                   subtitle="{{ trans('descriptions.changelog_index') }}.">
                <table class="table striped">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.version') }}</th>
                        <th>#</th>
                        <th>{{ trans('labels.content') }}</th>
                        <th>{{ trans('labels.author') }}</th>
                        <th>{{ trans('labels.email') }}</th>
                        <th>{{ trans('labels.published_at') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($changeLog as $logEntry)
                        <tr>
                            <td>
                                {{ $loop->index == 0 || $logEntry->version != $changeLog[$loop->index - 1]->version ? $logEntry->version : '' }}
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $logEntry->message }}</td>
                            <td>{{ $logEntry->author }}</td>
                            <td>{{ $logEntry->email }}</td>
                            <td>{{ $logEntry->date->diffForHumans() }}</td>
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

