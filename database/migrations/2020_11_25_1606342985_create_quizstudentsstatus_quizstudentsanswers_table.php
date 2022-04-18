<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizstudentsstatusquizstudentsanswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("quizstudentsanswers", "quizstudentsstatus_id"))
		{
	Schema::table("quizstudentsanswers", function (Blueprint $table)  {
		$table->integer("quizstudentsstatus_id")->unsigned();

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
		if (Schema::hasColumn("quizstudentsanswers", "quizstudentsstatus_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("quizstudentsanswers");
			Schema::table("quizstudentsanswers", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("quizstudentsanswers_quizstudentsstatus_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("quizstudentsanswers_quizstudentsstatus_id_foreign");
					$table->dropColumn("quizstudentsstatus_id");
				}else{
					$table->dropColumn("quizstudentsstatus_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
