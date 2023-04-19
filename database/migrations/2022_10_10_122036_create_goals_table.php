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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('type');
            $table->decimal('jan_goal', $precision = 8, $scale = 2)->nullable();
            $table->decimal('jan_result', $precision = 8, $scale = 2)->nullable();
            $table->decimal('feb_goal', $precision = 8, $scale = 2)->nullable();
            $table->decimal('feb_result', $precision = 8, $scale = 2)->nullable();
            $table->decimal('mar_goal', $precision = 8, $scale = 2)->nullable();
            $table->decimal('mar_result', $precision = 8, $scale = 2)->nullable();
            $table->decimal('apr_goal', $precision = 8, $scale = 2)->nullable();
            $table->decimal('apr_result', $precision = 8, $scale = 2)->nullable();
            $table->decimal('may_goal', $precision = 8, $scale = 2)->nullable();
            $table->decimal('may_result', $precision = 8, $scale = 2)->nullable();
            $table->decimal('jun_goal', $precision = 8, $scale = 2)->nullable();
            $table->decimal('jun_result', $precision = 8, $scale = 2)->nullable();
            $table->decimal('jul_goal', $precision = 8, $scale = 2)->nullable();
            $table->decimal('jul_result', $precision = 8, $scale = 2)->nullable();
            $table->decimal('aug_goal', $precision = 8, $scale = 2)->nullable();
            $table->decimal('aug_result', $precision = 8, $scale = 2)->nullable();
            $table->decimal('sep_goal', $precision = 8, $scale = 2)->nullable();
            $table->decimal('sep_result', $precision = 8, $scale = 2)->nullable();
            $table->decimal('oct_goal', $precision = 8, $scale = 2)->nullable();
            $table->decimal('oct_result', $precision = 8, $scale = 2)->nullable();
            $table->decimal('nov_goal', $precision = 8, $scale = 2)->nullable();
            $table->decimal('nov_result', $precision = 8, $scale = 2)->nullable();
            $table->decimal('dec_goal', $precision = 8, $scale = 2)->nullable();
            $table->decimal('dec_result', $precision = 8, $scale = 2)->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goals');
    }
};
