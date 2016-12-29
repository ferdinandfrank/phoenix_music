<?php

namespace App\Notifications;

use App\Models\NewsletterSubscriber;
use App\Models\Post;
use App\Models\Album;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * AlbumCreatedNotification
 * -----------------------
 * Notifies an user if an user created a post.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Notifications
 */
class AlbumCreatedNotification extends Notification {

    use Queueable;

    private $album;
    private $uploader;

    /**
     * Creates a new notification instance.
     *
     * @param Album $album
     * @param User  $uploader
     */
    public function __construct(Album $album, User $uploader) {
        $this->album = $album;
        $this->uploader = $uploader;
    }

    /**
     * Gets the notification's delivery channels.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable) {
        return ['database'];
    }

    /**
     * Gets the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable) {
        return [
            'user' => $this->uploader->name,
            'key' => $this->album->getRouteKey(),
            'title' => $this->album->title
        ];
    }
}
