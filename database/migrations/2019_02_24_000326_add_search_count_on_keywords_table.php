<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSearchCountOnKeywordsTable extends Migration
{
    public function up()
    {
        Schema::table('keywords', function (Blueprint $table) {
            $table->integer('search_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keyword', function (Blueprint $table) {
            $table->integer("search_count");
        });
    }
}
