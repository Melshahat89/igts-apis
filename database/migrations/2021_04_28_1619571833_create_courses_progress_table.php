<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesprogressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("progress", "courses_id"))
		{
	Schema::table("progress", function (Blueprint $table)  {
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
		if (Schema::hasColumn("progress", "courses_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("progress");
			Schema::table("progress", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("progress_courses_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("progress_courses_id_foreign");
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
