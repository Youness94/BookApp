<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\AothorController;
use App\Http\Controllers\AuthController;




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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/books', [BooksController::class,'index']);
Route::get('/books/{id}', [BooksController::class,'getBooksById']);
Route::get('/books/search/{id}', [BooksController::class,'searchBook']);
Route::post('/books', [BooksController::class,'add']);
Route::put('/books/{id}', [BooksController::class,'update']);
Route::delete('/books/{id}', [BooksController::class,'delete']);

Route::get('/books/{id}/author', [BooksController::class, 'getAuthor']);
Route::get('/authors/{id}/books', [AothorController::class, 'getBooks']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

