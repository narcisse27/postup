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
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->integer('area_id')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('adresse')->nullable();
            $table->integer('npa')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('canton')->nullable();
            $table->string('picture_name')->default('default-grey-avatar.png')->nullable();
            $table->string('api_token', 60)->unique()->nullable();
            $table->integer('abonnement_id')->default(1);
            $table->integer('mails_reserve')->default(20);
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
