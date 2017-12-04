<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionInputorderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traninput_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_product')->unsigned()->nullable();
            $table->integer('quantity')->unsigned()->nullable();
            $table->integer('price')->unsigned()->nullable();
            $table->integer('total')->unsigned()->nullable();
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
        Schema::dropIfExists('traninput_order');
    }
}
