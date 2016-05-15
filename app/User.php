<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * This is the model class for table 'users'
 *
 * @property integer(10) $id
 * @property string(255) $name
 * @property string(255) $email
 * @property string(255) $role
 * @property string(255) $password
 *
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role', 'api_token', 'pivot',
    ];

    /**
     * Relation to reset table
     *
     * @return Reset
     */
    public function resetToken() {
        return $this->hasMany(Reset::class, 'email', 'email');
    }

    /**
     * Relation to albums table where user is owner
     * 
     * @return array of Albums
     */
    public function ownAlbums() {
        return $this->hasMany(Album::class);
    }

    /**
     * Relation to albums table through album_user table (many to many relation)
     *
     * @return array of Albums
     */
    public function availableAlbums() {
        return $this->belongsToMany(Album::class, 'album_user');
    }
    
    /**
     * Return associative array of own and available albums
     *
     * @return array of Albums
     */
    public function allAlbums() {
        // Get available albums list
        $availableAlbums = $this->availableAlbums();
        // Get own albums list
        $ownAlbums = $this->ownAlbums();
        // Initialize result array
        $response = array();

        // Add availableAlbums only if it not empty
        if (sizeof($availableAlbums)>0) {
            $response['availableAlbums'] = $availableAlbums;
        }
        
        // Add ownAlbums only if it not empty
        if (sizeof($ownAlbums)>0) {
            $response['ownAlbums'] = $ownAlbums;
        }
        
        return $response;    
    }

    /**
     * Relation to photos table
     * 
     * @return array of Photos
     */
    public function photos(){
        $this->hasMany(Photo::class, 'user_id', 'id');
    }

    /**
     * Check if user is admin
     *
     * @return bool
     */
    public function isAdmin() {
        if ($this->role === 'admin') {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Check if the user is owner of related object (Album, Photo)
     * 
     * @param $related [Album,Photo]
     * @return bool
     */
    public function owns($related) {
        return $this->id == $related->user_id;
    }
    
    /**
     * Check if user is editor of album
     *
     * @param Album $album
     * @return bool
     */
    public function editor(Album $album) {
        return in_array($this, array($album->availableUsers()
            ->wherePivot('permission' == 'write')));
    }
    
    /**
     * Check if user have permission to see album
     *
     * @param Album $album
     * @return bool
     */
    public function canSee(Album $album) {
        return in_array($this, array($album->availableUsers()) );
    }
    
}
