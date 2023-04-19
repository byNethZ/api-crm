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
            $table->integer('status')->default(1);
            $table->string('business')->nullable();
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->string('city')->nullable();
            $table->string('town')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->integer('vendor_id');
            $table->integer('level')->nullable();
            $table->integer('type_id')->default(22);
            $table->string('color')->nullable();
            $table->string('place')->nullable();
            $table->string('hobby')->nullable();
            $table->string('movie')->nullable();
            $table->string('music')->nullable();
            $table->string('bio')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('sport')->nullable();
            $table->string('business_number')->nullable();
            $table->string('field_1')->nullable();
            $table->string('field_2')->nullable();
            $table->string('field_3')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('occupation', 100)->nullable();
            $table->integer('marital_status')->nullable();
            $table->integer('nationality')->nullable();
            $table->integer('language')->nullable();
            $table->string('fears')->nullable();
            $table->json('emotions')->nullable();
            $table->string('needs')->nullable();
            $table->string('identity')->nullable();
            $table->string('dreams')->nullable();
            $table->string('goals')->nullable();
            $table->string('tasks')->nullable();
            $table->string('relations')->nullable();
            $table->json('values')->nullable();
            $table->string('motivators')->nullable();
            $table->json('beliefs')->nullable();
            $table->json('mind')->nullable();
            $table->string('food')->nullable();
            $table->json('personality')->nullable();
            $table->string('mindset')->nullable();
            $table->string('pleasures')->nullable();
            $table->string('finances')->nullable();
            $table->string('wishes')->nullable();
            $table->string('important_dates')->nullable();
            $table->string('challenges')->nullable();
            $table->string('responsability')->nullable();
            $table->string('demotivators')->nullable();
            $table->string('works')->nullable();
            $table->longText('notes')->nullable();
            $table->string('token');
            $table->string('image')->nullable();
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
