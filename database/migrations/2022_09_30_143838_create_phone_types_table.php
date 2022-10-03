<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('phone_types')->insert([
            ['name' => 'Мобильный'],
            ['name' => 'Рабочий'],
            ['name' => 'Домашний'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phone_types');
    }
}
