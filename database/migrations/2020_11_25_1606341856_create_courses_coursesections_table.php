<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursescoursesectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("coursesections", "courses_id"))
		{
	Schema::table("coursesections", function (Blueprint $table)  {
		$table->integer("courses_id")->unsigned();

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
		if (Schema::hasColumn("coursesections", "courses_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("coursesections");
			Schema::table("coursesections", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("coursesections_courses_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("coursesections_courses_id_foreign");
					$table->dropColumn("courses_id");
				}else{
					$table->dropColumn("courses_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
