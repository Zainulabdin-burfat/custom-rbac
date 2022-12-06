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

Route::post('/signin', [App\Http\Controllers\Api\LoginController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function(){

    Route::post('/users', 'Api\UserController@index')->middleware(['scope:user.index']);
    Route::post('/posts', 'Api\PostController@index')->middleware(['scope:post.index']);


    Route::post('/test', function (Request $request) {
        if ($request->user()->tokenCan('post.index')) {
            return 'Can list posts';
        }
    });
});

Route::post('/test', function(){
    return "test route working";
});


// Route::post('/orders', function () {
//     return 'Access token has both "check-status" and "place-orders" scopes...';
// })->middleware(['scopes:post.index,user.index']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
