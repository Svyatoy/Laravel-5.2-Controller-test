<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role', 'api_token', 'pivot',
    ];

    public function ownAlbums() {
        return $this->hasMany('App\Album');
    }

    public function availableAlbums() {
        return $this->belongsToMany('App\Album', 'album_user');
    }

//    public function getOwnAlbumsListAttribute()
//    {
//        return $this->ownAlbums->lists('id')->toArray();
//    }
//
//    public function getAvailableAlbumsListAttribute()
//    {
//        return $this->availableAlbums->lists('id')->toArray();
//    }
}
