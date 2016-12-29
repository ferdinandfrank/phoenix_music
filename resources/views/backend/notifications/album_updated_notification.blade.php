@include('backend.notifications.layout', [
    'link' => route('albums.index'),
    'icon' => config('icons.album'),
    'title' => trans('notifications.album_updated.title'),
    'message' => trans('notifications.album_updated.text', [
                    'user' => $notification->data['user'],
                    'title' => $notification->data['title'],
                    'updated' => $notification->data['updated']
                    ])
])