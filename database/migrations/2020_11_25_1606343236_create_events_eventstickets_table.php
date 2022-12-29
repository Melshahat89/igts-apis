<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventseventsticketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("eventstickets", "events_id"))
		{
	Schema::table("eventstickets", function (Blueprint $table)  {
		$table->integer("events_id")->unsigned();

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
		if (Schema::hasColumn("eventstickets", "events_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("eventstickets");
			Schema::table("eventstickets", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("eventstickets_events_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("eventstickets_events_id_foreign");
					$table->dropColumn("events_id");
				}else{
					$table->dropColumn("events_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
