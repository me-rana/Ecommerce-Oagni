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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->unsignedBigInteger('uid')->nullable();
            $table->foreign('uid')
                         ->references('id')
                         ->on('users')
                         ->onUpdate('cascade')
                         ->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')
                        ->references('id')
                        ->on('products')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
            $table->unsignedBigInteger('seller')->nullable();
            $table->foreign('seller')
                        ->references('seller')
                        ->on('products')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
            $table->string('product_name')->nullable();
            $table->integer('quantity')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('vat')->nullable();
            $table->bigInteger('total_price')->nullable();
            $table->string('order_id')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('shipping_address',500)->nullable();
            $table->string('note',500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
