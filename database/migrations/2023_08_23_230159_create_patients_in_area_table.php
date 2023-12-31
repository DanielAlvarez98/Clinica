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
            $table->id();
            $table->foreignId('id_area')->nullable()->constrained('areas');
            $table->foreignId('id_patient')->nullable()->constrained('patients');
            $table->char('status',1);
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
