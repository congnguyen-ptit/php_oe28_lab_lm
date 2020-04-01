<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Http\Models\User;
use App\Http\Models\Book;
use App\Http\Models\BorrowerRecord;
use Illuminate\Support\Facades\Auth;

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
}
