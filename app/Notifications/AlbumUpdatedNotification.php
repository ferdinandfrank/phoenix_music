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
 * AlbumUpdatedNotification
 * -----------------------
 * Notifies an user if an user updated a album.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Notifications
 */
class AlbumUpdatedNotification extends Notification {

    use Queueable;

    private $album;
    private $user;
    private $updated;

    /**
     * Creates a new notification instance.
     *
     * @param Album $album
     * @param User  $user
     * @param array $updated
     */
    public function __construct(Album $album, User $user, array $updated) {
        $this->album = $album;
        $this->user = $user;
        $this->updated = $updated;
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
            'key' => $this->album->getRouteKey(),
            'title' => $this->album->title,
            'updated' => implode(", ", $this->updated)
        ];
    }
}
