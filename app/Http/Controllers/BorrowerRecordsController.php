<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use App\Http\Models\Book;
use App\Http\Models\BorrowerRecord;
use Illuminate\Support\Facades\Auth;

class BorrowerRecordsController extends Controller
{
    public function request(Request $request)
    {
        $datas = $request->all();
        if ($datas['end_date'] < $datas['start_date']) {
            return route('bookbag.index')->with('fail', trans('page.date'));
        }
        $borrower_record = [];
        $ids = [];
        $books = session()->get('item');
        $records = [];
        foreach ($books as $key => $value) {
            array_push($ids, $value['id']);
        }
        foreach ($ids as $key => $id) {
            $borrower_record = BorrowerRecord::create([
                'book_id' => $id,
                'user_id' => Auth::id(),
                'start_date' => $datas['start_date'],
                'end_date' => $datas['end_date'],
                'status' => config('const.request'),
            ]);
        }
        session()->forget('item');

        return redirect()->route('home');
    }
}
