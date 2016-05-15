<?php

namespace App\Policies;
use App\User;
use App\Album;

use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class AlbumPolicy
 * @package App\Policies
 *
 * AlbumPolicy is serve for authorization requests to AlbumController.
 *
 * return 403 error response ('Not authorized')
 *
 */
class AlbumPolicy
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
     * Authorize album show request
     * 
     * @param User $user
     * @param Album $album
     * @return bool
     */
    public function show(User $user, Album $album) {
        // See album can owner or user who have rights to see album
        return $user->owns($album)
            || $user->canSee($album);
    }

    /**
     * Authorize album update request
     * 
     * @param User $user
     * @param Album $album
     * @return bool
     */
    public function update(User $user, Album $album) {
        // Update photos can only album owners and album editors
        return $user->owns($album)
            || $user->editor($album) ;
    }

    /**
     * Authorize album destroy request
     * 
     * @param User $user
     * @param Album $album
     * @return bool
     */
    public function destroy(User $user, Album $album) {
        // Delete album can only owners
        return $user->owns($album) ;
    }
}
