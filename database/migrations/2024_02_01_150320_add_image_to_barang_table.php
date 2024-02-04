<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToBarangTable extends Migration
{
    public function up()
    {
        Schema::table('barang', function (Blueprint $table) {
            // Add an image column
            $table->string('image')->nullable();
        });
    }

    public function down()
    {
        Schema::table('barang', function (Blueprint $table) {
            // Remove the image column if rolling back
            $table->dropColumn('image');
        });
    }
};
