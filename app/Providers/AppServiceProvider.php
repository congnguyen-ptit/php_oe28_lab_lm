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
        $this->app->singleton(
            \App\Repositories\Book\BookRepoInterface::class,
            \App\Repositories\Book\BookRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Category\CategoryRepoInterface::class,
            \App\Repositories\Category\CategoryRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Publisher\PublisherRepoInterface::class,
            \App\Repositories\Publisher\PublisherRepository::class
        );
        $this->app->singleton(
            \App\Repositories\User\UserRepoInterface::class,
            \App\Repositories\User\UserRepository::class
        );
        $this->app->singleton(
            \App\Repositories\BorrowerRecord\BorrowerRecordRepoInterface::class,
            \App\Repositories\BorrowerRecord\BorrowerRecordRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Location\LocationRepoInterface::class,
            \App\Repositories\Location\LocationRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Role\RoleRepoInterface::class,
            \App\Repositories\Role\RoleRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Permission\PermissionRepoInterface::class,
            \App\Repositories\Permission\PermissionRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $categories = Category::where('parent_id', '=', config('const.empty'))->get();
//        $child_categories = Category::where('parent_id', '>', config('const.empty'))->get();
//        $books = Book::all();
//        $authors = User::where('role_id', '=', config('const.author'))->get();
//        $publishers = Publisher::all();
//        View::share([
//            'categories' => $categories,
//            'child_categories' => $child_categories,
//            'books' => $books,
//            'authors' => $authors,
//            'publishers' => $publishers,
//        ]);
    }
}
