<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Album extends Model
{
//    protected $table = 'albums';

    protected  $fillable = [
        'name',
        'description',
        'public',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'album_user')->withTimestamps();
    }
    
}
