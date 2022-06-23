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
        Schema::table('customers', function (Blueprint $table){
            $table->string('color')->after('type_id')->nullable();
            $table->string('place')->after('color')->nullable();
            $table->string('hobby')->after('place')->nullable();
            $table->string('movie')->after('hobby')->nullable();
            $table->string('music')->after('movie')->nullable();
            $table->string('bio')->after('music')->nullable();
            $table->string('birthplace')->after('bio')->nullable();
            $table->string('sport')->after('birthplace')->nullable();
            $table->string('business_number')->after('sport')->nullable();
            $table->string('field_1')->after('business_number')->nullable();
            $table->string('field_2')->after('field_1')->nullable();
            $table->string('field_3')->after('field_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function ($table) {
            $table->dropColumn('color');
            $table->dropColumn('place');
            $table->dropColumn('hobby');
            $table->dropColumn('movie');
            $table->dropColumn('music');
            $table->dropColumn('bio');
            $table->dropColumn('birthplace');
            $table->dropColumn('sport');
            $table->dropColumn('business_number');
            $table->dropColumn('field_1');
            $table->dropColumn('field_2');
            $table->dropColumn('field_3');
        });
    }
};

/*
color
place
hobby
movie
music
bio
birthplace
sport
business_number
field_1
field_2
field_3
*/
