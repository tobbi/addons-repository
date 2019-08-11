<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('addonType')->insert([
            ["type" => "Worldmap"],
            ["type" => "Levelset"]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('addonType')->insert([
            ["type" => "Worldmap"],
            ["type" => "Levelset"]
        ]);
    }
}
