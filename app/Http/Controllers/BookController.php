<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Book\BookRepoInterface;
use App\Repositories\Category\CategoryRepoInterface;
use App\Repositories\Publisher\PublisherRepoInterface;
use App\Repositories\User\UserRepoInterface;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    protected $bookRepo;
    protected $categoryRepo;
    protected $pubRepo;
    protected $userRepo;

    function __construct(
        BookRepoInterface $bookRepo,
        CategoryRepoInterface $categoryRepo,
        PublisherRepoInterface $pubRepo,
        UserRepoInterface $userRepo
    ) {
        $this->bookRepo = $bookRepo;
        $this->categoryRepo = $categoryRepo;
        $this->pubRepo = $pubRepo;
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $books = $this->bookRepo->getAllPaginate(config('const.take'));

        return view('user.pages.booksview', compact('books'));
    }

    public function create()
    {
        //
    }

    public function store(BookRequest $request)
    {
        $data = [
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
        ];
        $this->bookRepo->create($data);

        return redirect()->back()->with('cu', trans('page.cu'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $this->authorize($book, 'update');
        $book = $this->bookRepo->findById($id);
        if ($request->image == null) {
            $file = $book->image;
        } else {
            $file = 'images/'.$request->image;
        }
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'content' => $request->content,
            'description' => $request->description,
            'image' => $file,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'publisher_id' => $request->publisher_id,
        ];
        try {
            $this->bookRepo->update($id, $data);

            return redirect()->back()->with('success', trans('page.su'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function destroy($id)
    {
        $this->authorize($book, 'delete');
        try {
            $this->bookRepo->destroy($id);

            return redirect()->route('book.list');
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function showBySlug($slug)
    {
        try {
            $liked = false;
            $added = false;
            $data = [
                'slug' => $slug,
            ];
            $book = $this->bookRepo->findByAttrGetOne($data);
            if (Auth::check()) {
                $liked = $this->bookRepo->checkLiked($book, Auth::id());
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

    public function unlike($id)
    {
        $book = $this->bookRepo->findById($id);
        $this->bookRepo->unlikeBook($id, Auth::id());

        return response()->json([
            'book' => $book,
            'unliked' => trans('page.unliked'),
        ], 200);
    }

    public function like($id)
    {
        $book = $this->bookRepo->findById($id);
        $this->bookRepo->likeBook($id, Auth::id());

        return response()->json([
            'liked' => trans('page.liked'),
            'book' => $book,
        ], 200);
    }

    public function showByCategory($slug)
    {
        $dataCategory = [
            'slug' => $slug
        ];
        try {
            $category = $this->categoryRepo->findByAttrGetOne($dataCategory);
            $books = $category->books()->paginate(config('const.take'));

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
                return redirect()->route('books.index');
            } else {
                return redirect()->route('book.category', $category);
            }
        } else {
            if ($category === 'all') {
                try {
                    $data = [
                        'column' => 'name',
                        'operator' => 'LIKE',
                        'keywords' => $keywords,
                        'pages' => config('const.take'),
                    ];
                    $books = $this->bookRepo->searchByColumn($data);

                    return view('user.pages.booksview', compact('books'));
                } catch (ModelNotFoundException $e) {
                    response()->view('errors.404_user_not_found', [], 404);
                }
            } else {
                try {
                    $books = $this->categoryRepo->getBooksFromCategory($category, $keywords);

                    return view('user.pages.booksview', compact('books'));
                } catch (ModelNotFoundException $e) {
                    response()->view('errors.404_user_not_found', [], 404);
                }
            }
        }
    }

    public function showByPublisher($slug)
    {
        $dataPub = [
            'slug' => $slug
        ];
        try {
            $publisher = $this->pubRepo->findByAttrGetOne($dataPub);
            $books = $publisher->books()->paginate(config('const.take'));

            return view('user.pages.booksview', compact('books'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function showByAuthor($slug)
    {
        $data = [
            'user_slug' => $slug,
        ];
        try {
            $author = $this->userRepo->findByAttrGetOne($data);
            $books = $author->books()->paginate(config('const.take'));

            return view('user.pages.booksview', compact('books'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function getChildrenCategories($slug)
    {
        $data = [
            'slug' => $slug,
        ];
        try {
            $category = $this->categoryRepo->findByAttrGetOne($data);
            $child_category = $category->children()->paginate(config('const.take'));

            return view('user.pages.category', compact('child_category'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }
}
