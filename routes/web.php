<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::GET('/', [BlogController::class, 'home']);
Route::GET('/', [BlogController::class, 'homeTest'])->name('blogs.homeTest');

Route::GET('blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::GET('/search', [BlogController::class, 'search'])->name('blogs.search');
Route::GET('blogs/create', [BlogController::class, 'create'])->name('blogs.create');
Route::GET('blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
Route::GET('blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::DELETE('blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
Route::PUT('blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
Route::POST('blogs', [BlogController::class, 'store'])->name('blogs.store');

Route::GET('authors', [AuthorController::class, 'index'])->name('authors.index');
Route::DELETE('authors/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');
Route::GET('authors/{id}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
Route::PUT('authors/{id}', [AuthorController::class, 'update'])->name('authors.update');
Route::GET('authors/create', [AuthorController::class, 'create'])->name('authors.create');
Route::POST('authors', [AuthorController::class, 'store'])->name('authors.store');

Route::GET('categories', action: [CategoryController::class, 'index'])->name('categories.index');
Route::GET('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::POST('categories', [CategoryController::class, 'store'])->name('categories.store');
Route::GET('categories/{slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::DELETE('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::PUT('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::resource('users', UserController::class);
Route::resource('tags', TagController::class);
Route::get('tags/showAll/{id}', [TagController::class, 'showAll'])->name('tags.showAll');
Route::get('blogs/showAll/{id}', [BlogController::class, 'showAll'])->name('blogs.showAll');




//CTRL + P

/*
 GET|HEAD        users .................................... users.index › UserController@index
  POST            users ................................... users.store › UserController@store
  GET|HEAD        users/create ............................ users.create › UserController@create
  GET|HEAD        users/{user} ........................... users.show › UserController@show
  PUT|PATCH       users/{user} ........................... users.update › UserController@update
  DELETE          users/{user} ........................... users.destroy › UserController@destroy
  GET|HEAD        users/{user}/edit ...................... users.edit › UserController@edit


*/
