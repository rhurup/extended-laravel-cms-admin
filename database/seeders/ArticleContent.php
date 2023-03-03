<?php

namespace Database\Seeders;

use App\Models\Content\Articles;
use App\Models\Content\Module;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleContent extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $std_content = [
            [
                "id" => 1,
                "status" => 2,
                "slug" => "404",
                "title" => "Siden blev desværre ikke fundet",
                "content" => "<p>Vi kunne desværre ikke finde siden som du ledte efter.</p>",
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 2,
                "status" => 2,
                "slug" => "403",
                "title" => "Du har desværre ikke rettigheder til denne side.",
                "content" => "<p>Siden du ønsker at tilgå er desværre ikke tilgængelig.</p>",
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 3,
                "status" => 2,
                "slug" => "home",
                "title" => "Home",
                "content" => "<p>Welcome to the web site</p>",
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 4,
                "status" => 1,
                "slug" => "contact-us",
                "title" => "Kontakt os",
                "content" => "<p>Kontakt os</p>",
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
                "updated_by" => 1,
            ]
        ];

        Articles::insert($std_content);

        $std_modules = [
            [
                "id" => 1,
                "status" => 1,
                "title" => "Footer 1",
                "position" => "footer",
                "pages" => "*",
                "content" => file_get_contents(storage_path("imports/footer_1.html")) ?? "",
                "sm_col" => "12",
                "md_col" => "3",
                "xl_col" => "3",
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
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
                "content" => file_get_contents(storage_path("imports/footer_2.html")) ?? "",
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
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
                "content" => file_get_contents(storage_path("imports/footer_3.html")) ?? "",
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
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
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
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
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
                "updated_by" => 1,
            ]
        ];

        Module::insert($std_modules);
    }
}
