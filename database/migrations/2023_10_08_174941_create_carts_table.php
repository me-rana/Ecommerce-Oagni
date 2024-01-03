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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('product_name')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')
                         ->references('id')
                         ->on('products')
                         ->onUpdate('cascade')
                         ->onDelete('cascade');

            $table->unsignedBigInteger('uid')->nullable();
            $table->foreign('uid')
                        ->references('id')
                        ->on('users')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
            $table->string('quantity')->nullable();
            $table->string('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
