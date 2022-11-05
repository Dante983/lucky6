<?php

use App\Models\AdminUsers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
        $pass = '123456';

        AdminUsers::query()->insert([
           'name' => 'Super Admin',
           'email' => 'admin@admin.com',
           'password' => Hash::make($pass),
            'admin_type' => 0
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        AdminUsers::query()->where('admin_type', '=', 0)->delete();
    }
};
