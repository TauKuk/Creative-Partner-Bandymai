<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::get('/users/{user}/edit', [UserController::class, 'edit']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);

Route::get('/{user}/posts', [PostController::class, 'index']);
Route::get('/{user}/posts/create', [PostController::class, 'create']);
Route::post('/{user}/posts', [PostController::class, 'store']);
Route::get('/{user}/posts/{post}', [PostController::class, 'show']);
Route::get('/{user}/posts/{post}/edit', [PostController::class, 'edit']);
Route::put('/{user}/posts/{post}', [PostController::class, 'update']);
Route::delete('/{user}/posts/{post}', [PostController::class, 'destroy']);