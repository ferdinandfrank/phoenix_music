@extends('backend.layout')

@section('title', $isEditPage ? trans('action.edit_track') : trans('action.create_track'))

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ $track->getIndexPath() }}">{{ trans('labels.tracks') }}</a></li>
    @if($isEditPage)
        <li><a href="{{ $track->getEditPath() }}">{{ trans('action.edit_track') }}</a></li>
    @else
        <li><a href="{{ $track->getCreatePath() }}">{{ trans('action.create_track') }}</a></li>
    @endif
@stop

@section('content')
    <ajax-form
            action="{{ $isEditPage ? $track->getUpdatePath() : $track->getStorePath() }}"
            object-key="{{ $track->getRouteKeyName() }}"
            method="{{ $isEditPage ? 'PUT' : 'POST' }}"
            alert-key="track"
            detail-redirect="{{ $track->getPath() }}"
            object-name="{{ $track->title }}">
        <div class="row">
            <div class="col xs-12 md-8">
                <div class="row">
                    <div class="col xs-12">
                @if($isEditPage)
                    <panel title="{{ trans('action.edit_track') }}: {{ $track->title }}"
                           subtitle="{{ trans('param_labels.last_edited', ['date' => toDateString($track->updated_at), 'time' => $track->updated_at->toTimeString()]) }}">
                        @else
                            <panel title="{{ trans('action.create_track') }}">
                                @endif
                                <div class="row">
                                    <div class="col xs-12">
                                        <form-input name="title" lang-key="track" value="{{ $track->title }}"
                                                    :show-placeholder="true"
                                                    :max-length="{{ config('validation.track.title.max') }}"
                                                    :required="true"></form-input>
                                    </div>
                                    <div class="col xs-12">
                                        <form-codearea name="description" lang-key="track" value="{{ $track->description }}"
                                                       :stylesheets="['{{ elixir('assets/css/frontend.css') }}']"
                                                       :show-placeholder="true"></form-codearea>
                                    </div>
                                    <div class="col xs-12 md-6">
                                        <form-select name="composer_id" :value="{{ $track->composer_id ?? 'null' }}" :required="true" lang-key="track">
                                            @foreach ($composers as $composer)
                                                <option value="{{ $composer->id }}">{{ $composer->name }}</option>
                                            @endforeach
                                        </form-select>
                                    </div>
                                    <div class="col xs-12 md-6">
                                        <form-select name="album_id" :value="{{ $track->album_id ?? 'null' }}" lang-key="track">
                                            <option value="">{{ trans('defaults.no_album') }}</option>
                                            @foreach ($albums as $album)
                                                <option value="{{ $album->id }}">{{ $album->title }}</option>
                                            @endforeach
                                        </form-select>
                                    </div>
                                </div>
                            </panel>
                    </div>
                    <div class="col xs-12">
                            <panel title="{{ trans('labels.networks') }}">
                                <div class="row">
                                    <div class="col xs-12 md-6">
                                        <form-input name="audiojungle"
                                                    :max-length="{{ config('validation.track.audiojungle.max') }}"
                                                    :show-placeholder="true"
                                                    value="{{ $track->audiojungle }}"></form-input>
                                    </div>
                                    <div class="col xs-12 md-6">
                                        <form-input name="stye"
                                                    :max-length="{{ config('validation.track.stye.max') }}"
                                                    :show-placeholder="true"
                                                    value="{{ $track->stye }}"></form-input>
                                    </div>
                                    <div class="col xs-12 md-6">
                                        <form-input name="cdbaby"
                                                    :max-length="{{ config('validation.track.cdbaby.max') }}"
                                                    :show-placeholder="true"
                                                    value="{{ $track->cdbaby }}"></form-input>
                                    </div>
                                    <div class="col xs-12 md-6">
                                        <form-input name="amazon"
                                                    :max-length="{{ config('validation.track.amazon.max') }}"
                                                    :show-placeholder="true"
                                                    value="{{ $track->amazon }}"></form-input>
                                    </div>
                                    <div class="col xs-12 md-6">
                                        <form-input name="iTunes"
                                                    :max-length="{{ config('validation.track.itunes.max') }}"
                                                    :show-placeholder="true"
                                                    value="{{ $track->iTunes }}"></form-input>
                                    </div>
                                    <div class="col xs-12 md-6">
                                        <form-input name="youtube"
                                                    :max-length="{{ config('validation.track.youtube.max') }}"
                                                    :show-placeholder="true"
                                                    value="{{ $track->youtube }}"></form-input>
                                    </div>
                                </div>
                            </panel>
                    </div>
                    <div class="col xs-12">
                        <panel title="{{ trans('action.upload_track') }}">
                            <hidden-input name="file" :required="true" v-model="trackFile"></hidden-input>
                            <div class="center m-b-10 m-t-10">
                                <phoenix-audio ref="audioPlayer" v-show="trackFile" :file="loadedTrackFile"></phoenix-audio>
                                <span v-if="!trackFile" class="text-muted small">{{ trans('messages.no_file') }}</span>
                            </div>
                            <div class="btn-group center">
                                <a class="btn btn-secondary" v-on:click="showFileMediaManager = true">
                                    <icon icon="{{ config('icons.upload') }}"></icon>
                                    <span>{{ trans('action.choose_file') }}</span>
                                </a>
                            </div>
                            <media-modal v-if="showFileMediaManager" v-on:close="showFileMediaManager = false">
                                <media-manager :is-modal="true" :selected-event-name="selectedFileEventName"
                                               v-on:close="showFileMediaManager = false"></media-manager>
                            </media-modal>
                            <form-input name="length"
                                        :show-placeholder="true"
                                        :required="true" lang-key="track"
                                        value="{{ $track->length }}"></form-input>
                            <form-input name="bpm"
                                        :show-placeholder="true"
                                        type="number" :required="true" lang-key="track"
                                        value="{{ $track->bpm }}"></form-input>
                        </panel>
                    </div>
                </div>
            </div>
            <div class="col xs-12 md-4">
                <div class="row">
                    <div class="col xs-12">
                        <panel title="{{ trans('action.choose_cover') }}">
                            <hidden-input name="image" v-model="trackImage"></hidden-input>
                            <div class="center m-b-10 m-t-10">
                                <img v-if="trackImage" class="img-responsive" :src="trackImage">
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
                        <panel title="{{ trans('labels.categories') }}">
                            <form-select name="categories" :value="{{ $track->categories ? $track->categories->pluck('id') : 'null' }}" :show-placeholder="true" lang-key="track" :multiple="true">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </form-select>
                        </panel>
                    </div>
                    <div class="col xs-12">
                        <panel title="{{ trans('labels.tags') }}">
                            <form-textarea name="tags" :show-placeholder="true"
                                           lang-key="track" value="{{ $track->tags }}"></form-textarea>
                        </panel>
                    </div>
                    <div class="col xs-12">
                        <panel title="{{ trans('action.publish') }}">

                            <form-date-input name="published_at" :required="true"
                                                 lang-key="track"
                                                 value="{{ $track->published_at ?? \Carbon\Carbon::now() }}"></form-date-input>

                            <div class="btn-group center">
                                <a href="{{ url()->previous() }}" class="btn btn-warning">
                                    <icon icon="{{ config('icons.back') }}"></icon>
                                    <span>{{ trans('labels.back') }}</span>
                                </a>

                                @if($isEditPage)
                                    <form-button action="{{ $track->getDestroyPath() }}"
                                                 alert-key="track"
                                                 object-name="{{ $track->title }}"
                                                 redirect="{{ $track->getIndexPath() }}">
                                        <icon icon="{{ config('icons.delete') }}"></icon>
                                        <span>{{ trans('action.delete_track') }}</span>
                                    </form-button>

                                    <a href="{{ $track->getPath() }}" target="_blank" type="button"
                                       class="btn btn-primary">
                                        <icon icon="{{ config('icons.track') }}"></icon>
                                        <span>{{ trans('action.show_track') }}</span>
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
                    trackImage: "{{ $track->image }}",
                    selectedCoverEventName: "cover",
                    showFileMediaManager: false,
                    loadedTrackFile: "{{ $track->file }}",
                    trackFile: "{{ $track->file }}",
                    selectedFileEventName: "file",
                },

                watch: {
                    trackFile: function (val) {
                        this.$refs.audioPlayer.source = val;
                    },
                },

                created: function () {

                    window.eventHub.$on('media-manager-selected-cover', (file) => {
                        this.trackImage = file.relativePath;
                        this.showCoverMediaManager = false;
                    });

                    window.eventHub.$on('media-manager-selected-file', (file) => {
                        this.trackFile = file.relativePath;
                        this.showFileMediaManager = false;
                    });

                    window.eventHub.$on('media-manager-notification', function (message, type, time) {
                        showAlert(type, null, message, time);
                    });
                }
            });
        });
    </script>
@endpush