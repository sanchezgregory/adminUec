<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('person_id')->unsigned();
            $table->integer('representant_id')->unsigned();
            $table->integer('curse_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('person_id')->references('id')->on('persons');
            $table->foreign('representant_id')->references('id')->on('representants');
            $table->foreign('curse_id')->references('id')->on('curses');
        });
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
