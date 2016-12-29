<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

/**
 * UserDeletedNotification
 * -----------------------
 * Notifies an user if an user deletes a user.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Notifications
 */
class UserDeletedNotification extends Notification {

    use Queueable;

    private $user;

    private $initiator;

    /**
     * Creates a new notification instance.
     *
     * @param User $user
     * @param User $initiator
     */
    public function __construct(User $user, User $initiator) {
        $this->user = $user;
        $this->initiator = $initiator;
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
            'user' => $this->initiator->name,
            'name' => $this->user->name
        ];
    }
}
