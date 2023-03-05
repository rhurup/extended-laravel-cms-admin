<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("key", 255)->default("");
            $table->string("value", 255)->default("");
            $table->string("description", 255)->default("");
            $table->string("type", 100)->default("boolean");
            $table->string("type_reference", 100)->default("boolean");
            $table->tinyInteger("locked")->default(0);
            $table->timestamps();
            $table->integer("created_by")->default(0);
            $table->integer("updated_by")->default(0);
            $table->softDeletes();
            $table->integer("deleted_by")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
