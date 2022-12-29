<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourselectureslecturequestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("lecturequestions", "courselectures_id"))
		{
	Schema::table("lecturequestions", function (Blueprint $table)  {
		$table->integer("courselectures_id")->unsigned();

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
		if (Schema::hasColumn("lecturequestions", "courselectures_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("lecturequestions");
			Schema::table("lecturequestions", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("lecturequestions_courselectures_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("lecturequestions_courselectures_id_foreign");
					$table->dropColumn("courselectures_id");
				}else{
					$table->dropColumn("courselectures_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
