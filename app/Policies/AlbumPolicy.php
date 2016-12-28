<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\Track;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * AlbumPolicy
 * -----------------------
 * Handles the permissions on a post.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Policies
 */
class AlbumPolicy {

    use HandlesAuthorization;

    /**
     * Determines if the specified post can be updated by the user.
     *
     * @param    $user
     *
     * @return bool
     */
    public function store(User $user) {
        return $user->isType("manager") || $user->isType("admin");
    }

    /**
     * Determines if the specified post can be updated by the user.
     *
     * @param    $user
     * @param    $track
     *
     * @return bool
     */
    public function update(User $user, Track $track) {
        return $user->isType("manager") || $user->isType("admin");
    }

    /**
     * Determines if the specified post can be deleted by the user.
     *
     * @param    $user
     * @param    $track
     *
     * @return bool
     */
    public function delete(User $user, Track $track) {
        return $user->isType("manager") || $user->isType("admin");
    }
}
