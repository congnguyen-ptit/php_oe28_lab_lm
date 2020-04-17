<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\PublisherRequest;
use App\Http\Models\User;
use App\Http\Models\Book;
use App\Http\Models\Role;
use App\Http\Models\Permission;
use App\Http\Models\Comment;
use App\Http\Models\Publisher;
use App\Http\Models\Location;
use App\Http\Models\Category;
use App\Http\Models\BorrowerRecord;
use App\Enums\UserRole;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use App\Enums\Status;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
        $users = User::where('role_id', '<', UserRole::Administrator)->get();
        $latest_books = Book::orderBy('created_at', 'DESC')->get();
        $roles = Role::all();
        $borrower_records = BorrowerRecord::all();
        $request = BorrowerRecord::where('status', Status::Request);
        $borrowed = BorrowerRecord::where('status', Status::Borrowed);
        $returned = BorrowerRecord::where('status', Status::Returned);
        $rejected = BorrowerRecord::where('status', Status::Reject);
        $categories = Category::all();
        $permissions = Permission::all();
        View::share([
            'users' => $users,
            'borrower_records' => $borrower_records,
            'latest_books' => $latest_books,
            'roles' => $roles,
            'categories' => $categories,
            'request' => $request,
            'borrowed' => $borrowed,
            'returned' => $returned,
            'rejected' => $rejected,
            'permissions' => $permissions,
        ]);
    }

    public function index()
    {
        return view('admin.pages.home');
    }

    public function showAll()
    {
        return view('admin.pages.users');
    }

    public function showBooks()
    {
        return view('admin.pages.books');
    }

    public function getData()
    {
        $users = User::where('role_id', '!=', UserRole::Administrator)
            ->orderBy('created_at', 'DESC')
            ->get();

        return Datatables::of($users)
            ->addColumn('location', function($user) {
                foreach ($user->locations as $location) {
                    return $location->apartment_number.','.$location->street;
                }
            })
            ->addColumn('action', '
                <a href="{{ route(\'user.edit\', $id) }}">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>&#124;
                <form action="{{ route(\'user.delete\', $id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </form>'
            )
            ->rawColumns(['action'])
            ->make('true');
    }

    public function getBookDatas()
    {
        $books = Book::orderBy('created_at', 'DESC');

        return Datatables::of($books)
            ->addColumn('author', function($book) {
                return $book->user->name;
            })
            ->addColumn('publisher', function($book) {
                return $book->publisher->name;
            })
            ->addColumn('category', function($book) {
                return $book->category->name;
            })
            ->addColumn('action', '
                <a href="{{ route(\'book.edit\', $id) }}" data-toggle="tooltip">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>&#124;
                <form action="{{ route(\'book.delete\', $id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </form>'
            )
            ->rawColumns(['action', 'author', 'publisher', 'category'])
            ->make('true');
    }

    public function edit($id)
    {
        try{
            $user = User::findOrFail($id);

            return view('admin.pages.edituser', compact('user'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user.list');
    }

    public function editBook($id)
    {
        try{
            $book = Book::findOrFail($id);

            return view('admin.pages.editbook', compact('book'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function addBook()
    {
        return view('admin.pages.addbook');
    }

    public function showBorrowerRecord()
    {
        return view('admin.pages.records');
    }

    public function getRecordData()
    {
        $borrower_records = BorrowerRecord::orderBy('created_at', 'DESC');

        return Datatables::of($borrower_records)
            ->addColumn('user', function($borrower_record) {
                return $borrower_record->user->name;
            })
            ->addColumn('book', function($borrower_record) {
                return $borrower_record->book->name;
            })
            ->addColumn('action', '
                <a href="{{ route(\'record.detail\', $id) }}">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>'
            )
            ->editColumn('status', function($borrower_record) {
                if ($borrower_record->status == Status::Request) {
                    return "Requesting";
                }
                if ($borrower_record->status == Status::Borrowed) {
                    return "Borrowed";
                }
                if ($borrower_record->status == Status::Returned) {
                    return "Returned";
                }
                if ($borrower_record->status == Status::Reject) {
                    return "Rejected";
                }
            })
            ->rawColumns(['book', 'user', 'action'])
            ->make('true');
    }

    public function showRequest()
    {
        return view('admin.pages.requests');
    }

    public function getRequestData()
    {
        $borrower_records = BorrowerRecord::where('status', '=', Status::Request)
            ->orderBy('created_at', 'DESC')
            ->get();

        return Datatables::of($borrower_records)
            ->addColumn('user', function($borrower_record) {
                return $borrower_record->user->name;
            })
            ->addColumn('book', function($borrower_record) {
                return $borrower_record->book->name;
            })
            ->addColumn('action', '
                <a href="{{ route(\'record.detail\', $id) }}">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>&#124;
                <form action="{{ route(\'record.reject\', $id) }}" method="POST">
                    @csrf
                    @method("PATCH")
                    <button type="submit"><i class="fa fa-ban" aria-hidden="true"></i></button>
                </form>'
            )
            ->editColumn('status', function($borrower_record) {
                if ($borrower_record->status == Status::Request) {
                    return "Requesting";
                }
            })
            ->rawColumns(['book', 'user', 'action'])
            ->make('true');
    }

    public function recordDetail($id)
    {
        try {
            $borrower_record = BorrowerRecord::find($id);
            $user = User::find($borrower_record->user_id);

            return view('admin.pages.editrecord', compact('borrower_record', 'user'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function replyRequest($id)
    {
        $available = true;
        $min = true;
        $new_book = true;
        $borrowed_books = 0;
        $returned_books = 0;
        $borrower_record = BorrowerRecord::find($id);
        $user = User::find($borrower_record->user_id);
        $availabe_message = '';
        $min_message = '';
        $new_book_message = '';
        if ($borrower_record->book->quantity == config('const.empty')) {
            $available = false;
            $availabe_message = trans('page.am');
        }
        foreach ($user->borrowerRecords as $record) {
            if ($record->status == Status::Borrowed) {
                $borrowed_books++;
            }
            if ($record->status == Status::Returned) {
                $returned_books++;
            }
        }
        $latest_book = BorrowerRecord::where([
                'book_id' => $borrower_record->book_id,
                'user_id' => $borrower_record->user_id,
                'status' => Status::Borrowed
            ])->first();
        if ($latest_book) {
            $new_book = false;
            $new_book_message = trans('page.nm');
        }
        $number_of_books = $borrowed_books - $returned_books;
        if ($number_of_books > Status::Maximum ) {
            $min = false;
            $min_message = trans('page.mm');
        }
        if ($available && $new_book && $min) {
            $book = Book::find($borrower_record->book_id);
            $book->quantity = $book->quantity - Status::Unit;
            $borrower_record->status = Status::Borrowed;
            $borrower_record->save();
            $book->borrowerRecords()->save($borrower_record);
            $book->save();

            return redirect()->route('record.list');
        } else {
            return redirect()->route('record.detail', $id)->with([
                'am' => $availabe_message,
                'mm' => $min_message,
                'nm' => $new_book_message,
            ]);
        }
    }

    public function rejectRequest($id)
    {
        try {
            $borrower_record = BorrowerRecord::find($id);
            $borrower_record->status = Status::Reject;
            $borrower_record->save();

            return redirect()->route('record.list');
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function returnRequest($id)
    {
        try {
            $borrower_record = BorrowerRecord::find($id);
            $book = Book::find($borrower_record->book_id);
            $book->quantity = $book->quantity + Status::Unit;
            $borrower_record->status = Status::Returned;
            $borrower_record->save();
            $book->borrowerRecords()->save($borrower_record);
            $book->save();

            return redirect()->route('record.list');
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function showBorrowed()
    {
        return view('admin.pages.borrowed');
    }

    public function getBorrowedData()
    {
        $borrower_records = BorrowerRecord::where('status', '=', Status::Borrowed)
            ->orderBy('created_at', 'DESC')
            ->get();

        return Datatables::of($borrower_records)
            ->addColumn('user', function($borrower_record) {
                return $borrower_record->user->name;
            })
            ->addColumn('book', function($borrower_record) {
                return $borrower_record->book->name;
            })
            ->addColumn('action', '
                <a href="{{ route(\'record.detail\', $id) }}">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>&#124;
                <form action="{{ route(\'record.return\', $id) }}" method="POST">
                    @csrf
                    @method("PATCH")
                    <button type="submit"><i class="fa fa-undo" aria-hidden="true"></i></button>
                </form>'
            )
            ->editColumn('status', function($borrower_record) {
                if ($borrower_record->status == Status::Borrowed) {
                    return "Borrowed";
                }
            })
            ->rawColumns(['book', 'user', 'action'])
            ->make('true');
    }

    public function showReturned()
    {
        return view('admin.pages.returned');
    }

    public function getReturnedData()
    {
        $borrower_records = BorrowerRecord::where('status', '=', Status::Returned)
            ->orderBy('created_at', 'DESC')
            ->get();

        return Datatables::of($borrower_records)
            ->addColumn('user', function($borrower_record) {
                return $borrower_record->user->name;
            })
            ->addColumn('book', function($borrower_record) {
                return $borrower_record->book->name;
            })
            ->addColumn('action', '
                <a href="{{ route(\'record.detail\', $id) }}">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>'
            )
            ->editColumn('status', function($borrower_record) {
                if ($borrower_record->status == Status::Returned) {
                    return "Returned";
                }
            })
            ->rawColumns(['book', 'user', 'action'])
            ->make('true');
    }

    public function showAuthor()
    {
        return view('admin.pages.authors');
    }

    public function getAuthorData()
    {
        $users = User::where('role_id', '=', UserRole::Author)->get();

        return Datatables::of($users)
            ->addColumn('location', function($user) {
                foreach ($user->locations as $location) {
                    return $location->apartment_number . ',' . $location->street;
                }
            })
            ->addColumn('action', '
                <a href="{{ route(\'user.edit\', $id) }}">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>&#124;
                <form action="{{ route(\'user.delete\', $id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </form>'
            )
            ->rawColumns(['action'])
            ->make('true');
    }

    public function showReader()
    {
        return view('admin.pages.readers');
    }

    public function getReaderData()
    {
        $users = User::where('role_id', '=', UserRole::User)
            ->orderBy('created_at', 'DESC')
            ->get();

        return Datatables::of($users)
            ->addColumn('location', function($user) {
                foreach ($user->locations as $location) {
                    return $location->apartment_number.','.$location->street;
                }
            })
            ->addColumn('action', '
                <a href="{{ route(\'user.edit\', $id) }}">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>&#124;
                <form action="{{ route(\'user.delete\', $id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </form>'
            )
            ->rawColumns(['action'])
            ->make('true');
    }

    public function showPublisher()
    {
        return view('admin.pages.publishers');
    }

    public function getPublisherData()
    {
        $publishers = Publisher::orderBy('created_at', 'DESC');

        return Datatables::of($publishers)
            ->addColumn('action', '
                <a href="{{ route(\'publisher.edit\', $id) }}">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>&#124;
                <form action="{{ route(\'publisher.delete\', $id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </form>'
            )
            ->rawColumns(['action'])
            ->make('true');
    }

    public function editPublisher($id)
    {
        try {
            $publisher = Publisher::find($id);

            return view('admin.pages.editpublishers', compact('publisher'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function savePublisher(Request $request, $id)
    {
        try {
            $publisher = Publisher::find($id);
            $publisher->name = $request->name;
            $publisher->slug = Str::slug($request->name);
            $publisher->location = $request->location;
            $publisher->save();

            return redirect()->route('publisher.all')->with('success', trans('page.updatesuccessfully'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function deletePublisher($id)
    {
        $publisher = Publisher::find($id);
        $publisher->delete();

        return redirect()->route('publisher.all');
    }

    public function createPublisher()
    {
        return view('admin.pages.addpublisher');
    }

    public function storePublisher(PublisherRequest $request)
    {
        $publisher = Publisher::create([
            'code' => Str::random(config('const.code')),
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'location' => $request->location,
        ]);

        return redirect()->route('publisher.all')->with('createsucccessfully', trans('page.createsucccessfully'));
    }

    public function add()
    {
        return view('admin.pages.adduser');
    }

    public function storeUser(RegisterRequest $request)
    {
        $datas = $request->all();
        $new_user = User::create([
            'code' => Str::random(config('const.code')),
            'name' => $datas['name'],
            'user_slug' => Str::slug($datas['name']),
            'email' => $datas['email'],
            'phone_number' => $datas['phone_number'],
            'username' => $datas['username'],
            'password' => Hash::make($datas['password']),
            'role_id' => $datas['role_id'],
        ]);
        $user = User::find($new_user->id);
        $location = $user->locations()->create([
            'apartment_number' => $datas['apartment_number'],
            'street' => $datas['street'],
            'ward' => $datas['ward'],
            'district' => $datas['district'],
            'city' => $datas['city'],
            'user_id' => $user->id,
        ]);

        return redirect()->route('user.list')->with('createsucccessfully', trans('page.createsucccessfully'));
    }

    public function showCategory()
    {
        return view('admin.pages.categories');
    }

    public function getCategoryData()
    {
        $categories = Category::all();

        return Datatables::of($categories)
            ->addColumn('action', '
                <a href="{{ route(\'category.edit\', $id) }}">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>&#124;
                <form action="{{ route(\'category.delete\', $id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </form>'
            )
            ->editColumn('parent_id', function($category) {
                if ($category->parent_id == config('const.empty')) {
                    return $category->name;
                } else {
                    return $category->parent->name;
                }
            })
            ->rawColumns(['action'])
            ->make('true');
    }

    public function createCategory()
    {
        return view('admin.pages.addcategory');
    }

    public function storeCategory(CategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' =>$request->description,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('category.list')->with('createsucccessfully', trans('page.createsucccessfully'));
    }

    public function editCategory($id)
    {
        try {
            $category = Category::find($id);

            return view('admin.pages.editcategory', compact('category'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function saveCategory(Request $request, $id)
    {
        try {
            $category = Category::find($id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->parent_id = $request->parent_id;
            $category->save();

            return redirect()->route('category.list');
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function deleteCategory($id)
    {
        try{
            $category = Category::find($id);
            $category->delete();

            return redirect()->route('category.list');
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function showRejected()
    {
        return view('admin.pages.rejects');
    }

    public function getRejectedData()
    {
        $borrower_records = BorrowerRecord::where('status', '=', Status::Reject)
            ->orderBy('created_at', 'DESC')
            ->get();

        return Datatables::of($borrower_records)
            ->addColumn('user', function($borrower_record) {
                return $borrower_record->user->name;
            })
            ->addColumn('book', function($borrower_record) {
                return $borrower_record->book->name;
            })
            ->addColumn('action', '
                <a href="{{ route(\'record.detail\', $id) }}">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>'
            )
            ->editColumn('status', function($borrower_record) {
                if ($borrower_record->status == Status::Returned) {
                    return "Rejected";
                }
            })
            ->rawColumns(['book', 'user', 'action'])
            ->make('true');
    }

    public function showRoles()
    {
        return view('admin.pages.roles');
    }

    public function getRolesData()
    {
        $roles = Role::all();

        return Datatables::of($roles)
            ->addColumn('action', '
                <a href="{{ route(\'role.edit\', $id) }}">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>'
            )
            ->rawColumns(['action'])
            ->make('true');
    }

    public function editRole($id)
    {
        try{
            $role = Role::find($id);

            return view('admin.pages.editrole', compact('role'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function saveRole(RoleRequest $request, $id)
    {
        try{
            $role = Role::find($id);
            $this->authorize($role, 'update');
            $role->name = $request->name;
            $role->description = $request->description;
            $role->permissions()->sync($request->permission_id);

            return redirect()->route('role.edit', $id)->with('success', trans('page.updatesuccessfully'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function addRole()
    {
        return view('admin.pages.addrole');
    }

    public function storeRole(RoleRequest $request)
    {
        $this->authorize(Role::class, 'create');
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $role->permissions()->sync($request->permission_id);

        return redirect()->route('role.list')->with('createsucccessfully', trans('page.createsucccessfully'));
    }

    public function deleteRole($id)
    {
        try{
            $role = Role::find($id);
            $role->permissions()->detach();
            $role->delete();

            return redirect()->route('role.list')->with('success', trans('page.updatesuccessfully'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }
}
