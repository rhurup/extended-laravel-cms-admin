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
    $router->resource('users', \App\Admin\Controllers\Users\UsersController::class);
    $router->resource('roles', \App\Admin\Controllers\Users\RolesController::class);
    $router->resource('permissions', \App\Admin\Controllers\Users\PermissionsController::class);
    $router->resource('countries', \App\Admin\Controllers\CountriesController::class);
    $router->resource('settings', \App\Admin\Controllers\SettingsController::class);

});
