<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.pages.home');
    }
}
