<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = [
        'name',
        'description',
    ];
    public $timestamps = false;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permissions', 'permission_id', 'role_id');
    }
}
