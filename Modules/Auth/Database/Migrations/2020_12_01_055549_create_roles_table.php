<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        // Insert default data
        DB::table('roles')->insert(
            [
                [
                    'title'       => 'Администратор',
                    'slug'        => 'administrator',
                    'description' => 'Абсолютный доступ ко всем частям приложения',
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ],
                [
                    'title'       => 'Учредитель',
                    'slug'        => 'founder',
                    'description' => 'Доступ к отчетам',
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ],
                [
                    'title'       => 'Сотрудник',
                    'slug'        => 'employer',
                    'description' => 'Доступ к личной учетной записи сотрудника',
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ]
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
        Schema::dropIfExists('roles');
    }
}
