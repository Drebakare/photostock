<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( !Schema::hasTable('users') ) {
            Schema::create('regions', function (Blueprint $table) {
                $table->increments('id');
                $table->string("name");
                $table->string("currency_code");
                $table->double("rate");
                $table->unsignedInteger("country_id");
                $table->timestamps();
                $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
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
        Schema::dropIfExists('regions');
    }
}
