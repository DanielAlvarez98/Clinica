<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('id_history');
            $table->integer('id_patienArea');
            $table->string('diagnosi',100);
            $table->text('treatment');
            $table->date('date');
            $table->foreign('id_history')->references('id')->on('medical_history');
            $table->foreign('id_patienArea')->references('id')->on('areas');
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
        Schema::dropIfExists('diagnosis');
    }
}
