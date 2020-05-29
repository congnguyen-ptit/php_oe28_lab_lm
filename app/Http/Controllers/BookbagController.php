<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\Status;
use App\Repositories\BorrowerRecord\BorrowerRecordRepoInterface;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Book\BookRepoInterface;

class BookbagController extends Controller
{
    protected $bookRepo;
    protected $borrowerRecordRepo;

    function __construct(
        BookRepoInterface $bookRepo,
        BorrowerRecordRepoInterface $borrowerRecordRepo
    ) {
        $this->bookRepo = $bookRepo;
        $this->borrowerRecordRepo = $borrowerRecordRepo;
    }
    public function index()
    {
        $item = session()->has('item') ? session()->get('item') : null;
        if (Auth::check()) {
            $data = [
                'user_id' => Auth::id(),
                'status' => Status::Request,
            ];
            $requestings = $this->borrowerRecordRepo->findByAttr($data);
            $dataBorrowed = [
                'user_id' => Auth::id(),
                'status' => Status::Borrowed,
            ];
            $borroweds = $this->borrowerRecordRepo->findByAttr($dataBorrowed);
        }

        return view('user.pages.bookbag', [
            'item' => $item,
            'requestings' => $requestings,
            'borroweds' => $borroweds,
        ]);
    }

    public function addBook($id)
    {
        try {
            $book = $this->bookRepo->findById($id);
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
                        'price' => $book->price,
                        'quantity' => 1,
                    ]
                ];
                session()->put('item', $item);

                return response()->json([
                    'success' => trans('page.createsucccessfully'),
                ]);
            }
            if (isset($item[$id])) {
                return response()->json([
                    'exist' => trans('page.exist'),
                ]);
            }
            $item[$id] = [
                'id' => $book->id,
                'name' => $book->name,
                'img' => $book->image,
                'slug' => $book->slug,
                'author' => $book->user->name,
                'price' => $book->price,
                'quantity' => 1,
            ];
            session()->put('item', $item);

            return response()->json([
                'success' => trans('page.createsucccessfully'),
            ]);
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

        return response()->json([
            'deleted' => trans('page.rm'),
        ]);
    }
}
