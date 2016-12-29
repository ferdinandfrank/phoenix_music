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
 * AlbumDeletedNotification
 * -----------------------
 * Notifies an user if an user deleted a post.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Notifications
 */
class AlbumDeletedNotification extends Notification {

    use Queueable;

    private $album;
    private $user;

    /**
     * Creates a new notification instance.
     *
     * @param Album $album
     * @param User $user
     */
    public function __construct(Album $album, User $user) {
        $this->album = $album;
        $this->user = $user;
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
            'user' => $this->user->name,
            'title' => $this->album->title
        ];
    }
}
