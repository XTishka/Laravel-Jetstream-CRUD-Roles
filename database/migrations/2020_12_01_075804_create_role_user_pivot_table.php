<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRoleUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->foreignId('role_id')->references('id')->on('roles')->cascadeOnDelete();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
        });

        // Insert default data
        DB::table('role_user')->insert(
            [
                // user :: administrator
                [
                    'role_id' => '1',
                    'user_id' => '1',
                ],
            ]
        );
    }

    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
