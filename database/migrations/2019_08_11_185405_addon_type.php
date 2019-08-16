<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddonType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("addonType", function(Blueprint $table)
        {
            $table->increments('id');
            $table->string("type");
            $table->string('nfo_key');
        });

        DB::table('addonType')->insert([
            ["type" => "Worldmap", "nfo_key" => "worldmap"],
            ["type" => "Levelset", "nfo_key" => "levelset"],
            ["type" => "Language Pack", "nfo_key" => "languagepack"]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addonType');
    }
}
