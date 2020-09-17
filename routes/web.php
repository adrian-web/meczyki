<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/articles', [ArticleController::class, 'index']);

Route::get('/articles/user/{user}', [ArticleController::class, 'index']);

Route::get('/articles/create', [ArticleController::class, 'create']);

Route::post('/articles', [ArticleController::class, 'store']);

Route::get('/articles/{article}', [ArticleController::class, 'show']);

Route::get('/articles/{article}/edit', [ArticleController::class, 'edit']);

Route::patch('/articles/{article}', [ArticleController::class, 'update']);


Route::get('/users', [UserController::class, 'index']);
