@extends('backend.layout')

@section('title', trans('labels.categories'))

@section('breadcrumb')
    <li><span>{{ trans('labels.dashboard') }}</span></li>
    <li><span>{{ trans('labels.categories') }}</span></li>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <panel title="{{ trans('labels.categories') }}"
                   subtitle="{{ trans('descriptions.categories_index') }}...">
                <data-table lang-key="category" search-value="{{ request()->input('search') }}"
                            :count-value="{{ $entries_count }}">
                    <table class="table striped">
                        <thead>
                        <tr>
                            <th>@sortablelink('title', trans('labels.title'))</th>
                            <th>@sortablelink('description', trans('labels.description'))</th>
                            <th>@sortablelink('created_at', trans('labels.created_at'))</th>
                            <th class="center">{{ trans('labels.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr id="category-{{ $category->id }}"
                                class="{{ $newCategoryKeys->contains($category->getRouteKey()) ? 'new' : '' }}">
                                <td>
                                    <a class="link" href="{{ $category->getEditPath() }}">
                                        {{ $category->title }}
                                    </a>
                                </td>
                                <td>{{ $category->description ?? '-' }}</td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                                <td class="btn-group">
                                    @can('update', $category)
                                        <a href="{{ $category->getEditPath() }}" class="btn btn-xs btn-success">
                                            <icon icon="{{ config('icons.edit') }}"></icon>
                                        </a>
                                    @endcan
                                    @can('delete', $category)
                                        <form-button action="{{ $category->getDestroyPath() }}"
                                                     object-name="{{ $category->title }}"
                                                     alert-key="category"
                                                     remove="#category-{{ $category->id }}"
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
                {{ $categories->links() }}
                @can('store', \App\Models\Category::class)
                    <div class="btn-group m-t-20 flex-reverse">
                        <a href="{{ route('categories.create') }}" class="btn btn-success">
                            <icon icon="{{ config('icons.add') }}"></icon>
                            <span>{{ trans('action.create_category') }}</span>
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

