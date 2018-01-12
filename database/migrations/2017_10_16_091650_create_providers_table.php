<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('phone')->unsigned()->nullable();
            $table->string('address');
            $table->string('email')->unique();
            $table->timestamps();
        });
        DB::table('providers')->insert(
            array(
                'name' => 'FPT Shop',
                'phone'=> '123456789',
                'address' => "danang city",
                'email'  => "fptshop@gmail.com",
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
        Schema::dropIfExists('providers');
    }
}
