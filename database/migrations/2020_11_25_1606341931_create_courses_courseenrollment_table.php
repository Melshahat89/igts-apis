<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursescourseenrollmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("courseenrollment", "courses_id"))
		{
	Schema::table("courseenrollment", function (Blueprint $table)  {
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
		if (Schema::hasColumn("courseenrollment", "courses_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("courseenrollment");
			Schema::table("courseenrollment", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("courseenrollment_courses_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("courseenrollment_courses_id_foreign");
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
