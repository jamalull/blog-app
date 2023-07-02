<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostApiController;
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

Route::prefix('v1')->group(function(){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::middleware('auth:api')->group(function () {
        // Route::resource('posts', PostController::class);
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('allpost', [PostApiController::class, 'index']);
        Route::get('singlepost/{id}', [PostApiController::class, 'show']);
        Route::post('createpost', [PostApiController::class, 'store']);
        Route::post('updatepost/{id}', [PostApiController::class, 'update']);
        Route::delete('deletepost/{id}', [PostApiController::class, 'destroy']);
        // Route::post('post', [PostApiController::class, 'index']);

    });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });