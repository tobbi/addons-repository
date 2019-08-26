<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSuperTuxVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supertux_versions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('github_url');
        });

        DB::table('supertux_versions')->insert([
            ["name" => "0.3.5", "github_url" => "https://github.com/SuperTux/supertux/releases/tag/v0.3.5"],
            ["name" => "0.4.0", "github_url" => "https://github.com/SuperTux/supertux/releases/tag/v0.4.0"],
            ["name" => "0.5.0", "github_url" => "https://github.com/SuperTux/supertux/releases/tag/v0.5.0"],
            ["name" => "0.6.0", "github_url" => "https://github.com/SuperTux/supertux/releases/tag/v0.6.0"],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropTable('supertux_versions');
    }
}
