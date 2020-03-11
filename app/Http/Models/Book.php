<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = [
        'code',
        'name',
        'description',
        'content',
        'image',
        'quantity',
        'publisher_id',
        'category_id',
        'user_id',
    ];
    public $timestamps = true;
}
