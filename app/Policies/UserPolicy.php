<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * UserPolicy
 * -----------------------
 * Handles the permissions on an user.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Policies
 */
class UserPolicy {

    use HandlesAuthorization;

    /**
     * Determines if the specified user can be updated by the user.
     *
     * @param User $user
     * @param User $updateUser
     *
     * @return bool
     */
    public function update(User $user, User $updateUser) {
        return $user->id === $updateUser->id || $user->isType("admin");
    }

    /**
     * Determines if the specified user can be updated by the user.
     *
     * @param User $user
     * @param User $updateUser
     *
     * @return bool
     */
    public function updateRoles(User $user, User $updateUser) {
        return $user->isType("admin");
    }

    /**
     * Determines if the specified user can be updated by the user.
     *
     * @param User $user
     * @param User $updateUser
     *
     * @return bool
     */
    public function updatePassword(User $user, User $updateUser) {
        return $user->id === $updateUser->id;
    }

    /**
     * Determines if the specified user can create an user.
     *
     * @param User $user
     *
     * @return bool
     */
    public function store(User $user) {
        return $user->isType("admin");
    }

    /**
     * Determines if the specified user can create an user.
     *
     * @param User $user
     * @param User $deleteUser
     *
     * @return bool
     */
    public function delete(User $user, User $deleteUser) {
        return $user->isType("admin");
    }

    /**
     * Determines if the specified user can enable the maintenance mode.
     *
     * @param User $user
     *
     * @return bool
     */
    public function enableMaintenance(User $user) {
        return $user->isType("admin") || $user->isType("manager");
    }
}
