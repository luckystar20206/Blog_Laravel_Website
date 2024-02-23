<?php

use App\Http\Controllers\API\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts' , [PostController::class , 'index']);

Route::post('/posts' , [PostController::class , 'store']);

Route::put('/posts/{post}' , [PostController::class , 'update']);

Route::delete('/posts/{post}' , [PostController::class , 'destroy']);

Route::get('/posts/{post}' , [PostController::class , 'show']);
