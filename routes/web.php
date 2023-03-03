<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

// Profile endpoint
// Require Authentication for these endpoints
Route::middleware(['auth'])->group(function() {
    Route::group(
        ['prefix' => 'profile'],
        function ($router) {
            $router->get('/', 'App\Http\Controllers\Profile\ProfileController@index')->name("profile.index_get");
        }
    );
});

Route::get('/', 'App\Http\Controllers\Content\ArticleController@home')->name("home");
Route::get('/{slug}', 'App\Http\Controllers\Content\ArticleController@index')->name("content");

Route::fallback('App\Http\Controllers\Content\ArticleController@index');
