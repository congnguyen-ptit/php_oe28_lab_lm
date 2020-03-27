<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Book;
use App\Http\Models\User;
use App\Http\Models\Category;
use App\Http\Models\Publisher;
use Illuminate\Support\Facades\Auth;

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

    public function showByCategory($slug)
    {
        try {
            $category = Category::where('slug', $slug)->firstOrFail();
            $books = $category->books()->paginate(config('const.take'));

            return view('user.pages.booksview', compact('books'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function showByPublisher($slug)
    {
        try {
            $publisher = Publisher::where('slug', $slug)->firstOrFail();
            $books = $publisher->books()->paginate(config('const.take'));

            return view('user.pages.booksview', compact('books'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function showByAuthor($slug)
    {
        try {
            $author = User::where('user_slug', $slug)->firstOrFail();
            $books = $author->books()->paginate(config('const.take'));

            return view('user.pages.booksview', compact('books'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function searchByCategory(Request $request)
    {
        $keywords = trim($request->keywords);
        $category = $request->category;
        if (empty($keywords)) {
            if ($category === 'all') {
                return redirect()->route('books.list');
            } else {
                return redirect()->route('book.category', $category);
            }
        } else {
            if ($category === 'all') {
                try {
                    $books = Book::where('name', 'LIKE', "%{$keywords}%")->orderBy('name')->paginate(config('const.take'));

                    return view('user.pages.booksview', compact('books'));
                } catch (ModelNotFoundException $e) {
                    response()->view('errors.404_user_not_found', [], 404);
                }
            } else {
                try {
                    $category_type = Category::where('slug', $category)->firstOrFail();
                    $books = $category_type->books()->where('name', 'LIKE', "%{$keywords}%")
                            ->orderBy('name')->paginate(config('const.take'));

                    return view('user.pages.booksview', compact('books'));
                } catch (ModelNotFoundException $e) {
                    response()->view('errors.404_user_not_found', [], 404);
                }
            }
        }
    }

    public function getChildrenCategories($slug)
    {
        try {
            $category = Category::where('slug', $slug)->firstOrFail();
            $child_category = $category->children()->paginate(config('const.take'));

            return view('user.pages.category', compact('child_category'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }
}
