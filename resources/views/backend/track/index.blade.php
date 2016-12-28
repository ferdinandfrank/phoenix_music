@extends('backend.layout')

@section('title', trans('labels.posts'))
@section('description', Settings::blogDescriptionShort())

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ route('posts.index') }}">{{ trans('labels.posts') }}</a></li>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <panel title="{{ trans('labels.posts') }}" subtitle="{{ trans('common.posts_index_description') }}...">
                <table class="table striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('labels.title') }}</th>
                        <th>{{ trans('labels.author') }}</th>
                        <th>{{ trans('labels.status') }}</th>
                        <th>{{ trans('labels.visits') }}</th>
                        <th>{{ trans('labels.created_at') }}</th>
                        <th>{{ trans('labels.updated_at') }}</th>
                        <th>{{ trans('labels.published_at') }}</th>
                        <th class="center">{{ trans('labels.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)
                        <tr id="post-{{ $post->id }}">
                            <td>{{ $post->id }}</td>
                            <td>
                                <a href="{{ $post->getPath() }}">
                                    {{ $post->title }}
                                </a>
                            </td>
                            <td><a href="#">{{ $post->author->display_name }}</a></td>
                            <td>{!! $post->getPresenter()->getStatusLabel() !!}</td>
                            <td>{{ $post->getViewsCount() }}</td>
                            <td>{{ $post->created_at->diffForHumans() }}</td>
                            <td>{{ !empty($post->updated_at) ? $post->updated_at->diffForHumans() : '-' }}</td>
                            <td>{{ !empty($post->published_at) ? $post->published_at->diffForHumans() : '-' }}</td>
                            <td class="btn-group">
                                @can('update', $post)
                                    <a href="{{ $post->getEditPath() }}" class="btn btn-xs btn-success">
                                        <icon icon="{{ config('icons.edit') }}"></icon>
                                    </a>
                                @endcan
                                @can('delete', $post)
                                    <form-button action="{{ $post->getDestroyPath() }}" object-name="{{ $post->title }}"
                                                 alert-key="post" remove="#post-{{ $post->id }}"
                                                 size="xs">
                                        <icon icon="{{ config('icons.delete') }}"></icon>
                                    </form-button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $posts->links() }}
                <div class="btn-group flex-reverse m-t-20">
                    <a href="{{ route('posts.create') }}" class="btn btn-success">
                        <icon icon="{{ config('icons.add') }}"></icon>
                        <span>{{ trans('action.create_post') }}</span>
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
