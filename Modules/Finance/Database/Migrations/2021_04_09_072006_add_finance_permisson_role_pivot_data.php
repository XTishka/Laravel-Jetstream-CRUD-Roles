<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddFinancePermissonRolePivotData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permission_role', function (Blueprint $table) {

            DB::table('permission_role')->insert(
                [
                    // role :: administrator
                    [
                        'role_id'       => '1',
                        'permission_id' => '6',
                    ],
                    [
                        'role_id'       => '1',
                        'permission_id' => '7',
                    ],
                    [
                        'role_id'       => '1',
                        'permission_id' => '8',
                    ],
                    [
                        'role_id'       => '1',
                        'permission_id' => '9',
                    ],
                    [
                        'role_id'       => '1',
                        'permission_id' => '10',
                    ],
                ]
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('', function (Blueprint $table) {

        });
    }
}
