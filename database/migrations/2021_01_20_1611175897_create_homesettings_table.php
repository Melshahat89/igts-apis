<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomesettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homesettings', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean("bundles")->nullable();
			$table->boolean("featured_courses")->nullable();
			$table->boolean("events")->nullable();
			$table->boolean("talks")->nullable();
			
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
        Schema::dropIfExists('homesettings');
    }
}
