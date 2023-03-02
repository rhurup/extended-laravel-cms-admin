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

\Illuminate\Support\Facades\Auth::routes();

// Testing endpoint
Route::group(
    ['prefix' => 'test'],
    function($router)
    {
        //$router->get('/', 'TestController@index')->name("test.index_get");
    }
);

Route::group(
    ['prefix' => 'members'],
    function($router)
    {
        $router->post('/login', 'App\Http\Controllers\Members\MemberController@login')->name("members.login");
        $router->post('/register', 'App\Http\Controllers\Members\MemberController@register')->name("members.register");

        $router->get('/', 'App\Http\Controllers\Members\MemberController@index')->middleware(['auth:api'])->name("members.indexr");
        $router->get('/check', 'App\Http\Controllers\Members\MemberController@check')->middleware(['auth:api'])->name("members.check");
    }
);

Route::get('/', 'App\Http\Controllers\Content\ArticleController@home')->name("home");
Route::get('/{slug}', 'App\Http\Controllers\Content\ArticleController@index')->name("content");

Route::fallback('App\Http\Controllers\Content\ArticleController@index');
