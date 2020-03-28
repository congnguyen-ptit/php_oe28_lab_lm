<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function removeBook($id){
        Cart::remove($id);
        return redirect()->back();
    }
}
