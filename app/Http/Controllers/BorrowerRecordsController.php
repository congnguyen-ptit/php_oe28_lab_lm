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
        $borrower_record = [];
        $ids = [];
        $books = collect(Cart::content());
        $records = [];
        foreach ($books as $key => $value) {
            array_push($ids, $value->id);
        }
        foreach ($ids as $key => $id) {
            $borrower_record = BorrowerRecord::create([
                'book_id' => $id,
                'user_id' => Auth::id(),
                'start_date' => $datas['start_date'][$key],
                'end_date' => $datas['end_date'][$key],
                'status' => config('const.request'),
            ]);
        }
        Cart::destroy();
        return redirect()->route('home');
    }
}
