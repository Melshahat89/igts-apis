<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessgroupsbusinessgroupsusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("businessgroupsusers", "businessgroups_id"))
		{
	Schema::table("businessgroupsusers", function (Blueprint $table)  {
		$table->integer("businessgroups_id")->unsigned();

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
		if (Schema::hasColumn("businessgroupsusers", "businessgroups_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("businessgroupsusers");
			Schema::table("businessgroupsusers", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("businessgroupsusers_businessgroups_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("businessgroupsusers_businessgroups_id_foreign");
					$table->dropColumn("businessgroups_id");
				}else{
					$table->dropColumn("businessgroups_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
