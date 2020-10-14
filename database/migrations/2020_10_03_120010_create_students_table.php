<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('student_id');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('year')->nullable();
            $table->string('course')->nullable();
            $table->string('section')->nullable();
            $table->boolean('valid');
            $table->timestamps();
        });

        DB::update("ALTER TABLE students AUTO_INCREMENT = 010000001;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}