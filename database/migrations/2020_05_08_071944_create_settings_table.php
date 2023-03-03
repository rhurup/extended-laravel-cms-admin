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
            $table->tinyInteger("locked")->default(0);
            $table->timestamps();
            $table->integer("created_by")->default(0);
            $table->integer("updated_by")->default(0);
            $table->softDeletes();
            $table->integer("deleted_by")->default(0);
        });
        \App\Models\Settings\Settings::insert(['key'         => 'default.timezone',
                                            'value'       => 'Europe/London',
                                            'description' => 'Default timezone for users',
                                            'locked'      => 1
        ]);
        \App\Models\Settings\Settings::insert(['key'         => 'default.country',
                                            'value'       => 'United Kingdom',
                                            'description' => 'Default country for users',
                                            'locked'      => 1
        ]);
        \App\Models\Settings\Settings::insert(['key'         => 'default.language',
                                            'value'       => 'en-GB',
                                            'description' => 'Default language for users',
                                            'locked'      => 1
        ]);
        \App\Models\Settings\Settings::insert(['key'         => 'default.logo',
                                            'value'       => 'images/default_logo.svg',
                                            'description' => 'Default logo',
                                            'locked'      => 1
        ]);
        \App\Models\Settings\Settings::insert(['key'         => 'default.admin_view',
                                            'value'       => 'admin.home',
                                            'description' => 'Default admin home view',
                                            'locked'      => 1
        ]);
        \App\Models\Settings\Settings::insert(['key'         => 'default.frontend_view',
                                            'value'       => 'frontend.home',
                                            'description' => 'Default frontend home view',
                                            'locked'      => 1
        ]);

        \App\Models\Settings\Settings::insert(['key'         => 'default.admin_logo',
                                               'value'       => 'storage/logo.png',
                                               'description' => 'Default admin logo',
                                               'locked'      => 1
        ]);
        \App\Models\Settings\Settings::insert(['key'         => 'default.frontend_logo',
                                               'value'       => 'storage/logo.png',
                                               'description' => 'Default frontend logo',
                                               'locked'      => 1
        ]);

        \App\Models\Settings\Settings::insert(['key'         => 'default.register_user_allowed',
                                               'value'       => '1',
                                               'description' => 'Allow registering users public',
                                               'locked'      => 1
        ]);
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
