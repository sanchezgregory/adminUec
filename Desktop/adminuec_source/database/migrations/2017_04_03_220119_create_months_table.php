<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('months', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('nm');
            $table->integer('cost_id')->unsigned();
            $table->integer('period_id')->unsigned();
            $table->timestamps();

            $table->foreign('period_id')->references('id')->on('periods');
            $table->foreign('cost_id')->references('id')->on('costs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('months');
    }
}
