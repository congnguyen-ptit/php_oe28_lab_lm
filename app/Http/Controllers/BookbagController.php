<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Cart;
use App\Http\Models\Book;

class BookbagController extends Controller
{
    public function index()
    {
        return view('user.pages.bookbag');
    }

    public function addBook($id)
    {
        if ((Cart::content()->contains('id', $id))){
            return back();
        } else {
            $book = Book::find($id);
            $add = Cart::add([
                'id' => $book->id,
                'name' => $book->name,
                'qty' => config('const.one'),
                'price' => config('const.empty'),
                'weight' => config('const.empty'),
                'options' => [
                    'img' => $book->image,
                    'author' => $book->user->name,
                    'slug' => $book->slug,
                    'user_slug' => $book->user->user_slug,
                ]
            ]);
            if ($add) {
                return redirect()->back();
            }
        }
    }

    public function removeBook($id){
        $rowId = Cart::content()->where('id', $id)->first()->rowId;;
        Cart::remove($rowId);
        return redirect()->back();
    }
}
