<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AuthorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('register', [AuthorController::class, 'registerAuthor']);
Route::post('login', [AuthorController::class, 'loginAuthor']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('profile', [AuthorController::class, 'profileAuthor']);
    Route::post('logout', [AuthorController::class, 'logoutAuthor']);


    Route::post('create-book',[BookController::class,'createBook']);
    Route::get('list-books',[BookController::class,'listBook']);
    Route::get('single-book/{$id}',[BookController::class,'singleBook']);
    Route::post('update-book/{$id}',[BookController::class,'updateBook']);
    Route::get('delete-book/{$id}',[BookController::class,'deleteBook']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
