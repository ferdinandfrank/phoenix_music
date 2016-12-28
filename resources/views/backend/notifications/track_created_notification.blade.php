@include('backend.notifications.layout', [
    'link' => route('tracks.show', [$notification->data['key']]),
    'icon' => config('icons.icons.track'),
    'title' => trans('notifications.track_created.title'),
    'message' => trans('notifications.track_created.text', [
                    'user' => $notification->data['user'],
                    'title' => $notification->data['title']
                    ])
])
