<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Photo
 *
 * This is the model class for table 'photos'
 *
 * @property integer(10) $id
 * @property integer(10) $album_id
 * @property integer(10) $user_id
 * @property string(255) $src
 * @property string(255) $description
 * @property string(100) $size
 *
 */
class Photo extends Model
{
    // Database table name
    protected $table = 'photos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $fillable = [
        'description',
        'src',
        'album_id',
        'user_id'
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
     * Relation to albums table and Album class
     * 
     * @return Album
     */
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    /**
     * Relation to users table
     * @return User
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Relation to resized_photos table
     * 
     * @return ResizedPhoto
     */
    public function sizes()
    {
        return $this->hasMany('App\ResizedPhoto', 'photo_id', 'id');
    }    
    
}
