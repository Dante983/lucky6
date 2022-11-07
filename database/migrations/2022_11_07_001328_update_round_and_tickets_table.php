<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->renameColumn('numbers', 'user_numbers');
        });
        Schema::table('rounds', function (Blueprint $table) {
            $table->renameColumn('numbers', 'lucky_numbers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->renameColumn('user_numbers', 'numbers');
        });
        Schema::table('rounds', function (Blueprint $table) {
            $table->renameColumn('lucky_numbers', 'numbers');
        });
    }
};
