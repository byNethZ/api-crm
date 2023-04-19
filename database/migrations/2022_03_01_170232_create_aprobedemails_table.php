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
        Schema::create('aprobedemails', function (Blueprint $table) {
            $table->id();
            $table->string('customer');
            $table->integer('customer_id');
            $table->string('user_id');
            $table->string('type', 20)->nullable();
            $table->string('notes', 700)->nullable();
            $table->string('urldropbox');
            $table->integer('aprobed');
            $table->string('approver');
            $table->string('message');
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
        Schema::dropIfExists('aprobedemails');
    }
};
