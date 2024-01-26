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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Only authenticated members can access these routes
Route::group(['middleware' => ['auth']], function () {

    Route::get('posts/create', 'App\Http\Controllers\PostController@create')->name('posts.create');
    Route::post('posts', 'App\Http\Controllers\PostController@store')->name('posts.store');
    Route::get('posts/{post}/edit', 'App\Http\Controllers\PostController@edit')->name('posts.edit');
    Route::delete('posts/{post}/destroy', 'App\Http\Controllers\PostController@destroy')->name('posts.destroy');
    Route::patch('posts/{post}/update', 'App\Http\Controllers\PostController@update')->name('posts.update');

 });

 Route::get('posts', 'App\Http\Controllers\PostController@index')->name('posts.index');
 Route::get('posts/{post}', 'App\Http\Controllers\PostController@show')->name('posts.show');
