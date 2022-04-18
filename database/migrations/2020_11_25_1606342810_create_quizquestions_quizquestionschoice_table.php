<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizquestionsquizquestionschoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("quizquestionschoice", "quizquestions_id"))
		{
	Schema::table("quizquestionschoice", function (Blueprint $table)  {
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
		if (Schema::hasColumn("quizquestionschoice", "quizquestions_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("quizquestionschoice");
			Schema::table("quizquestionschoice", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("quizquestionschoice_quizquestions_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("quizquestionschoice_quizquestions_id_foreign");
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
