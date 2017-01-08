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
                <table class="table striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('input.title') }}</th>
                        <th>{{ trans('labels.tracks_count') }}</th>
                        <th>{{ trans('labels.published_at') }}</th>
                        <th class="center">{{ trans('labels.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($albums as $album)
                        <tr id="album-{{ $album->id }}">
                            <td>{{ $album->id }}</td>
                            <td>
                                <a href="{{ $album->getPath() }}" class="link">
                                    {{ $album->title }}
                                </a>
                            </td>
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
