<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\ImageController;

// Letakkan route search sebelum resource route
Route::get('/posts/search', [PostController::class, 'search']);
Route::get('/galleries/search', [GalleryController::class, 'search']);

Route::apiResource('categories', CategoryController::class);
Route::apiResource('comments', CommentController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('galleries', GalleryController::class);
Route::apiResource('images', ImageController::class)->except(['update']);

Route::get('/galleries/by-post/{postId}', [GalleryController::class, 'getByPost']);
Route::get('/images/count', [ImageController::class, 'count']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
