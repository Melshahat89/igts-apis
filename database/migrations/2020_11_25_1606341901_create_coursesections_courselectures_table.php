<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesectionscourselecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("courselectures", "coursesections_id"))
		{
	Schema::table("courselectures", function (Blueprint $table)  {
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
		if (Schema::hasColumn("courselectures", "coursesections_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("courselectures");
			Schema::table("courselectures", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("courselectures_coursesections_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("courselectures_coursesections_id_foreign");
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
