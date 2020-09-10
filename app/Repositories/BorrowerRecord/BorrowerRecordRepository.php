<?php

namespace App\Repositories\BorrowerRecord;

use App\Http\Models\BorrowerRecord;
use App\Repositories\ModelRepository;
use Carbon\Carbon;
use App\Enums\Status;

class BorrowerRecordRepository extends ModelRepository implements BorrowerRecordRepoInterface
{
    public function getModel()
    {
        return BorrowerRecord::class;
    }

    public function update($id, $data = []){
        $record = $this->findById($id);
        $record->status = $data['status'];
        $record->save();
    }

    public function getBorrowerRecordWeekly()
    {
        $start_week = Carbon::now()->startOfWeek();
        $end_week = Carbon::now()->endOfWeek();
        $number = $this->model->whereBetween('updated_at', [$start_week, $end_week])
            ->where('status', Status::Borrowed)
            ->count();
        return $number;
    }

}
