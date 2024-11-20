<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthenticatedSessionController::class, 'create']);

Route::get('/', [HomeController::class, 'home']);

Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/petugas', [AdminController::class, 'index']);
    Route::get('/petugas/create', [AdminController::class, 'create']);
    Route::post('/petugas', [AdminController::class, 'store']);
    Route::get('/petugas/edit/{id}', [AdminController::class, 'edit']);
    Route::put('/petugas/update/{id}', [AdminController::class, 'update']);
    Route::get('/petugas/delete/{id}', [AdminController::class, 'delete']);


    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/category/create', [CategoryController::class, 'create']);
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/category/update/{id}', [CategoryController::class, 'update']);
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete']);

    Route::get('/post', [PostController::class, 'index']);
    Route::get('/post/create', [PostController::class, 'create']);
    Route::post('/post', [PostController::class, 'store']);
    Route::get('/post/edit/{id}', [PostController::class, 'edit']);
    Route::put('/post/update/{id}', [PostController::class, 'update']);
    Route::get('/post/delete/{id}', [PostController::class, 'delete']);
    Route::get('/post/search', [PostController::class, 'search']);

    Route::get('/gallery', [GalleryController::class, 'index']);
    Route::get('/gallery/create', [GalleryController::class, 'create']);
    Route::post('/gallery', action: [GalleryController::class, 'store']);
    Route::get('/gallery/edit/{id}', [GalleryController::class, 'edit']);
    Route::put('/gallery/update/{id}', [GalleryController::class, 'update']);
    Route::get('/gallery/delete/{id}', [GalleryController::class, 'delete']);
    Route::get('/gallery/{id}', [GalleryController::class, 'show']);


    Route::post('/images/create', [ImageController::class, 'create']);
    Route::get('/images/{id}', [ImageController::class, 'delete'])->name('images.delete');

});

require __DIR__ . '/auth.php';
