@extends('backend.layout')

@section('title', trans('labels.albums'))

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ route('albums.index') }}">{{ trans('labels.albums') }}</a></li>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <panel title="{{ trans('labels.albums') }}" subtitle="{{ trans('descriptions.albums_index') }}...">
                <data-table lang-key="album" search-value="{{ request()->input('search') }}"
                            :count-value="{{ $entries_count }}">
                    <table class="table striped">
                        <thead>
                        <tr>
                            <th>@sortablelink('title', trans('labels.title'))</th>
                            <th>@sortablelink('description', trans('labels.description'))</th>
                            <th>@sortablelink('tracks_count', trans('labels.tracks_count'))</th>
                            <th>@sortablelink('published_at', trans('labels.published_at'))</th>
                            <th class="center">{{ trans('labels.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($albums as $album)
                            <tr id="album-{{ $album->id }}"
                                class="{{ $newAlbumKeys->contains($album->getRouteKey()) ? 'new' : '' }}">
                                <td>
                                    <a href="{{ $album->getPath() }}" class="link">
                                        {{ $album->title }}
                                    </a>
                                </td>
                                <td>{{ $album->description ?? '-' }}</td>
                                <td>{{ $album->tracks_count }}</td>
                                <td>{{ $album->published_at->diffForHumans() }}</td>
                                <td class="btn-group">
                                    @can('update', $album)
                                        <a href="{{ $album->getEditPath() }}" class="btn btn-xs btn-success">
                                            <icon icon="{{ config('icons.edit') }}"></icon>
                                        </a>
                                    @endcan
                                    @can('delete', $album)
                                        <form-button action="{{ $album->getDestroyPath() }}"
                                                     object-name="{{ $album->title }}"
                                                     alert-key="album" remove="#album-{{ $album->id }}"
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
                {{ $albums->links() }}
                @can('store', \App\Models\Album::class)
                    <div class="btn-group flex-reverse m-t-20">
                        <a href="{{ route('albums.create') }}" class="btn btn-success">
                            <icon icon="{{ config('icons.add') }}"></icon>
                            <span>{{ trans('action.create_album') }}</span>
                        </a>
                    </div>
                @endcan
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
