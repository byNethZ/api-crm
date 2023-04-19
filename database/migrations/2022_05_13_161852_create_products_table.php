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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('name');
            $table->string('supplier');
            $table->integer('category_id');
            $table->string('description_english');
            $table->string('description_spanish');
            $table->decimal('price_one')->nullable();
            $table->decimal('price_two')->nullable();
            $table->decimal('price_three')->nullable();
            $table->decimal('price_four')->nullable();
            $table->decimal('price_five')->nullable();
            $table->decimal('price_six')->nullable();
            $table->decimal('price_seven')->nullable();
            $table->decimal('tax')->nullable();
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
        Schema::dropIfExists('products');
    }
};
