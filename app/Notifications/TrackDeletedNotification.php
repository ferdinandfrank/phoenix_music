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
 * TrackDeletedNotification
 * -----------------------
 * Notifies an user if an user deleted a post.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Notifications
 */
class TrackDeletedNotification extends Notification {

    use Queueable;

    private $track;
    private $user;

    /**
     * Creates a new notification instance.
     *
     * @param Track $track
     * @param User $user
     */
    public function __construct(Track $track, User $user) {
        $this->track = $track;
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
            'author' => $this->track->composer->name,
            'title' => $this->track->title
        ];
    }
}
