<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLengthToGameStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_stores', function (Blueprint $table) {
            // Create a new column called `length` where all existing
            // games will be assigned a default value of `4`
            $table->unsignedInteger('length')->default(4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_stores', function (Blueprint $table) {
            // Drop the `length` column
            $table->dropColumn('length');
        });
    }
}