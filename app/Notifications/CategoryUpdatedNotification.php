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
 * CategoryUpdatedNotification
 * -----------------------
 * Notifies an user if an user updated a category.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Notifications
 */
class CategoryUpdatedNotification extends Notification {

    use Queueable;

    private $category;
    private $user;
    private $updated;

    /**
     * Creates a new notification instance.
     *
     * @param Category $category
     * @param User  $user
     * @param array $updated
     */
    public function __construct(Category $category, User $user, array $updated) {
        $this->category = $category;
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
            'key' => $this->category->getRouteKey(),
            'title' => $this->category->title,
            'updated' => implode(", ", $this->updated)
        ];
    }
}
