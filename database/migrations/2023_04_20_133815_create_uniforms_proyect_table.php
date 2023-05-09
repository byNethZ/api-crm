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
        Schema::create('uniforms_projects', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->integer('type');
            $table->string('color', 20);
            $table->integer('size_xs')->nullable();
            $table->integer('size_s')->nullable();
            $table->integer('size_m')->nullable();
            $table->integer('size_l')->nullable();
            $table->integer('size_xl')->nullable();
            $table->integer('size_xxl')->nullable();
            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uniforms_projects');
    }
};
