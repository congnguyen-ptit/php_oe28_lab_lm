<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'code',
        'name',
        'email',
        'phone_number',
        'username',
        'role_id',
    ];
    protected $hidden = [
        'password',
    ];
    public $timestamps = true;
}
