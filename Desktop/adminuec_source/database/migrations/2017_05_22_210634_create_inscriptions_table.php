<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id')->unsigned();
            $table->integer('period_id')->unsigned();
            $table->integer('curse_id')->unsigned();
            $table->integer('inscriptioncost_id')->unsigned();
            $table->timestamps();

            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('curse_id')->references('id')->on('curses');
            $table->foreign('period_id')->references('id')->on('periods');
            $table->foreign('inscriptioncost_id')->references('id')->on('inscription_costs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscriptions');
    }
}
