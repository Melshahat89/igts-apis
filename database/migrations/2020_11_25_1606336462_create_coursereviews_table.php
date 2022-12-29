<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursereviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coursereviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string("review")->nullable();
			$table->integer("rating")->nullable();
			$table->boolean("type")->nullable();
			$table->string("manual_name")->nullable();
			$table->string("manual_image")->nullable();
			
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
        Schema::dropIfExists('coursereviews');
    }
}
