<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('itinerary')->nullable();
            $table->text('packageincludes')->nullable();
            $table->text('durationdetail')->nullable();
            $table->text('infos')->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('orderb')->unsigned()->default(0);
            $table->boolean('stats')->default(1); 
            $table->boolean('isdeleted')->default(0); 
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
        Schema::dropIfExists('menus');
    }
}
