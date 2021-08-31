<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnoncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('compte_id');
            $table->unsignedSmallInteger('category_item_id');
            $table->unsignedSmallInteger('ville_id');
            $table->string('sector_name',80)->nullable();
            $table->boolean('is_offer');
            $table->boolean('is_new');
            $table->string('title', 100);
            $table->text('description');
            $table->string('price')->nullable();
            $table->unsignedTinyInteger('price_option_id')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedInteger('views');
            $table->timestamp('last_visit'); 
            $table->boolean('suspended')->default(0);
            $table->boolean('deleted')->default(0);
            $table->boolean('validated')->default(0);
            $table->integer('category_id');
            $table->integer('region_id');
            $table->string('ad_email');
            $table->string('ad_phone')->nullable();
            $table->string('identifiant')->nullable();
            $table->boolean('is_sold')->default(0);
            $table->timestamp('expire_at')->nullable();
            $table->string('ip_adress')->nullable();
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
        Schema::dropIfExists('annonces');
    }
}
