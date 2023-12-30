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
            $table->id();
            $table->foreignId('id_employee')->nullable()->constrained('employees');
            $table->foreignId('id_area')->nullable()->constrained('areas');
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
        Schema::dropIfExists('employee_in_area');
    }
}
