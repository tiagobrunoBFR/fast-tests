<?php

use App\Http\Controllers\CommentPostController;
use App\Http\Controllers\CommentReplyController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::post('posts/{post}/comments', [CommentPostController::class, 'store'])->name('posts.comments.store');
    Route::post('comments/{comment}/replies', [CommentReplyController::class, 'store'])->name('comments.replies.store');
});

