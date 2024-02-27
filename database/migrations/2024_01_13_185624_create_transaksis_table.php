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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nota', 20);
            $table->date('tanggal');
            $table->integer('tunai');
            $table->integer('kembali');
            $table->BigInteger('kasir_id')->unsigned();
            $table->integer('keranjang_id')->unsigned();
            $table->foreign('kasir_id')->references('id')->on('users');
            $table->foreign('keranjang_id')->references('id')->on('keranjangs');
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
        Schema::dropIfExists('transaksis');
    }
};
