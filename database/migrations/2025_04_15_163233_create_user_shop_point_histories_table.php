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
        Schema::create('user_shop_point_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('content_id')->nullable();
            $table->string('content_type')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('type')->nullable();
            $table->double('prev_amount')->nullable();
            $table->double('amount')->nullable();
            $table->double('final_amount')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_shop_point_histories');
    }
};
