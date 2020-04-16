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
        Route::get('/all', 'AdminController@getBookDatas')->name('data');
        Route::get('/{id}/edit', 'AdminController@editBook')->name('edit');
        Route::get('/add', 'AdminController@addBook')->name('add');
    });
    Route::group(['prefix' => 'borrower-records', 'as' => 'record.'], function() {
        Route::get('/', 'AdminController@showBorrowerRecord')->name('list');
        Route::get('/all', 'AdminController@getRecordData')->name('data');
        Route::get('/{id}/detail', 'AdminController@recordDetail')->name('detail');
        Route::get('/request', 'AdminController@showRequest')->name('request');
        Route::get('/request/all', 'AdminController@getRequestData')->name('requestData');
        Route::get('/borrowed', 'AdminController@showBorrowed')->name('borrowed');
        Route::get('/borrowed/all', 'AdminController@getBorrowedData')->name('borrowedData');
        Route::get('/returned', 'AdminController@showReturned')->name('returned');
        Route::get('/returned/all', 'AdminController@getReturnedData')->name('returnedData');
        Route::get('/rejected', 'AdminController@showRejected')->name('rejected');
        Route::get('/rejected/all', 'AdminController@getRejectedData')->name('rejectedData');
        Route::patch('/{id}/check/', 'AdminController@replyRequest')->name('reply');
        Route::patch('/{id}/reject/', 'AdminController@rejectRequest')->name('reject');
        Route::patch('/{id}/return/', 'AdminController@returnRequest')->name('return');
    });
    Route::group(['prefix' => 'publishers', 'as' => 'publisher.'], function() {
        Route::get('/', 'AdminController@showPublisher')->name('all');
        Route::get('/all', 'AdminController@getPublisherData')->name('data');
        Route::get('/add', 'AdminController@createPublisher')->name('add');
        Route::post('/store', 'AdminController@storePublisher')->name('store');
        Route::get('/{id}/edit', 'AdminController@editPublisher')->name('edit');
        Route::patch('/{id}/save', 'AdminController@savePublisher')->name('save');
        Route::delete('/{id}/delete/', 'AdminController@deletePublisher')->name('delete');
    });
    Route::group(['prefix' => 'categories', 'as' => 'category.'], function() {
        Route::get('/', 'AdminController@showCategory')->name('list');
        Route::get('/all', 'AdminController@getCategoryData')->name('data');
        Route::get('/add', 'AdminController@createCategory')->name('add');
        Route::post('/store', 'AdminController@storeCategory')->name('store');
        Route::get('/{id}/edit', 'AdminController@editCategory')->name('edit');
        Route::patch('/{id}/save', 'AdminController@saveCategory')->name('save');
        Route::delete('/{id}/delete', 'AdminController@deleteCategory')->name('delete');
    });
    Route::group(['prefix' => 'roles', 'as' => 'role.'], function() {
        Route::get('/', 'AdminController@showRoles')->name('list');
        Route::get('/all', 'AdminController@getRolesData')->name('data');
        Route::get('/{id}/edit', 'AdminController@editRole')->name('edit');
        Route::patch('/{id}/save', 'AdminController@saveRole')->name('save');
        Route::get('/add', 'AdminController@addRole')->name('add');
        Route::post('/store', 'AdminController@storeRole')->name('store');
        Route::delete('/{id}/delete', 'AdminController@deleteRole')->name('delete');
    });
});

Route::group(['prefix' => 'books', 'as' => 'book.'], function() {
    Route::get('/', 'BookController@index')->name('books.list');
    Route::get('{book}/details', 'BookController@detail')->name('detail');
    Route::get('/categories/{category}', 'BookController@showByCategory')->name('category');
    Route::get('/publishers/{publisher}', 'BookController@showByPublisher')->name('publisher');
    Route::get('/authors/{author}', 'BookController@showByAuthor')->name('author');
    Route::get('/search', 'BookController@searchByCategory')->name('search');
    Route::get('{category}', 'BookController@getChildrenCategories')->name('allcategories');
    Route::get('/like/{book}', 'BookController@likeBook')->name('like')->middleware('auth');
    Route::get('/unlike/{book}', 'BookController@unlikeBook')->name('unlike')->middleware('auth');
    Route::post('/store', 'BookController@store')->name('store');
    Route::patch('/{id}/save', 'BookController@update')->name('save');
    Route::delete('/{id}/delete', 'BookController@delete')->name('delete');
});

Route::group(['prefix' => 'users', 'as' => 'user.'], function() {
    Route::get('{user}/details', 'UserController@detail')->name('detail');
    Route::get('/follow/{user}', 'UserController@follow')->name('follow')->middleware('auth');
    Route::get('/unfollow/{user}', 'UserController@unfollow')->name('unfollow')->middleware('auth');
    Route::get('/myaccount/{id}', 'UserController@myAccount')->name('account')->middleware('auth');
    Route::post('/request', 'BorrowerRecordsController@request')->name('request')->middleware('auth');
    Route::patch('/{id}/save', 'UserController@update')->name('save');
    Route::get('/books/add', 'UserController@addBook')->name('book');
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
