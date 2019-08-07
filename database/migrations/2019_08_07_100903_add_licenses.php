<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLicenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('licenses')->insert([
            [
                'title' => "GPL 3.0",
                'version' => '1.0',
                'description' => 'General Public License version 3.0',
                'http_url' => 'https://www.gnu.org/licenses/gpl-3.0.html'
            ],
            [
                'title' => 'CC-BY',
                'version' => '3.0',
                'description' => 'CC BY',
                'http_url' => 'https://creativecommons.org/licenses/by/4.0/'
            ],
            [
                'title' => 'CC-BY-SA',
                'version' => '3.0',
                'description' => 'CC BY SA',
                'http_url' => 'https://creativecommons.org/licenses/by-sa/4.0/'
            ],
            [
                'title' => 'CC-BY-ND',
                'version' => '3.0',
                'description' => 'CC BY ND',
                'http_url' => 'https://creativecommons.org/licenses/by-nd/4.0/'
            ],
            [
                'title' => 'CC-BY-NC',
                'version' => '3.0',
                'description' => 'CC BY NC',
                'http_url' => 'https://creativecommons.org/licenses/by-nc/4.0/'
            ],
            [
                'title' => 'CC-BY-NC-SA',
                'version' => '3.0',
                'description' => 'CC BY NC SA',
                'http_url' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/'
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
