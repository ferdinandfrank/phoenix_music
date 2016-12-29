@include('backend.notifications.layout', [
    'link' => route('albums.index'),
    'icon' => config('icons.album'),
    'title' => trans('notifications.album_deleted.title'),
    'message' => trans('notifications.album_deleted.text', [
                    'user' => $notification->data['user'],
                    'title' => $notification->data['title']
                    ])
])
