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
            $table->string('pro_name');
            $table->string('slug');
            $table->string('image_path')->nullable();
            $table->string('orginal_price');
            $table->string('discount_price')->nullable();
            $table->string('availability');
            $table->string('shipping')->nullable();
            $table->string('seller');
            $table->string('weight')->nullable();
            $table->unsignedBigInteger('category')->nullable();
            $table->foreign('category')
                         ->references('id')
                         ->on('p_categories')
                         ->onUpdate('cascade')
                         ->onDelete('cascade');
            $table->softDeletes();
            $table->string('description',5000);
            $table->string('information',5000)->nullable();
            $table->timestamps();
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
