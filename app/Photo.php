<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';

    protected  $fillable = [
        'description',
        'src',
        'album_id'
    ];

    protected $hidden = [
        'pivot',
    ];

    public function album()
    {
        return $this->belongsTo('App\Album');
    }

    public function sizes()
    {
        return $this->hasMany('App\ResizedPhoto', 'photo_id', 'id');
    }    
    
}
