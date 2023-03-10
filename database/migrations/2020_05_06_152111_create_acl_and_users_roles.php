<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAclAndUsersRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users_roles_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('group')->nullable(false);
            $table->string('key')->nullable(false);
            $table->text('description')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger("deleted_by")->default(0);
        });

        Schema::create('users_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('description')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger("deleted_by")->default(0);
        });


        Schema::create('users_roles_permissions_map', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->foreign('permission_id')->references('id')->on('users_roles_permissions');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('users_roles');
        });

        Schema::create('users_roles_maps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id')->nullable(false);
            $table->foreign('users_id')->references('id')->on('users');
            $table->unsignedBigInteger('users_roles_id')->nullable(false);
            $table->foreign('users_roles_id')->references('id')->on('users_roles');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_roles');
        Schema::dropIfExists('users_roles_map');
        Schema::dropIfExists('users_roles_permissions');
    }
}
