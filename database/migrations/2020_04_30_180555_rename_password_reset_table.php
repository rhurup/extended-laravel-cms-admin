<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePasswordResetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists("password_resets");
        //Schema::rename("password_resets", "users_reset_password");
        Schema::rename("password_reset_tokens", "users_reset_password_tokens");
        Schema::dropIfExists("personal_access_tokens");
        //Schema::rename("personal_access_tokens", "users_personal_access_tokens");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
