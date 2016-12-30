@extends('backend.layout')

@section('title', trans('labels.tools'))

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ route('tools.index') }}">{{ trans('labels.tools') }}</a></li>
@stop

@section('content')
    <div class="row">
        @can('enableMaintenance', \App\Models\User::class)
            <div class="col xs-12">
            @if($status === 1)
                <panel title="{{ trans('action.enable_maintenance_mode') }}">
                    <p>{{ trans('descriptions.enable_maintenance_mode') }}</p>
                    <div class="btn-group flex-reverse">
                        <form-button :confirm="true" alert-key="enable_maintenance_mode"
                                     redirect="{{ route('tools.index') }}"
                                     action="{{ route('tools.enable_maintenance_mode') }}" color="warning"
                                     method="POST">
                            <i class="{{ config('icons.maintenance') }}"></i>
                            <span>{{ trans('action.enable_maintenance_mode') }}</span>
                        </form-button>
                    </div>
                </panel>
            @else
                <panel title="{{ trans('action.disable_maintenance_mode') }}">
                    <p>{{ trans('descriptions.disable_maintenance_mode') }}</p>
                    <div class="btn-group flex-reverse">
                        <form-button :confirm="true" alert-key="disable_maintenance_mode"
                                     redirect="{{ route('tools.index') }}"
                                     action="{{ route('tools.disable_maintenance_mode') }}" color="success"
                                     method="POST">
                            <i class="{{ config('icons.maintenance') }}"></i>
                            <span>{{ trans('action.disable_maintenance_mode') }}</span>
                        </form-button>
                    </div>
                </panel>
            @endif
            </div>
        @endcan
        <div class="col xs-12">
            <panel title="{{ trans('action.export_data') }}">
                <p>{{ trans('descriptions.export_data') }}</p>
                <div class="btn-group flex-reverse">
                    <form method="POST" action="{{ route('tools.download_archive') }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">
                            <i class="{{ config('icons.download') }}"></i>
                            <span>{{ trans('action.export_data') }}</span>
                        </button>
                    </form>
                </div>
            </panel>
        </div>
        <div class="col xs-12">
            <panel title="{{ trans('action.send_test_mail') }}">
                <p>{{ trans('descriptions.send_test_mail') }}</p>
                <div class="btn-group flex-reverse">
                    <form-button alert-key="send_test_mail"
                                 action="{{ route('tools.mail') }}"
                                 color="success"
                                 method="POST">
                        <i class="{{ config('icons.email') }}"></i>
                        <span>{{ trans('action.send_test_mail') }}</span>
                    </form-button>
                </div>
            </panel>
        </div>
        <div class="col xs-12">
            <panel title="{{ trans('action.manage_log') }}">
                <p>{{ trans('descriptions.manage_log') }}</p>
                <div class="btn-group flex-reverse">
                    <form method="POST" action="{{ route('tools.download_log') }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">
                            <i class="{{ config('icons.download') }}"></i>
                            <span>{{ trans('action.download_log') }}</span>
                        </button>
                    </form>
                </div>
                <div class="btn-group flex-reverse">
                    <form-button alert-key="clear_log" action="{{ route('tools.clear_log') }}"
                                 color="warning" method="POST">
                        <i class="{{ config('icons.refresh') }}"></i> <span>{{ trans('action.clear_log') }}</span>
                    </form-button>
                </div>
            </panel>
        </div>
        <div class="col xs-12">
            <panel title="{{ trans('action.create_database_backup') }}">
                <p>{{ trans('descriptions.create_database_backup') }}</p>
                <div class="btn-group flex-reverse">
                    <form-button alert-key="create_backup" action="{{ route('tools.backup') }}"
                                 color="primary" method="POST">
                        <i class="{{ config('icons.store') }}"></i> <span>{{ trans('action.create_database_backup') }}</span>
                    </form-button>
                </div>
            </panel>
        </div>
        <div class="col xs-12">
            <panel title="{{ trans('action.reset_index') }}">
                <p>{{ trans('descriptions.reset_index') }}</p>
                <div class="btn-group flex-reverse">
                    <form-button alert-key="reset_index" action="{{ route('tools.reset_index') }}"
                                 color="primary" method="POST">
                        <i class="{{ config('icons.refresh') }}"></i> <span>{{ trans('action.reset_index') }}</span>
                    </form-button>
                </div>
            </panel>
        </div>
        <div class="col xs-12">
            <panel title="{{ trans('action.clear_cache') }}">
                <p>{{ trans('descriptions.clear_cache') }}</p>
                <div class="btn-group flex-reverse">
                    <form-button :confirm="true" alert-key="clear_cache" action="{{ route('tools.cache_clear') }}" color="warning" method="POST">
                        <i class="{{ config('icons.refresh') }}"></i> <span>{{ trans('action.clear_cache') }}</span>
                    </form-button>
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
