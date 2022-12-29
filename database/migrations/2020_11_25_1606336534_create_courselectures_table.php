<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourselecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courselectures', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title")->nullable();
			$table->string("slug")->nullable();
			$table->text("description")->nullable();
			$table->string("video_file")->nullable();
			$table->string("length")->nullable();
			$table->boolean("is_free")->nullable();
			$table->string("position")->nullable();
			
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
        Schema::dropIfExists('courselectures');
    }
}
