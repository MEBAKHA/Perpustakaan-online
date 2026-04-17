<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/books', [ApiController::class, 'index']);
Route::get('/book/{id}', [ApiController::class, 'show']);

Route::post('/login', [ApiController::class, 'login']);
Route::get('/books/status/{status}', [ApiController::class, 'bookBystatus']);
Route::get('/books/search/{search}', [ApiController::class, 'search']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/books', [ApiController::class, 'store']);
    Route::put('/books/{id}', [ApiController::class, 'update']);
    Route::delete('/books/{id}', [ApiController::class, 'destroy']);
});
