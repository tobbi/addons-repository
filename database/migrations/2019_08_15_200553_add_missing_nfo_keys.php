<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMissingNfoKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('addonType')->where("type", "Worldmap")->update(['nfo_key' => 'worldmap']);
        DB::table('addonType')->where("type", "Levelset")->update(['nfo_key'=> 'levelset']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('addonType')->where("type", "Worldmap")->update(['nfo_key' => null]);
        DB::table('addonType')->where("type", "Levelset")->update(['nfo_key'=> null]);
    }
}
