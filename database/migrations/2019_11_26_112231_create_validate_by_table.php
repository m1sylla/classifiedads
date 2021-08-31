<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidateByTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //'ad', 'sponsore', 'advertisement', 'user', 'business', 'admin'
        Schema::create('validate_by', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('admin_id');
            $table->integer('activity_id');
            $table->string('activity_type'); 
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
        Schema::dropIfExists('validate_by');
    }
}
