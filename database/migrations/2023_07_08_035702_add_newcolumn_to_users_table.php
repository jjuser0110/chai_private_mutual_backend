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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique();
            $table->string('contact_no')->nullable();
            $table->string('id_card')->nullable();
            $table->integer('role_id');
            $table->integer('is_active')->default(1);
            $table->integer('upline')->nullable();
            $table->string('invitation_code')->nullable();
            $table->string('medal')->nullable();
            $table->double('available_fund')->default(0);
            $table->double('total_money')->default(0);
            $table->double('unavailable_fund')->default(0);
            $table->double('income')->default(0);
            $table->double('credit_score')->default(0);
            $table->double('shop_point')->default(0);
            $table->string('account_health')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
