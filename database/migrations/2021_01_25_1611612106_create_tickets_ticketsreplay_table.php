<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsticketsreplayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("ticketsreplay", "tickets_id"))
		{
	Schema::table("ticketsreplay", function (Blueprint $table)  {
		$table->integer("tickets_id")->unsigned();

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
		if (Schema::hasColumn("ticketsreplay", "tickets_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("ticketsreplay");
			Schema::table("ticketsreplay", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("ticketsreplay_tickets_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("ticketsreplay_tickets_id_foreign");
					$table->dropColumn("tickets_id");
				}else{
					$table->dropColumn("tickets_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
