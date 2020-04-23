<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('manufacturer');
            $table->string('model');
            $table->string('body');
            $table->string('color');
            $table->string('fuel');
            $table->string('type');
            $table->integer('passenger_quantity');
            $table->string('weight_class');
            $table->integer('year');
            $table->unsignedDouble('engine_displacement');
            $table->unsignedInteger('horsepower');
            $table->unsignedDouble('weight_rating');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
