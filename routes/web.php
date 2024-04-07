<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostReplyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PostController::class, 'index'])->name('home');

Route::resource('posts', PostController::class)
    ->only(['index', 'store', 'show', 'edit', 'destroy']);

Route::resource('postreplies', PostReplyController::class)
    ->only(['edit', 'destroy']);

Route::post('/posts/{post}/storeReply/', [PostReplyController::class, 'store'])->middleware('auth')
    ->name('posts.storeReply');

Route::post('/posts/{post}/like/', [PostController::class, 'like'])->middleware('auth')
    ->name('posts.like');   

Route::post('/posts/{post}/unlike/', [PostController::class, 'unlike'])->middleware('auth')
    ->name('posts.unlike');     

Route::post('/postreplies/{postreply}/like/', [PostReplyController::class, 'like'])->middleware('auth')
    ->name('postreplies.like'); 

Route::post('/postreplies/{postreply}/unlike/', [PostReplyController::class, 'unlike'])->middleware('auth')
    ->name('postreplies.unlike'); 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
