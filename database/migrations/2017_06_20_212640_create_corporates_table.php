<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('contact_firstname')->nullable();
            $table->string('contact_lastname')->nullable();
            $table->integer('sexe')->nullable(); // true female , false male
            $table->string('adresse')->nullable();
            $table->integer('npa')->nullable();
            $table->string('city')->nullable();
            $table->integer('canton_id')->nullable();
            $table->string('canton_abbreviation')->nullable();
            $table->string('email');
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
        Schema::dropIfExists('corporates');
    }
}
