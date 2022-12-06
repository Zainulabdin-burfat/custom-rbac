<?php

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



// Route wise access

Route::group(['middleware' => ['auth', 'permissions']], function () {
// Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('user.index');
        Route::get('/create', 'UserController@create')->name('user.create');
        Route::post('/create', 'UserController@store')->name('user.store');
        Route::get('/{user}', 'UserController@show')->name('user.show');
        Route::get('/{user}/edit', 'UserController@edit')->name('user.edit');
        Route::put('/{user}', 'UserController@update')->name('user.update');
        Route::delete('/{user}/delete', 'UserController@destroy')->name('user.destroy');
    });


    // Post Routes

    Route::group(['prefix' => 'posts'], function () {

        // Route::get('/', 'PostController@index')->name('post.index')->middleware('permissions');

        Route::get('/', 'PostController@index')->name('post.index');
        
        Route::get('/create', 'PostController@create')->name('post.create')->middleware('can:post.create,post');
        Route::post('/create', 'PostController@store')->name('post.store');
        Route::get('/{post}', 'PostController@show')->name('post.show');
        Route::get('/{post}/edit', 'PostController@edit')->name('post.edit');
        Route::put('/{post}', 'PostController@update')->name('post.update');
        Route::delete('/{post}/delete', 'PostController@destroy')->name('post.destroy');
    });


    // Permissions Routes

    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', 'PermissionController@index')->name('permission.index');
        Route::get('/create', 'PermissionController@create')->name('permission.create');
        Route::post('/create', 'PermissionController@store')->name('permission.store');
        Route::get('/{permission}', 'PermissionController@show')->name('permission.show');
        Route::get('/{permission}/edit', 'PermissionController@edit')->name('permission.edit');
        Route::put('/{permission}', 'PermissionController@update')->name('permission.update');
        Route::delete('/{permission}/delete', 'PermissionController@destroy')->name('permission.destroy');
    });


    // Roles Routes

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', 'RoleController@index')->name('role.index');
        Route::get('/create', 'RoleController@create')->name('role.create');
        Route::post('/create', 'RoleController@store')->name('role.store');
        Route::get('/{role}', 'RoleController@show')->name('role.show');
        Route::get('/{role}/edit', 'RoleController@edit')->name('role.edit');
        Route::put('/{role}', 'RoleController@update')->name('role.update');
        Route::delete('/{role}/delete', 'RoleController@destroy')->name('role.destroy');
    });
});




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
