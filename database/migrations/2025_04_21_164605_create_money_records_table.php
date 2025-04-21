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
        Schema::create('money_records', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('type')->nullable();
            $table->double('before_amount')->nullable();
            $table->double('amount')->nullable();
            $table->double('after_amount')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('money_records');
    }
};
