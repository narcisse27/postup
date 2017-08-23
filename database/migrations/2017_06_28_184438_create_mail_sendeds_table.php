<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailSendedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_sendeds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('template_id');
            $table->string('template_name');
            $table->longText('content')->nullable();
            $table->string('salutation')->nullable();
            $table->integer('corporate_id');
            $table->boolean('test_mail');
            $table->string('mail_object')->nullable();
            $table->text('mail_content')->nullable();
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
        Schema::dropIfExists('mail_sendeds');
    }
}
