<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fbookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('calenderId');
            $table->integer('adults');
            $table->integer('childs');

            $table->string('firstname');
            $table->string('lastname');
            $table->string('mobilenos');
            $table->string('alt_mobilenos')->nullable();
            $table->string('email');
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
        Schema::dropIfExists('fbookings');
    }
}
