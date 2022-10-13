<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountEmlpoyeeSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_emlpoyee_salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->comment('user_id=employee_id');            
            $table->string('date')->nullable();
            $table->double('amount')->nullable();
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
        Schema::dropIfExists('account_emlpoyee_salaries');
    }
}
