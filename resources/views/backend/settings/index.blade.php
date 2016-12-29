@extends('backend.layout')

@section('title', trans('labels.settings'))

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ route('settings.index') }}">{{ trans('labels.settings') }}</a></li>
@stop

@section('content')
    <ajax-form
            action="{{ route('settings.update') }}"
            method="PUT"
            alert-key="settings">
        <div class="row">
            <div class="col md-8 xs-12">
                <div class="row">
                    <div class="col xs-12">
                        <panel title="{{ trans('labels.general_settings') }}">
                            <div class="row">
                                <div class="col xs-12">
                                    <form-input name="title" value="{{ $settings['title']}}"
                                                :required="true"></form-input>
                                </div>
                                <div class="col xs-12">
                                    <form-input name="author" value="{{ $settings['author']}}"
                                                :required="true"></form-input>
                                </div>
                                <div class="col xs-12 md-6">
                                    <form-input name="email_contact" value="{{ $settings['email_contact']}}"
                                                :required="true"></form-input>
                                </div>
                                <div class="col xs-12 md-6">
                                    <form-input name="email_admin" value="{{ $settings['email_admin']}}"
                                                :required="true"></form-input>
                                </div>
                                <div class="col xs-12">
                                    <form-codearea name="description" help-path="{{ route('help') }}"
                                                   value="{{ $settings['description'] }}"></form-codearea>
                                </div>
                                <div class="col xs-12">
                                    <form-codearea name="imprint" help-path="{{ route('help') }}"
                                                   value="{{ $settings['imprint'] }}"></form-codearea>
                                </div>
                            </div>
                        </panel>
                    </div>
                    <div class="col xs-12 md-6">
                        <panel title="{{ trans('labels.networks') }}">
                            <div class="row">
                                <div class="col xs-12">
                                    <form-input name="facebook"
                                                :show-placeholder="true"
                                                value="{{ $settings['facebook']}}"></form-input>
                                </div>
                                <div class="col xs-12">
                                    <form-input name="youtube"
                                                :show-placeholder="true"
                                                value="{{ $settings['youtube']}}"></form-input>
                                </div>
                                <div class="col xs-12">
                                    <form-input name="twitter"
                                                :show-placeholder="true"
                                                value="{{ $settings['twitter']}}"></form-input>
                                </div>
                                <div class="col xs-12">
                                    <form-input name="stye"
                                                :show-placeholder="true"
                                                value="{{ $settings['stye']}}"></form-input>
                                </div>
                                <div class="col xs-12">
                                    <form-input name="audiojungle"
                                                :show-placeholder="true"
                                                value="{{ $settings['audiojungle']}}"></form-input>
                                </div>
                                <div class="col xs-12">
                                    <form-input name="cdbaby"
                                                :show-placeholder="true"
                                                value="{{ $settings['cdbaby']}}"></form-input>
                                </div>
                                <div class="col xs-12">
                                    <form-input name="iTunes"
                                                :show-placeholder="true"
                                                value="{{ $settings['iTunes']}}"></form-input>
                                </div>
                                <div class="col xs-12">
                                    <form-input name="amazon"
                                                :show-placeholder="true"
                                                value="{{ $settings['amazon']}}"></form-input>
                                </div>
                            </div>
                        </panel>
                    </div>
                    <div class="col xs-12 md-6">
                        <panel title="{{ trans('labels.advanced_settings') }}">
                            <div class="row">
                                <div class="col xs-12">
                                    <form-textarea name="keywords" value="{{ $settings['keywords']}}"></form-textarea>
                                </div>
                            </div>
                        </panel>
                    </div>
                </div>
            </div>
            <div class="col md-4 xs-12">
                <div class="row">
                    <div class="col xs-12">
                        <panel title="{{ trans('action.choose_logo') }}" subtitle="{{ trans('descriptions.logo') }}">
                            <input name="logo" type="hidden" v-model="logo"/>
                            <div class="center m-b-10 m-t-10">
                                <img v-if="logo" class="img-responsive" :src="logo">
                                <span v-else class="text-muted small">{{ trans('messages.no_image') }}</span>
                            </div>
                            <div class="btn-group center">
                                <a class="btn btn-secondary" v-on:click="showLogoMediaManager = true">
                                    <icon icon="{{ config('icons.upload') }}"></icon>
                                    <span>{{ trans('action.choose_logo') }}</span>
                                </a>
                            </div>
                            <media-modal v-if="showLogoMediaManager" v-on:close="showLogoMediaManager = false">
                                <media-manager :is-modal="true" :selected-event-name="selectedLogoEventName"
                                               v-on:close="showLogoMediaManager = false"></media-manager>
                            </media-modal>
                        </panel>
                    </div>
                    <div class="col xs-12">
                        <panel title="{{ trans('action.choose_cover') }}" subtitle="{{ trans('descriptions.cover') }}">
                            <input name="background" type="hidden" v-model="cover"/>
                            <div class="center m-b-10 m-t-10">
                                <img v-if="cover" class="img-responsive" :src="cover">
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
                        <panel title="{{ trans('action.choose_favicon') }}" subtitle="{{ trans('descriptions.favicon') }}">
                            <input name="favicon" type="hidden" v-model="favicon"/>
                            <div class="center m-b-10 m-t-10">
                                <img v-if="favicon" class="img-responsive" :src="favicon">
                                <span v-else class="text-muted small">{{ trans('messages.no_image') }}</span>
                            </div>
                            <div class="btn-group center">
                                <a class="btn btn-secondary" v-on:click="showFaviconMediaManager = true">
                                    <icon icon="{{ config('icons.upload') }}"></icon>
                                    <span>{{ trans('action.choose_favicon') }}</span>
                                </a>
                            </div>
                            <media-modal v-if="showFaviconMediaManager" v-on:close="showFaviconMediaManager = false">
                                <media-manager :is-modal="true" :selected-event-name="selectedFaviconEventName"
                                               v-on:close="showFaviconMediaManager = false"></media-manager>
                            </media-modal>
                        </panel>
                    </div>
                    <div class="col xs-12">
                        <panel title="{{ trans('action.choose_intro_video') }}" subtitle="{{ trans('descriptions.intro_video') }}">
                            <input name="intro_video" type="hidden" v-model="intro_video"/>
                            <div class="center m-b-10 m-t-10">
                                <video v-if="intro_video" autoplay muted loop class="img-responsive">
                                    <source :src="intro_video" type="video/mp4">
                                </video>
                                <span v-else class="text-muted small">{{ trans('messages.no_video') }}</span>
                            </div>
                            <div class="btn-group center">
                                <a class="btn btn-secondary" v-on:click="showIntroVideoMediaManager = true">
                                    <icon icon="{{ config('icons.upload') }}"></icon>
                                    <span>{{ trans('action.choose_intro_video') }}</span>
                                </a>
                            </div>
                            <media-modal v-if="showIntroVideoMediaManager" v-on:close="showIntroVideoMediaManager = false">
                                <media-manager :is-modal="true" :selected-event-name="selectedIntroVideoEventName"
                                               v-on:close="showIntroVideoMediaManager = false"></media-manager>
                            </media-modal>
                        </panel>
                    </div>
                    <div class="col xs-12">
                        <panel title="{{ trans('labels.actions') }}">
                            <div class="btn-group center">
                                <button type="submit" class="btn btn-success">
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
                showLogoMediaManager: false,
                showCoverMediaManager: false,
                showFaviconMediaManager: false,
                showIntroVideoMediaManager: false,
                logo: "{{ $settings['logo']}}",
                cover: "{{ $settings['background']}}",
                favicon: "{{ $settings['favicon']}}",
                intro_video: "{{ $settings['intro_video']}}",
                selectedLogoEventName: "logo",
                selectedCoverEventName: "cover",
                selectedFaviconEventName: "favicon",
                selectedIntroVideoEventName: "intro_video"
            },
            created: function () {
                window.eventHub.$on('media-manager-selected-logo', function (file) {
                    this.logo = file.relativePath;
                    this.showLogoMediaManager = false;
                }.bind(this));

                window.eventHub.$on('media-manager-selected-cover', function (file) {
                    this.cover = file.relativePath;
                    this.showCoverMediaManager = false;
                }.bind(this));

                window.eventHub.$on('media-manager-selected-favicon', function (file) {
                    this.favicon = file.relativePath;
                    this.showFaviconMediaManager = false;
                }.bind(this));

                window.eventHub.$on('media-manager-selected-intro_video', function (file) {
                    this.intro_video = file.relativePath;
                    this.showIntroVideoMediaManager = false;
                }.bind(this));

                window.eventHub.$on('media-manager-notification', function (message, type, time) {
                    showAlert(type, null, message, time);
                });
            }
        });
    });
</script>
@endpush

