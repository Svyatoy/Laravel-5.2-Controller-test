<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ResizedPhoto
 *
 * This is the model class for table 'resized_photos'
 *
 * @property integer(10) $id
 * @property integer(10) $photo_id
 * @property string(255) $src
 * @property string(20)  $status
 * @property string(255) $comment
 * @property string(100) $size
 *
 */
class ResizedPhoto extends Model
{
    protected $table = 'resized_photos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $fillable = [
        'comment',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot',
    ];

    /**
     * Define relation to parent photo.
     * 
     * @return Photo
     */
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
