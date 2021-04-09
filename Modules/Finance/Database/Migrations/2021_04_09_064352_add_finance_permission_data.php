<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AddFinancePermissionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert default data
        DB::table('permissions')->insert(
            [
                [
                    'title'       => 'Финансы :: Отчтеты',
                    'slug'        => 'finance_dashboards',
                    'description' => 'Доступ к финансовым отчетам',
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ],
                [
                    'title'       => 'Финансы :: Операции',
                    'slug'        => 'finance_operations',
                    'description' => 'Управление финансовыми операциями',
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ],
                [
                    'title'       => 'Финансы :: Контрагенты',
                    'slug'        => 'finance_counterparties',
                    'description' => 'Управление контрагентами',
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ],
                [
                    'title'       => 'Финансы :: Валюта',
                    'slug'        => 'finance_currencies',
                    'description' => 'Управление влютами',
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ],
                [
                    'title'       => 'Финансы :: НДС',
                    'slug'        => 'finance_vat',
                    'description' => 'Настройка НДС',
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            DB::table('permissions')->delete();
        });
    }
}
