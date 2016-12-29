@include('backend.notifications.layout', [
    'link' => route('albums.index'),
    'icon' => config('icons.album'),
    'title' => trans('notifications.album_created.title'),
    'message' => trans('notifications.album_created.text', [
                    'user' => $notification->data['user'],
                    'title' => $notification->data['title']
                    ])
])