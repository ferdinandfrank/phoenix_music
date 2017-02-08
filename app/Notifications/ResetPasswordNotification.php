<?php

namespace App\Notifications;

use App\Models\Settings;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class ResetPasswordNotification extends Notification {

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string $token
     */
    public function __construct($token) {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed $notifiable
     *
     * @return array|string
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        return (new MailMessage)
            ->greeting(\Lang::get('email.greeting', ['name' => $notifiable->name]))
            ->subject(\Lang::get('email.password_reset.title', ['title' => Settings::pageTitle()]))
            ->line(\Lang::get('email.password_reset.content', ['title' => Settings::pageTitle()]))
            ->action(\Lang::get('action.reset_password'), url('password/reset', $this->token));
    }
}
