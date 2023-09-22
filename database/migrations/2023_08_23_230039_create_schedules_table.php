<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('id_employeeArea');
            $table->integer('id_day');
            $table->time('start_time');
            $table->time('end_time');
            $table->foreign('id_employeeArea')->references('id')->on('employee_in_area');
            $table->foreign('id_day')->references('id')->on('weekdays');
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
        Schema::dropIfExists('schedules');
    }
}
