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
        Schema::dropIfExists("articles");
        Schema::dropIfExists("modules");
        Schema::dropIfExists("menus");
        Schema::dropIfExists("menus_roles");

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("status")->default(0)->index();
            $table->string("slug", 255)->unique();
            $table->string("title", 255)->default("");
            $table->string("image", 255)->default("");
            $table->string("roles", 255)->default("*");
            $table->text("content");
            $table->timestamps();
            $table->integer("created_by")->default(0)->index();
            $table->integer("updated_by")->default(0)->index();
            $table->softDeletes();
            $table->integer("deleted_by")->default(0)->index();
        });

        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("status")->default(0)->index();
            $table->string("title", 255);
            $table->text("content");
            $table->string("img", 255)->nullable();
            $table->string("layout", 255)->default("card");
            $table->string("pages", 255)->default("*");
            $table->string("position", 255);
            $table->string("roles", 255)->default("*");
            $table->tinyInteger("sm_col")->default(12);
            $table->tinyInteger("md_col")->default(12);
            $table->tinyInteger("xl_col")->default(12);
            $table->timestamps();
            $table->integer("created_by")->default(0)->index();
            $table->integer("updated_by")->default(0)->index();
            $table->softDeletes();
            $table->integer("deleted_by")->default(0)->index();
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('title', 50);
            $table->string('icon', 50);
            $table->string('uri')->nullable();
            $table->timestamps();
            $table->integer("created_by")->default(0)->index();
            $table->integer("updated_by")->default(0)->index();
            $table->softDeletes();
            $table->integer("deleted_by")->default(0)->index();
        });

        Schema::create('menu_roles_maps', function (Blueprint $table) {
            $table->integer('menu_id');
            $table->integer('users_roles_id');
            $table->index(['users_roles_id', 'menu_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
