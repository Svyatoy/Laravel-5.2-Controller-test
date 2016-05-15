<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

/**
 * Class Reset
 *
 * This is the model class for table 'resets'
 *
 * @property integer(10) $id
 * @property string(255) $email
 * @property string(255) $token
 * @property bool        $active
 *
 */
class Reset extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'token',
        'active',
    ];

    /**
     * Relation to users table
     *
     * @return User
     */
    public function user() {
        $this->belongsTo(User::class);
    }
}
