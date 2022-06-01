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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/books', 'BookController');

Route::post('/books/book_comment/store', 'BookCommentController@store')->name('book_comment.store');
Route::delete('/books/book_comment/{book_comment}', 'BookCommentController@destroy')->name('book_comment.destroy');

Route::get('/reply/favorite/{book}', 'FavoriteController@favorite')->name('favorite');
Route::get('/reply/unfavorite/{book}', 'FavoriteController@unfavorite')->name('unfavorite');

Route::resource('users', 'UserController');
