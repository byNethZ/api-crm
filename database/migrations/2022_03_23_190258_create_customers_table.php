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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->string('name');
            $table->string('surname');
            $table->string('address');
            $table->string('zipcode');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->string('city');
            $table->string('town');
            $table->string('phone');
            $table->string('email');
            $table->string('website');
            $table->integer('vendor_id');
            $table->integer('level');
            $table->integer('type_id');
            $table->string('token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
