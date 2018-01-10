<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('unit');
            $table->timestamps();
        });
        DB::table('calculation')->insert(
            array(
                ['name' => "giảm giá theo %", 'unit'=>'%'],
                ['name' => "giảm giá theo $", 'unit'=>'$']
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
        Schema::dropIfExists('calculation');
    }
}
