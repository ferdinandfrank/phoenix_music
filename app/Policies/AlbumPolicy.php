<?php

namespace App\Policies;

use App\Models\Album;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * AlbumPolicy
 * -----------------------
 * Handles the permissions on an album.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Policies
 */
class AlbumPolicy {

    use HandlesAuthorization;

    /**
     * Determines if the specified album can be updated by the user.
     *
     * @param    $user
     *
     * @return bool
     */
    public function store(User $user) {
        return $user->isType("manager") || $user->isType("admin");
    }

    /**
     * Determines if the specified album can be updated by the user.
     *
     * @param    $user
     * @param    $album
     *
     * @return bool
     */
    public function update(User $user, Album $album) {
        return $user->isType("manager") || $user->isType("admin");
    }

    /**
     * Determines if the specified album can be deleted by the user.
     *
     * @param    $user
     * @param    $album
     *
     * @return bool
     */
    public function delete(User $user, Album $album) {
        return $user->isType("manager") || $user->isType("admin");
    }
}
