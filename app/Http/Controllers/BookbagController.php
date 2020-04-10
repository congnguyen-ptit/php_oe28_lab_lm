<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Book;
use App\Enums\Status;
use App\Http\Models\BorrowerRecord;
use Illuminate\Support\Facades\Auth;

class BookbagController extends Controller
{
    public function index()
    {
        $item = session()->has('item') ? session()->get('item') : null;
        if (Auth::check()) {
            $requestings = BorrowerRecord::where([
                'user_id' => Auth::id(),
                'status' => Status::Request,
            ])->get();
            $borroweds = BorrowerRecord::where([
                'user_id' => Auth::id(),
                'status' => Status::Borrowed,
            ])->get();
        }

        return view('user.pages.bookbag', compact('item', 'requestings', 'borroweds'));
    }

    public function addBook($id)
    {
        try {
            $book = Book::find($id);
            if (!$book) {
                abort(404);
            }
            $item = session()->has('item') ? session()->get('item') : null;
            if ($item == null) {
                $item = [
                    $id => [
                        'id' => $book->id,
                        'name' => $book->name,
                        'img' => $book->image,
                        'slug' => $book->slug,
                        'author' => $book->user->name,
                    ]
                ];
                session()->put('item', $item);

                return redirect()->back()->with('success', trans('page.success'));
            }
            if (isset($item[$id])) {
                return redirect()->back()->with('exist', trans('page.exist'));
            }
            $item[$id] = [
                'id' => $book->id,
                'name' => $book->name,
                'img' => $book->image,
                'slug' => $book->slug,
                'author' => $book->user->name,
            ];
            session()->put('item', $item);

            return redirect()->back()->with('success', trans('page.success'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }

    }

    public function removeBook(Request $request, $id){
        $item = $request->session()->get('item');
        if (isset($item[$id])) {
            unset($item[$id]);
            session()->put('item', $item);
        }

        return redirect()->back()->with('deleted', trans('page.rm'));
    }
}
