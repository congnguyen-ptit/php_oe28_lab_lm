<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(config('const.take'));

        return view('user.pages.booksview', compact('books'));
    }
    public function detail($slug)
    {
        try {
            $book = Book::where('slug', $slug)->firstOrFail();

            return view('user.pages.booksdetail', compact('book'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }

    }
}
