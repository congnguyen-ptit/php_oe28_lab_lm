<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Policies\BookPolicy;
use App\Http\Models\Book;
use App\Http\Models\User;
use App\Http\Models\Category;
use App\Http\Models\Publisher;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;
use Illuminate\Support\Str;

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
            $liked = false;
            $added = false;
            $book = Book::where('slug', $slug)->firstOrFail();
            if (Auth::check()) {
                $liked = $book->likedUsers()->wherePivot('user_id', Auth::id())->exists();
            }
            $item = session()->has('item') ? session()->get('item') : null;
            if (isset($item[$book->id])) {
                $added = true;
            }

            return view('user.pages.booksdetail')->with([
                'book' => $book,
                'liked' => $liked,
                'added' => $added,
            ]);
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

    public function likeBook($id)
    {
        $book = Book::find($id);
        $book->likedUsers()->attach(Auth::id());

        return redirect()->route('book.detail', $book->slug);
    }

    public function unlikeBook($id)
    {
        $book = Book::find($id);
        $book->likedUsers()->detach(Auth::id());

        return redirect()->route('book.detail', $book->slug);
    }

    public function store(BookRequest $request)
    {
        $this->authorize(Book::class, 'create');
        $book = Book::create([
            'code' => Str::random(config('const.code')),
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'content' => $request->content,
            'description' => $request->description,
            'image' => 'images/'.$request->image,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'publisher_id' => $request->publisher_id,
        ]);

        return redirect()->back()->with('cu', trans('page.cu'));
    }

    public function delete($id)
    {
        try {
            $book = Book::findOrFail($id);
            $this->authorize($book, 'delete');
            $book->delete();

            return redirect()->route('book.list');
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $book = Book::findOrFail($id);
            $this->authorize($book, 'update');
            $book->name = $request->name;
            $book->user_id = $request->user_id;
            $book->slug = Str::slug($request->name);
            $book->category_id = $request->category_id;
            $book->publisher_id = $request->publisher_id;
            $book->content = $request->content;
            $book->description = $request->description;
            $book->quantity = $request->quantity;
            if ($request->image == null) {
                $file = $book->image;
            } else {
                $book->image = 'images/'.$request->image;
            }
            $book->save();

            return redirect()->back()->with('success', trans('page.su'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }




}
