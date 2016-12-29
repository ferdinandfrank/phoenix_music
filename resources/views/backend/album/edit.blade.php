@extends('backend.layout')

@section('title', $isEditPage ? trans('action.edit_album') : trans('action.create_album'))

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ $album->getIndexPath() }}">{{ trans('labels.albums') }}</a></li>
    @if($isEditPage)
        <li><a href="{{ $album->getEditPath() }}">{{ trans('action.edit_album') }}</a></li>
    @else
        <li><a href="{{ $album->getCreatePath() }}">{{ trans('action.create_album') }}</a></li>
    @endif
@stop

@section('content')
    <ajax-form
            action="{{ $album->getStorePath() }}"
            update-action="{{ $album->getUpdatePath() }}"
            update-key="{{ $album->getRouteKeyName() }}"
            method="{{ $isEditPage ? 'PUT' : 'POST' }}"
            alert-key="album"
            detail-redirect="{{ $album->getPath() }}"
            object-name="{{ $album->title }}">
        <div class="row">
            <div class="col xs-12 md-8">
                <div class="row">
                    <div class="col xs-12">
                        @if($isEditPage)
                            <panel title="{{ trans('action.edit_album') }}: {{ $album->title }}"
                                   subtitle="{{ trans('param_labels.last_edited', ['date' => $album->updated_at->toDateString(), 'time' => $album->updated_at->toTimeString()]) }}">
                                @else
                                    <panel title="{{ trans('action.create_album') }}">
                                        @endif
                                        <div class="row">
                                            <div class="col xs-12">
                                                <form-input name="title" lang-key="album" value="{{ $album->title }}"
                                                            :show-placeholder="true"
                                                            :max-length="{{ config('validation.album.title.max') }}"
                                                            :required="true"></form-input>
                                            </div>
                                            <div class="col xs-12">
                                                <form-codearea name="description" lang-key="album" value="{{ $album->description }}"
                                                               :show-placeholder="true"></form-codearea>
                                            </div>
                                        </div>
                                    </panel>
                    </div>
                    <div class="col xs-12">
                        <panel title="{{ trans('labels.networks') }}">
                            <div class="row">
                                <div class="col xs-12 md-6">
                                    <form-input name="audiojungle"
                                                :max-length="{{ config('validation.album.audiojungle.max') }}"
                                                :show-placeholder="true"
                                                value="{{ $album->audiojungle }}"></form-input>
                                </div>
                                <div class="col xs-12 md-6">
                                    <form-input name="stye"
                                                :max-length="{{ config('validation.album.stye.max') }}"
                                                :show-placeholder="true"
                                                value="{{ $album->stye }}"></form-input>
                                </div>
                                <div class="col xs-12 md-6">
                                    <form-input name="cdbaby"
                                                :max-length="{{ config('validation.album.cdbaby.max') }}"
                                                :show-placeholder="true"
                                                value="{{ $album->cdbaby }}"></form-input>
                                </div>
                                <div class="col xs-12 md-6">
                                    <form-input name="amazon"
                                                :max-length="{{ config('validation.album.amazon.max') }}"
                                                :show-placeholder="true"
                                                value="{{ $album->amazon }}"></form-input>
                                </div>
                                <div class="col xs-12 md-6">
                                    <form-input name="iTunes"
                                                :max-length="{{ config('validation.album.itunes.max') }}"
                                                :show-placeholder="true"
                                                value="{{ $album->iTunes }}"></form-input>
                                </div>
                            </div>
                        </panel>
                    </div>
                </div>
            </div>
            <div class="col xs-12 md-4">
                <div class="row">
                    <div class="col xs-12">
                        <panel title="{{ trans('action.choose_cover') }}">
                            <input name="image" type="hidden" v-model="albumImage"/>
                            <div class="center m-b-10 m-t-10">
                                <img v-if="albumImage" class="img-responsive" :src="albumImage">
                                <span v-else class="text-muted small">{{ trans('messages.no_image') }}</span>
                            </div>
                            <div class="btn-group center">
                                <a class="btn btn-secondary" v-on:click="showCoverMediaManager = true">
                                    <icon icon="{{ config('icons.upload') }}"></icon>
                                    <span>{{ trans('action.choose_cover') }}</span>
                                </a>
                            </div>
                            <media-modal v-if="showCoverMediaManager" v-on:close="showCoverMediaManager = false">
                                <media-manager :is-modal="true" :selected-event-name="selectedCoverEventName"
                                               v-on:close="showCoverMediaManager = false"></media-manager>
                            </media-modal>
                        </panel>
                    </div>
                    <div class="col xs-12">
                        <panel title="{{ trans('labels.tags') }}">
                            <form-textarea name="tags" :show-placeholder="true"
                                           lang-key="album" value="{{ $album->tags }}"></form-textarea>
                        </panel>
                    </div>
                    <div class="col xs-12">
                        <panel title="{{ trans('action.publish') }}">

                            <form-date-input name="published_at" :required="true"
                                             lang-key="album"
                                             value="{{ $album->published_at ?? \App\Utils\LocalDate::now() }}"></form-date-input>

                            <div class="btn-group center">
                                @if($isEditPage)
                                    <form-button action="{{ $album->getDestroyPath() }}"
                                                 redirect="{{ $album->getIndexPath() }}">
                                        <icon icon="{{ config('icons.delete') }}"></icon>
                                        <span>{{ trans('action.delete_album') }}</span>
                                    </form-button>

                                    <a href="{{ $album->getPath() }}" target="_blank" type="button"
                                       class="btn btn-primary">
                                        <icon icon="{{ config('icons.album') }}"></icon>
                                        <span>{{ trans('action.show_album') }}</span>
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
                showCoverMediaManager: false,
                albumImage: "{{ $album->image }}",
                selectedCoverEventName: "cover",
            },
            created: function () {

                window.eventHub.$on('media-manager-selected-cover', (file) => {
                    this.albumImage = file.relativePath;
                    this.showCoverMediaManager = false;
                });

                window.eventHub.$on('media-manager-notification', function (message, type, time) {
                    showAlert(type, null, message, time);
                });
            }
        });
    });
</script>
@endpush