<?php

namespace App\Notifications;

use App\Models\Track;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Settings;

/**
 * TrackCreatedNotification
 * -----------------------
 * Notifies an user if an user created a track.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Notifications
 */
class TrackCreatedNotification extends Notification {

    use Queueable;

    private $track;
    private $uploader;

    /**
     * Creates a new notification instance.
     *
     * @param Track $track
     * @param User  $uploader
     */
    public function __construct(Track $track, User $uploader) {
        $this->track = $track;
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
        return ['mail', 'database'];
    }

    /**
     * Gets the mail representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        return (new MailMessage)
            ->subject(trans('email.track_created.subject', ['title' => Settings::pageTitle()]))
            ->greeting(\Lang::get('email.greeting', ['name' => $notifiable->name]))
            ->line(trans('email.track_created.content', ['title' => $this->track->title, 'author' => $this->uploader->name, 'composer' => $this->track->composer->name, 'name' => Settings::pageTitle()]))
            ->action(\Lang::get('action.show_track'), $this->track->getPath());
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
            'user'   => $this->uploader->name,
            'key'    => $this->track->getRouteKey(),
            'author' => $this->track->composer->name,
            'title'  => $this->track->title
        ];
    }
}
