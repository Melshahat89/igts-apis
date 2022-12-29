<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderspositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordersposition', function (Blueprint $table) {
            $table->increments('id');
            $table->double("amount")->nullable();
			$table->string("notes")->nullable();
			$table->integer("certificate_id")->nullable();
			$table->string("shipping_id")->nullable();
			$table->integer("status")->nullable();
			
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
        Schema::dropIfExists('ordersposition');
    }
}
