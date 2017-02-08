@include('backend.notifications.layout', [
    'link' => route('settings.index'),
    'icon' => config('icons.settings'),
    'title' => trans('notifications.settings_updated.title'),
    'message' => trans('notifications.settings_updated.text', [
                    'user' => $notification->data['user']
                    ])
])