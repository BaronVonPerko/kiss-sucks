<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropLastPlayedForTopArtists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('top_artists', function (Blueprint $table) {
            $table->dropColumn('last_played');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('top_artists', function (Blueprint $table) {
            $table->addColumn('datetime', 'last_played')->nullable();
        });
    }
}
