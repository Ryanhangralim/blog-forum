<?php

use App\Http\Controllers\AdminCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\LikeController;

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

Route::get('/', function () {
    return view('home', [
        "title" => "Home"
    ]);
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "name" => "Ryan Hangralim", 
        "email" => "hangralim.2208561030@student.unud.ac.id"]);
});


Route::get('/posts', [PostController::class, 'index']);
//halaman single post
Route::get('posts/{post:slug}', [PostController::class, 'show']);

//halaman categories
Route::get('/categories', [CategoryController::class, 'index']);

//halaman blog penulis
Route::get('/authors/{author:username}', [AuthorController::class, 'show']);

//halaman category
Route::get('/categories/{category:slug}', [CategoryController::class, 'show']);

//halaman login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

//halaman register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

//halaman dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

//resource post
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');

//halaman category tanpa 'show'
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');

//comment
Route::post('/posts/{post:slug}', [CommentController::class, 'store'])->middleware('auth');

//like
Route::post('/comments/{comment:id}', [LikeController::class, 'add_like'])->middleware('auth');