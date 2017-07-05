<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->enum('role', ['admin', 'editor', 'user']);
            $table->string('password');
            $table->boolean('active')->default(true);
            $table->integer('person_id')->unsigned();
            $table->string('img')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            // ---- al borrar un trabajador se borra su usuario -----
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            // -------------------------------------------------------
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
