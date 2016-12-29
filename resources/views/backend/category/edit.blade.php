@extends('backend.layout')

@section('title', $isEditPage ? trans('action.edit_category') : trans('action.create_category'))

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ $category->getIndexPath() }}">{{ trans('labels.categories') }}</a></li>
    @if($isEditPage)
        <li><a href="{{ $category->getEditPath() }}">{{ trans('action.edit_category') }}</a></li>
    @else
        <li><a href="{{ $category->getCreatePath() }}">{{ trans('action.create_category') }}</a></li>
    @endif
@stop

@section('content')
    <ajax-form
            action="{{ $category->getStorePath() }}"
            update-action="{{ $category->getUpdatePath() }}"
            update-key="{{ $category->getRouteKeyName() }}"
            method="{{ $isEditPage ? 'PUT' : 'POST' }}"
            alert-key="category"
            redirect="{{ $category->getIndexPath() }}"
            object-name="{{ $category->title }}">
        <div class="row">
            <div class="col xs-12 md-8">
                @if($isEditPage)
                    <panel title="{{ trans('action.edit_category') }}: {{ $category->title }}"
                           subtitle="{{ trans('param_labels.last_edited', ['date' => $category->updated_at->toDateString(), 'time' => $category->updated_at->toTimeString()]) }}">
                        @else
                            <panel title="{{ trans('action.create_category') }}">
                                @endif
                                <form-input name="title" lang-key="category" value="{{ $category->title }}"
                                            :show-placeholder="true"
                                            :max-length="{{ config('validation.category.title.max') }}"
                                            :required="true"></form-input>
                                <form-textarea name="description" lang-key="category"
                                               :max-length="{{ config('validation.category.description.max') }}"
                                               value="{{ $category->description }}"
                                               :show-placeholder="true"
                                               :required="true"></form-textarea>
                            </panel>
            </div>
            <div class="col xs-12 md-4">
                <panel title="{{ trans('labels.actions') }}">
                    <div class="btn-group center">
                        @if($isEditPage)
                            <form-button action="{{ $category->getDestroyPath() }}"
                                         alert-key="category"
                                         object-name="{{ $category->title }}"
                                         redirect="{{ $category->getIndexPath() }}">
                                <icon icon="{{ config('icons.delete') }}"></icon>
                                <span>{{ trans('action.delete_category') }}</span>
                            </form-button>
                        @endif
                        <button type="submit" class="btn btn-success">
                            <icon icon="{{ config('icons.save') }}"></icon>
                            <span>{{ trans('action.save') }}</span>
                        </button>
                    </div>
                </panel>

            </div>
        </div>
    </ajax-form>
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
