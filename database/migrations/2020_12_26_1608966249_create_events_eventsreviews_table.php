<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventseventsreviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("eventsreviews", "events_id"))
		{
	Schema::table("eventsreviews", function (Blueprint $table)  {
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
		if (Schema::hasColumn("eventsreviews", "events_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("eventsreviews");
			Schema::table("eventsreviews", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("eventsreviews_events_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("eventsreviews_events_id_foreign");
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
