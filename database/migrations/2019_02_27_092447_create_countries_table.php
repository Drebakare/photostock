<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   if(!Schema::hasTable('countries')){
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string("capital")->nullable();
            $table->string("citizenship")->nullable();
            $table->string("country_code")->nullable();
            $table->string("currency")->nullable();
            $table->string("currency_code")->nullable();
            $table->string("currency_sub_unit")->nullable();
            $table->string("currency_symbol")->nullable();
            $table->string("currency_decimals")->nullable();
            $table->string("full_name")->nullable();
            $table->string("iso_3166_2")->nullable();
            $table->string("iso_3166_3")->nullable();
            $table->string("name")->nullable();
            $table->integer("region_code")->nullable();
            $table->integer("sub_region_code")->nullable();
            $table->integer("eea")->nullable();
            $table->integer("calling_code")->nullable();
            $table->string("flag")->nullable();
            $table->timestamps();
        });
    }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
