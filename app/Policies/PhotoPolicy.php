<?php

namespace App\Policies;

use App\Photo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PhotoPolicy
 * @package App\Policies
 *
 * PhotoPolicy is serve for authorization requests to PhotoController.
 *
 * return 403 error response ('Not authorized')
 */
class PhotoPolicy
{
    use HandlesAuthorization;

    /**
     * Before all authorizations we check if user has admin role.
     * If he has - authorize request.
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
     * Authorization check of photo show requests
     * 
     * @param User $user
     * @param Photo $photo
     * @return bool
     */
    public function show(User $user, Photo $photo) {
        // See photo can photo owner, photo->album owner or user who have rights to see album
        return $user->owns($photo) 
            || $user->owns($photo->album()) 
            || $user->canSee($photo->album());
    }

    /**
     * Authorization check for photo store requests
     * 
     * @param User $user
     * @param Photo $photo
     * @return bool
     */
    public function store(User $user, Photo $photo) {
        // Store photos can only album owners or album editors
        return $user->owns($photo->album())
           ||  $user->editor($photo->album());
    }

    /**
     * Authorization check for photo update requests
     * 
     * @param User $user
     * @param Photo $photo
     * @return bool
     */
    public function update(User $user, Photo $photo) {
        // Update photos can only album owners and album editors
        return $user->owns($photo->album()) 
            || $user->editor($photo->album()) ;
    }

    /**
     * Authorization check for photo destroy requests
     * 
     * @param User $user
     * @param Photo $photo
     * @return bool
     */
    public function destroy(User $user, Photo $photo) {
        // Delete photo can only owners (album editor or album owner)
        return $user->owns($photo) ;
    }
}
