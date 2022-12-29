<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizquizquestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("quizquestions", "quiz_id"))
		{
	Schema::table("quizquestions", function (Blueprint $table)  {
		$table->integer("quiz_id")->unsigned();

	});		}

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::disableForeignKeyConstraints();
		if (Schema::hasColumn("quizquestions", "quiz_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("quizquestions");
			Schema::table("quizquestions", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("quizquestions_quiz_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("quizquestions_quiz_id_foreign");
					$table->dropColumn("quiz_id");
				}else{
					$table->dropColumn("quiz_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
