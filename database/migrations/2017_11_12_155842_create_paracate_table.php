<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateParacateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paracatedetail', function (Blueprint $table) {
            $table->integer('parameters_id')->unsigned()->nullable();
            $table->foreign('parameters_id')->references('id')->on('parameters');
            $table->integer('categories_id')->unsigned()->nullable();
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->timestamps();
        });
        DB::table('paracatedetail')->insert(
            array(
                'parameters_id' => 1,
                'categories_id' => 1
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paracatedetail', function (Blueprint $table) {
            //
        });
    }
}
