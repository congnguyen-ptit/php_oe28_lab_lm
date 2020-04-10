<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use App\Http\Models\Category;
use App\Http\Models\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($slug)
    {
        try {
            $follow = false;
            $user = User::where('user_slug', $slug)->firstOrFail();
            if (Auth::check()) {
                $follow = $user->followed()->wherePivot('follower_id', Auth::id())->exists();
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
        $user = User::find($id);
        $user->followed()->attach(Auth::id());

        return redirect()->route('user.detail', $user->user_slug);
    }

    public function unfollow($id)
    {
        $user = User::find($id);
        $user->followed()->detach(Auth::id());

        return redirect()->route('user.detail', $user->user_slug);
    }

    public function myAccount($id)
    {
        $user = User::find($id);

        return view('user.pages.myaccount', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $datas = $request->all();
        try{
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->user_slug = Str::slug($request->name);
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->role_id = $request->role_id;
            $locations = Location::where('user_id', $id)->get();
            foreach ($locations as $key => $location) {
                $location->apartment_number = $datas['apartment_number'][$key];
                $location->street = $datas['street'][$key];
                $location->ward = $datas['ward'][$key];
                $location->district = $datas['district'][$key];
                $location->city = $datas['city'][$key];
                $location->save();
                $user->locations()->save($location);
            }
            $user->save();

            return redirect()->back()->with('success', trans('page.su'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

    public function addBook()
    {
        return view('user.pages.addbook');
    }
}
