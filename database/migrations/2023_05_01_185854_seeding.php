<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \Illuminate\Support\Facades\Artisan::call('db:seed --class "AdminTables"');
        \Illuminate\Support\Facades\Artisan::call('admin:import "api-tester"');
        \Illuminate\Support\Facades\Artisan::call('admin:import "ckeditor"');
        \Illuminate\Support\Facades\Artisan::call('admin:import "helpers"');
        \Illuminate\Support\Facades\Artisan::call('admin:import "media-manager"');
        \Illuminate\Support\Facades\Artisan::call('admin:import "redis-manager"');
        \Illuminate\Support\Facades\Artisan::call('admin:import "reporter"');
        \Illuminate\Support\Facades\Artisan::call('admin:import "scheduling"');

        \Illuminate\Support\Facades\Artisan::call('db:seed --class "SettingsTables"');

        \Illuminate\Support\Facades\Artisan::call('db:seed --class "UsersTables"');

        \Illuminate\Support\Facades\Artisan::call('db:seed --class "ArticleContent"');

        \Illuminate\Support\Facades\Artisan::call('db:seed --class "MenuContent"');


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
