<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * CategoryPolicy
 * -----------------------
 * Handles the permissions on a category.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Policies
 */
class CategoryPolicy {

    use HandlesAuthorization;

    /**
     * Determines if a category can be created by the user.
     *
     * @param    $user
     *
     * @return bool
     */
    public function store(User $user) {
        return $user->isType("manager") || $user->isType("admin");
    }

    /**
     * Determines if the specified category can be updated by the user.
     *
     * @param    $user
     * @param    $category
     *
     * @return bool
     */
    public function update(User $user, Category $category) {
        return $user->isType("manager") || $user->isType("admin");
    }

    /**
     * Determines if the specified category can be deleted by the user.
     *
     * @param    $user
     * @param    $category
     *
     * @return bool
     */
    public function delete(User $user, Category $category) {
        return $user->isType("manager") || $user->isType("admin");
    }
}
