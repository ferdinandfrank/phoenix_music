@extends('backend.layout')

@section('title', trans('labels.tools'))
@section('description', Settings::blogDescriptionShort())

@section('breadcrumb')
    <li><span>{{ trans('labels.dashboard') }}</span></li>
    <li><span>{{ trans('labels.tools') }}</span></li>
@stop

@section('content')
    <div class="row">
        @can('enableMaintenance', \App\Models\User::class)
            <div class="col xs-12">
            @if($status === 1)
                <panel title="{{ trans('action.enable_maintenance_mode') }}">
                    <p>{{ trans('common.enable_maintenance_mode_description') }}</p>
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
                    <p>{{ trans('common.disable_maintenance_mode_description') }}</p>
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
                <p>{{ trans('common.export_data_description') }}</p>
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
            <panel title="{{ trans('action.manage_log') }}">
                <p>{{ trans('common.manage_log_description') }}</p>
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
                <p>{{ trans('common.create_database_backup_description') }}</p>
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
                <p>{{ trans('common.reset_index_description') }}</p>
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
                <p>{{ trans('common.clear_cache_description') }}</p>
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
