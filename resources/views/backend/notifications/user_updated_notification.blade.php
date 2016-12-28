@include('backend.notifications.layout', [
    'link' => route('users.edit', [$notification->data['key']]),
    'icon' => config('icons.user'),
    'title' => trans('notifications.user_updated.title'),
    'message' => trans('notifications.user_updated.text', [
                    'user' => $notification->data['user'],
                    'updated' => $notification->data['updated']
                    ])
])
