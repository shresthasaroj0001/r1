<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_rates', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('calenderId'); //tour datetime Id
            $table->integer('feenameId'); //tour datetime Id

            $table->decimal('rates', 8, 2);
            // $table->decimal('rate_5_7', 8, 2);
            // $table->decimal('rate_9_11', 8, 2);
            // $table->decimal('rate_12_23', 8, 2);
            $table->dateTime('createdDate'); //tour time
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_rates');
    }
}
