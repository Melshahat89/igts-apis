<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventstransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("transactions", "events_id"))
		{
	Schema::table("transactions", function (Blueprint $table)  {
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
		if (Schema::hasColumn("transactions", "events_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("transactions");
			Schema::table("transactions", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("transactions_events_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("transactions_events_id_foreign");
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
