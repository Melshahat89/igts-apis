<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessdatabusinessgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("businessgroups", "businessdata_id"))
		{
	Schema::table("businessgroups", function (Blueprint $table)  {
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
		if (Schema::hasColumn("businessgroups", "businessdata_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("businessgroups");
			Schema::table("businessgroups", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("businessgroups_businessdata_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("businessgroups_businessdata_id_foreign");
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
