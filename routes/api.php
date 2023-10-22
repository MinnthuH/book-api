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
    Route::get('profile', [AuthorController::class, 'profileAuthor']);
    Route::post('logout', [AuthorController::class, 'logoutAuthor']);


    Route::post('create-book',[BookController::class,'createBook']);
    Route::get('author-books',[BookController::class,'authorBook']);
    Route::get('/detailbook/{id}',[BookController::class,'singleBook']);
    Route::post('update-book/{id}',[BookController::class,'updateBook']);
    Route::get('delete-book/{id}',[BookController::class,'deleteBook']);
});


