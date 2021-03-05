<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Insert default data
        DB::table('users')->insert(
            [
                'name'       => 'Тахир Бердыев',
                'email'      => 'takhir.berdyiev@gmail.com',
                'password'   => '$2y$10$hV53GGWoSkHo9Pyrrtniv.APAAf6MwefBNEXQunnXjlk6nq.wwtQa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
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
        Schema::dropIfExists('users');
    }
}
