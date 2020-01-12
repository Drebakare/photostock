<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsCollectionOnUploadsTable extends Migration
{
    public function up()
    {
        Schema::table('uploads', function (Blueprint $table) {
            $table->addColumn('integer','is_collection')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uploads', function (Blueprint $table) {
            $table->integer("is_collection");
        });
    }
}
