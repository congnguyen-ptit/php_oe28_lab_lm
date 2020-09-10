<?php

namespace App\Repositories\Permission;

use App\Repositories\ModelRepository;
use App\Http\Models\Permission;

class PermissionRepository extends ModelRepository implements PermissionRepoInterface
{
    public function getModel()
    {
        return Permission::class;
    }

    public function update($id, $data = [])
    {

    }
}
