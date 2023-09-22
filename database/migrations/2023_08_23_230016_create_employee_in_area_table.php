<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeInAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_in_area', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('id_employee');
            $table->integer('id_area');
            $table->char('status',1);
            $table->foreign('id_employee')->references('id')->on('employees');
            $table->foreign('id_area')->references('id')->on('areas');
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
        Schema::dropIfExists('employee_in_area');
    }
}
