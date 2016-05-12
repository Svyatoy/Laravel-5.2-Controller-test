<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResizedPhoto extends Model
{
    protected $table = 'resized_photos';

    protected  $fillable = [
        'comment',
        'status'
    ];

    protected $hidden = [
        'pivot',
    ];

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }
}
