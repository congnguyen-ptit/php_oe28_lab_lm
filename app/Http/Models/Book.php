<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = [
        'code',
        'name',
        'slug',
        'description',
        'content',
        'image',
        'quantity',
        'publisher_id',
        'category_id',
        'user_id',
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function borrower_records()
    {
        return $this->hasMany(BorrowerRecord::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function favorite_books()
    {
        return $this->hasMany(FavoriteBook::class);
    }
}
