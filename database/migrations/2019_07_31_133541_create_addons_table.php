<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addons', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('version');
            $table->text('description');
            $table->string('slug');
            $table->string('http_url');
            $table->string('thumb_url');
            $table->string('md5');
            $table->integer('author_id')->unsigned();
            $table->integer('license_id')->unsigned();
            $table->boolean('enabled');
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('license_id')->references('id')->on('licenses');
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
        Schema::dropIfExists('addons');
    }
}
