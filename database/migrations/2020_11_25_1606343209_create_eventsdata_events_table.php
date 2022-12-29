<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsdataeventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("events", "eventsdata_id"))
		{
	Schema::table("events", function (Blueprint $table)  {
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
		if (Schema::hasColumn("events", "eventsdata_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("events");
			Schema::table("events", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("events_eventsdata_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("events_eventsdata_id_foreign");
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
