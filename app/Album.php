<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';

    protected  $fillable = [
        'name',
        'description',
        'public',
        'user_id'
    ];

    protected $hidden = [
        'pivot',
    ];

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function available_users()
    {
        return $this->belongsToMany('App\User', 'album_user');
    }
    
    public function photos()
    {
        return $this->hasMany('App\Photo', 'album_id', 'id');
    }
    
}
