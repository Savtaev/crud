<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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
Route::get('/posts', PostController::class);
Route::get('/post/{id}', [PostController::class, 'getPost']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', RegisterController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/post/create', [PostController::class, 'create']);
    Route::get('/post/delete/{id}', [PostController::class, 'delete']);
    Route::get('/comment/delete/{id}', [CommentController::class, 'delete']);

    Route::post('/post/edit/{id}', [PostController::class, 'editPost']);
    Route::post('/comment/edit/{id}', [CommentController::class, 'editComment']);


    Route::get('comments/{id}/', [CommentController::class]);
    Route::post('comment/create', [CommentController::class, 'createComment']);

});
