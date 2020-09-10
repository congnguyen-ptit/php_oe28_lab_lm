<?php

namespace App\Repositories\Location;

use App\Repositories\ModelRepository;
use App\Http\Models\Location;

class LocationRepository extends ModelRepository implements LocationRepoInterface
{
    public function getModel()
    {
        return Location::class;
    }

    public function update($id, $data = [])
    {
        $location = $this->findById($id);
        $location->apartment_number = $data['apartment_number'];
        $location->street = $data['street'];
        $location->ward = $data['ward'];
        $location->district = $data['district'];
        $location->city = $data['city'];
        $location->save();
    }
}
