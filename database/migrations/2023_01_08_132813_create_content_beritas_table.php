<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentBeritasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_beritas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('berita_id')->constrained('beritas');
            $table->string('title');
            $table->string('description');
            $table->longText('content');
            $table->string('image_content')->nullable();
            $table->date('date');
            $table->string('publish')->default('0');
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
        Schema::dropIfExists('content_beritas');
    }
}
