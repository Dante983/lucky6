<?php

use App\Models\Locations;
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
        $data = [
            ['city' => 'Banja Luka', 'updated_at' => \Carbon\Carbon::now(), 'created_at' => \Carbon\Carbon::now()],
            ['city' => 'Bijeljina', 'updated_at' => \Carbon\Carbon::now(), 'created_at' => \Carbon\Carbon::now()],
            ['city' => 'Prijedor', 'updated_at' => \Carbon\Carbon::now(), 'created_at' => \Carbon\Carbon::now()],
            ['city' => 'Prnjavor', 'updated_at' => \Carbon\Carbon::now(), 'created_at' => \Carbon\Carbon::now()],
            ['city' => 'Brcko', 'updated_at' => \Carbon\Carbon::now(), 'created_at' => \Carbon\Carbon::now()],
            ['city' => 'Laktasi', 'updated_at' => \Carbon\Carbon::now(), 'created_at' => \Carbon\Carbon::now()],
        ];

        \DB::table('locations')->insert($data);
        Schema::drop('failed_jobs');
        Schema::drop('password_resets');
        Schema::drop('personal_access_tokens');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::table('locations')->delete();
    }
};
