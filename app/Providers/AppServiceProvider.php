<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Models\Category;
use App\Http\Models\Book;
use App\Http\Models\User;
use App\Http\Models\Publisher;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = Category::where('parent_id', '=', config('const.empty'))->get();
        $child_categories = Category::where('parent_id', '>', config('const.empty'))->get();
        $books = Book::all();
        $authors = User::where('role_id', '=', config('const.author'))->get();
        $publishers = Publisher::all();
        View::share([
            'categories' => $categories,
            'child_categories' => $child_categories,
            'books' => $books,
            'authors' => $authors,
            'publishers' => $publishers,
        ]);
    }
}
