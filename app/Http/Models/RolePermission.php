<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'roles_permissions';
    protected $fillable = [
        'role_id',
        'permission_id',
    ];
    public $timestamps = false;
}
