<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserquizstudentsanswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("quizstudentsanswers", "user_id"))
		{
	Schema::table("quizstudentsanswers", function (Blueprint $table)  {
		$table->integer("user_id")->unsigned();

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
		if (Schema::hasColumn("quizstudentsanswers", "user_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("quizstudentsanswers");
			Schema::table("quizstudentsanswers", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("quizstudentsanswers_user_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("quizstudentsanswers_user_id_foreign");
					$table->dropColumn("user_id");
				}else{
					$table->dropColumn("user_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
