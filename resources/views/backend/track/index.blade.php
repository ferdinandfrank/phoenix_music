@extends('backend.layout')

@section('title', trans('labels.tracks'))

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ route('tracks.index') }}">{{ trans('labels.tracks') }}</a></li>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <panel title="{{ trans('labels.tracks') }}" subtitle="{{ trans('descriptions.tracks_index') }}...">
                <data-table lang-key="track" search-value="{{ request()->input('search') }}"
                            :count-value="{{ $entries_count }}">
                    <table class="table striped">
                        <thead>
                        <tr>
                            <th>@sortablelink('title', trans('labels.title'))</th>
                            <th>@sortablelink('composer_id', trans('labels.composer'))</th>
                            <th>@sortablelink('album_id', trans('labels.album'))</th>
                            <th>@sortablelink('published_at', trans('labels.published_at'))</th>
                            <th>{{ trans('labels.category') }}</th>
                            <th>{{ trans('labels.visits') }}</th>
                            <th class="center">{{ trans('labels.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tracks as $track)
                            <tr id="track-{{ $track->id }}"
                                class="{{ $newTrackKeys->contains($track->getRouteKey()) ? 'new' : '' }}">
                                <td>
                                    <a class="link" href="{{ $track->getPath() }}">
                                        {{ $track->title }}
                                    </a>
                                </td>
                                <td><a class="link"
                                       href="{{ $track->composer->getPath() }}">{{ $track->composer->name }}</a></td>
                                <td>{{ !empty($track->album) ? $track->album->title : '-' }}</td>
                                <td>{{ $track->published_at->diffForHumans() }}</td>
                                <td>
                                    @if(count($track->categories))
                                        @foreach($track->categories as $category)
                                            <a href="{{ $category->getPath() }}" class="link">{{ $category->title }}</a>
                                            @if(!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $track->getViewsCount() }}</td>
                                <td class="btn-group">
                                    @can('update', $track)
                                        <a href="{{ $track->getEditPath() }}" class="btn btn-xs btn-success">
                                            <icon icon="{{ config('icons.edit') }}"></icon>
                                        </a>
                                    @endcan
                                    @can('delete', $track)
                                        <form-button action="{{ $track->getDestroyPath() }}"
                                                     object-name="{{ $track->title }}"
                                                     alert-key="track" remove="#track-{{ $track->id }}"
                                                     size="xs">
                                            <icon icon="{{ config('icons.delete') }}"></icon>
                                        </form-button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </data-table>
                {{ $tracks->links() }}
                <div class="btn-group flex-reverse m-t-20">
                    <a href="{{ route('tracks.create') }}" class="btn btn-success">
                        <icon icon="{{ config('icons.add') }}"></icon>
                        <span>{{ trans('action.upload_track') }}</span>
                    </a>
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
