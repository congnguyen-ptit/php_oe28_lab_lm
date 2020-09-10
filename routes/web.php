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
Route::get('login/{service}', 'Auth\LoginController@redirectToProvider')->name('login.service');
Route::get('login/{service}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth' => 'admin']], function() {
    Route::post('/markAsRead/{id}', 'AdminController@markAsRead')->name('read');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::group(['prefix' => 'users', 'as' => 'user.'], function() {
        Route::get('/', 'AdminController@showAll')->name('list');
        Route::get('/all', 'AdminController@getData')->name('data');
        Route::get('/add', 'AdminController@add')->name('add');
        Route::post('/store', 'AdminController@storeUser')->name('store');
        Route::get('/{id}/edit', 'AdminController@edit')->name('edit');
        Route::delete('/{id}/delete', 'AdminController@delete')->name('delete');
        Route::get('/authors', 'AdminController@showAuthor')->name('author');
        Route::get('/authors/all', 'AdminController@getAuthorData')->name('authorData');
        Route::get('/readers', 'AdminController@showReader')->name('reader');
        Route::get('/readers/all', 'AdminController@getReaderData')->name('readerData');
    });
    Route::group(['prefix' => 'books', 'as' => 'book.'], function() {
        Route::get('/', 'AdminController@showBooks')->name('list');
        Route::get('/{id}/edit', 'AdminController@editBook')->name('edit');
        Route::get('/add', 'AdminController@addBook')->name('add');
    });
    Route::group(['prefix' => 'borrower-records', 'as' => 'record.'], function() {
        Route::get('/', 'AdminController@showBorrowerRecord')->name('list');
        Route::get('/{id}/detail', 'AdminController@recordDetail')->name('detail');
        Route::get('/request', 'AdminController@showRequest')->name('request');
        Route::get('/borrowed', 'AdminController@showBorrowed')->name('borrowed');
        Route::get('/returned', 'AdminController@showReturned')->name('returned');
        Route::get('/rejected', 'AdminController@showRejected')->name('rejected');
        Route::patch('/{id}/check/', 'AdminController@replyRequest')->name('reply');
        Route::patch('/{id}/reject/', 'AdminController@rejectRequest')->name('reject');
        Route::patch('/{id}/return/', 'AdminController@returnRequest')->name('return');
    });
    Route::group(['prefix' => 'publishers', 'as' => 'publisher.'], function() {
        Route::get('/', 'AdminController@showPublisher')->name('all');
        Route::get('/add', 'AdminController@createPublisher')->name('add');
        Route::post('/store', 'AdminController@storePublisher')->name('store');
        Route::get('/{id}/edit', 'AdminController@editPublisher')->name('edit');
        Route::patch('/{id}/save', 'AdminController@savePublisher')->name('save');
        Route::delete('/{id}/delete/', 'AdminController@deletePublisher')->name('delete');
        Route::post('/check', 'AdminController@checkPublisher')->name('check');
    });
    Route::group(['prefix' => 'categories', 'as' => 'category.'], function() {
        Route::get('/', 'AdminController@showCategory')->name('list');
        Route::get('/all', 'AdminController@getCategoryData')->name('data');
        Route::get('/add', 'AdminController@createCategory')->name('add');
        Route::post('/store', 'AdminController@storeCategory')->name('store');
        Route::get('/{id}/edit', 'AdminController@editCategory')->name('edit');
        Route::patch('/{id}/save', 'AdminController@saveCategory')->name('save');
        Route::delete('/{id}/delete', 'AdminController@deleteCategory')->name('delete');
        Route::post('check/', 'AdminController@checkCate')->name('check');
    });
    Route::group(['prefix' => 'roles', 'as' => 'role.'], function() {
        Route::get('/', 'AdminController@showRoles')->name('list');
        Route::get('/all', 'AdminController@getRolesData')->name('data');
        Route::get('/{id}/edit', 'AdminController@editRole')->name('edit');
        Route::patch('/{id}/save', 'AdminController@saveRole')->name('save');
        Route::get('/add', 'AdminController@addRole')->name('add');
        Route::post('/store', 'AdminController@storeRole')->name('store');
        Route::delete('/{id}/delete', 'AdminController@deleteRole')->name('delete');
        Route::post('/check', 'AdminController@checkRole')->name('check');
    });
});

Route::group(['prefix' => 'books', 'as' => 'book.'], function() {
    Route::get('{book}/details', 'BookController@showBySlug')->name('detail');
    Route::get('/categories/{category}', 'BookController@showByCategory')->name('category');
    Route::get('/publishers/{publisher}', 'BookController@showByPublisher')->name('publisher');
    Route::get('/authors/{author}', 'BookController@showByAuthor')->name('author');
    Route::get('/search', 'BookController@searchByCategory')->name('search');
    Route::get('{category}', 'BookController@getChildrenCategories')->name('allcategories');
    Route::get('/like/{book}', 'BookController@like')->name('like')->middleware(['auth']);
    Route::get('/unlike/{book}', 'BookController@unlike')->name('unlike')->middleware('auth');
});

Route::resource('books', 'BookController');

Route::group(['prefix' => 'users', 'as' => 'user.'], function() {
    Route::get('{user}/details', 'UserController@detail')->name('detail');
    Route::get('/follow/{user}', 'UserController@follow')->name('follow')->middleware('auth');
    Route::get('/unfollow/{user}', 'UserController@unfollow')->name('unfollow')->middleware('auth');
    Route::get('/myaccount/{id}', 'UserController@myAccount')->name('account')->middleware('auth');
    Route::post('/request', 'BorrowerRecordsController@request')->name('request')->middleware('auth');
    Route::patch('/{id}/save', 'UserController@update')->name('save');
    Route::get('/books/add', 'UserController@addBook')->name('book');
    Route::post('/check', 'UserController@checkInput')->name('check');
});

Route::post('/comments/{book}', 'CommentController@store')->name('comments');

Route::group(['prefix' => 'bookbag'], function() {
    Route::get('/', 'BookbagController@index')->name('bookbag.index');
    Route::get('/add/{book}', 'BookbagController@addBook')->name('bookbag.add');
    Route::get('/remove/{book}', 'BookbagController@removeBook')->name('bookbag.remove');
});

Route::group(['prefix' => 'borrower-records'], function() {
    Route::delete('/{id}/delete', 'BorrowerRecordsController@recordDelete')->name('record.delete');
});
