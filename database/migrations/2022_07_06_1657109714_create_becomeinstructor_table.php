<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBecomeInstructorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('becomeinstructor', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name")->nullable();
			$table->string("email")->nullable();
			$table->string("phone")->nullable();
			$table->string("title")->nullable();
			$table->integer("specialist")->nullable();
			$table->string("yourCourses")->nullable();
			$table->string("cv")->nullable();
			$table->string("socialAccount")->nullable();
			
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
        Schema::dropIfExists('becomeinstructor');
    }
}
