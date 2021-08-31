<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('annonce_id')->unique();
            $table->string('thumbnail')->nullable();
            $table->string('photo1')->nullable();
            $table->string('photo2')->nullable();
            $table->string('photo3')->nullable();
            $table->string('photo4')->nullable();
            $table->string('photo5')->nullable();
            $table->string('photo6')->nullable();
            $table->string('photo7')->nullable();
            $table->string('photo8')->nullable();
            $table->string('photo9')->nullable();
            $table->string('photo10')->nullable();
            $table->string('photo11')->nullable();
            $table->string('photo12')->nullable();
            $table->string('photo13')->nullable();
            $table->string('photo14')->nullable();
            $table->string('photo15')->nullable();
            $table->string('photo16')->nullable();
            $table->string('photo17')->nullable();
            $table->string('photo18')->nullable();
            $table->string('photo19')->nullable();
            $table->string('photo20')->nullable();
            $table->string('number')->default(0);
            $table->string('photo_link');
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
        Schema::dropIfExists('photos');
    }
}
