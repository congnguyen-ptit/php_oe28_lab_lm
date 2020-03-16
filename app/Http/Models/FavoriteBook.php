<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteBook extends Model
{
    protected $table = 'favorite_books';
    protected $fillable = [
        'user_id',
        'book_id',
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
