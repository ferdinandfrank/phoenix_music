<?php

namespace App\Notifications;

use App\Models\Category;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

/**
 * CategoryDeletedNotification
 * -----------------------
 * Notifies an user if an user deleted a category.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Notifications
 */
class CategoryDeletedNotification extends Notification {

    use Queueable;

    private $category;

    private $user;

    /**
     * Creates a new notification instance.
     *
     * @param Category $category
     * @param User     $user
     */
    public function __construct(Category $category, User $user) {
        $this->category = $category;
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
            'user'  => $this->user->name,
            'title' => $this->category->title
        ];
    }
}
