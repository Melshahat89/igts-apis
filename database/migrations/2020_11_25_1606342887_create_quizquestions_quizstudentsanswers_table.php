<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizquestionsquizstudentsanswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("quizstudentsanswers", "quizquestions_id"))
		{
	Schema::table("quizstudentsanswers", function (Blueprint $table)  {
		$table->integer("quizquestions_id")->unsigned();

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
		if (Schema::hasColumn("quizstudentsanswers", "quizquestions_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("quizstudentsanswers");
			Schema::table("quizstudentsanswers", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("quizstudentsanswers_quizquestions_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("quizstudentsanswers_quizquestions_id_foreign");
					$table->dropColumn("quizquestions_id");
				}else{
					$table->dropColumn("quizquestions_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
