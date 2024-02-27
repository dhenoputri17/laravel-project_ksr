<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->increments('id');
            $table->BigInteger('user_id')->unsigned()->nullable();
            $table->integer('meja_id')->unsigned()->nullable();
            $table->integer('total');
            $table->string('status', 20);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('meja_id')->references('id')->on('mejas');
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
        Schema::dropIfExists('keranjangs');
    }
};
