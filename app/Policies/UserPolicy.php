<?php

namespace App\Policies;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UserPolicy
 * @package App\Policies
 *
 * UserPolicy is serve for authorization requests to UserController.
 *
 * return 403 error response ('Not authorized')
 *
 */
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Before all authorizations we check if user has admin role.
     * If it has - authorize request.
     *
     * @param User $user
     * @return bool
     */
    public function before(User $user)
    {
        // Admin can do anything
        return $user->isAdmin();
    }

    /**
     * Authorize user show request
     *
     * @param User $user
     * @param User $user_to_show
     * @return bool
     */
    public function show(User $user, User $user_to_show) {
        // Check if authenticated user and requested user is equals
        return $user == $user_to_show;
    }

    /**
     * Authorize user update request
     *
     * @param User $user
     * @param User $user_to_update
     * @return bool
     */
    public function update(User $user, User $user_to_update) {
        // Check if authenticated user and requested user is equals
        return $user == $user_to_update;
    }

    /**
     * Authorize user albums show request
     *
     * @param User $user
     * @param User $user_with_albums
     * @return bool
     */
    public function getUserAlbums(User $user, User $user_with_albums) {
        // Check if authenticated user and requested user is equals
        return $user == $user_with_albums;
    }

}
