<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('mobilenos');
            $table->string('alt_mobilenos')->nullable();
            $table->string('email');
            $table->string('cruiseterminal')->nullable();
            $table->string('airport')->nullable();
            $table->string('other')->nullable();
            $table->string('triptype');
            $table->dateTime('traveldate');
            $table->string('pickupaddress');
            $table->integer('noofpassenger');
            // $table->date('dropoffaddress');
            $table->string('flightinfo');
            $table->boolean('privatecharter');
            $table->string('additionalinfo')->nullable();
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
        Schema::dropIfExists('enquiries');
    }
}
