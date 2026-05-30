<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [PostController::class, 'index'])
        ->name('dashboard');

    Route::get('/post/create', [PostController::class, 'create'])
        ->name('post.create');

    Route::post('/post/create', [PostController::class, 'store'])
        ->name('post.store');

    Route::get('/post/{post:slug}/edit', [PostController::class, 'edit'])
        ->name('post.edit');

    Route::patch('/post/{post:slug}', [PostController::class, 'update'])
        ->name('post.update');

    Route::delete('/post/{post:slug}', [PostController::class, 'destroy'])
        ->name('post.destroy');

    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])
        ->name('posts.like');

    Route::post('/users/{user}/follow', [FollowController::class, 'toggle'])
        ->name('users.follow');

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
        ->name('comments.store');
});

Route::get('/post/{post:slug}', [PostController::class, 'show'])
    ->name('post.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/@{username}', [ProfileController::class, 'show'])
    ->name('profile.public');

require __DIR__.'/auth.php';
