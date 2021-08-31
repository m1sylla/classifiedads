<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professionnels', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('compte_id');
            $table->unsignedSmallInteger('category_id');
            $table->string('brand');
            $table->string('website');
            $table->text('description');
            $table->string('location');
            $table->string('logo');
            $table->boolean('active')->default(1);
            $table->boolean('validated')->default(0);
            $table->boolean('refused')->default(0);
            $table->boolean('suspended')->default(0);
            $table->boolean('deleted')->default(0);
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
        Schema::dropIfExists('professionnels');
    }
}
