<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKemahasiswaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kemahasiswaans', function (Blueprint $table) {
            $table->id();
            $table->string('keyword');
            $table->string('image_header');
            $table->foreignId('category_kemahasiswaan_id')->constrained('category_kemahasiswaans');
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
        Schema::dropIfExists('kemahasiswaans');
    }
}
