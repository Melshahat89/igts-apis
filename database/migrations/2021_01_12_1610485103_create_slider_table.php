<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title")->nullable();
			$table->string("description")->nullable();
			$table->string("image_m_ar")->nullable();
			$table->string("image_m_en")->nullable();
			$table->string("image_d_ar")->nullable();
			$table->string("image_d_en")->nullable();
			$table->boolean("status")->nullable();
			
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
        Schema::dropIfExists('slider');
    }
}
