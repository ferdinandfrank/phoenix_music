@include('backend.notifications.layout', [
    'link' => route('tracks.show', [$notification->data['key']]),
    'icon' => config('icons.track'),
    'title' => trans('notifications.track_updated.title'),
    'message' => trans('notifications.track_updated.text', [
                    'user' => $notification->data['user'],
                    'title' => $notification->data['title'],
                    'author' => $notification->data['author'],
                    'updated' => $notification->data['updated']
                    ])
])
