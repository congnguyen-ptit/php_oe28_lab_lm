<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Foundation\Auth\Access\Authorizable as AuthorizableTrait;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

class User extends \Eloquent implements Authenticatable, Authorizable
{
    use AuthenticableTrait, AuthorizableTrait;

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

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function favoriteBooks()
    {
        return $this->belongsToMany(Book::class, 'favorite_books', 'user_id', 'book_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function borrowerRecords()
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

    public static function boot() {
        parent::boot();
        static::deleting(function($user) {
            $user->books()->delete();
            $user->comments()->delete();
            $user->borrowerRecords()->delete();
            $user->locations()->delete();
            $user->rates()->delete();
        });
    }

    public function hasPermission(Permission $permission) {
        return !! optional(optional($this->role)->permissions)->contains($permission);
    }
}
