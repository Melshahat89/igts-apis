<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderspromotionusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("promotionusers", "orders_id"))
		{
	Schema::table("promotionusers", function (Blueprint $table)  {
		$table->integer("orders_id")->unsigned();

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
		if (Schema::hasColumn("promotionusers", "orders_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("promotionusers");
			Schema::table("promotionusers", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("promotionusers_orders_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("promotionusers_orders_id_foreign");
					$table->dropColumn("orders_id");
				}else{
					$table->dropColumn("orders_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
