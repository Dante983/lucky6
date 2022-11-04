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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('budget');
        });
        Schema::table('admin_users', function (Blueprint $table) {
            $table->integer('admin_role');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('budget');
        });
        Schema::table('admin_users', function (Blueprint $table) {
            $table->dropColumn('admin_role');
        });
    }
};