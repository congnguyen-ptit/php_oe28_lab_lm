<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'publishers';
    protected $fillable = [
        'code',
        'name',
        'location',
    ];
    public $timestamps = true;
}
