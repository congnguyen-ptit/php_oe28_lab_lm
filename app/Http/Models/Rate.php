<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rates';
    protected $fillable = [
        'user_id',
        'book_id',
        'number_of_stars',
    ];
    public $timestamps = true;
}
