<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresionAtmosfericaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presion_atmosferica', function (Blueprint $table) {
            $table->increments('id');
            $table->double('presion');
            $table->dateTime('fecha');
            $table->date('label_chart');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presion_atmosferica');
    }
}
