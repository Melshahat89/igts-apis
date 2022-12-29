<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserticketsreplayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("ticketsreplay", "user_id"))
		{
	Schema::table("ticketsreplay", function (Blueprint $table)  {
		$table->integer("user_id")->unsigned();

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
		if (Schema::hasColumn("ticketsreplay", "user_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("ticketsreplay");
			Schema::table("ticketsreplay", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("ticketsreplay_user_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("ticketsreplay_user_id_foreign");
					$table->dropColumn("user_id");
				}else{
					$table->dropColumn("user_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
