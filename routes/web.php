<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth' => 'admin']], function() {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
});

Route::group(['prefix' => 'books'], function() {
    Route::get('/', 'BookController@index')->name('books.list');
    Route::get('{book}/details', 'BookController@detail')->name('book.detail');
    Route::get('/categories/{category}', 'BookController@showByCategory')->name('book.category');
    Route::get('/publishers/{publisher}', 'BookController@showByPublisher')->name('book.publisher');
    Route::get('/authors/{author}', 'BookController@showByAuthor')->name('book.author');
    Route::get('/search', 'BookController@searchByCategory')->name('book.search');
    Route::get('{category}', 'BookController@getChildrenCategories')->name('book.allcategories');
    Route::get('/like/{book}', 'BookController@likeBook')->name('book.like')->middleware('auth');
    Route::get('/unlike/{book}', 'BookController@unlikeBook')->name('book.unlike')->middleware('auth');
});

Route::group(['prefix' => 'users'], function() {
    Route::get('{user}/details', 'UserController@detail')->name('user.detail');
    Route::get('/follow/{user}', 'UserController@follow')->name('user.follow')->middleware('auth');
    Route::get('/unfollow/{user}', 'UserController@unfollow')->name('user.unfollow')->middleware('auth');
    Route::get('/myaccount/{id}', 'UserController@myAccount')->name('user.account')->middleware('auth');
    Route::post('/request', 'BorrowerRecordsController@request')->name('user.request')->middleware('auth');
});

Route::post('/comments/{book}', 'CommentController@store')->name('comments');

Route::group(['prefix' => 'bookbag'], function() {
    Route::get('/', 'BookbagController@index')->name('bookbag.index');
    Route::get('/add/{book}', 'BookbagController@addBook')->name('bookbag.add');
    Route::get('/remove/{book}', 'BookbagController@removeBook')->name('bookbag.remove');
});
