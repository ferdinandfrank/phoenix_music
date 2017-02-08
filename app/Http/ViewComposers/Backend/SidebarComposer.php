<?php

namespace App\Http\ViewComposers\Backend;

use App\Notifications\AdvertisementCreatedNotification;
use App\Notifications\AlbumCreatedNotification;
use App\Notifications\CategoryCreatedNotification;
use App\Notifications\NewsletterSubscriptionNotification;
use App\Notifications\PostCommentCreatedNotification;
use App\Notifications\PostCreatedNotification;
use App\Notifications\SerieCreatedNotification;
use App\Notifications\TrackCreatedNotification;
use App\Notifications\UserCreatedNotification;
use Illuminate\View\View;

/**
 * SidebarComposer
 * -----------------------
 * ${CARET}
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\ViewComposers
 */
class SidebarComposer {

    /**
     * Binds the necessary data to the view.
     *
     * @param  View $view
     *
     * @return void
     */
    public function compose(View $view) {
        if (\Auth::check()) {
            $numOfNewAlbums = \Auth::user()->unreadNotifications()->where('type',
                AlbumCreatedNotification::class)->groupBy('notifiable_id', 'created_at')->count();
            $view->with('numOfNewAlbums', $numOfNewAlbums);

            $numOfNewTracks = \Auth::user()->unreadNotifications()->where('type',
                TrackCreatedNotification::class)->groupBy('notifiable_id', 'created_at')->count();
            $view->with('numOfNewTracks', $numOfNewTracks);

            $numOfNewCategories = \Auth::user()->unreadNotifications()->where('type',
                CategoryCreatedNotification::class)->groupBy('notifiable_id', 'created_at')->count();
            $view->with('numOfNewCategories', $numOfNewCategories);

            $numOfNewUsers = \Auth::user()->unreadNotifications()->where('type',
                UserCreatedNotification::class)->groupBy('notifiable_id', 'created_at')->count();
            $view->with('numOfNewUsers', $numOfNewUsers);
        }
    }
}