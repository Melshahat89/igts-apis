<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesectionsquizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("quiz", "coursesections_id"))
		{
	Schema::table("quiz", function (Blueprint $table)  {
		$table->integer("coursesections_id")->unsigned();

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
		if (Schema::hasColumn("quiz", "coursesections_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("quiz");
			Schema::table("quiz", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("quiz_coursesections_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("quiz_coursesections_id_foreign");
					$table->dropColumn("coursesections_id");
				}else{
					$table->dropColumn("coursesections_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
