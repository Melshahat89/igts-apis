<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("orders", "payments_id"))
		{
	Schema::table("orders", function (Blueprint $table)  {
		$table->integer("payments_id")->unsigned();

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
		if (Schema::hasColumn("orders", "payments_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("orders");
			Schema::table("orders", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("orders_payments_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("orders_payments_id_foreign");
					$table->dropColumn("payments_id");
				}else{
					$table->dropColumn("payments_id");
				}
			Schema::enableForeignKeyConstraints();
			});
		}
		Schema::enableForeignKeyConstraints();

    }
}
