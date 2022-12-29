<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessdatabusinesscoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("businesscourses", "businessdata_id"))
		{
	Schema::table("businesscourses", function (Blueprint $table)  {
		$table->integer("businessdata_id")->unsigned();

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
		if (Schema::hasColumn("businesscourses", "businessdata_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("businesscourses");
			Schema::table("businesscourses", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("businesscourses_businessdata_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("businesscourses_businessdata_id_foreign");
					$table->dropColumn("businessdata_id");
				}else{
					$table->dropColumn("businessdata_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
