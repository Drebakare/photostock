<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollectionIdOnUploadsTable extends Migration
{
    public function up()
    {
        Schema::table('uploads', function (Blueprint $table) {
            $table->unsignedInteger('collection_id')->nullable();
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
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
            $table->integer("collection_id");
        });
    }
}
