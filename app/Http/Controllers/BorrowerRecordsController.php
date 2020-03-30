<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\User;
use App\Http\Models\Book;
use App\Http\Models\BorrowerRecord;
use Illuminate\Support\Facades\Auth;
use App\Enums\Status;
use Carbon\Carbon;

class BorrowerRecordsController extends Controller
{
    public function request(Request $request)
    {
        $datas = $request->all();
        if ($datas['start_date'] > $datas['end_date']) {
            return redirect()->route('bookbag.index')->with([
                'fail' => trans('page.date'),
            ]);
        }
        $start = Carbon::parse($datas['start_date']);
        $end = Carbon::parse($datas['end_date']);
        if ($end->diffInDays($start) > Status::Number) {
            return redirect()->route('bookbag.index')->with([
                'over' => trans('page.over'),
            ]);
        }

        $books = session()->get('item');
        foreach ($books as $key => $value) {
            $borrower_record = BorrowerRecord::create([
                'book_id' => $value['id'],
                'user_id' => Auth::id(),
                'start_date' => $datas['start_date'],
                'end_date' => $datas['end_date'],
                'status' => config('const.request'),
            ]);
        }
        session()->forget('item');

        return redirect()->route('home');
    }

    public function recordDelete($id)
    {
        try {
            $borrower_record = BorrowerRecord::find($id);
            $borrower_record->delete();

            return redirect()->back();
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }
}
