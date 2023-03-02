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
        Schema::dropIfExists("content");
        Schema::dropIfExists("content_articles");
        Schema::dropIfExists("content_modules");
        Schema::dropIfExists("content_menus");
        Schema::dropIfExists("content_menus_roles");

        Schema::create('content_articles', function (Blueprint $table) {
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

        Schema::create('content_modules', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("status")->default(0)->index();
            $table->string("title", 255);
            $table->text("content");
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

        Schema::create('content_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('title', 50);
            $table->string('icon', 50);
            $table->string('uri')->nullable();
            $table->string('permission')->nullable();
            $table->timestamps();
            $table->integer("created_by")->default(0)->index();
            $table->integer("updated_by")->default(0)->index();
            $table->softDeletes();
            $table->integer("deleted_by")->default(0)->index();
        });

        Schema::create('content_menus_roles', function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('menu_id');
            $table->index(['role_id', 'menu_id']);
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
