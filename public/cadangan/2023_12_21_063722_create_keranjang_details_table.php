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
        Schema::create('keranjang_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('keranjang_id')->unsigned();
            $table->integer('produk_id')->unsigned();
            $table->integer('qty');
            $table->integer('subtotal');
            $table->foreign('keranjang_id')->references('id')->on('keranjangs');
            $table->foreign('produk_id')->references('id')->on('produks');
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
        Schema::dropIfExists('keranjang_details');
    }
};
