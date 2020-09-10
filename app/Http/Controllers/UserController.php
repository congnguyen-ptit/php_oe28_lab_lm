<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepoInterface;

class UserController extends Controller
{
    protected $userRepo;

    function __construct(
        UserRepoInterface $userRepo
    ) {
        $this->userRepo = $userRepo;
    }
    public function detail($slug)
    {
        try {
            $follow = false;
            $data = [
                'user_slug' => $slug,
            ];
            $user = $this->userRepo->findByAttrGetOne($data);
            if (Auth::check()) {
                $follow = $this->userRepo->checkFollow($user, Auth::id());
            } else {
                $follow = false;
            }

            return view('user.pages.userview')->with([
                'user' => $user,
                'follow' => $follow,
            ]);
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function follow($id)
    {
        $user = $this->userRepo->findById($id);
        $this->userRepo->follow($id, Auth::id());

        return response()->json([
            'user' => $user,
            'success' => trans('page.followed'),
        ]);
    }

    public function unfollow($id)
    {
        $user = $this->userRepo->findById($id);
        $this->userRepo->unfollow($id, Auth::id());

        return response()->json([
            'user' => $user,
            'success' => trans('page.unfollowed'),
        ]);
    }

    public function myAccount($id)
    {
        $user = $this->userRepo->findById($id);

        return view('user.pages.myaccount', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        try {
            $this->userRepo->update($id, $data);

            return response()->json([
                'success' => trans('page.su'),
            ]);
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function addBook()
    {
        return view('user.pages.addbook');
    }

    public function checkInput(Request $request)
    {
        if (isset($request->email_check)) {
            $data = [
                'email' => $request->email,
            ];
            $user_email = $this->userRepo->findByAttr($data);
            if(count($user_email) > config('const.empty') ) {
                return response()->json([
                    'existed' => true,
                    'message' => trans('page.email.existed'),
                ]);
            } else {
                return response()->json([
                    'existed' => false,
                ]);
            }
            exit();
        }
        if (isset($request->phone_check)) {
            $data = [
                'phone_number' => $request->phone_number,
            ];
            $user_phone_number = $this->userRepo->findByAttr($data);
            if(count($user_phone_number) > config('const.empty') ) {
                return response()->json([
                    'existed' => true,
                    'message' => trans('page.username.existed'),
                ]);
            } else {
                return response()->json([
                    'existed' => false,
                ]);
            }
            exit();
        }
        if (isset($request->username_check)) {
            $data = [
                'username' => $request->username,
            ];
            $user_username = $this->userRepo->findByAttr($data);
            if(count($user_username) > config('const.empty') ) {
                return response()->json([
                    'existed' => true,
                    'message' => trans('page.username.existed'),
                ]);
            } else {
                return response()->json([
                    'existed' => false,
                ]);
            }
            exit();
        }
    }
}
