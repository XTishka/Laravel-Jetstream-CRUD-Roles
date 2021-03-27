<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePermissionRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->foreignId('role_id')->references('id')->on('roles')->cascadeOnDelete();
            $table->foreignId('permission_id')->references('id')->on('permissions')->cascadeOnDelete();
        });

        // Insert default data
        DB::table('permission_role')->insert(
            [
                // role :: administrator
                [
                    'role_id'       => '1',
                    'permission_id' => '1',
                ],
                [
                    'role_id'       => '1',
                    'permission_id' => '2',
                ],
                [
                    'role_id'       => '1',
                    'permission_id' => '3',
                ],
                [
                    'role_id'       => '1',
                    'permission_id' => '4',
                ],
                [
                    'role_id'       => '1',
                    'permission_id' => '5',
                ],

                // role :: founder
                [
                    'role_id'       => '2',
                    'permission_id' => '5',
                ],

                // role :: employer
                [
                    'role_id'       => '3',
                    'permission_id' => '5',
                ],
            ]
        );
    }

    public function down()
    {
        Schema::dropIfExists('permission_role');
    }
}
