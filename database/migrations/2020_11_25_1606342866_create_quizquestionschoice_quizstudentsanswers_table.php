<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizquestionschoicequizstudentsanswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("quizstudentsanswers", "quizquestionschoice_id"))
		{
	Schema::table("quizstudentsanswers", function (Blueprint $table)  {
		$table->integer("quizquestionschoice_id")->unsigned();

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
		if (Schema::hasColumn("quizstudentsanswers", "quizquestionschoice_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("quizstudentsanswers");
			Schema::table("quizstudentsanswers", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("quizstudentsanswers_quizquestionschoice_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("quizstudentsanswers_quizquestionschoice_id_foreign");
					$table->dropColumn("quizquestionschoice_id");
				}else{
					$table->dropColumn("quizquestionschoice_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
