<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizstudentsstatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizstudentsstatus', function (Blueprint $table) {
            $table->increments('id');
            $table->date("start_time")->nullable();
			$table->date("end_time")->nullable();
			$table->string("pause_time")->nullable();
			$table->integer("status")->nullable();
			$table->string("skipped_question_id")->nullable();
			$table->integer("passed")->nullable();
			$table->integer("exam_anytime")->nullable();
			
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
        Schema::dropIfExists('quizstudentsstatus');
    }
}
