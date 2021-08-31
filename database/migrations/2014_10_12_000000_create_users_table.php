<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name',50);
            $table->string('email')->unique();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('password');
            $table->string('avatar')->default('user.png');
            $table->boolean('confirmed')->default(0);
            $table->boolean('validated')->default(0);
            $table->boolean('refused')->default(0);
            $table->boolean('suspended')->default(0);
            $table->boolean('deleted')->default(0);
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
        Schema::dropIfExists('users');
    }
}
