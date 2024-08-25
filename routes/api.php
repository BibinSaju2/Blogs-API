<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/delete/{id}', [UserController::class, 'delete']);

Route::resource('user', UserController::class)->except(['destroy', 'update']);


    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('posts')->group(function () {
            Route::get('/', [PostController::class, 'index']);
            Route::post('/create', [PostController::class, 'create']);
            Route::post('/update', [PostController::class, 'update']);
            Route::get('delete/{id}', [PostController::class, 'delete']);
            Route::get('show/{id}', [PostController::class, 'show']);
        });

        Route::prefix('comments')->group(function () {
            Route::get('/', [CommentController::class, 'index']);
            Route::post('/create', [CommentController::class, 'create']);
            Route::post('/update', [CommentController::class, 'update']);
            Route::get('delete/{id}', [CommentController::class, 'delete']);
            Route::get('show/{id}', [CommentController::class, 'show']);
        });
    });
