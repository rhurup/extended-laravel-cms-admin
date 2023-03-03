<?php

namespace Database\Seeders;

use Encore\Admin\Auth\Database\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuContent extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $menu_items = [
            [
                "id" => 1,
                "parent_id" => 0,
                "order" => 1,
                "title" => "Home",
                "icon" => "fa-globe",
                "uri" => "/",
                "created_at" => \Carbon\Carbon::now(),
                "created_by" => 1,
                "updated_at" => \Carbon\Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 2,
                "parent_id" => 0,
                "order" => 2,
                "title" => "Example",
                "icon" => "fa-align-center",
                "uri" => "/example",
                "created_at" => \Carbon\Carbon::now(),
                "created_by" => 1,
                "updated_at" => \Carbon\Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 3,
                "parent_id" => 2,
                "order" => 3,
                "title" => "Example 2",
                "icon" => "fa-align-center",
                "uri" => "/example2",
                "created_at" => \Carbon\Carbon::now(),
                "created_by" => 1,
                "updated_at" => \Carbon\Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 4,
                "parent_id" => 0,
                "order" => 4,
                "title" => "Kontakt os",
                "icon" => "fa-bars",
                "uri" => "/contact-us",
                "created_at" => \Carbon\Carbon::now(),
                "created_by" => 1,
                "updated_at" => \Carbon\Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 5,
                "parent_id" => 0,
                "order" => 5,
                "title" => "Log ind",
                "icon" => "fa-bars",
                "uri" => "/login",
                "created_at" => \Carbon\Carbon::now(),
                "created_by" => 1,
                "updated_at" => \Carbon\Carbon::now(),
                "updated_by" => 1,
            ],
        ];

        \App\Models\Content\Menu::insert($menu_items);

        $admin_menu_item = Menu::query()->where('title', 'Admin')->first();

        Menu::query()->where('uri', 'api-tester')->update(['parent_id' => $admin_menu_item->id]);
        Menu::query()->where('uri', 'redis')->update(['parent_id' => $admin_menu_item->id]);
        Menu::query()->where('uri', 'exceptions')->update(['parent_id' => $admin_menu_item->id]);
        Menu::query()->where('uri', 'scheduling')->update(['parent_id' => $admin_menu_item->id]);
        Menu::query()->where('uri', 'countries')->update(['parent_id' => $admin_menu_item->id]);
        Menu::query()->where('title', 'Helpers')->update(['parent_id' => $admin_menu_item->id]);
        Menu::query()->where('uri', 'media')->update(['order' => 4]);
        Menu::query()->where('uri', 'settings')->update(['order' => 5]);

        Menu::saveOrder([], $admin_menu_item->id);

    }
}
