@include('backend.notifications.layout', [
    'link' => route('users.index'),
    'icon' => config('icons.user'),
    'title' => trans('notifications.user_created.title'),
    'message' => trans('notifications.user_created.text', [
                    'user' => $notification->data['user'],
                    'name' => $notification->data['name']
                    ])
])
