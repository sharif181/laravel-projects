<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[\App\Http\Controllers\Auth\PassportController::class,'login']);
Route::post('/register',[\App\Http\Controllers\Auth\PassportController::class,'register']);
Route::get('/profile',[\App\Http\Controllers\Auth\PassportController::class,'profile']);

//blog router
Route::get('/blogs',[\App\Http\Controllers\BlogController::class,'index']);
Route::get('/blogs/{id}',[\App\Http\Controllers\BlogController::class,'show']);
Route::delete('/blogs/{id}',[\App\Http\Controllers\BlogController::class,'destroy']);
Route::post('/blogs',[\App\Http\Controllers\BlogController::class,'store']);
Route::put('/blogs/{id}',[\App\Http\Controllers\BlogController::class,'update']);
