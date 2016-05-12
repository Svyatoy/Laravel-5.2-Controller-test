<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    //protected $table = 'users';

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

    public function resetToken() {
        return $this->hasMany('App\Reset', 'email', 'email');
    }
    
    public function ownAlbums() {
        return $this->hasMany('App\Album');
    }

    public function availableAlbums() {
        return $this->belongsToMany('App\Album', 'album_user');
    }

    public function isAdmin() {
        if ($this->role === 'admin') {
            return true;
        }else{
            return false;
        }
    }
    
}
