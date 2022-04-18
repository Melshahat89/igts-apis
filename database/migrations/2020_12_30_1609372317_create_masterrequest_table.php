<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterrequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterrequest', function (Blueprint $table) {
            $table->increments('id');
            $table->string("qualification")->nullable();
			$table->string("collage_name")->nullable();
			$table->string("section")->nullable();
			$table->string("g_year")->nullable();
			$table->string("address")->nullable();
			$table->text("documentation")->nullable();
			
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
        Schema::dropIfExists('masterrequest');
    }
}
