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
    Route::get('{book}/details', 'BookController@detail')->name('book.detail');
});

Route::group(['prefix' => 'users'], function() {
    Route::get('{user}/details', 'UserController@detail')->name('user.detail');
});
