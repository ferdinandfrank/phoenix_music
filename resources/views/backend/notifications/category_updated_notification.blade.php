@include('backend.notifications.layout', [
    'link' => route('categories.index'),
    'icon' => config('icons.category'),
    'title' => trans('notifications.category_updated.title'),
    'message' => trans('notifications.category_updated.text', [
                    'user' => $notification->data['user'],
                    'title' => $notification->data['title'],
                    'updated' => $notification->data['updated']
                    ])
])