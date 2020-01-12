<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDescriptionToTitleOnPhotosTable extends Migration
{

    public function up()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropColumn("description");
        });
    }


    public function down()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->string("description");
        });
    }
}
