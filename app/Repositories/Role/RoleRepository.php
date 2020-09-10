<?php

namespace App\Repositories\Role;

use App\Repositories\ModelRepository;
use App\Http\Models\Role;

class RoleRepository extends ModelRepository implements RoleRepoInterface
{
    public function getModel()
    {
        return Role::class;
    }

    public function update($id, $data = [])
    {
        $role = $this->findById($id);
        $role->name = $data['name'];
        $role->description = $data['description'];
        $role->permissions()->sync($data['permission_id']);
        $role->save();
    }
}

