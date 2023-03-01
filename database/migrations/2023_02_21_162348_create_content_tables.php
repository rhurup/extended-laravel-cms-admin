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

        $std_content = [
            [
                "id" => 1,
                "status" => 2,
                "slug" => "404",
                "title" => "Siden blev desværre ikke fundet",
                "content" => "<p>Vi kunne desværre ikke finde siden som du ledte efter.</p>",
                "created_at" => \Carbon\Carbon::now(),
                "created_by" => 1,
                "updated_at" => \Carbon\Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 2,
                "status" => 2,
                "slug" => "403",
                "title" => "Du har desværre ikke rettigheder til denne side.",
                "content" => "<p>Siden du ønsker at tilgå er desværre ikke tilgængelig.</p>",
                "created_at" => \Carbon\Carbon::now(),
                "created_by" => 1,
                "updated_at" => \Carbon\Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 3,
                "status" => 2,
                "slug" => "home",
                "title" => "Forside",
                "content" => "<p>Velkommen til hjemmesiden</p>",
                "created_at" => \Carbon\Carbon::now(),
                "created_by" => 1,
                "updated_at" => \Carbon\Carbon::now(),
                "updated_by" => 1,
            ]
        ];

        foreach($std_content as $content){
            \App\Models\Content\ContentArticles::insert($content);
        }


        $std_modules = [
            [
                "id" => 1,
                "status" => 1,
                "title" => "Footer 1",
                "position" => "footer",
                "pages" => "*",
                "content" => "<p>1</p>",
                "sm_col" => "12",
                "md_col" => "3",
                "xl_col" => "3",
                "created_at" => \Carbon\Carbon::now(),
                "created_by" => 1,
                "updated_at" => \Carbon\Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 2,
                "status" => 1,
                "title" => "Footer 2",
                "position" => "footer",
                "pages" => "*",
                "sm_col" => "12",
                "md_col" => "3",
                "xl_col" => "3",
                "content" => "<p>2</p>",
                "created_at" => \Carbon\Carbon::now(),
                "created_by" => 1,
                "updated_at" => \Carbon\Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 3,
                "status" => 1,
                "title" => "Footer 3",
                "position" => "footer",
                "pages" => "*",
                "sm_col" => "12",
                "md_col" => "3",
                "xl_col" => "3",
                "content" => "<p>2</p>",
                "created_at" => \Carbon\Carbon::now(),
                "created_by" => 1,
                "updated_at" => \Carbon\Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 4,
                "status" => 1,
                "title" => "Top 1",
                "position" => "top",
                "pages" => "*",
                "sm_col" => "12",
                "md_col" => "6",
                "xl_col" => "6",
                "content" => "<p>Top 1</p>",
                "created_at" => \Carbon\Carbon::now(),
                "created_by" => 1,
                "updated_at" => \Carbon\Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 5,
                "status" => 1,
                "title" => "Top 2",
                "position" => "top",
                "pages" => "*",
                "sm_col" => "12",
                "md_col" => "6",
                "xl_col" => "6",
                "content" => "<p>Top 2</p>",
                "created_at" => \Carbon\Carbon::now(),
                "created_by" => 1,
                "updated_at" => \Carbon\Carbon::now(),
                "updated_by" => 1,
            ]
        ];

        foreach($std_modules as $module){
            \App\Models\Content\ContentModules::insert($module);
        }


        exit;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
