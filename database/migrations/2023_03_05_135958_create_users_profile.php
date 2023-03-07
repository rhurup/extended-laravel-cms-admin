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
        Schema::create('users_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("users_id")->nullable(false);
            $table->integer("member_no")->nullable();
            $table->integer("member_year")->nullable();
            $table->string("address", 255)->default("");
            $table->string("address_2", 255)->default("");
            $table->string("zip", 100)->default("");
            $table->string("city", 100)->default("");
            $table->integer("country_id")->nullable();
            $table->string("phone")->nullable();
            $table->date("birthday")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_profile');
    }
};
