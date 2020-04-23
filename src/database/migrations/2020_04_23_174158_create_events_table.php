<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
            $table->timestamp('date');
            $table->text('place');
            $table->unsignedDouble('cost');
            $table->unsignedBigInteger('last_event_id')->nullable();
            $table->text('note');
            $table->text('review_note')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('driverA_id');
            $table->foreign('driverA_id')->references('id')->on('drivers')->onDelete('cascade');
            $table->unsignedBigInteger('driverB_id');
            $table->foreign('driverB_id')->references('id')->on('drivers')->onDelete('cascade');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->foreign('last_event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
