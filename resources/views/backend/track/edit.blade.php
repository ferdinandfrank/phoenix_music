@extends('backend.layout')

@section('title', $isEditPage ? trans('action.edit_post') : trans('action.create_post'))
@section('description', Settings::blogDescriptionShort())

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ $post->getIndexPath() }}">{{ trans('labels.posts') }}</a></li>
    @if($isEditPage)
        <li><a href="{{ $post->getEditPath() }}">{{ trans('action.edit_post') }}</a></li>
    @else
        <li><a href="{{ $post->getCreatePath() }}">{{ trans('action.create_post') }}</a></li>
    @endif
@stop

@section('content')
    <ajax-form
            action="{{ $post->getStorePath() }}"
            update-action="{{ $post->getUpdatePath() }}"
            update-key="{{ $post->getRouteKeyName() }}"
            method="{{ $isEditPage ? 'PUT' : 'POST' }}"
            alert-key="post"
            detail-redirect="{{ $post->getPath() }}"
            object-name="{{ $post->title }}">
        <div class="row">
            <div class="col xs-12 md-8">
                @if($isEditPage)
                    <panel title="{{ trans('action.edit_post') }}: {{ $post->title }}"
                           subtitle="{{ trans('param_labels.last_edited', ['date' => $post->updated_at->toDateString(), 'time' => $post->updated_at->toTimeString()]) }}">
                        @else
                            <panel title="{{ trans('action.create_post') }}">
                                @endif
                                <form-input name="title" lang-key="post" value="{{ $post->title }}"
                                            :show-placeholder="true"
                                            :max-length="{{ config('validation.post.title.max') }}"
                                            :required="true"></form-input>
                                <form-textarea name="subtitle" lang-key="post" value="{{ $post->subtitle }}"
                                            :show-placeholder="true"
                                            :required="true"></form-textarea>
                                <form-codearea lang-key="post" name="content" value="{{ $post->content }}" help-path="{{ route('help') }}"
                                               :required="true"></form-codearea>
                            </panel>
            </div>
            <div class="col xs-12 md-4">
                <div class="row">
                    <div class="col xs-12">
                        <panel title="{{ trans('labels.categories') }}">
                            <form-select name="categories" lang-key="post" :multiple="true" :show-placeholder="true">
                                @foreach (\App\Models\Category::all() as $category)
                                    <option @if ($post->categories->pluck('id')->contains($category->id)) selected
                                            @endif value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </form-select>
                        </panel>
                    </div>
                    <div class="col xs-12">
                        <panel title="{{ trans('labels.tags') }}">
                            <form-textarea name="tags" :show-placeholder="true"
                                           :max-length="{{ config('validation.post.tags.max') }}"
                                           lang-key="post" value="{{ $post->tags }}"></form-textarea>
                        </panel>
                    </div>
                    <div class="col xs-12">
                        <panel title="{{ trans('action.choose_cover') }}">
                            <input name="image" type="hidden" v-model="postImage"/>
                            <div class="center m-b-10 m-t-10">
                                <img v-if="postImage" class="img-responsive" :src="postImage">
                                <span v-else class="text-muted small">{{ trans('messages.no_image') }}</span>
                            </div>
                            <div class="btn-group center">
                                <a class="btn btn-secondary" v-on:click="showMediaManager = true">
                                    <icon icon="{{ config('icons.upload') }}"></icon>
                                    <span>{{ trans('action.choose_cover') }}</span>
                                </a>
                            </div>
                            <media-modal v-if="showMediaManager" v-on:close="showMediaManager = false">
                                <media-manager :is-modal="true" :selected-event-name="selectedEventName"
                                               v-on:close="showMediaManager = false"></media-manager>
                            </media-modal>
                        </panel>
                    </div>
                    <div class="col xs-12">
                        <panel title="{{ trans('action.publish') }}">
                            <form-select lang-key="post" name="layout" :disabled="true">
                                @foreach(getBladeFolderFiles(resource_path('views/frontend/post/show')) as $layoutFile)
                                    <option value="{{ $layoutFile }}">{{ makePretty($layoutFile) }}</option>
                                @endforeach
                            </form-select>

                            <form-select lang-key="post" name="layout_preview"
                                         help-path="{{ $isEditPage ? route('posts.layouts.preview', $post) : route('posts.layouts.preview') }}">
                                @foreach(getBladeFolderFiles(resource_path('views/frontend/post/preview')) as $layoutFile)
                                    <option value="{{ $layoutFile }}" @if ($layoutFile == $post->layout_preview) selected
                                            @endif>{{ makePretty($layoutFile) }}</option>
                                @endforeach
                            </form-select>

                            <form-switch name="is_draft"
                                         lang-key="post"
                                         :value="isDraft"></form-switch>

                            <form-datetime-input name="published_at" v-if="!isDraft"
                                                 lang-key="post"
                                                 value="{{ $post->published_at ?? \App\Utils\LocalDate::now() }}"></form-datetime-input>

                            <div class="btn-group center">
                                @if($isEditPage)
                                    <form-button action="{{ $post->getDestroyPath() }}"
                                                 redirect="{{ $post->getIndexPath() }}">
                                        <icon icon="{{ config('icons.delete') }}"></icon>
                                        <span>{{ trans('action.delete_post') }}</span>
                                    </form-button>

                                    <a href="{{ $post->getPath() }}" target="_blank" type="button"
                                       class="btn btn-primary">
                                        <icon icon="{{ config('icons.post') }}"></icon>
                                        <span>{{ trans('action.show_post') }}</span>
                                    </a>
                                @endif

                                <button type="submit" id="submit-btn" class="btn btn-success">
                                    <icon icon="{{ config('icons.save') }}"></icon>
                                    <span>{{ trans('action.save') }}</span>
                                </button>
                            </div>
                        </panel>
                    </div>

                </div>
            </div>
        </div>
    </ajax-form>
@stop

@push('js')
    <script>
        $(document).ready(function () {
            new VueModel({
                el: '#content-wrapper',
                data: {
                    showMediaManager: false,
                    postImage: "{{ $post->image }}",
                    selectedEventName: "post-image",
                    isDraft: "{{ $post->is_draft ? 'true' : 'false' }}" == 'true'
                },
                created: function () {
                    window.eventHub.$on('is_draft-input-changed', (input) => {
                        this.isDraft = input;
                    });

                    window.eventHub.$on('media-manager-selected-post-image', (file) => {
                        this.postImage = file.relativePath;
                        this.showMediaManager = false;
                    });

                    window.eventHub.$on('media-manager-notification', function (message, type, time) {
                        showAlert(type, null, message, time);
                    });
                }
            });
        });
    </script>
@endpush