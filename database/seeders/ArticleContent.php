<?php

namespace Database\Seeders;

use App\Models\Articles;
use App\Models\Modules;
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
                "content" => "",
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
                "content" => "",
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
                "content" => "",
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
                "content" => "",
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
                "updated_by" => 1,
            ]
        ];


        foreach ($std_content as $content) {
            if (file_exists(storage_path("imports/" . $content['slug'] . ".html"))) {
                $content['content'] = file_get_contents(storage_path("imports/" . $content['slug'] . ".html"));
            }
            Articles::insert($content);
        }

        $std_modules = [
            [
                "id" => 1,
                "status" => 1,
                "title" => "1",
                "position" => "footer",
                "pages" => "*",
                "layout" => "raw",
                "content" => "",
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
                "title" => "2",
                "position" => "footer",
                "pages" => "*",
                "layout" => "raw",
                "sm_col" => "12",
                "md_col" => "3",
                "xl_col" => "3",
                "content" => "",
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 3,
                "status" => 1,
                "title" => "3",
                "position" => "footer",
                "pages" => "*",
                "layout" => "raw",
                "sm_col" => "12",
                "md_col" => "3",
                "xl_col" => "3",
                "content" => "",
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 4,
                "status" => 1,
                "title" => "4",
                "position" => "footer",
                "pages" => "*",
                "layout" => "raw",
                "sm_col" => "12",
                "md_col" => "3",
                "xl_col" => "3",
                "content" => "",
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 5,
                "status" => 1,
                "title" => "1",
                "position" => "top",
                "img" => "images/hjemmeside4.jpg",
                "pages" => "3",
                "layout" => "card",
                "sm_col" => "12",
                "md_col" => "4",
                "xl_col" => "4",
                "content" => '',
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 6,
                "status" => 1,
                "title" => "2",
                "position" => "top",
                "img" => "images/hjemmeside1.jpg",
                "pages" => "3",
                "layout" => "card",
                "sm_col" => "12",
                "md_col" => "4",
                "xl_col" => "4",
                "content" => '',
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 7,
                "status" => 1,
                "title" => "3",
                "position" => "top",
                "img" => "images/hjemmeside3.jpg",
                "pages" => "3",
                "layout" => "card",
                "sm_col" => "12",
                "md_col" => "4",
                "xl_col" => "4",
                "content" => '',
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 8,
                "status" => 1,
                "title" => "1",
                "position" => "bottom",
                "img" => "images/hjemmeside1.jpg",
                "pages" => "3",
                "layout" => "card",
                "sm_col" => "12",
                "md_col" => "4",
                "xl_col" => "4",
                "content" => '',
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 9,
                "status" => 1,
                "title" => "2",
                "position" => "bottom",
                "img" => "images/hjemmeside4.jpg",
                "pages" => "3",
                "layout" => "card",
                "sm_col" => "12",
                "md_col" => "4",
                "xl_col" => "4",
                "content" => '',
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
                "updated_by" => 1,
            ],
            [
                "id" => 10,
                "status" => 1,
                "title" => "3",
                "position" => "bottom",
                "img" => "images/hjemmeside5.jpg",
                "pages" => "3",
                "layout" => "card",
                "sm_col" => "12",
                "md_col" => "4",
                "xl_col" => "4",
                "content" => '',
                "created_at" => Carbon::now(),
                "created_by" => 1,
                "updated_at" => Carbon::now(),
                "updated_by" => 1,
            ]
        ];

        foreach ($std_modules as $module) {
            $file_name = $module['position'] . '_' . $module['title'];
            if (file_exists(storage_path("imports/" . $file_name . ".html"))) {
                $module['content'] = file_get_contents(storage_path("imports/" . $file_name . ".html"));
            }
            $module['title'] = $module['position'] . ' ' . $module['title'];
            Modules::insert($module);
        }

    }
}
