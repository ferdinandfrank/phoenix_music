@include('backend.notifications.layout', [
    'link' => route('users.index'),
    'icon' => config('icons.user'),
    'title' => trans('notifications.user_deleted.title'),
    'message' => trans('notifications.user_deleted.text', [
                    'user' => $notification->data['user'],
                    'name' => $notification->data['name']
                    ])
])
