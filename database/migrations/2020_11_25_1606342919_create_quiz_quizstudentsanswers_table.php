<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizquizstudentsanswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("quizstudentsanswers", "quiz_id"))
		{
	Schema::table("quizstudentsanswers", function (Blueprint $table)  {
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
		if (Schema::hasColumn("quizstudentsanswers", "quiz_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("quizstudentsanswers");
			Schema::table("quizstudentsanswers", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("quizstudentsanswers_quiz_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("quizstudentsanswers_quiz_id_foreign");
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
