<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $table = 'followers';
    protected $fillable = [
        'follower_id',
        'followed_id',
    ];
    public $timestamps = true;
}
