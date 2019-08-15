<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLanguagePackToAddonType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addonType', function(Blueprint $table) {
            $table->string('nfo_key');
        });

        DB::table('addonType')->insert([
            [
                "type" => "Language Pack",
                "nfo_key" => "languagepack"
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
