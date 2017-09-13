<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = [
        'name', 'card_id', 'email', 'phoneno',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
