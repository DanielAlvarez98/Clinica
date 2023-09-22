<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsInAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients_in_area', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('id_area');
            $table->integer('id_patient');
            $table->char('status',1);
            $table->foreign('id_area')->references('id')->on('areas');
            $table->foreign('id_patient')->references('id')->on('patients');
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
        Schema::dropIfExists('patients_in_area');
    }
}
