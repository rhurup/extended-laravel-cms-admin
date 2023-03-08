<?php

namespace Database\Seeders;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTables extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create a user.
        Administrator::truncate();
        Administrator::create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'name'     => 'Administrator',
        ]);

        // create a role.
        Role::truncate();
        Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);

        // add role to user.
        Administrator::first()->roles()->save(Role::first());

        //create a permission
        Permission::truncate();
        Permission::insert([
            [
                'name'        => 'All permission',
                'slug'        => '*',
                'http_method' => '',
                'http_path'   => '*',
            ],
            [
                'name'        => 'Dashboard',
                'slug'        => 'dashboard',
                'http_method' => 'GET',
                'http_path'   => '/',
            ],
            [
                'name'        => 'Login',
                'slug'        => 'auth.login',
                'http_method' => '',
                'http_path'   => "/auth/login\r\n/auth/logout",
            ],
            [
                'name'        => 'User setting',
                'slug'        => 'auth.setting',
                'http_method' => 'GET,PUT',
                'http_path'   => '/auth/setting',
            ],
            [
                'name'        => 'Auth management',
                'slug'        => 'auth.management',
                'http_method' => '',
                'http_path'   => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
            ],
        ]);

        Role::first()->permissions()->save(Permission::first());

        // add default menus.
        Menu::truncate();
        Menu::insert([
            [
                'parent_id' => 0,
                'order'     => 1,
                'title'     => 'Dashboard',
                'icon'      => 'fa-bar-chart',
                'uri'       => '/',
            ],
            [
                'parent_id' => 0,
                'order'     => 2,
                'title'     => 'Articles',
                'icon'      => 'fa-file-text-o',
                'uri'       => 'articles',
            ],
            [
                'parent_id' => 0,
                'order'     => 3,
                'title'     => 'Modules',
                'icon'      => 'fa-cubes',
                'uri'       => 'modules',
            ],
            [
                'parent_id' => 0,
                'order'     => 4,
                'title'     => 'Menus',
                'icon'      => 'fa-bars',
                'uri'       => 'menus',
            ],
            [
                'parent_id' => 0,
                'order'     => 5,
                'title'     => 'Users',
                'icon'      => 'fa-user-md',
                'uri'       => 'users',
            ],
            [
                'parent_id' => 5,
                'order'     => 5,
                'title'     => 'Users',
                'icon'      => 'fa-user-md',
                'uri'       => 'users',
            ],
            [
                'parent_id' => 5,
                'order'     => 6,
                'title'     => 'Roles',
                'icon'      => 'fa-user',
                'uri'       => 'roles',
            ],
            [
                'parent_id' => 5,
                'order'     => 7,
                'title'     => 'Permissions',
                'icon'      => 'fa-ban',
                'uri'       => 'permissions',
            ],
            [
                'parent_id' => 0,
                'order'     => 8,
                'title'     => 'Countries',
                'icon'      => 'fa-globe',
                'uri'       => 'countries',
            ],
            [
                'parent_id' => 0,
                'order'     => 9,
                'title'     => 'Admin',
                'icon'      => 'fa-tasks',
                'uri'       => '',
            ],
            [
                'parent_id' => 9,
                'order'     => 10,
                'title'     => 'Users',
                'icon'      => 'fa-users',
                'uri'       => 'auth/users',
            ],
            [
                'parent_id' => 9,
                'order'     => 11,
                'title'     => 'Roles',
                'icon'      => 'fa-user',
                'uri'       => 'auth/roles',
            ],
            [
                'parent_id' => 9,
                'order'     => 12,
                'title'     => 'Permission',
                'icon'      => 'fa-ban',
                'uri'       => 'auth/permissions',
            ],
            [
                'parent_id' => 9,
                'order'     => 13,
                'title'     => 'Menu',
                'icon'      => 'fa-bars',
                'uri'       => 'auth/menu',
            ],
            [
                'parent_id' => 9,
                'order'     => 14,
                'title'     => 'Operation log',
                'icon'      => 'fa-history',
                'uri'       => 'auth/logs',
            ],
            [
                'parent_id' => 0,
                'order'     => 15,
                'title'     => 'Settings',
                'icon'      => 'fa-cogs',
                'uri'       => 'settings',
            ],
        ]);

        // add role to menu.
        Menu::find(2)->roles()->save(Role::first());
    }
}
