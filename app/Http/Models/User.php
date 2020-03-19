<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Notifications\Notifiable;

class User extends \Eloquent implements Authenticatable
{
    use AuthenticableTrait;

    protected $table = 'users';
    protected $fillable = [
        'code',
        'name',
        'user_slug',
        'email',
        'phone_number',
        'username',
        'password',
        'role_id',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = true;

    public function roleID()
    {
        return $this->role_id;
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function favorite_books()
    {
        return $this->hasMany(FavoriteBook::class);
    }

    public function borrower_records()
    {
        return $this->hasMany(BorrowerRecord::class);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'followed_id');
    }

    public function followed()
    {
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'follower_id');
    }

    public function publishers()
    {
        return $this->belongsToMany(Publisher::class, 'books', 'user_id', 'publisher_id');
    }
}
