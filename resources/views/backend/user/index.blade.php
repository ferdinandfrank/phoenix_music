@extends('backend.layout')

@section('title', trans('labels.users'))

@section('breadcrumb')
    <li><a href="{{ route('admin') }}">{{ trans('labels.dashboard') }}</a></li>
    <li><a href="{{ route('users.index') }}">{{ trans('labels.users') }}</a></li>
@stop

@section('content')
    <div class="row">
        <div class="col">
            <panel title="{{ trans('labels.users') }}" subtitle="{{ trans('descriptions.users_index') }}...">
                <data-table lang-key="user" search-value="{{ request()->input('search') }}"
                            :count-value="{{ $entries_count }}">
                    <table class="table striped">
                        <thead>
                        <tr>
                            <th>@sortablelink('name', trans('input.name'))</th>
                            <th>@sortablelink('email', trans('input.email'))</th>
                            <th>@sortablelink('birthday', trans('input.birthday'))</th>
                            <th>@sortablelink('user_type', trans('input.user_type'))</th>
                            <th>@sortablelink('role', trans('input.role'))</th>
                            <th>@sortablelink('tracks_count', trans('labels.composed_tracks'))</th>
                            <th class="center">{{ trans('labels.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr id="user-{{ $user->id }}"
                                class="{{ $newUserKeys->contains($user->getRouteKey()) ? 'new' : '' }}">
                                <td>
                                    <a href="{{ $user->getPath() }}">
                                        {{ $user->name }}
                                    </a>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->birthday ? $user->birthday->toDateString() : '-' }}</td>
                                <td>{{ $user->getTypeAsString() }}</td>
                                <td>{{ $user->role ?? '-' }}</td>
                                <td>{{ $user->tracks_count }}</td>
                                <td class="btn-group">
                                    @can('update', $user)
                                        <a href="{{ $user->getEditPath() }}" class="btn btn-xs btn-success">
                                            <icon icon="{{ config('icons.edit') }}"></icon>
                                        </a>
                                    @endcan
                                    @can('delete', $user)
                                        <form-button action="{{ $user->getDestroyPath() }}"
                                                     object-name="{{ $user->name }}"
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
                </data-table>
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
