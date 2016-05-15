<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Album
 *
 * This is the model class for table 'albums'
 *
 * @property integer(10) $id
 * @property string(100) $name
 * @property string(255) $description
 * @property bool        $public
 * @property integer(10) $user_id
 *
 */
class Album extends Model
{
    // Table name
    protected $table = 'albums';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $fillable = [
        'name',
        'description',
        'public',
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
     * Return related User class
     * 
     * @return User
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Return related users through album_user (many to many relation)
     * 
     * @return array of Users
     */
    public function availableUsers()
    {
        return $this->belongsToMany(User::class, 'album_user');
    }

    /**
     * Return related to album photos
     * 
     * @return Photo
     */
    public function photos()
    {
        return $this->hasMany(Photo::class, 'album_id', 'id');
    }
    
}
