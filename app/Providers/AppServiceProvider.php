<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Models\Category;
use App\Http\Models\Book;

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
        $categories = Category::where('parent_id', '=', '0')->get();
        $child_categories = Category::where('parent_id', '>', '0')->get();
        $books = Book::all();
        View::share([
            'categories' => $categories,
            'child_categories' => $child_categories,
            'books' => $books,
        ]);
    }
}
