<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddonIdToIntermediateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('super_tux_to_addon_revision', function (Blueprint $table) {
            $table->integer('addon_id')->unsigned();
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
        Schema::table('super_tux_to_addon_revision', function (Blueprint $table) {
            $table->dropColumn('addon_id');
        });
    }
}
