<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Artisan::call('db:seed --class "AdminTables"');
        Artisan::call('admin:import "api-tester"');
        Artisan::call('admin:import "ckeditor"');
        Artisan::call('admin:import "helpers"');
        Artisan::call('admin:import "media-manager"');
        Artisan::call('admin:import "redis-manager"');
        Artisan::call('admin:import "reporter"');
        Artisan::call('admin:import "scheduling"');

        Artisan::call('db:seed --class "SettingsTables"');

        Artisan::call('db:seed --class "UsersTables"');

        Artisan::call('db:seed --class "ArticleContent"');

        Artisan::call('db:seed --class "MenuContent"');


        if(file_exists(database_path("/seeders/CustomTables.php"))){
            Artisan::call('db:seed --class "CustomTables"');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
