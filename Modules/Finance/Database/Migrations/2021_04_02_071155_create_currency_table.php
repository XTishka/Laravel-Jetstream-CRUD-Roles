<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fnc_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('code', 3)->unique();
            $table->string('designation', 10)->unique();
            $table->string('base_currency', 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Insert default data
        DB::table('fnc_currencies')->insert(
            [
                [
                    'title'       => 'Украинская гривна',
                    'code'        => 'UAH',
                    'designation' => 'грн.',
                    'base_currency' => 'on',
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ],
                [
                    'title'       => 'Российский рубль',
                    'code'        => 'RUB',
                    'designation' => 'руб.',
                    'base_currency' => null,
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ],
                [
                    'title'       => 'Доллар США',
                    'code'        => 'USD',
                    'designation' => '$',
                    'base_currency' => null,
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ],
                [
                    'title'       => 'Евро',
                    'code'        => 'EUR',
                    'designation' => '€',
                    'base_currency' => null,
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
        Schema::dropIfExists('fnc_currencies');
    }
}
