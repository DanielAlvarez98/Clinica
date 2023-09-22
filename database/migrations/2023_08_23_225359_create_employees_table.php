<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('id_rol');
            $table->foreign('id_rol')->references('id')->on('roles');
            $table->string('name',50);
            $table->string('lastname',50);
            $table->string('dni',8)->unique();
            $table->string('email',100)->unique();
            $table->string('gender',10);
            $table->date('birthdate');
            $table->string('photo',100);
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
        Schema::dropIfExists('employees');
    }
}
