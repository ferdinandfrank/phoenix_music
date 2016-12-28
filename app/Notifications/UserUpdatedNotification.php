<?php

namespace App\Notifications;

use App\Models\Category;
use App\Models\NewsletterSubscriber;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * UserUpdatedNotification
 * -----------------------
 * Notifies an user if another user updated his profile.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Notifications
 */
class UserUpdatedNotification extends Notification {

    use Queueable;

    private $user;
    private $creator;
    private $updated;

    /**
     * Creates a new notification instance.
     *
     * @param User  $user
     * @param User  $creator
     * @param array $updated
     */
    public function __construct(User $user, User $creator, array $updated) {
        $this->user = $user;
        $this->creator = $creator;
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
            'key' => $this->user->getRouteKey(),
            'user' => $this->creator->name,
            'updated' => implode(", ", $this->updated)
        ];
    }
}
