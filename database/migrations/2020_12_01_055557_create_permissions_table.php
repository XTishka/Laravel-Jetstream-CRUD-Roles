<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        // Insert default data
        DB::table('permissions')->insert(
            [
                [
                    'title'       => 'Настройки :: Приложение',
                    'slug'        => 'application_settings',
                    'description' => 'Доступ к настройкам приложения',
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ],
                [
                    'title'       => 'Настройки :: Пользователи',
                    'slug'        => 'user_management',
                    'description' => 'Создание и управление пользователями',
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ],
                [
                    'title'       => 'Настройки :: Доступы',
                    'slug'        => 'permissions_management',
                    'description' => 'Управление доступами',
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ],
                [
                    'title'       => 'Настройки :: Роли',
                    'slug'        => 'roles_management',
                    'description' => 'Управление ролями',
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ],
                [
                    'title'       => 'Управление задачами',
                    'slug'        => 'tasks_management',
                    'description' => 'Создание и управление задачами',
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
        Schema::dropIfExists('permissions');
    }
}
