<?php

use App\Http\Controllers\Api\posts\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// posts routes

Route::group(['controller' => PostController::class, 'prefix' => 'posts'], function () {

    Route::get('/', 'index');
    Route::get('/show', 'show');
    Route::post('/', 'store');
    Route::put('/', 'update');
    Route::delete('/delete', 'destroy');
});
