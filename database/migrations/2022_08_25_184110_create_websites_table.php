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
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('customer_id')->nullable();
            $table->date('initial_date');
            $table->date('end_date')->nullable();
            $table->string('service');
            $table->string('payment');
            $table->string('invoice');
            $table->integer('invoice_id')->nullable();
            $table->decimal('payment_received')->nullable();
            $table->integer('payment_method')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->integer('maintenance')->default(0);
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('websites');
    }
};
