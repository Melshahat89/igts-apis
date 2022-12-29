<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessdatabusinessdomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("businessdomains", "businessdata_id"))
		{
	Schema::table("businessdomains", function (Blueprint $table)  {
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
		if (Schema::hasColumn("businessdomains", "businessdata_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("businessdomains");
			Schema::table("businessdomains", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("businessdomains_businessdata_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("businessdomains_businessdata_id_foreign");
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
