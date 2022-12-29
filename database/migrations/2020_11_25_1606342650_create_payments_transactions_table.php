<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentstransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    		if (!Schema::hasColumn("transactions", "payments_id"))
		{
	Schema::table("transactions", function (Blueprint $table)  {
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
		if (Schema::hasColumn("transactions", "payments_id"))
		{
			$arrayOfKeys = $this->listTableForeignKeys("transactions");
			Schema::table("transactions", function ($table) use ($arrayOfKeys) {
			Schema::disableForeignKeyConstraints();
				if(in_array("transactions_payments_id_foreign" , $arrayOfKeys)){
					$table->dropForeign("transactions_payments_id_foreign");
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
