<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businessdata', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name")->nullable();
			$table->integer("discount_type")->nullable();
			$table->string("discount_value")->nullable();
			$table->boolean("automatically_license")->nullable();
			$table->string("logo")->nullable();
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
        Schema::dropIfExists('businessdata');
    }
}
