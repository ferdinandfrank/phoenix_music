@extends('backend.layout')

@section('title', $isEditPage ? trans('action.edit_user') : trans('action.create_user'))

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
            action="{{ $isEditPage ? $user->getUpdatePath() : $user->getStorePath() }}"
            method="{{ $isEditPage ? 'PUT' : 'POST' }}"
            alert-key="user"
            redirect="{{ $user->getIndexPath() }}"
            object-name="{{ $user->name }}">
        <div class="row">
            <div class="col md-8 xs-12">
                <div class="row">
                    <div class="col xs-12">

                        @if($isEditPage)
                            <panel title="{{ trans('action.edit_user') }}: {{ $user->name }}"
                                   subtitle="{{ $user->updated_at ? trans('param_labels.last_edited', ['date' => toDateString($user->updated_at), 'time' => $user->updated_at->toTimeString()]) : '' }}">
                                @else
                                    <panel title="{{ trans('action.create_user') }}">
                                        @endif
                                        <div class="row">
                                            <div class="col xs-12">
                                                <form-input name="name"
                                                            :required="true"
                                                            :max-length="{{ config('validation.user.name.max') }}"
                                                            value="{{ $user->name }}"></form-input>
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
                                            @can('update-roles', $user)
                                                <div class="col xs-12 lg-6">
                                                    <form-select name="user_type" :value="{{ $user->user_type ?? 'null' }}" :required="true">
                                                        @foreach(config('user_type') as $userType => $id)
                                                            <option value="{{ $id }}">{{ trans('input.user_types.' . $userType) }}</option>
                                                        @endforeach
                                                    </form-select>
                                                </div>
                                                <div class="col xs-12 lg-6">
                                                    <form-input name="role"
                                                                :max-length="{{ config('validation.user.role.max') }}"
                                                                value="{{ $user->role }}"></form-input>
                                                </div>
                                            @endcan
                                            <div class="col xs-12">
                                                <form-codearea name="about" lang-key="user"
                                                               value="{{ $user->about }}"></form-codearea>
                                            </div>
                                        </div>
                                    </panel>
                    </div>
                    <div class="col xs-12">
                        <panel title="{{ trans('labels.networks') }}">
                            <div class="row">
                                <div class="col xs-12 lg-6">
                                    <form-input name="url"
                                                :show-placeholder="true"
                                                :max-length="{{ config('validation.user.url.max') }}"
                                                value="{{ $user->url }}"></form-input>
                                </div>
                                <div class="col xs-12 lg-6">
                                    <form-input name="twitter"
                                                :show-placeholder="true"
                                                :max-length="{{ config('validation.user.twitter.max') }}"
                                                value="{{ $user->twitter }}"></form-input>
                                </div>
                                <div class="col xs-12 lg-6">
                                    <form-input name="facebook"
                                                :show-placeholder="true"
                                                :max-length="{{ config('validation.user.facebook.max') }}"
                                                value="{{ $user->facebook }}"></form-input>
                                </div>
                                <div class="col xs-12 lg-6">
                                    <form-input name="github"
                                                :show-placeholder="true"
                                                :max-length="{{ config('validation.user.github.max') }}"
                                                value="{{ $user->github }}"></form-input>
                                </div>
                                <div class="col xs-12 lg-6">
                                    <form-input name="linkedin"
                                                :show-placeholder="true"
                                                :max-length="{{ config('validation.user.linkedin.max') }}"
                                                value="{{ $user->linkedin }}"></form-input>
                                </div>
                                <div class="col xs-12 lg-6">
                                    <form-input name="instagram"
                                                :show-placeholder="true"
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
                            <hidden-input name="image" v-model="avatar"></hidden-input>
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
                                    <div class="col xs-12">
                                        <form-input type="password"
                                                    :min-length="{{ config('validation.user.password.min') }}"
                                                    :max-length="{{ config('validation.user.password.max') }}"
                                                    name="password"></form-input>
                                    </div>
                                    <div class="col xs-12">
                                        <form-input type="password" :confirmed="true" name="password_confirmation"></form-input>
                                    </div>
                                </div>
                            </panel>
                        </div>
                    @endcan
                    <div class="col xs-12">
                        <panel title="{{ trans('action.save') }}">
                            <div class="btn-group center">
                                <a href="{{ url()->previous() }}" class="btn btn-warning">
                                    <icon icon="{{ config('icons.back') }}"></icon>
                                    <span>{{ trans('labels.back') }}</span>
                                </a>

                                @if($isEditPage)
                                    <form-button action="{{ $user->getDestroyPath() }}"
                                                 object-name="{{ $user->name }}"
                                                 alert-key="user"
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
                avatar: "{{ $user->image }}",
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
