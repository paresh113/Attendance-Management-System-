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
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('emp_id')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('date_of_birth');
            $table->string('address');
            $table->string('joining_date');
            $table->string('contact_number')->unique();
            $table->string('emp_status');
            $table->string('emp_designation');
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
