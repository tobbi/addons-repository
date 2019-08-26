<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperTuxToAddonRevisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_tux_to_addon_revision', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('supertux_version_id')->unsigned();
            $table->bigInteger('revision_id')->unsigned();
            $table->foreign('supertux_version_id')->references('id')->on('supertux_versions');
            $table->foreign('revision_id')->references('id')->on('addon_revisions');
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
        Schema::dropIfExists('super_tux_to_addon_revision');
    }
}
