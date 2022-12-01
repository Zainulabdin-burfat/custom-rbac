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
 

Route::group(['middleware' => ['auth:api']], function(){

    Route::post('/users', 'Api\UserController@index')->middleware(['scope:user.index']);
    Route::post('/posts', 'Api\PostController@index')->middleware(['scope:post.index']);

    // Route::post('/users', function (Request $request) {
        // if ($request->user()->tokenCan('post.index')) {
        //     return 'Can list posts';
        // }
    // });
});


Route::post('/testing', function () {
    return 'api call';
});

Route::post('/signin', [App\Http\Controllers\Api\UserController::class, 'login']);

Route::get('/orders', function () {
    return 'Access token has both "check-status" and "place-orders" scopes...';
})->middleware(['auth:api', 'scopes:check-status,place-orders']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
