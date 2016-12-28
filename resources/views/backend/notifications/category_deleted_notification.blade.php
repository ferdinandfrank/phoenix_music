@include('backend.notifications.layout', [
    'link' => route('categories.index'),
    'icon' => config('icons.category'),
    'title' => trans('notifications.category_deleted.title'),
    'message' => trans('notifications.category_deleted.text', [
                    'user' => $notification->data['user'],
                    'title' => $notification->data['title']
                    ])
])
