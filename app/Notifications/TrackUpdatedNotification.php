<?php

namespace App\Notifications;

use App\Models\NewsletterSubscriber;
use App\Models\Post;
use App\Models\Track;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * TrackUpdatedNotification
 * -----------------------
 * Notifies an user if an user updated a track.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Notifications
 */
class TrackUpdatedNotification extends Notification {

    use Queueable;

    private $track;
    private $user;
    private $updated;

    /**
     * Creates a new notification instance.
     *
     * @param Track $track
     * @param User  $user
     * @param array $updated
     */
    public function __construct(Track $track, User $user, array $updated) {
        $this->track = $track;
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
            'user' => $this->user->display_name,
            'author' => $this->track->composer->name,
            'key' => $this->track->getRouteKey(),
            'title' => $this->track->title,
            'updated' => implode(", ", $this->updated)
        ];
    }
}
