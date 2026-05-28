<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;   
use App\Http\Controllers\FollowController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [PostController::class, 'index'])
        ->name('dashboard');

    Route::get('/post/create', [PostController::class, 'create'])
        ->name('post.create');

    Route::post('/post/create', [PostController::class, 'store'])
        ->name('post.store');

    Route::get('/post/{post:slug}', [PostController::class, 'show'])
        ->name('post.show');

    Route::get('/post/{post:slug}/edit', [PostController::class, 'edit'])
        ->name('post.edit');

    Route::patch('/post/{post:slug}', [PostController::class, 'update'])
        ->name('post.update');

    Route::delete('/post/{post:slug}', [PostController::class, 'destroy'])
        ->name('post.destroy');
    
    // Like/Unlike Toggle Action
    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('posts.like');

    // Follow/Unfollow Toggle Action
    Route::post('/users/{user}/follow', [FollowController::class, 'toggle'])->name('users.follow');

    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public Author Profile Route
Route::get('/@{username}', [ProfileController::class, 'show'])
    ->name('profile.public');// if u keep this outside the middleware then anyone can see the authors's post

require __DIR__.'/auth.php';
