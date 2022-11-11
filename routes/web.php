<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$missing = function()
{
    return response()->json([
        'status' => 400,
        'error' => 'Record not found',
    ],400);
};



// Route::resource('/posts', 'PostController')->missing($missing);
// Route::resource('/users', 'UserController')->missing($missing);

Route::group(['middleware' => ['role:admin', 'auth']], function() {
// Route::group(['middleware' => ['auth']], function() {
    
    Route::resource('/roles', 'RoleController');
    Route::resource('/permissions', 'PermissionController');

    Route::resource('/posts', 'PostController');
    Route::resource('/users', 'UserController');

 });


Route::get('/syncpermissions', function(){
    Artisan::call("create:permission");
    return back();
});

// Route::get('/roles', "PermissionController@Permission");



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
