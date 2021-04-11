<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NoteController;
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

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::group(['middleware' => ['auth:sanctum']],function(){
    Route::post('/tag',[TagController::class,'store']);
    Route::get('/tag',[TagController::class,'show']);
    Route::delete('/tag/{id}',[TagController::class,'destroy']);

    Route::post('/note',[NoteController::class,'store']);
    Route::get('/note',[NoteController::class,'show']);
    Route::patch('/note/{id}',[NoteController::class,'update']);
    Route::delete('/note/{id}',[NoteController::class,'destroy']);

    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/auth',[AuthController::class,'auth']);
    Route::get('/perfil',[AuthController::class,'perfil']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
