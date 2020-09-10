<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\PublisherRequest;
use App\Http\Models\Permission;

use App\Http\Models\Comment;
use App\Enums\UserRole;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use App\Enums\Status;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Category\CategoryRepoInterface;
use App\Repositories\Publisher\PublisherRepoInterface;
use App\Repositories\Book\BookRepoInterface;
use App\Repositories\User\UserRepoInterface;
use App\Repositories\BorrowerRecord\BorrowerRecordRepoInterface;
use App\Repositories\Location\LocationRepoInterface;
use App\Repositories\Role\RoleRepoInterface;
use App\Repositories\Permission\PermissionRepoInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $categoryRepo;
    protected $pubRepo;
    protected $bookRepo;
    protected $userRepo;
    protected $brRepo;
    protected $locationRepo;
    protected $roleRepo;
    protected $perRepo;

    public function __construct(
        CategoryRepoInterface $categoryRepo,
        PublisherRepoInterface $pubRepo,
        BookRepoInterface $bookRepo,
        UserRepoInterface $userRepo,
        BorrowerRecordRepoInterface $brRepo,
        LocationRepoInterface $locationRepo,
        RoleRepoInterface $roleRepo,
        PermissionRepoInterface $perRepo
    )
    {
        $this->middleware(['auth', 'admin']);
        $this->categoryRepo = $categoryRepo;
        $this->pubRepo = $pubRepo;
        $this->bookRepo = $bookRepo;
        $this->userRepo = $userRepo;
        $this->brRepo = $brRepo;
        $this->locationRepo = $locationRepo;
        $this->roleRepo = $roleRepo;
        $this->perRepo = $perRepo;
        $users = $this->userRepo->getLatestUsers();
        $latest_books = $this->bookRepo->getLatestBook();
        $roles = $this->roleRepo->getAll();
        $borrower_records = $this->brRepo->getAll();
        $data = [
            'request' => [
                'status' => Status::Request,
            ],
            'borrowed' => [
                'status' => Status::Borrowed,
            ],
            'returned' => [
                'status' => Status::Returned,
            ],
            'rejected' => [
                'status' => Status::Reject,
            ],
        ];
        $request = $this->brRepo->findByAttr($data['request']);
        $borrowed = $this->brRepo->findByAttr($data['borrowed']);
        $returned = $this->brRepo->findByAttr($data['returned']);
        $rejected = $this->brRepo->findByAttr($data['rejected']);
        $categories = $this->categoryRepo->getAllPaginate(config('const.getAll'));
        $permissions = $this->perRepo->getAllPaginate(config('const.getAll'));
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
        $users = $this->userRepo->getAllPaginate(config('const.getAll'));

        return view('admin.pages.users',[
            'title' => trans('page.members'),
            'users' => $users,
        ]);
    }

    public function showBooks()
    {
        $books = $this->bookRepo->getAllPaginate(config('const.getAll'));

        return view('admin.pages.books', [
            'books' => $books,
        ]);
    }

    public function edit($id)
    {
        try{
            $user = $this->userRepo->findById($id);

            return view('admin.pages.edituser', [
                'user' => $user,
            ]);
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function delete($id)
    {
        try {
            $this->userRepo->destroy($id);

            return response()->json([
                'success' => trans('page.deleted'),
                'redirect' => route('user.list'),
            ]);
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }

    }

    public function editBook($id)
    {
        try {
            $book = $this->bookRepo->findById($id);

            return view('admin.pages.editbook', [
                'book' => $book,
            ]);
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

        $records = $this->brRepo->getAllPaginate(config('const.getAll'));
        return view('admin.pages.records', [
            'records' => $records,
            'title' => trans('page.allrc')
        ]);
    }

    public function showRequest()
    {
        $data = [
            'status' => Status::Request,
        ];
        $records = $this->brRepo->findByAttrPaginate($data, config('const.getAll'));

        return view('admin.pages.records',  [
            'records' => $records,
            'title' => trans('page.requesting'),
        ]);
    }

    public function recordDetail($id)
    {
        try {
            $borrower_record = $this->brRepo->findById($id);
            $user = $this->userRepo->findById($borrower_record->user_id);

            return view('admin.pages.editrecord', [
                'borrower_record' => $borrower_record,
                'user' => $user,
            ]);
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
        $borrower_record = $this->brRepo->findById($id);
        $user = $this->userRepo->findById($borrower_record->user_id);

        if ($borrower_record->book->quantity == config('const.empty')) {
            $available = false;
            return json([
                'available' => $availabe,
                'am' => trans('page.am'),
            ]);
            exit();
        }
        foreach ($user->borrowerRecords as $record) {
            if ($record->status == Status::Borrowed) {
                $borrowed_books++;
            }
            if ($record->status == Status::Returned) {
                $returned_books++;
            }
        }
        $data = [
            'book_id' => $borrower_record->book_id,
            'user_id' => $borrower_record->user_id,
            'status' => Status::Borrowed,
        ];
        $latest_book = $this->brRepo->findFirst($data);
        if ($latest_book) {
            $new_book = false;
            return response()->json([
                'new_book' => $new_book,
                'new_book_message' => trans('page.nm'),
            ]);
            exit();
        }
        $number_of_books = $borrowed_books - $returned_books;
        if ($number_of_books > Status::Maximum ) {
            $min = false;
            return response()->json([
                'min' => $min,
                'min_message' => trans('page.nm'),
            ]);
            exit();
        }

        if ($available && $new_book && $min) {
            $borrowed_record_data = [
                'status' => Status::Borrowed,
            ];
            $this->brRepo->update($id, $borrowed_record_data);
            $this->bookRepo->updateBorrow($borrower_record->book_id, Status::Unit, $borrower_record);
            Mail::to($borrower_record->user->email)->send(new NotificationMail($borrower_record));

            return response()->json([
                'success' => trans('page.su'),
            ]);
        }
    }

    public function rejectRequest($id)
    {
        try {
            $data = [
                'status' => Status::Reject,
            ];
            $this->brRepo->update($id, $data);

            return response()->json([
                'success' => trans('page.su'),
            ]);
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function returnRequest($id)
    {
        try {
            $data = [
                'status' => Status::Returned,
            ];
            $this->brRepo->update($id, $data);
            $borrower_record = $this->brRepo->findById($id);
            $this->bookRepo->updateReturn($borrower_record->book_id, Status::Unit, $borrower_record);


            return response()->json([
                'success' => trans('page.su'),
            ]);
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function showBorrowed()
    {
        $data =[
            'status' => Status::Borrowed,
        ];
        $records = $this->brRepo->findByAttrPaginate($data, config('const.getAll'));

        return view('admin.pages.records', [
            'records' => $records,
            'title' => trans('page.borrowed'),
        ]);
    }

    public function showReturned()
    {
        $data =[
            'status' => Status::Returned,
        ];
        $records = $this->brRepo->findByAttrPaginate($data, config('const.getAll'));

        return view('admin.pages.records',  [
            'records' => $records,
            'title' => trans('page.returned'),
        ]);
    }

    public function showAuthor()
    {
        $data = [
            'role_id' => UserRole::Author,
        ];
        $users = $this->userRepo->findByAttrPaginate($data, config('const.getAll'));

        return view('admin.pages.users', [
            'users' => $users,
            'title' => trans('page.author'),
        ]);
    }

    public function showReader()
    {
        $data = [
            'role_id' => UserRole::User,
        ];
        $users = $this->userRepo->findByAttrPaginate($data, config('const.getAll'));

        return view('admin.pages.users', [
            'users' => $users,
            'title' => trans('page.user'),
        ]);
    }

    public function showPublisher()
    {
        $publishers = $this->pubRepo->getAllPaginate(config('const.getAll'));

        return view('admin.pages.publishers', compact('publishers'));
    }

    public function editPublisher($id)
    {
        try {
            $publisher = $this->pubRepo->findById($id);

            return view('admin.pages.editpublishers', compact('publisher'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function savePublisher(Request $request, $id)
    {
        $data = $request->all();
        try {
            $this->pubRepo->update($id, $data);

            return response()->json([
                'success' => trans('page.su'),
                'redirect' => route('publisher.list'),
            ]);
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function deletePublisher($id)
    {
        try {
            $this->pubRepo->destroy($id);

            return response()->json([
                'success' => trans('page.deleted'),
                'redirect' => route('publisher.list'),
            ]);
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function createPublisher()
    {
        return view('admin.pages.addpublisher');
    }

    public function storePublisher(PublisherRequest $request)
    {

        $data = [
            'code' => Str::random(config('const.code')),
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'location' => $request->location,
        ];
        $this->pubRepo->create($data);

        return response()->json([
            'success' => trans('page.createsucccessfully'),
            'redirect' => route('publisher.list'),
        ]);
    }

    public function add()
    {
        return view('admin.pages.adduser');
    }

    public function storeUser(RegisterRequest $request)
    {
        $userData = [
            'code' => Str::random(config('const.code')),
            'name' => $request->name,
            'user_slug' => Str::slug($request->name),
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ];
        $new_user = $this->userRepo->create($userData);
        $locationData = [
            'apartment_number' => $request->apartment_number,
            'street' => $request->street,
            'ward' => $request->ward,
            'district' => $request->district,
            'city' => $request->city,
            'user_id' => $new_user->id,
        ];
        $this->locationRepo->create($locationData);

        return response()->json([
            'success' => trans('page.createsucccessfully'),
            'redirect' => route('user.list'),
        ]);
    }

    public function showCategory()
    {
        $categories = $this->categoryRepo->getAllPaginate(config('const.getAll'));

        return view('admin.pages.categories', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.pages.addcategory');
    }

    public function storeCategory(CategoryRequest $request)
    {
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' =>$request->description,
            'parent_id' => $request->parent_id,
        ];
        $this->categoryRepo->create($data);

        return response()->json([
            'success' => trans('page.createsucccessfully'),
            'redirect' => route('category.list'),
        ]);
    }

    public function editCategory($id)
    {
        $category = $this->categoryRepo->findById($id);

        return view('admin.pages.editcategory', compact('category'));
    }

    public function saveCategory(Request $request, $id)
    {
        $data = $request->all();
        try {
            $this->categoryRepo->update($id, $data);

            return response()->json([
                'success' => trans('page.su'),
                'redirect' => route('category.list'),
            ]);
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function deleteCategory($id)
    {
        try {
            $this->categoryRepo->destroy($id);

            return response()->json([
                'success' => trans('page.deleted'),
                'redirect' => route('category.list'),
            ]);
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function showRejected()
    {
        $data =[
            'status' => Status::Reject,
        ];
        $records = $this->brRepo->findByAttrPaginate($data, config('const.getAll'));

        return view('admin.pages.records',  [
            'records' => $records,
            'title' => trans('page.rejected'),
        ]);
    }

    public function showRoles()
    {
        return view('admin.pages.roles');
    }

    public function editRole($id)
    {
        try {
            $role = $this->roleRepo->findById($id);

            return view('admin.pages.editrole', compact('role'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function saveRole(RoleRequest $request, $id)
    {
        $data = $request->all();
        try {
            $role = $this->roleRepo->findById($id);
            $this->authorize($role, 'update');
            $this->roleRepo->update($id, $data);

            return response()->json([
                'success' => trans('page.su'),
                'redirect' => route('role.list'),
            ]);
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
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        $role = $this->roleRepo->create($data);
        $role->permissions()->sync($request->permission_id);

        return response()->json([
            'success' => trans('page.createsucccessfully'),
            'redirect' => route('role.list'),
        ]);
    }

    public function deleteRole($id)
    {
        try {
            $role = $this->roleRepo->findById($id);
            $role->permissions()->detach();
            $this->roleRepo->destroy($id);

            return response()->json([
                'success' => trans('page.su'),
                'redirect' => route('role.list'),
            ]);
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function checkCate(Request $request){
        if (isset($request->name_check)) {
            $data = [
                'name' => $request->name,
            ];
            $categories = $this->categoryRepo->findByAttr($data);
            if (count($categories) > config('const.empty') ) {
                return response()->json([
                    'existed' => true,
                    'message' => trans('page.name.existed'),
                ]);
            } else {
                return response()->json([
                    'existed' => false,
                ]);
            }
        }
    }

    public function checkRole(Request $request)
    {
        if (isset($request->name_check)) {
            $data = [
                'name' => $request->name,
            ];
            $roles = $this->roleRepo->findByAttr($data);
            if (count($roles) > config('const.empty') ) {
                return response()->json([
                    'existed' => true,
                    'message' => trans('page.name.existed'),
                ]);
            } else {
                return response()->json([
                    'existed' => false,
                ]);
            }
        }
    }

    public function checkPublisher(Request $request)
    {
        if (isset($request->publisher_name_check)) {
            $data = [
                'name' => $request->name,
            ];
            $name = $this->pubRepo->findByAttr($data);
            if (count($name) > config('const.empty') ) {
                return response()->json([
                    'existed' => true,
                    'message' => trans('page.name.existed'),
                ]);
            } else {
                return response()->json([
                    'existed' => false,
                ]);
            }
        }
    }

    public function markAsRead($id) {
        Auth::user()->unreadNotifications->where('id', $id)->markAsRead();
    }
}
