<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('shipping_address');
            $table->unsignedBigInteger('shipping_state_id');
            $table->string('shipping_zipcode');
            $table->string('alternative_phone')->nullable();
            $table->string('address_on_product')->nullable();
            $table->decimal('subtotal');
            $table->decimal('discount', 5, 2)->nullable();
            $table->decimal('shipping_cost', 5, 2)->nullable();
            $table->decimal('taxes')->nullable();
            $table->longText('obvservations')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
