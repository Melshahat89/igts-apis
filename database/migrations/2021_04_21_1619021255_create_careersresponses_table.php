<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareersresponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('careersresponses', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name")->nullable();
			$table->string("email")->nullable();
			$table->string("mobile")->nullable();
			$table->string("file")->nullable();
			
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
        Schema::dropIfExists('careersresponses');
    }
}
