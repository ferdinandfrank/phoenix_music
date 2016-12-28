@include('backend.notifications.layout', [
    'link' => route('tracks.index'),
    'icon' => config('icons.track'),
    'title' => trans('notifications.track_deleted.title'),
    'message' => trans('notifications.track_deleted.text', [
                    'user' => $notification->data['user'],
                    'title' => $notification->data['title'],
                    'author' => $notification->data['author']
                    ])
])
