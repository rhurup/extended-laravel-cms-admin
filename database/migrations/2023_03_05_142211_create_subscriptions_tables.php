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
        Schema::create('subscriptions_groups', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(false);
            $table->tinyInteger("visibility")->default(0);
        });

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("subscriptions_groups_id")->nullable(false);
            $table->string("name")->nullable(false);
            $table->unsignedBigInteger("users_roles_id")->nullable(false);
            $table->tinyInteger("visibility")->default(0);
            $table->tinyInteger("set_member_no")->default(0);
            $table->tinyInteger("auto_renew")->default(0);
            $table->tinyInteger("entitled_to_vote")->default(0);
            $table->integer("expire_day")->default(0);
            $table->integer("expire_month")->default(0);
            $table->tinyInteger("expire_calendar_year")->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('subscriptions_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("subscriptions_id")->nullable(false);
            $table->string("from")->default("");
            $table->string("to")->default("");
            $table->decimal("price")->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('subscriptions_map', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("subscription_id")->nullable(false);
            $table->unsignedBigInteger("users_id")->nullable(false);
            $table->string("transaction_id")->default("");
            $table->decimal("transaction_amount")->default(0);
            $table->string("transaction_currency")->default("");
            $table->date("payment_date")->nullable(false);
            $table->date("start_date")->nullable(false);
            $table->date("expire_date")->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions_groups');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('subscriptions_map');
    }
};
