@extends('backend.layout')

@section('title', trans('labels.users'))
@section('description', Settings::blogDescriptionShort())

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ route('users.index') }}">{{ trans('labels.users') }}</a></li>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <panel title="{{ trans('labels.users') }}" subtitle="{{ trans('common.users_index_description') }}...">
                <table class="table striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('labels.display_name') }}</th>
                        <th>{{ trans('labels.email') }}</th>
                        <th>{{ trans('labels.birthday') }}</th>
                        <th>{{ trans('labels.gender') }}</th>
                        <th>{{ trans('labels.user_type') }}</th>
                        <th>{{ trans('labels.job') }}</th>
                        <th class="center">{{ trans('labels.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr id="user-{{ $user->id }}">
                            <td>{{ $user->id }}</td>
                            <td>
                                <a href="{{ $user->getPath() }}">
                                    {{ $user->display_name }}
                                </a>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->birthday ? $user->birthday->toDateString() : '-' }}</td>
                            <td>{{ $user->getGenderName() }}</td>
                            <td>{{ trans('input.user_types.' . array_search($user->user_type, config('user_type'))) }}</td>
                            <td>{{ $user->job ?? '-' }}</td>
                            <td class="btn-group">
                                @can('update', $user)
                                    <a href="{{ $user->getEditPath() }}" class="btn btn-xs btn-success">
                                        <icon icon="{{ config('icons.edit') }}"></icon>
                                    </a>
                                @endcan
                                @can('delete', $user)
                                    <form-button action="{{ $user->getDestroyPath() }}"
                                                 object-name="{{ $user->display_name }}"
                                                 alert-key="user" remove="#user-{{ $user->id }}"
                                                 size="xs">
                                        <icon icon="{{ config('icons.delete') }}"></icon>
                                    </form-button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
                @can('store', \App\Models\User::class)
                    <div class="btn-group flex-reverse m-t-20">
                        <a href="{{ route('users.create') }}" class="btn btn-success">
                            <icon icon="{{ config('icons.add') }}"></icon>
                            <span>{{ trans('action.create_user') }}</span>
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
