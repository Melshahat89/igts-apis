<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizquizstudentsstatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("quizstudentsstatus", "quiz_id"))
		{
	Schema::table("quizstudentsstatus", function (Blueprint $table)  {
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
		if (Schema::hasColumn("quizstudentsstatus", "quiz_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("quizstudentsstatus");
			Schema::table("quizstudentsstatus", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("quizstudentsstatus_quiz_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("quizstudentsstatus_quiz_id_foreign");
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
