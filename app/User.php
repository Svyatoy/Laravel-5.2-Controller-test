<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

//    protected $table = 'users';

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
        'password', 'remember_token',
    ];

    public function albums() {
        return $this->belongsToMany('App\Album', 'album_user')->withTimestamps();
    }

}
