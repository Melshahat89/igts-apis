<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderspaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("payments", "orders_id"))
		{
	Schema::table("payments", function (Blueprint $table)  {
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
		if (Schema::hasColumn("payments", "orders_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("payments");
			Schema::table("payments", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("payments_orders_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("payments_orders_id_foreign");
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
