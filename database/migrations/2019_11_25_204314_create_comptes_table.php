<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comptes', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable(); 
            $table->string('password');
            $table->string('avatar')->default('user.png');
            $table->integer('ads_number')->default(0);
            $table->boolean('phone_verified')->default(0);
            $table->boolean('confirmed')->default(0);
            $table->boolean('suspended')->default(0);
            $table->boolean('deleted')->default(0);
            $table->timestamp('last_visit')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('comptes');
    }
}
