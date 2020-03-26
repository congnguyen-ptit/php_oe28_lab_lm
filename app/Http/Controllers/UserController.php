<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use App\Http\Models\Category;
use Illuminate\Support\Facades\Auth;

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
            $user = User::where('user_slug', $slug)->firstOrFail();

            return view('user.pages.userview', compact('user'));
        } catch (ModelNotFoundException $e) {
            response()->view('errors.404_user_not_found', [], 404);
        }
    }

}
