<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
