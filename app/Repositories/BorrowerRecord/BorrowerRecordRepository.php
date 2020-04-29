<?php

namespace App\Repositories\BorrowerRecord;

use App\Http\Models\BorrowerRecord;
use App\Repositories\ModelRepository;

class BorrowerRecordRepository extends ModelRepository implements BorrowerRecordRepoInterface
{
    public function getModel()
    {
        return BorrowerRecord::class;
    }

    public function update($id, $data = []){

    }
}
