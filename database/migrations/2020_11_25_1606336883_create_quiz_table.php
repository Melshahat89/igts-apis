<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title")->nullable();
			$table->string("description")->nullable();
			$table->string("instructions")->nullable();
			$table->string("time")->nullable();
			$table->string("time_in_mins")->nullable();
			$table->string("type")->nullable();
			$table->string("pass_percentage")->nullable();
			
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
        Schema::dropIfExists('quiz');
    }
}
