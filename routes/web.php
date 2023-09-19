<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PhotoController;

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

Route::get('/', [ArticleController::class, 'index']);
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/detail/{id}', [ArticleController::class, 'detail']);

Route::get('/articles/detail/delete/{id}', [ArticleController::class, 'delete']);

Route::get('/articles/add', [ArticleController::class, 'add']);
Route::post('/articles/add', [ArticleController::class, 'create']);

Route::get('/articles/detail/{id}/edit', [ArticleController::class, 'edit']);
Route::post('/articles/detail/{id}/edit', [ArticleController::class, 'update']);

Route::post('/articles/comment/add', [CommentController::class, 'create']);
Route::get('/articles/comment/delete/{id}', [CommentController::class, 'delete']);
Route::post('/articles/comment/{id}/edit', [CommentController::class, 'update']);

Route::get('/articles/like/{id}', [LikeController::class, 'detail']);
Route::post('/articles/like', [LikeController::class, 'add']);

Route::get('/articles/photo', [PhotoController::class, 'add']);
Route::post('/articles/photo/', [PhotoController::class, 'store']);

Route::post('/articles/photo/{id}', [PhotoController::class, 'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\ArticleController::class, 'index'])->name('home');
