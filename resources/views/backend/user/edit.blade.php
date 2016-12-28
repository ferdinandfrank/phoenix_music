@extends('backend.layout')

@section('title', $isEditPage ? trans('action.edit_user') : trans('action.create_user'))
@section('description', Settings::blogDescriptionShort())

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ $user->getIndexPath() }}">{{ trans('labels.users') }}</a></li>
    @if($isEditPage)
        <li><a href="{{ $user->getEditPath() }}">{{ trans('action.edit_user') }}</a></li>
    @else
        <li><a href="{{ $user->getCreatePath() }}">{{ trans('action.create_user') }}</a></li>
    @endif
@stop

@section('content')
    <ajax-form
            action="{{ $user->getStorePath() }}"
            update-action="{{ $user->getUpdatePath() }}"
            update-key="{{ $user->getRouteKeyName() }}"
            method="{{ $isEditPage ? 'PUT' : 'POST' }}"
            alert-key="user"
            redirect="{{ $user->getIndexPath() }}"
            object-name="{{ $user->display_name }}">
        <div class="row">
            <div class="col md-8 xs-12">
                <div class="row">
                    <div class="col xs-12">

                        @if($isEditPage)
                            <panel title="{{ trans('action.edit_user') }}: {{ $user->display_name }}"
                                   subtitle="{{ $user->updated_at ? trans('param_labels.last_edited', ['date' => $user->updated_at->toDateString(), 'time' => $user->updated_at->toTimeString()]) : '' }}">
                                @else
                                    <panel title="{{ trans('action.create_user') }}">
                                        @endif
                                        <div class="row">
                                            <div class="col xs-12 lg-6">
                                                <form-input name="first_name"
                                                            :max-length="{{ config('validation.user.first_name.max') }}"
                                                            value="{{ $user->first_name }}"></form-input>
                                            </div>
                                            <div class="col xs-12 lg-6">
                                                <form-input name="last_name"
                                                            :max-length="{{ config('validation.user.last_name.max') }}"
                                                            value="{{ $user->last_name }}"></form-input>
                                            </div>
                                            <div class="col xs-12">
                                                <form-input name="display_name" value="{{ $user->display_name }}"
                                                            :max-length="{{ config('validation.user.display_name.max') }}"
                                                            :required="true"></form-input>
                                            </div>
                                            <div class="col xs-12 lg-6">
                                                <form-input name="email" type="email" value="{{ $user->email }}"
                                                            :max-length="{{ config('validation.user.email.max') }}"
                                                            :required="true"></form-input>
                                            </div>
                                            <div class="col xs-12 lg-6">
                                                <form-date-input name="birthday"
                                                                 value="{{ $user->birthday }}"></form-date-input>
                                            </div>
                                            <div class="col xs-12 lg-6">
                                                <form-select name="gender" :required="true">
                                                    <option value="m" {{ $user->gender != 'w' ? 'selected' : '' }}>{{ trans('labels.male') }}</option>
                                                    <option value="w" {{ $user->gender == 'w' ? 'selected' : '' }}>{{ trans('labels.female') }}</option>
                                                </form-select>
                                            </div>
                                            @can('update-roles', $user)
                                                <div class="col xs-12 lg-6">
                                                    <form-select name="user_type" lang-key="user" :required="true">
                                                        @foreach(config('user_type') as $userType => $id)
                                                            <option value="{{ $id }}" {{ $user->user_type == $id ? 'selected' : '' }}>{{ trans('input.user_types.' . $userType) }}</option>
                                                        @endforeach
                                                    </form-select>
                                                </div>
                                                <div class="col xs-12 lg-6">
                                                    <form-input name="job"
                                                                :max-length="{{ config('validation.user.job.max') }}"
                                                                value="{{ $user->job }}"></form-input>
                                                </div>
                                            @endcan
                                            <div class="col xs-12">
                                                <form-textarea name="bio" lang-key="user"
                                                               value="{{ $user->bio }}"></form-textarea>
                                            </div>
                                        </div>
                                    </panel>
                    </div>
                    <div class="col xs-12">
                        <panel title="{{ trans('labels.social_networks') }}">
                            <div class="row">
                                <div class="col xs-12 lg-6">
                                    <form-input name="url"
                                                :max-length="{{ config('validation.user.url.max') }}"
                                                value="{{ $user->url }}"></form-input>
                                </div>
                                <div class="col xs-12 lg-6">
                                    <form-input name="twitter"
                                                :max-length="{{ config('validation.user.twitter.max') }}"
                                                value="{{ $user->twitter }}"></form-input>
                                </div>
                                <div class="col xs-12 lg-6">
                                    <form-input name="facebook"
                                                :max-length="{{ config('validation.user.facebook.max') }}"
                                                value="{{ $user->facebook }}"></form-input>
                                </div>
                                <div class="col xs-12 lg-6">
                                    <form-input name="github"
                                                :max-length="{{ config('validation.user.github.max') }}"
                                                value="{{ $user->github }}"></form-input>
                                </div>
                                <div class="col xs-12 lg-6">
                                    <form-input name="linkedin"
                                                :max-length="{{ config('validation.user.linkedin.max') }}"
                                                value="{{ $user->linkedin }}"></form-input>
                                </div>
                                <div class="col xs-12 lg-6">
                                    <form-input name="instagram"
                                                :max-length="{{ config('validation.user.instagram.max') }}"
                                                value="{{ $user->instagram }}"></form-input>
                                </div>
                            </div>
                        </panel>
                    </div>
                </div>
            </div>
            <div class="col md-4 xs-12">
                <div class="row">
                    <div class="col sm-12">
                        <panel title="{{ trans('action.choose_avatar') }}">
                            <input name="avatar" type="hidden" v-model="avatar"/>
                            <div class="center m-b-10 m-t-10">
                                <img v-if="avatar" class="avatar" :src="avatar">
                                <span v-else class="text-muted small">{{ trans('messages.no_avatar') }}</span>
                            </div>
                            <div class="btn-group center">
                                <a class="btn btn-secondary" v-on:click="showMediaManager = true">
                                    <icon icon="{{ config('icons.upload') }}"></icon>
                                    <span>{{ trans('action.choose_avatar') }}</span>
                                </a>
                            </div>
                            <media-modal v-if="showMediaManager" v-on:close="showMediaManager = false">
                                <media-manager :is-modal="true" :selected-event-name="selectedEventName"
                                               v-on:close="showMediaManager = false"></media-manager>
                            </media-modal>
                        </panel>
                    </div>
                    @can('update-password', $user)
                        <div class="col xs-12">
                            <panel title="{{ trans('action.change_password') }}">
                                <div class="row">
                                    <div class="col xs-12 lg-6">
                                        <form-input type="password" name="password"></form-input>
                                    </div>
                                    <div class="col xs-12 lg-6">
                                        <form-input type="password" name="password_confirmation"></form-input>
                                    </div>
                                </div>
                            </panel>
                        </div>
                    @endcan
                    <div class="col xs-12">
                        <panel title="{{ trans('action.save') }}">
                            <div class="btn-group center">
                                @if($isEditPage)
                                    <form-button action="{{ $user->getDestroyPath() }}"
                                                 redirect="{{ $user->getIndexPath() }}">
                                        <icon icon="{{ config('icons.delete') }}"></icon>
                                        <span>{{ trans('action.delete_user') }}</span>
                                    </form-button>

                                    <a href="{{ $user->getPath() }}" type="button" class="btn btn-primary">
                                        <icon icon="{{ config('icons.user') }}"></icon>
                                        <span>{{ trans('action.show_user') }}</span>
                                    </a>
                                @endif

                                <button type="submit" class="btn btn-success">
                                    @if($isEditPage)
                                        <icon icon="{{ config('icons.save') }}"></icon>
                                        <span>{{ trans('action.save') }}</span>
                                    @else
                                        <icon icon="{{ config('icons.save') }}"></icon>
                                        <span>{{ trans('action.create_user') }}</span>
                                    @endif
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
                avatar: "{{ $user->avatar }}",
                selectedEventName: "avatar"
            },
            created: function () {
                window.eventHub.$on('media-manager-selected-avatar', function (file) {
                    this.avatar = file.relativePath;
                    this.showMediaManager = false;
                }.bind(this));

                window.eventHub.$on('media-manager-notification', function (message, type, time) {
                    showAlert(type, null, message, time);
                });
            }
        });
    });
</script>
@endpush
