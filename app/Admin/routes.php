<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('articles', \App\Admin\Controllers\Content\ArticlesController::class);
    $router->resource('modules', \App\Admin\Controllers\Content\ModulesController::class);
    $router->resource('menus', \App\Admin\Controllers\Content\MenusController::class);
    $router->resource('menus', \App\Admin\Controllers\Users\MenusController::class);

});
