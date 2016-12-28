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
 * UserCreatedNotification
 * -----------------------
 * Notifies an user if an user created a new user.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Notifications
 */
class UserCreatedNotification extends Notification {

    use Queueable;

    private $user;

    private $creator;

    /**
     * Creates a new notification instance.
     *
     * @param User $user
     * @param User     $creator
     */
    public function __construct(User $user, User $creator) {
        $this->user = $user;
        $this->creator = $creator;
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
            'user' => $this->creator->name,
            'name' => $this->user->name
        ];
    }
}
