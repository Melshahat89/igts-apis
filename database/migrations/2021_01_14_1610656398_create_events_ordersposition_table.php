<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsorderspositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("ordersposition", "events_id"))
		{
	Schema::table("ordersposition", function (Blueprint $table)  {
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
		if (Schema::hasColumn("ordersposition", "events_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("ordersposition");
			Schema::table("ordersposition", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("ordersposition_events_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("ordersposition_events_id_foreign");
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
