<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourcalenderdatetimeinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourcalenderdatetimeinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tourdetails_id');
            $table->dateTime('tourdatetime');
            $table->integer('paxs');
            $table->decimal('rate_children', 8, 2);
            $table->decimal('rate_adult', 8, 2);
            $table->boolean('stats')->default(1); 
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tourcalenderdatetimeinfos');
    }
}
