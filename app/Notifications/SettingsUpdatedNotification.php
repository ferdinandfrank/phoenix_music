<?php

namespace App\Notifications;

use App\Models\NewsletterSubscriber;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * SettingsUpdatedNotification
 * -----------------------
 * Notifies an user if an user updated the settings.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Notifications
 */
class SettingsUpdatedNotification extends Notification {

    use Queueable;

    private $user;

    /**
     * Creates a new notification instance.
     *
     * @param User  $user
     */
    public function __construct(User $user) {
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
            'user' => $this->user->name
        ];
    }
}
