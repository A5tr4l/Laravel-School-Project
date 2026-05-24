<?php

use Illuminate\Support\Facades\Route;
use App\Models\Comment;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('home');
})->middleware('auth');

use App\Http\Controllers\PostController;

Route::post('/posts', [PostController::class, 'store'])->middleware('auth');
Route::get('/', [PostController::class, 'index'])->middleware('auth');
Route::get('/search', [PostController::class, 'search'])->middleware('auth');

use App\Http\Controllers\CommentController;

Route::post('/comments', [CommentController::class, 'store'])->middleware('auth');

use App\Http\Controllers\TopicController;

Route::post('/topics', [TopicController::class, 'store'])->middleware('auth');

Route::get('/topics/history', [TopicController::class, 'history'])->middleware('auth');
Route::get('/topics/{topic}', [TopicController::class, 'show'])->middleware('auth');