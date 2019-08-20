<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddonRevisions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addon_revisions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('author_id')->unsigned();
            $table->integer('addon_id')->unsigned();
            $table->dateTime('changed');
            $table->text('revision_text')->nullable();
            $table->string('file_path');
            $table->string('version');
            $table->string('sha256');
            $table->string('md5');
            $table->foreign('author_id')->references('id')->on('authors');
            $table->foreign('addon_id')->references('id')->on('addons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropTable('addon_revisions');
    }
}
