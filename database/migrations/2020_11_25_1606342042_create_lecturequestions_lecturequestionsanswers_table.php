<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturequestionslecturequestionsanswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("lecturequestionsanswers", "lecturequestions_id"))
		{
	Schema::table("lecturequestionsanswers", function (Blueprint $table)  {
		$table->integer("lecturequestions_id")->unsigned();

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
		if (Schema::hasColumn("lecturequestionsanswers", "lecturequestions_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("lecturequestionsanswers");
			Schema::table("lecturequestionsanswers", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("lecturequestionsanswers_lecturequestions_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("lecturequestionsanswers_lecturequestions_id_foreign");
					$table->dropColumn("lecturequestions_id");
				}else{
					$table->dropColumn("lecturequestions_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
