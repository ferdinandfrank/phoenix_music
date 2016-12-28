<li>
    <a href="{{ $link }}" class="{{ empty($notification->read_at) ? 'unread' : '' }}">
        <p class="title">
            <icon icon="{{ $icon }}"></icon>
            <span>{{ $title }}</span>
        </p>
        <span class="message">{{ $message }}</span>
        <span class="date">{{ $notification->created_at->diffForHumans() }}</span>
    </a>
</li>