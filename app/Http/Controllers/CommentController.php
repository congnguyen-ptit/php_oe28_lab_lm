<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Models\Book;
use App\Http\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(CommentRequest $request, $id)
    {
        $book = Book::find($id);
        $comment = Comment::create([
            'content' => $request->comment,
            'book_id' => $id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('book.detail', $book->slug);
    }
}
