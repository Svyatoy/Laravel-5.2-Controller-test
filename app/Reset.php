<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reset extends Model
{
    protected $fillable = [
        'email',
        'token',
        'active',
    ];

    public function user() {
        $this->belongsTo('App\User');
    }
}
