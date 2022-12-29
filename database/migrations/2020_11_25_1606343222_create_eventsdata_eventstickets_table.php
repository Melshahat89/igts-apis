<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsdataeventsticketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("eventstickets", "eventsdata_id"))
		{
	Schema::table("eventstickets", function (Blueprint $table)  {
		$table->integer("eventsdata_id")->unsigned();

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
		if (Schema::hasColumn("eventstickets", "eventsdata_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("eventstickets");
			Schema::table("eventstickets", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("eventstickets_eventsdata_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("eventstickets_eventsdata_id_foreign");
					$table->dropColumn("eventsdata_id");
				}else{
					$table->dropColumn("eventsdata_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
