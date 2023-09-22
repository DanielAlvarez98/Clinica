<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('id_patient');
            $table->integer('id_schedule');
            $table->time('start_time');
            $table->time('end_time');
            $table->text('description');
            $table->char('status',1);
            $table->foreign('id_patient')->references('id')->on('patients');
            $table->foreign('id_schedule')->references('id')->on('schedules');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
