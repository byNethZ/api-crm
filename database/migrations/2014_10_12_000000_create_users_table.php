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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('personal_phone');
            $table->string('public_phone')->nullable();
            $table->string('password');
            $table->integer('role_id');
            $table->integer('departament_id');
            $table->rememberToken();
            $table->string('token');
            $table->string('avatar')->nullable();
            $table->timestamps();
            $table->integer('departament_alt_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
