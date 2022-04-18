<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title")->nullable();
			$table->longText("description")->nullable();
			$table->string("image")->nullable();
			$table->boolean("is_free")->nullable();
			$table->string("price_egp")->nullable();
			$table->string("price_usd")->nullable();
			$table->integer("type")->nullable();
			$table->boolean("status")->nullable();
			$table->text("location")->nullable();
			$table->text("live_link")->nullable();
			$table->text("recorded_link")->nullable();
			
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
        Schema::dropIfExists('events');
    }
}
