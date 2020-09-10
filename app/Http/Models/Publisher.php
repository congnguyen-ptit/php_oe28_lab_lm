<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'publishers';
    protected $fillable = [
        'code',
        'name',
        'slug',
        'location',
    ];
    public $timestamps = true;

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'books', 'publisher_id', 'user_id');
    }
    public static function boot() {
        parent::boot();
        static::deleting(function($publisher) {
            $publisher->books()->delete();
        });
    }
}
