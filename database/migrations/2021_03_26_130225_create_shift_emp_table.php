<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftEmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_shifts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('guard')->unsigned();
            $table->integer('shift')->unsigned();
            $table->timestamp('date');
            $table->string('status');
            $table->timestamps();
            
            $table->foreign('guard')->references('id')->on('users');  
            $table->foreign('shift')->references('id')->on('shifts');      
        });

      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shift_emp');
    }
}
