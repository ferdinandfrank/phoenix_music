<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * SettingsPolicy
 * -----------------------
 * Handles the permissions on the settings.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Policies
 */
class SettingsPolicy {

    use HandlesAuthorization;

    /**
     * Determines if the specified user can update the blog's settings.
     *
     * @param    $user
     *
     * @return bool
     */
    public function update(User $user) {
        return $user->isType("manager") || $user->isType("admin");
    }

}
