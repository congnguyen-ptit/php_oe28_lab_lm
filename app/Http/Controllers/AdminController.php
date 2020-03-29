<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use App\Http\Models\Book;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
use App\Enums\UserRole;
use App\Http\Models\BorrowerRecord;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
        $users = User::where('role_id', '<', UserRole::Administrator)->get();
        $latest_books = Book::orderBy('created_at', 'DESC')->get();
        $borrower_records = BorrowerRecord::all();
        View::share([
            'users' => $users,
            'borrower_records' => $borrower_records,
            'latest_books' => $latest_books,
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

    public function getData()
    {
        $users = User::where('role_id', '<', UserRole::Administrator)->get();

        return Datatables::of($users)
            ->addColumn('location', function($user) {
                foreach ($user->locations as $location) {
                    return $location->apartment_number.','.$location->street;
                }
            })
            ->addColumn('action', function($user) {
                return '<a href="/admin/edit/'.$user->id.'" class="btn btn-primary">'.trans('page.edit').'</a>
                        <a href="/admin/delete/'.$user->id.'" class="btn btn-danger">'.trans('page.delete').'</a>';
            })
            ->rawColumns(['action'])
            ->make('true');
    }

    public function edit($id)
    {
        //
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user.list');
    }

    public function showCategory($slug)
    {
        //
    }

}
