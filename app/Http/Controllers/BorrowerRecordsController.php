<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Enums\Status;
use Carbon\Carbon;
use App\Repositories\BorrowerRecord\BorrowerRecordRepoInterface;
use App\Repositories\User\UserRepoInterface;
use App\Notifications\RequestNotification;
use App\Enums\UserRole;
use App\Events\BookRequestEvent;

class BorrowerRecordsController extends Controller
{
    protected $brRepo;
    protected $userRepo;

    function __construct(BorrowerRecordRepoInterface $brRepo, UserRepoInterface $userRepo)
    {
        $this->brRepo = $brRepo;
        $this->userRepo = $userRepo;
    }

    public function request(Request $request)
    {
        $datas = $request->all();
        if ($datas['start_date'] > $datas['end_date']) {
            return response()->json([
                'message' => trans('page.date'),
                'fail' => true,
            ]);
            exit();
        }
        $start = Carbon::parse($datas['start_date']);
        $end = Carbon::parse($datas['end_date']);
        if ($end->diffInDays($start) > Status::Number) {
            return response()->json([
                'over' => trans('page.over'),
                'fail_over' => true,
            ]);
            exit();
        }
        $books = session()->get('item');
        foreach ($books as $key => $value) {
            $insert_data = [
                'book_id' => $value['id'],
                'user_id' => Auth::id(),
                'start_date' => $datas['start_date'],
                'end_date' => $datas['end_date'],
                'status' => config('const.request'),
            ];
            $borrower_record = $this->brRepo->create($insert_data);
            $administrator_data = [
                'role_id' => UserRole::Administrator,
            ];
            $admins = $this->userRepo->findByAttr($administrator_data);
            foreach ($admins as $admin) {
                $admin->notify(new RequestNotification($borrower_record->id, Auth::user()->name));
                event(new BookRequestEvent(Auth::user()->name . ' ' . trans('page.sendrequest'), $borrower_record->id));
            }
        }
        session()->forget('item');

        return response()->json([
            'success' => true,
            'message' => 'ok',
        ]);
    }

    public function recordDelete($id)
    {
        try {
            $this->brRepo->delete($id);

            return redirect()->back();
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }
}
