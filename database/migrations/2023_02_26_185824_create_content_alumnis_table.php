<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentAlumnisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_alumnis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->constrained('alumnis');
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
        Schema::dropIfExists('content_alumnis');
    }
}
