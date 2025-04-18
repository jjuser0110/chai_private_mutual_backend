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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('product_category_id')->nullable();
            $table->string('product_name')->nullable();
            $table->double('product_price')->nullable();
            $table->double('product_percentage')->nullable();
            $table->string('product_size')->nullable();
            $table->string('earning_yield')->nullable();
            $table->string('project_deadline')->nullable();
            $table->string('user_level')->nullable();
            $table->double('investment_amount')->nullable();
            $table->text('project_rules')->nullable();
            $table->integer('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
